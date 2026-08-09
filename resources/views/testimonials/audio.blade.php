@extends('layouts.app')

@section('title', 'Audio Testimonials — Integrated Rehab and Physical Therapy P.C.')
@section('meta_description', 'Listen to audio patient testimonials from Integrated Rehab and Physical Therapy P.C. in Brooklyn, NY.')

@section('content')

  <section class="section" style="padding-top:56px;">
    <div class="container">
      <div class="section-header">
        <span class="eyebrow">Testimonials</span>
        <h1>Audio testimonials</h1>
        <p>Listen to patients describe their recovery journeys in their own words.</p>
      </div>

      @if ($items->isEmpty())
        <div class="card" style="max-width:760px;">
          <h3>Audio clips coming soon</h3>
          <p>Patient audio testimonials will appear here. Until then, you can read written reviews
            or watch video stories from our patients.</p>
          <div style="display:flex; flex-wrap:wrap; gap:12px; margin-top:12px;">
            <a href="{{ route('testimonials.reviews') }}" class="btn btn-dark">Read reviews</a>
            <a href="{{ route('testimonials.videos') }}" class="btn btn-primary">Watch videos</a>
          </div>
        </div>
      @else
        <div class="media-gallery media-gallery-audio">
          @foreach ($items as $item)
            <div class="media-card media-card-audio">
              @if ($item->title)
                <h3>{{ $item->title }}</h3>
              @else
                <h3>Audio testimonial</h3>
              @endif
              <audio src="{{ $item->url }}" controls preload="metadata"></audio>
            </div>
          @endforeach
        </div>
      @endif
    </div>
  </section>

@endsection
