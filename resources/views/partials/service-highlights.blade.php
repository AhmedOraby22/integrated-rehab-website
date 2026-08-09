@php
  $serviceHighlights = $serviceHighlights ?? \App\Models\ServiceHighlight::active()->ordered()->get();
@endphp

@if ($serviceHighlights->isNotEmpty())
<section class="services-showcase" aria-label="Services">
  <div class="services-showcase-inner">
    <h2 class="services-showcase-title">Services</h2>

    <div class="services-showcase-carousel" data-services-carousel>
      <button type="button" class="services-showcase-nav services-showcase-prev" aria-label="Previous service">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.6" aria-hidden="true"><path d="M15 18l-6-6 6-6"/></svg>
      </button>

      <div class="services-showcase-viewport">
        <div class="services-showcase-track">
          @foreach ($serviceHighlights as $highlight)
            <article class="services-showcase-slide">
              <div class="services-showcase-card">
                <img
                  class="services-showcase-image"
                  src="{{ $highlight->image_url }}"
                  alt="{{ $highlight->title }}"
                  loading="{{ $loop->first ? 'eager' : 'lazy' }}"
                >
                <div class="services-showcase-panel">
                  <div class="services-showcase-panel-copy">
                    <h3>{{ $highlight->title }}</h3>
                    @if (!empty($highlight->bullets))
                      <ul>
                        @foreach ($highlight->bullets as $bullet)
                          <li>{{ $bullet }}</li>
                        @endforeach
                      </ul>
                    @endif
                  </div>
                  <a href="{{ route('services') }}" class="services-showcase-cta">{{ $highlight->button_label }}</a>
                </div>
              </div>
            </article>
          @endforeach
        </div>
      </div>

      <button type="button" class="services-showcase-nav services-showcase-next" aria-label="Next service">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.6" aria-hidden="true"><path d="M9 18l6-6-6-6"/></svg>
      </button>
    </div>
  </div>
</section>
@endif
