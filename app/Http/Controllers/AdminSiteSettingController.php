<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminSiteSettingController extends Controller
{
    public function edit()
    {
        $settings = SiteSetting::allCached();
        $platforms = SiteSetting::PLATFORMS;

        return view('admin.site-settings.edit', compact('settings', 'platforms'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'contact_email' => ['required', 'email', 'max:255'],
            'footer_links' => ['nullable', 'array'],
            'footer_links.*.platform' => ['required_with:footer_links.*.url', Rule::in(array_keys(SiteSetting::PLATFORMS))],
            'footer_links.*.url' => ['nullable', 'url', 'max:500'],
            'footer_links.*.label' => ['nullable', 'string', 'max:120'],
            'awards_links' => ['nullable', 'array'],
            'awards_links.*.platform' => ['required_with:awards_links.*.url', Rule::in(array_keys(SiteSetting::PLATFORMS))],
            'awards_links.*.url' => ['nullable', 'url', 'max:500'],
            'awards_links.*.label' => ['nullable', 'string', 'max:120'],
        ]);

        SiteSetting::setMany([
            'contact_email' => $data['contact_email'],
            'footer_social_links' => SiteSetting::normalizeSocialLinks($data['footer_links'] ?? []),
            'awards_social_links' => SiteSetting::normalizeSocialLinks($data['awards_links'] ?? []),
        ]);

        return redirect()
            ->route('admin.site-settings.edit')
            ->with('status', 'Contact and social links updated successfully.');
    }
}
