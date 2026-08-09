<?php

namespace App\Http\Controllers;

use App\Models\TestimonialMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class AdminTestimonialMediaController extends Controller
{
    public function index(string $type)
    {
        abort_unless(in_array($type, TestimonialMedia::TYPES, true), 404);

        $items = TestimonialMedia::ofType($type)->ordered()->get();

        return view('admin.testimonial-media.index', [
            'type' => $type,
            'typeLabel' => $this->typeLabel($type),
            'items' => $items,
            'accept' => $this->acceptAttribute($type),
            'hint' => $this->uploadHint($type),
        ]);
    }

    public function store(Request $request, string $type)
    {
        abort_unless(in_array($type, TestimonialMedia::TYPES, true), 404);

        if ($type === TestimonialMedia::TYPE_VIDEO) {
            return $this->storeYoutubeVideo($request);
        }

        $rules = [
            'title' => ['nullable', 'string', 'max:160'],
            'is_active' => ['nullable', 'boolean'],
            'file' => array_merge(['required', 'file'], $this->fileRules($type)),
        ];

        $data = $request->validate($rules);

        $file = $request->file('file');
        $directory = 'testimonials/'.$type.'s';
        $path = $file->store($directory, 'public');

        if (! $path) {
            return back()
                ->withInput()
                ->withErrors(['file' => 'Upload failed. Please try again.']);
        }

        $nextOrder = (int) TestimonialMedia::ofType($type)->max('sort_order') + 1;

        TestimonialMedia::create([
            'type' => $type,
            'title' => $data['title'] ?? null,
            'file_path' => $path,
            'mime_type' => $file->getMimeType(),
            'file_size' => $file->getSize(),
            'sort_order' => $nextOrder,
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()
            ->route('admin.testimonial-media.index', $type)
            ->with('status', $this->typeLabel($type).' uploaded successfully.');
    }

    public function update(Request $request, TestimonialMedia $media)
    {
        $rules = [
            'title' => ['nullable', 'string', 'max:160'],
            'is_active' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:9999'],
        ];

        if ($media->type === TestimonialMedia::TYPE_VIDEO) {
            $rules['external_url'] = ['nullable', 'url', 'max:500'];
        }

        $data = $request->validate($rules);

        if ($media->type === TestimonialMedia::TYPE_VIDEO && filled($data['external_url'] ?? null)) {
            $youtubeId = TestimonialMedia::extractYoutubeId($data['external_url']);
            if (! $youtubeId) {
                throw ValidationException::withMessages([
                    'external_url' => 'Please enter a valid YouTube video URL.',
                ]);
            }
            $media->external_url = $data['external_url'];
            $media->file_path = null;
            $media->mime_type = 'video/youtube';
        }

        $media->title = $data['title'] ?? null;
        $media->is_active = $request->boolean('is_active');
        if (array_key_exists('sort_order', $data) && $data['sort_order'] !== null) {
            $media->sort_order = $data['sort_order'];
        }
        $media->save();

        return redirect()
            ->route('admin.testimonial-media.index', $media->type)
            ->with('status', 'Item updated successfully.');
    }

    public function destroy(TestimonialMedia $media)
    {
        $type = $media->type;

        if ($media->file_path) {
            Storage::disk('public')->delete($media->file_path);
        }
        $media->delete();

        return redirect()
            ->route('admin.testimonial-media.index', $type)
            ->with('status', 'Item deleted successfully.');
    }

    private function storeYoutubeVideo(Request $request)
    {
        $data = $request->validate([
            'title' => ['nullable', 'string', 'max:160'],
            'external_url' => ['required', 'url', 'max:500'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $youtubeId = TestimonialMedia::extractYoutubeId($data['external_url']);
        if (! $youtubeId) {
            throw ValidationException::withMessages([
                'external_url' => 'Please enter a valid YouTube video URL.',
            ]);
        }

        $nextOrder = (int) TestimonialMedia::ofType(TestimonialMedia::TYPE_VIDEO)->max('sort_order') + 1;

        TestimonialMedia::create([
            'type' => TestimonialMedia::TYPE_VIDEO,
            'title' => $data['title'] ?? null,
            'file_path' => null,
            'external_url' => $data['external_url'],
            'mime_type' => 'video/youtube',
            'file_size' => null,
            'sort_order' => $nextOrder,
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()
            ->route('admin.testimonial-media.index', TestimonialMedia::TYPE_VIDEO)
            ->with('status', 'YouTube video added successfully.');
    }

    private function fileRules(string $type): array
    {
        return match ($type) {
            TestimonialMedia::TYPE_PICTURE => [
                'image',
                'mimes:jpg,jpeg,png,webp,gif',
                'max:5120',
            ],
            TestimonialMedia::TYPE_AUDIO => [
                'mimetypes:audio/mpeg,audio/mp3,audio/wav,audio/x-wav,audio/mp4,audio/x-m4a,audio/aac,audio/ogg',
                'mimes:mp3,wav,m4a,aac,ogg',
                'max:20480',
            ],
            default => [Rule::in([])],
        };
    }

    private function acceptAttribute(string $type): string
    {
        return match ($type) {
            TestimonialMedia::TYPE_PICTURE => 'image/jpeg,image/png,image/webp,image/gif',
            TestimonialMedia::TYPE_AUDIO => 'audio/mpeg,audio/wav,audio/mp4,audio/aac,audio/ogg',
            default => '*/*',
        };
    }

    private function uploadHint(string $type): string
    {
        return match ($type) {
            TestimonialMedia::TYPE_PICTURE => 'JPG, PNG, WebP, or GIF. Max 5 MB.',
            TestimonialMedia::TYPE_VIDEO => 'Paste a full YouTube link, e.g. https://www.youtube.com/watch?v=...',
            TestimonialMedia::TYPE_AUDIO => 'MP3, WAV, M4A, AAC, or OGG. Max 20 MB.',
            default => '',
        };
    }

    private function typeLabel(string $type): string
    {
        return match ($type) {
            TestimonialMedia::TYPE_PICTURE => 'Picture',
            TestimonialMedia::TYPE_VIDEO => 'Video',
            TestimonialMedia::TYPE_AUDIO => 'Audio',
            default => ucfirst($type),
        };
    }
}
