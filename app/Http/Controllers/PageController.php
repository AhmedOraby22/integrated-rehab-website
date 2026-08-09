<?php

namespace App\Http\Controllers;

use App\Models\TestimonialMedia;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function about()
    {
        return view('about');
    }

    public function services()
    {
        return view('services');
    }

    public function locations()
    {
        return view('locations');
    }

    public function insurance()
    {
        return view('insurance');
    }

    public function testimonialReviews(Request $request)
    {
        $all = collect(config('patient_reviews', []));
        $perPage = 5;
        $page = max(1, (int) $request->query('page', 1));
        $total = $all->count();
        $lastPage = max(1, (int) ceil($total / $perPage));
        $page = min($page, $lastPage);

        $reviews = new LengthAwarePaginator(
            $all->forPage($page, $perPage)->values(),
            $total,
            $perPage,
            $page,
            [
                'path' => $request->url(),
                'query' => $request->query(),
            ]
        );

        return view('testimonials.reviews', compact('reviews'));
    }

    public function testimonialPictures()
    {
        $items = TestimonialMedia::ofType(TestimonialMedia::TYPE_PICTURE)
            ->active()
            ->ordered()
            ->get();

        return view('testimonials.pictures', compact('items'));
    }

    public function testimonialVideos()
    {
        $items = TestimonialMedia::ofType(TestimonialMedia::TYPE_VIDEO)
            ->active()
            ->ordered()
            ->paginate(3)
            ->withQueryString();

        return view('testimonials.videos', compact('items'));
    }

    public function testimonialAudio()
    {
        $items = TestimonialMedia::ofType(TestimonialMedia::TYPE_AUDIO)
            ->active()
            ->ordered()
            ->get();

        return view('testimonials.audio', compact('items'));
    }
}
