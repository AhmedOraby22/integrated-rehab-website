@include('partials.service-highlights')

<footer class="site-footer">
  <div class="site-footer-top">
    <div class="container">
      <nav class="footer-menu" aria-label="Footer navigation">
        <a href="{{ route('home') }}">Home</a>
        <a href="{{ route('services') }}">Services</a>
        <a href="{{ route('about') }}">About Us</a>
        <a href="{{ route('locations') }}">Locations</a>
        <a href="{{ route('insurance') }}">Insurance</a>
        <a href="{{ route('contact') }}">Contact</a>
        @auth
          @if (auth()->user()->is_admin)
            <a href="{{ route('admin.dashboard') }}">Admin</a>
          @endif
        @else
          <a href="{{ route('admin.login') }}">Login</a>
        @endauth
      </nav>
    </div>
  </div>

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
          <h4>Sunset Park</h4>
          <p>6806 5th Ave<br>Brooklyn, NY 11220</p>
          <p><a href="tel:3474620980">347-462-0980</a></p>
        </div>
      </div>

      <div class="footer-connect">
        <h4>Get in touch</h4>
        <div class="footer-social-row">
          <a href="#" aria-label="YouTube">
            <svg viewBox="0 0 24 24" fill="currentColor"><path d="M21.6 7.2s-.2-1.5-.8-2.1c-.8-.8-1.7-.8-2.1-.9C15.9 4 12 4 12 4h0s-3.9 0-6.7.2c-.4 0-1.3.1-2.1.9-.6.6-.8 2.1-.8 2.1S2 9 2 10.7v1.6C2 14 2.2 15.7 2.2 15.7s.2 1.5.8 2.1c.8.8 1.8.8 2.3.9 1.7.1 6.7.2 6.7.2s3.9 0 6.7-.2c.4 0 1.3-.1 2.1-.9.6-.6.8-2.1.8-2.1s.2-1.7.2-3.4v-1.6c0-1.7-.2-3.5-.2-3.5ZM9.9 14.1V8.9l5 2.6-5 2.6Z"/></svg>
          </a>
          <a href="#" aria-label="Facebook">
            <svg viewBox="0 0 24 24" fill="currentColor"><path d="M13.5 21v-7.5H16l.5-3H13.5V8.2c0-.9.3-1.5 1.6-1.5H16.6V4.2C16.3 4.2 15.3 4 14.2 4 11.9 4 10.3 5.4 10.3 8V10.5H7.8v3H10.3V21H13.5Z"/></svg>
          </a>
          <a href="#" aria-label="Twitter">
            <svg viewBox="0 0 24 24" fill="currentColor"><path d="M18.9 4.5h3.4l-7.4 8.5 8.7 11.5h-6.8l-5.3-7-6.1 7H2.1l7.9-9.1L2.3 4.5h7l4.8 6.4 4.8-6.4Z"/></svg>
          </a>
        </div>
        <a href="mailto:info@integratedrehabandphysicaltherapy.com" class="footer-email">
          info@integratedrehabandphysicaltherapy.com
        </a>
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
