@extends('layouts.app')

@section('title', 'Pictures — Integrated Rehab and Physical Therapy P.C.')
@section('meta_description', 'Photo highlights from Integrated Rehab and Physical Therapy P.C. clinics and patient care in Brooklyn, NY.')

@section('content')

  <section class="section" style="padding-top:56px;">
    <div class="container">
      <div class="section-header">
        <span class="eyebrow">Testimonials</span>
        <h1>Pictures</h1>
        <p>A look inside our Brooklyn clinics and the care environment our patients experience.</p>
      </div>

      @if ($items->isEmpty())
        <div class="card" style="max-width:760px;">
          <h3>Photo gallery coming soon</h3>
          <p>We’re preparing clinic and patient-care photos for this page. In the meantime, visit us
            at either Brooklyn location or reach out with questions.</p>
          <div style="display:flex; flex-wrap:wrap; gap:12px; margin-top:12px;">
            <a href="{{ route('locations') }}" class="btn btn-dark">Locations &amp; Hours</a>
            <a href="{{ route('contact') }}" class="btn btn-primary">Send Us an Email</a>
          </div>
        </div>
      @else
        <div class="media-gallery media-gallery-pictures">
          @foreach ($items as $item)
            <figure class="media-card">
              <img src="{{ $item->url }}" alt="{{ $item->title ?: 'Patient and clinic photo' }}" loading="lazy">
              @if ($item->title)
                <figcaption>{{ $item->title }}</figcaption>
              @endif
            </figure>
          @endforeach
        </div>
      @endif
    </div>
  </section>

@endsection
