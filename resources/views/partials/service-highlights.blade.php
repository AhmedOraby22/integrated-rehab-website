@if ($serviceHighlights->isNotEmpty())
<section class="service-highlights">
  <div class="service-highlights-grid">
    @foreach ($serviceHighlights as $highlight)
      <a href="{{ route('services') }}" class="service-highlight-card">
        <div class="service-highlight-head">
          <span class="service-arrow" aria-hidden="true">&#9654;</span>
          <h3>{{ $highlight->title }}</h3>
        </div>
        <div
          class="service-highlight-photo"
          style="background-image: url('{{ $highlight->image_url }}');"
        ></div>
      </a>
    @endforeach
  </div>
</section>
@endif
