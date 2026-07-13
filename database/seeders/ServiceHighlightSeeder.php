<?php

namespace Database\Seeders;

use App\Models\ServiceHighlight;
use Illuminate\Database\Seeder;

class ServiceHighlightSeeder extends Seeder
{
    public function run(): void
    {
        $defaults = [
            [
                'title' => 'Spine and Joint Care',
                'image' => 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?w=600&h=340&fit=crop',
                'sort_order' => 1,
            ],
            [
                'title' => 'Pulmonary Rehabilitation',
                'image' => 'https://images.unsplash.com/photo-1517836357463-d25dfeac3438?w=600&h=340&fit=crop',
                'sort_order' => 2,
            ],
            [
                'title' => 'Cardiac Rehabilitation',
                'image' => 'https://images.unsplash.com/photo-1571019614242-c5c5dee9f50b?w=600&h=340&fit=crop',
                'sort_order' => 3,
            ],
            [
                'title' => 'General Weakness',
                'image' => 'https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?w=600&h=340&fit=crop',
                'sort_order' => 4,
            ],
        ];

        foreach ($defaults as $item) {
            ServiceHighlight::updateOrCreate(
                ['sort_order' => $item['sort_order']],
                [
                    'title' => $item['title'],
                    'image' => $item['image'],
                    'is_active' => true,
                ]
            );
        }
    }
}
