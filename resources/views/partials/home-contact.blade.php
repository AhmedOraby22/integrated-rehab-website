<section class="home-contact" id="contact-us" aria-label="Contact us">
  <div class="home-contact-grid">
    <div class="home-contact-form-wrap">
      <h2 class="home-contact-title">Contact us</h2>
      <p class="home-contact-lede">We would love to hear from you!</p>

      @if (session('status') && request()->routeIs('home'))
        <div class="alert-success">{{ session('status') }}</div>
      @endif

      @if ($errors->any() && (old('_form') === 'home-contact' || $errors->has('session')))
        <div class="alert-error">
          Please fix the following before sending:
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form method="POST" action="{{ route('contact.store') }}" class="home-contact-form" novalidate>
        @csrf
        <input type="hidden" name="redirect_to" value="home">
        <input type="hidden" name="_form" value="home-contact">

        <div class="field honeypot" aria-hidden="true">
          <label for="home-company-website">Leave this field empty</label>
          <input type="text" id="home-company-website" name="company_website" tabindex="-1" autocomplete="off">
        </div>

        <div class="field">
          <label for="home-subject">Subject <span class="req">*</span></label>
          <input type="text" id="home-subject" name="subject" value="{{ old('_form') === 'home-contact' ? old('subject') : '' }}" required>
        </div>

        <div class="field">
          <label for="home-name">Name <span class="req">*</span></label>
          <input type="text" id="home-name" name="name" value="{{ old('_form') === 'home-contact' ? old('name') : '' }}" required>
        </div>

        <div class="field">
          <label for="home-email">Email <span class="req">*</span></label>
          <input type="email" id="home-email" name="email" value="{{ old('_form') === 'home-contact' ? old('email') : '' }}" required>
        </div>

        <div class="field">
          <label for="home-phone">Phone number <span class="req">*</span></label>
          <input type="tel" id="home-phone" name="phone" value="{{ old('_form') === 'home-contact' ? old('phone') : '' }}" required>
        </div>

        <div class="field">
          <label for="home-message">Message <span class="req">*</span></label>
          <textarea id="home-message" name="message" rows="5" placeholder="Tell us how we can help you" required>{{ old('_form') === 'home-contact' ? old('message') : '' }}</textarea>
        </div>

        <button type="submit" class="home-contact-submit">Submit</button>
      </form>
    </div>

    <aside class="home-contact-media" aria-label="Contact details">
      <img
        src="{{ asset('images/contact-us.jpg') }}"
        alt="Physical therapy care at Integrated Rehab"
        class="home-contact-image"
        width="800"
        height="600"
        loading="lazy"
      >
      <div class="home-contact-overlay">
        <a href="tel:7183323401" class="home-contact-chip">
          <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
            <path d="M6.5 3.5h3.2l1.2 4.2-2 1.2a12.5 12.5 0 0 0 5.2 5.2l1.2-2 4.2 1.2v3.2c0 .9-.7 1.6-1.6 1.6C10.2 18.1 5.9 13.8 5.9 8.1c0-.9.7-1.6 1.6-1.6Z"/>
          </svg>
          <span>(718) 332-3401</span>
        </a>
        <a href="mailto:{{ $siteSettings['contact_email'] }}" class="home-contact-chip">
          <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
            <rect x="3" y="5" width="18" height="14" rx="2"/><path d="M3 7l9 6 9-6"/>
          </svg>
          <span>{{ $siteSettings['contact_email'] }}</span>
        </a>
      </div>
    </aside>
  </div>
</section>
