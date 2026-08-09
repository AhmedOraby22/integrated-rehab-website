@extends('layouts.app')

@section('title', 'Reviews — Integrated Rehab and Physical Therapy P.C.')
@section('meta_description', 'Read patient reviews and written testimonials from Integrated Rehab and Physical Therapy P.C. in Brooklyn, NY.')

@section('content')

  <section class="section reviews-page" style="padding-top:56px;">
    <div class="testimonials-container">
      <div class="section-header">
        <span class="eyebrow">Testimonials</span>
        <h1>Patient reviews</h1>
        <p>Hear from patients who chose Integrated Rehab and Physical Therapy for care that feels personal.</p>
      </div>

      <div class="reviews-list">
        @foreach ($reviews as $review)
          <article class="review-card">
            <p class="review-card-quote">“{{ $review['quote'] }}”</p>
            <footer class="review-card-meta">
              @php
                $attribution = collect([
                  $review['name'] ?? null,
                  !empty($review['location']) ? 'in '.$review['location'] : null,
                ])->filter()->implode(' ');
              @endphp
              @if ($attribution !== '')
                <span class="review-card-who">{{ $attribution }}</span>
                @if (!empty($review['date']))
                  <span class="review-card-sep" aria-hidden="true">–</span>
                @endif
              @endif
              @if (!empty($review['date']))
                <time class="review-card-date">{{ $review['date'] }}</time>
              @endif
            </footer>
          </article>
        @endforeach
      </div>

      @if ($reviews->hasPages())
        <nav class="reviews-pagination" aria-label="Reviews pages">
          <div class="reviews-pagination-info">
            Page {{ $reviews->currentPage() }} of {{ $reviews->lastPage() }}
          </div>
          <div class="reviews-pagination-links">
            @if ($reviews->onFirstPage())
              <span class="disabled" aria-hidden="true">&laquo;</span>
            @else
              <a href="{{ $reviews->previousPageUrl() }}" aria-label="Previous page">&laquo;</a>
            @endif

            @for ($page = 1; $page <= $reviews->lastPage(); $page++)
              @if ($page == $reviews->currentPage())
                <span class="current" aria-current="page">{{ $page }}</span>
              @else
                <a href="{{ $reviews->url($page) }}">{{ $page }}</a>
              @endif
            @endfor

            @if ($reviews->hasMorePages())
              <a href="{{ $reviews->nextPageUrl() }}" aria-label="Next page">&raquo;</a>
            @else
              <span class="disabled" aria-hidden="true">&raquo;</span>
            @endif
          </div>
        </nav>
      @endif
    </div>
  </section>

@endsection
