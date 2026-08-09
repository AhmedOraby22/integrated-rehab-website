<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceHighlight extends Model
{
    protected $fillable = [
        'title',
        'bullets',
        'cta_label',
        'image',
        'sort_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'bullets' => 'array',
        ];
    }

    public function getImageUrlAttribute(): string
    {
        if (str_starts_with($this->image, 'http://') || str_starts_with($this->image, 'https://')) {
            return $this->image;
        }

        return asset('storage/'.$this->image);
    }

    public function getButtonLabelAttribute(): string
    {
        return $this->cta_label ?: ($this->title.' Service');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }
}
