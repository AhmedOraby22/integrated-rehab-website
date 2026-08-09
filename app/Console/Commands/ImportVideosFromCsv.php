<?php

namespace App\Console\Commands;

use App\Models\TestimonialMedia;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class ImportVideosFromCsv extends Command
{
    protected $signature = 'videos:import-csv {path=videos.csv : Path to CSV file} {--fresh : Delete existing videos first}';

    protected $description = 'Import YouTube videos with titles from a CSV file';

    public function handle(): int
    {
        $path = $this->argument('path');
        if (! is_file($path)) {
            $path = base_path($path);
        }

        if (! is_file($path)) {
            $this->error("File not found: {$path}");

            return self::FAILURE;
        }

        $rows = $this->parseCsv($path);
        if ($rows === []) {
            $this->error('No valid YouTube URLs found in CSV.');

            return self::FAILURE;
        }

        if ($this->option('fresh')) {
            $deleted = TestimonialMedia::ofType(TestimonialMedia::TYPE_VIDEO)->delete();
            $this->info("Deleted {$deleted} existing video(s).");
        }

        $imported = 0;
        $skipped = 0;

        foreach ($rows as $index => $row) {
            $youtubeId = TestimonialMedia::extractYoutubeId($row['url']);
            if (! $youtubeId) {
                $this->warn("Skipping invalid URL: {$row['url']}");
                $skipped++;

                continue;
            }

            $title = $this->normalizeTitle($row['title'], $row['url']);

            TestimonialMedia::create([
                'type' => TestimonialMedia::TYPE_VIDEO,
                'title' => $title,
                'file_path' => null,
                'external_url' => $row['url'],
                'mime_type' => 'video/youtube',
                'file_size' => null,
                'sort_order' => $index + 1,
                'is_active' => true,
            ]);

            $imported++;
        }

        $this->info("Imported {$imported} video(s)." . ($skipped ? " Skipped {$skipped}." : ''));

        return self::SUCCESS;
    }

    /**
     * @return list<array{title: string, url: string}>
     */
    private function parseCsv(string $path): array
    {
        $contents = file_get_contents($path);
        if ($contents === false) {
            return [];
        }

        $contents = preg_replace('/^\xEF\xBB\xBF/', '', $contents) ?? $contents;
        $lines = preg_split('/\R/', $contents) ?: [];
        $rows = [];
        $seen = [];

        foreach ($lines as $line) {
            $line = trim($line);
            if ($line === '') {
                continue;
            }

            if (! preg_match('/(https?:\/\/(?:www\.)?youtube\.com\/(?:watch\?(?:[^,\s]*&)?v=|shorts\/|embed\/|live\/)[A-Za-z0-9_-]+|https?:\/\/youtu\.be\/[A-Za-z0-9_-]+)/i', $line, $matches)) {
                continue;
            }

            $url = $matches[1];
            $youtubeId = TestimonialMedia::extractYoutubeId($url);
            if (! $youtubeId || isset($seen[$youtubeId])) {
                continue;
            }

            $seen[$youtubeId] = true;
            $title = trim(str_replace($url, '', $line), " \t,");

            $rows[] = [
                'title' => $title,
                'url' => $this->normalizeYoutubeUrl($url),
            ];
        }

        return $rows;
    }

    private function normalizeYoutubeUrl(string $url): string
    {
        $id = TestimonialMedia::extractYoutubeId($url);
        if (! $id) {
            return $url;
        }

        if (str_contains($url, '/shorts/')) {
            return 'https://www.youtube.com/shorts/'.$id;
        }

        return 'https://www.youtube.com/watch?v='.$id;
    }

    private function normalizeTitle(string $title, string $url): ?string
    {
        $title = trim(preg_replace('/\s+/', ' ', $title) ?? $title);

        if ($this->isUsableTitle($title)) {
            return mb_substr($title, 0, 160);
        }

        $fetched = $this->fetchYoutubeTitle($url);
        if ($fetched) {
            return mb_substr($fetched, 0, 160);
        }

        return null;
    }

    private function isUsableTitle(string $title): bool
    {
        if ($title === '') {
            return false;
        }

        if (preg_match('/^[\s\.,]+$/', $title)) {
            return false;
        }

        if (preg_match('/^\d{1,2}-[A-Za-z]{3}$/i', $title)) {
            return false;
        }

        if (preg_match('/^\d{1,2}-[A-Za-z]{3},\d{4}$/i', $title)) {
            return false;
        }

        if (preg_match('/^\d{4}$/', $title)) {
            return false;
        }

        if (preg_match('/^\d+d$/i', $title)) {
            return false;
        }

        return true;
    }

    private function fetchYoutubeTitle(string $url): ?string
    {
        try {
            $response = Http::timeout(8)->get('https://www.youtube.com/oembed', [
                'url' => $url,
                'format' => 'json',
            ]);

            if ($response->successful()) {
                $title = trim((string) $response->json('title', ''));

                return $title !== '' ? $title : null;
            }
        } catch (\Throwable) {
            // Fall back to null title.
        }

        return null;
    }
}
