<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;

class SiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        $defaults = SiteSetting::defaults();

        // Preserve contact email if already customized.
        $existingEmail = SiteSetting::query()->where('key', 'contact_email')->value('value');
        if ($existingEmail) {
            $defaults['contact_email'] = $existingEmail;
        }

        SiteSetting::setMany($defaults);
        Cache::forget(SiteSetting::CACHE_KEY);
    }
}
