<section class="home-awards-header" aria-label="Awards and contact">
  <div class="container">
    <ul class="home-awards-badges">
      <li>
        <a
          href="https://drsalemandsalama.com/wp-content/uploads/2015/09/scan-1.jpg"
          target="_blank"
          rel="noopener noreferrer"
        >
          <img
            src="{{ asset('images/awards/brand-1.png') }}"
            alt="Top Physical Therapy Practice in Brooklyn"
            width="162"
            height="155"
          >
        </a>
      </li>
      <li>
        <a
          href="https://www.opencare.com/physical-therapists/brooklyn-ny/#tc24630608509"
          target="_blank"
          rel="noopener noreferrer"
        >
          <img
            src="{{ asset('images/awards/brand-2.png') }}"
            alt="Opencare Patients' Choice Winner 2015"
            width="141"
            height="155"
          >
        </a>
      </li>
      <li>
        <img
          src="{{ asset('images/awards/brand-3.png') }}"
          alt="Best of 2020 Brooklyn — Doctors of Physical Therapy"
          width="110"
          height="155"
        >
      </li>
      <li>
        <a
          href="https://drsalemandsalama.com/wp-content/uploads/2015/09/scan-2.jpg"
          target="_blank"
          rel="noopener noreferrer"
        >
          <img
            src="{{ asset('images/awards/brand-4.png') }}"
            alt="Quality Patient Care — Open Care"
            width="162"
            height="155"
          >
        </a>
      </li>
    </ul>

    <p class="home-awards-promo">
      Personalized Expert Care for Lasting Recovery, Better Movement, and Improved Well-Being.
    </p>

    <div class="home-awards-contacts">
      <p>
        <a href="https://maps.google.com/?q=2657+Batchelder+St,+Brooklyn,+NY+11235" target="_blank" rel="noopener noreferrer">2657 Batchelder St, 1st Floor Brooklyn, NY 11235</a>
        <span class="home-awards-sep" aria-hidden="true">•</span>
        <a href="tel:6467198631">Fax 646-719-8631</a>
        <span class="home-awards-sep" aria-hidden="true">•</span>
        <a href="tel:7183323401">Call 718-332-3401</a>
      </p>
      <p>
        <a href="https://maps.google.com/?q=6806+5th+Ave,+Brooklyn,+NY+11220" target="_blank" rel="noopener noreferrer">6806 5th Ave Brooklyn NY 11220</a>
        <span class="home-awards-sep" aria-hidden="true">•</span>
        <a href="tel:3474620980">Call 347-462-0980</a>
      </p>
    </div>

    <div class="home-awards-actions">
      <div class="home-awards-social">
        @include('partials.social-icons', ['links' => $siteSettings['awards_social_links'] ?? []])
      </div>
      <a href="{{ route('testimonials.reviews') }}" class="home-awards-guestbook">Guestbook</a>
    </div>
  </div>
</section>
