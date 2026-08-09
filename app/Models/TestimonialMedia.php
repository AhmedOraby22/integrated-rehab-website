<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestimonialMedia extends Model
{
    public const TYPE_PICTURE = 'picture';
    public const TYPE_VIDEO = 'video';
    public const TYPE_AUDIO = 'audio';

    public const TYPES = [
        self::TYPE_PICTURE,
        self::TYPE_VIDEO,
        self::TYPE_AUDIO,
    ];

    protected $table = 'testimonial_media';

    protected $fillable = [
        'type',
        'title',
        'file_path',
        'external_url',
        'mime_type',
        'file_size',
        'sort_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'file_size' => 'integer',
            'sort_order' => 'integer',
        ];
    }

    public function getUrlAttribute(): ?string
    {
        if ($this->file_path) {
            return asset('storage/'.$this->file_path);
        }

        return $this->external_url;
    }

    public function getYoutubeIdAttribute(): ?string
    {
        return static::extractYoutubeId($this->external_url);
    }

    public function getEmbedUrlAttribute(): ?string
    {
        $id = $this->youtube_id;

        return $id ? 'https://www.youtube.com/embed/'.$id : null;
    }

    public function getIsYoutubeAttribute(): bool
    {
        return $this->type === self::TYPE_VIDEO && filled($this->youtube_id);
    }

    public function getTypeLabelAttribute(): string
    {
        return match ($this->type) {
            self::TYPE_PICTURE => 'Pictures',
            self::TYPE_VIDEO => 'Videos',
            self::TYPE_AUDIO => 'Audio',
            default => ucfirst($this->type),
        };
    }

    public function scopeOfType($query, string $type)
    {
        return $query->where('type', $type);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderByDesc('id');
    }

    public static function extractYoutubeId(?string $url): ?string
    {
        if (! $url) {
            return null;
        }

        $patterns = [
            '/(?:youtube\.com\/watch\?[^#]*v=|youtu\.be\/|youtube\.com\/embed\/|youtube\.com\/shorts\/|youtube\.com\/live\/)([A-Za-z0-9_-]{6,})/i',
            '/(?:youtube\.com\/(?:v|e)\/)([A-Za-z0-9_-]{6,})/i',
        ];

        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $url, $matches)) {
                return $matches[1];
            }
        }

        return null;
    }
}
