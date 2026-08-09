@extends('layouts.app')

@section('title', 'Videos — Integrated Rehab and Physical Therapy P.C.')
@section('meta_description', 'Watch video testimonials from patients of Integrated Rehab and Physical Therapy P.C. in Brooklyn, NY.')

@section('content')

  <section class="section videos-page" style="padding-top:56px;">
    <div class="container videos-page-inner">
      <div class="videos-page-header">
        <span class="eyebrow">Testimonials</span>
        <h1 class="videos-page-title">Videos</h1>
        @unless ($items->isEmpty())
          <p class="videos-page-intro">
            Patient video testimonials from Integrated Rehab and Physical Therapy.
            @if ($items->total())
              <span class="videos-page-count">{{ number_format($items->total()) }} videos</span>
            @endif
          </p>
        @endunless
      </div>

      @if ($items->isEmpty())
        <div class="card">
          <h3>Videos coming soon</h3>
          <p>Patient video testimonials will appear here. You can also visit our YouTube channels.</p>
          <div style="display:flex; flex-wrap:wrap; gap:12px; margin-top:12px;">
            @php
              $youtubeLink = collect($siteSettings['footer_social_links'] ?? [])
                ->firstWhere('platform', 'youtube');
            @endphp
            @if (! empty($youtubeLink['url']))
              <a href="{{ $youtubeLink['url'] }}" class="btn btn-dark" target="_blank" rel="noopener noreferrer">YouTube channel</a>
            @endif
            <a href="{{ route('contact') }}" class="btn btn-primary">Send Us an Email</a>
          </div>
        </div>
      @else
        <div class="videos-list">
          @foreach ($items as $item)
            <article class="video-embed-card">
              @if ($item->title)
                <h2 class="video-embed-title">{{ $item->title }}</h2>
              @endif
              @if ($item->is_youtube)
                <div class="video-embed-frame">
                  <iframe
                    src="{{ $item->embed_url }}"
                    title="{{ $item->title ?: 'Patient video testimonial' }}"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    referrerpolicy="strict-origin-when-cross-origin"
                    allowfullscreen
                    loading="lazy"
                  ></iframe>
                </div>
              @elseif ($item->url)
                <div class="video-embed-frame">
                  <video src="{{ $item->url }}" controls preload="metadata" playsinline></video>
                </div>
              @endif
            </article>
          @endforeach
        </div>

        @include('partials.videos-pagination')
      @endif
    </div>
  </section>

@endsection
