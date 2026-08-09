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
                'title' => 'Sports Rehabilitation',
                'image' => 'service-highlights/sports.jpg',
                'cta_label' => 'Sports Rehabilitation Service',
                'bullets' => [
                    'Aids quick recovery',
                    'Personalized and expert care',
                    'Prevent re-injury',
                    'Advanced methods to ease pain',
                    'Restore health and full function',
                ],
                'sort_order' => 1,
            ],
            [
                'title' => 'Orthopedic Rehabilitation',
                'image' => 'service-highlights/ortho.jpg',
                'cta_label' => 'Orthopedic Rehabilitation Service',
                'bullets' => [
                    'Regain mobility and live pain-free',
                    'Get personalized care and advanced treatment',
                    'Improve strength and function',
                    'Manage chronic and musculoskeletal pain',
                ],
                'sort_order' => 2,
            ],
            [
                'title' => 'Stroke & Neurological Rehabilitation',
                'image' => 'service-highlights/stroke.jpg',
                'cta_label' => 'Stroke & Neurological Rehabilitation Service',
                'bullets' => [
                    'Restore function and mobility after a stroke',
                    'Improve speech, strength and coordination',
                    'Enhance your quality of life through tailored care',
                ],
                'sort_order' => 3,
            ],
            [
                'title' => 'Vestibular Rehabilitation',
                'image' => 'service-highlights/vestibular.jpg',
                'cta_label' => 'Vestibular Rehabilitation Service',
                'bullets' => [
                    'Restore balance and stability',
                    'Cure dizziness and inner-ear issues',
                    'Improve coordination and balance',
                ],
                'sort_order' => 4,
            ],
            [
                'title' => 'Lymphedema Treatment',
                'image' => 'service-highlights/lymphedema.jpg',
                'cta_label' => 'Lymphedema Treatment Service',
                'bullets' => [
                    'Reduces swelling and improves life quality',
                    'Address fluid build-up in limbs',
                    'Treat primary and secondary lymphedema causes',
                    'Restore independence and manage symptoms',
                ],
                'sort_order' => 5,
            ],
            [
                'title' => 'GAIT Training',
                'image' => 'service-highlights/gait.jpg',
                'cta_label' => 'GAIT Training Service',
                'bullets' => [
                    'Boosts walking, balance and strength',
                    'Aids injury recovery and mobility issues',
                    'Enhances coordination and reduces falls',
                    'Improves endurance and muscle memory',
                ],
                'sort_order' => 6,
            ],
        ];

        ServiceHighlight::query()->delete();

        foreach ($defaults as $item) {
            ServiceHighlight::create([
                'title' => $item['title'],
                'image' => $item['image'],
                'cta_label' => $item['cta_label'],
                'bullets' => $item['bullets'],
                'sort_order' => $item['sort_order'],
                'is_active' => true,
            ]);
        }
    }
}
