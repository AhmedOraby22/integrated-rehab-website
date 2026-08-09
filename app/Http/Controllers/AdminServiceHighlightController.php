<?php

namespace App\Http\Controllers;

use App\Models\ServiceHighlight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminServiceHighlightController extends Controller
{
    public function edit()
    {
        $highlights = ServiceHighlight::ordered()->get();

        return view('admin.service-highlights.edit', compact('highlights'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'highlights' => ['required', 'array'],
            'highlights.*.id' => ['required', 'exists:service_highlights,id'],
            'highlights.*.title' => ['required', 'string', 'max:120'],
            'highlights.*.cta_label' => ['nullable', 'string', 'max:160'],
            'highlights.*.bullets' => ['nullable', 'string', 'max:2000'],
            'highlights.*.is_active' => ['nullable', 'boolean'],
            'highlights.*.image' => ['nullable', 'image', 'max:4096'],
        ]);

        foreach ($data['highlights'] as $index => $item) {
            $highlight = ServiceHighlight::findOrFail($item['id']);

            $highlight->title = $item['title'];
            $highlight->cta_label = $item['cta_label'] ?: null;
            $highlight->is_active = ! empty($item['is_active']);
            $highlight->bullets = $this->parseBullets($item['bullets'] ?? '');

            if ($request->hasFile("highlights.{$index}.image")) {
                if (! str_starts_with($highlight->image, 'http')) {
                    Storage::disk('public')->delete($highlight->image);
                }

                $highlight->image = $request->file("highlights.{$index}.image")
                    ->store('service-highlights', 'public');
            }

            $highlight->save();
        }

        return redirect()
            ->route('admin.service-highlights.edit')
            ->with('status', 'Service section updated successfully.');
    }

    private function parseBullets(?string $raw): array
    {
        if (! $raw) {
            return [];
        }

        return collect(preg_split('/\r\n|\r|\n/', $raw) ?: [])
            ->map(fn ($line) => trim($line))
            ->filter()
            ->values()
            ->all();
    }
}
