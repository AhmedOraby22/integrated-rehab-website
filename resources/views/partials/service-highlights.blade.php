@if ($serviceHighlights->isNotEmpty())
<section class="footer-services">
  <div class="container">
    <div class="footer-services-header">
      <span class="eyebrow">Specialized Care</span>
      <h2>How we help you recover</h2>
    </div>

    <div class="footer-services-grid">
      @foreach ($serviceHighlights as $highlight)
        <a href="{{ route('services') }}" class="footer-service-card">
          <div
            class="footer-service-image"
            style="background-image: url('{{ $highlight->image_url }}');"
          ></div>
          <div class="footer-service-body">
            <h3>{{ $highlight->title }}</h3>
            <span class="footer-service-link">Learn more</span>
          </div>
        </a>
      @endforeach
    </div>
  </div>
</section>
@endif
