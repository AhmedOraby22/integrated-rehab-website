<footer class="site-footer">
  <div class="container">
    <div class="footer-main">
      <div class="footer-brand">
        <a href="{{ route('home') }}">
          <img
            src="{{ asset('images/logo.png') }}"
            alt="Integrated Rehab and Physical Therapy P.C."
            class="footer-logo"
          >
        </a>
        <p>Physical therapy and rehabilitation care in Brooklyn — mornings, evenings, and weekends.</p>
      </div>

      <div class="footer-locations">
        <div class="footer-location">
          <h4>Sheepshead Bay</h4>
          <p>2657 Batchelder St, 1st Floor<br>Brooklyn, NY 11235</p>
          <p>
            <a href="tel:7183323401">718-332-3401</a><br>
            Fax: 646-719-8631
          </p>
        </div>

        <div class="footer-location">
          <h4>Bay Ridge</h4>
          <p>6806 5th Ave<br>Brooklyn, NY 11220</p>
          <p><a href="tel:3474620980">347-462-0980</a></p>
        </div>
      </div>

      <div class="footer-connect">
        <h4>Get in touch</h4>
        <div class="footer-social-row">
          @include('partials.social-icons', ['links' => $siteSettings['footer_social_links'] ?? []])
        </div>
        @if (! empty($siteSettings['contact_email']))
          <a href="mailto:{{ $siteSettings['contact_email'] }}" class="footer-email">
            {{ $siteSettings['contact_email'] }}
          </a>
        @endif
        <a href="{{ route('contact') }}" class="btn btn-primary footer-cta">Send Us an Email</a>
      </div>
    </div>

    <div class="footer-bottom">
      <span>&copy; {{ date('Y') }} Integrated Rehab and Physical Therapy P.C.</span>
      <span>Brooklyn, NY</span>
    </div>
  </div>
</footer>

<button type="button" class="back-to-top" aria-label="Back to top" hidden>
  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 19V5M5 12l7-7 7 7"/></svg>
</button>
