<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SiteSetting extends Model
{
    public const CACHE_KEY = 'site_settings.all.v2';

    public const PLATFORMS = [
        'youtube' => 'YouTube',
        'facebook' => 'Facebook',
        'x' => 'X (Twitter)',
    ];

    protected $fillable = [
        'key',
        'value',
    ];

    public static function defaults(): array
    {
        return [
            'contact_email' => 'info@integratedrehabandphysicaltherapy.com',
            'footer_social_links' => json_encode([
                [
                    'platform' => 'youtube',
                    'url' => 'https://www.youtube.com/channel/UCjefZ2BUdISkZocxflvX7rg',
                    'label' => 'YouTube channel 1',
                ],
                [
                    'platform' => 'youtube',
                    'url' => 'https://www.youtube.com/channel/UCBkbWDELkJXLDjN8f9502Fg',
                    'label' => 'YouTube channel 2',
                ],
                [
                    'platform' => 'youtube',
                    'url' => 'https://www.youtube.com/channel/UCBkbWDELkJXLDjN8f9502Fg',
                    'label' => 'YouTube channel 3',
                ],
                [
                    'platform' => 'x',
                    'url' => 'https://x.com/IRPTherapy',
                    'label' => 'X (formerly Twitter)',
                ],
                [
                    'platform' => 'facebook',
                    'url' => 'https://www.facebook.com/groups/500487627976587/',
                    'label' => 'Facebook group',
                ],
                [
                    'platform' => 'facebook',
                    'url' => 'https://www.facebook.com/American-Manual-Therapy-Academy-103817865175599/',
                    'label' => 'American Manual Therapy Academy on Facebook',
                ],
            ]),
            'awards_social_links' => json_encode([
                [
                    'platform' => 'facebook',
                    'url' => 'https://www.facebook.com/IRPTherapy',
                    'label' => 'Facebook',
                ],
                [
                    'platform' => 'x',
                    'url' => 'https://x.com/IRPTherapy',
                    'label' => 'X (formerly Twitter)',
                ],
                [
                    'platform' => 'youtube',
                    'url' => 'https://www.youtube.com/channel/UCjefZ2BUdISkZocxflvX7rg',
                    'label' => 'YouTube',
                ],
            ]),
        ];
    }

    public static function allCached(): array
    {
        return Cache::rememberForever(self::CACHE_KEY, function () {
            $stored = static::query()->pluck('value', 'key')->all();
            $merged = array_merge(static::defaults(), $stored);

            return static::normalizeSettings($merged);
        });
    }

    public static function socialLinks(string $key): array
    {
        $settings = static::allCached();

        return $settings[$key] ?? [];
    }

    public static function setMany(array $values): void
    {
        foreach ($values as $key => $value) {
            if (is_array($value)) {
                $value = json_encode(array_values($value));
            }

            static::query()->updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        // Drop legacy fixed URL keys if they still exist.
        static::query()->whereIn('key', [
            'youtube_url_1',
            'youtube_url_2',
            'youtube_url_3',
            'x_url',
            'facebook_group_url',
            'facebook_academy_url',
            'facebook_page_url',
        ])->delete();

        Cache::forget(self::CACHE_KEY);
    }

    public static function normalizeSocialLinks(mixed $value): array
    {
        if (is_string($value)) {
            $decoded = json_decode($value, true);
            $value = is_array($decoded) ? $decoded : [];
        }

        if (! is_array($value)) {
            return [];
        }

        $platforms = array_keys(self::PLATFORMS);

        return collect($value)
            ->map(function ($item) use ($platforms) {
                if (! is_array($item)) {
                    return null;
                }

                $platform = strtolower(trim((string) ($item['platform'] ?? '')));
                $url = trim((string) ($item['url'] ?? ''));
                $label = trim((string) ($item['label'] ?? ''));

                if ($url === '' || ! in_array($platform, $platforms, true)) {
                    return null;
                }

                if ($label === '') {
                    $label = self::PLATFORMS[$platform];
                }

                return [
                    'platform' => $platform,
                    'url' => $url,
                    'label' => $label,
                ];
            })
            ->filter()
            ->values()
            ->all();
    }

    private static function normalizeSettings(array $settings): array
    {
        // Migrate older fixed keys if dynamic lists are not saved yet.
        if (! array_key_exists('footer_social_links', $settings)
            || (is_string($settings['footer_social_links'] ?? null)
                && trim((string) $settings['footer_social_links']) === '')) {
            $settings['footer_social_links'] = static::legacyFooterLinks($settings);
        }

        if (! array_key_exists('awards_social_links', $settings)
            || (is_string($settings['awards_social_links'] ?? null)
                && trim((string) $settings['awards_social_links']) === '')) {
            $settings['awards_social_links'] = static::legacyAwardsLinks($settings);
        }

        $settings['footer_social_links'] = static::normalizeSocialLinks($settings['footer_social_links'] ?? []);
        $settings['awards_social_links'] = static::normalizeSocialLinks($settings['awards_social_links'] ?? []);

        return $settings;
    }

    private static function legacyFooterLinks(array $settings): array
    {
        $map = [
            'youtube_url_1' => ['platform' => 'youtube', 'label' => 'YouTube channel 1'],
            'youtube_url_2' => ['platform' => 'youtube', 'label' => 'YouTube channel 2'],
            'youtube_url_3' => ['platform' => 'youtube', 'label' => 'YouTube channel 3'],
            'x_url' => ['platform' => 'x', 'label' => 'X (formerly Twitter)'],
            'facebook_group_url' => ['platform' => 'facebook', 'label' => 'Facebook group'],
            'facebook_academy_url' => ['platform' => 'facebook', 'label' => 'American Manual Therapy Academy on Facebook'],
        ];

        $links = [];
        foreach ($map as $key => $meta) {
            $url = trim((string) ($settings[$key] ?? ''));
            if ($url !== '') {
                $links[] = [
                    'platform' => $meta['platform'],
                    'url' => $url,
                    'label' => $meta['label'],
                ];
            }
        }

        return $links;
    }

    private static function legacyAwardsLinks(array $settings): array
    {
        $links = [];

        $facebook = trim((string) ($settings['facebook_page_url'] ?? ''));
        if ($facebook !== '') {
            $links[] = [
                'platform' => 'facebook',
                'url' => $facebook,
                'label' => 'Facebook',
            ];
        }

        $x = trim((string) ($settings['x_url'] ?? ''));
        if ($x !== '') {
            $links[] = [
                'platform' => 'x',
                'url' => $x,
                'label' => 'X (formerly Twitter)',
            ];
        }

        $youtube = trim((string) ($settings['youtube_url_1'] ?? ''));
        if ($youtube !== '') {
            $links[] = [
                'platform' => 'youtube',
                'url' => $youtube,
                'label' => 'YouTube',
            ];
        }

        return $links;
    }
}
