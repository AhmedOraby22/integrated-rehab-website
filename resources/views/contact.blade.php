@extends('layouts.app')

@section('title', 'Send Us an Email — Integrated Rehab and Physical Therapy P.C.')

@section('content')

  <section class="section" style="padding-top:56px;">
    <div class="container">
      <div class="section-header">
        <span class="eyebrow">Contact</span>
        <h1>Send Us an Email</h1>
        <p>Have a question about an appointment, insurance, or one of our two Brooklyn offices?
          Send us a message and we'll reply within one business day — or call us directly.</p>
      </div>

      <div class="contact-split">
        <div class="contact-info-card">
          <h3>Reach us directly</h3>

          <div class="line">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.5 19.5 0 0 1-6-6 19.8 19.8 0 0 1-3.1-8.7A2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1.9.3 1.8.6 2.7a2 2 0 0 1-.4 2.1L8.1 9.7a16 16 0 0 0 6 6l1.2-1.2a2 2 0 0 1 2.1-.4c.9.3 1.8.5 2.7.6a2 2 0 0 1 1.9 2.2Z"/></svg>
            <div>
              <div><a href="tel:7183323401">718-332-3401</a> — Sheepshead Bay office</div>
              <div><a href="tel:3474620980">347-462-0980</a> — Bay Ridge office</div>
            </div>
          </div>

          <div class="line">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="M3 7l9 6 9-6"/></svg>
            <div><a href="mailto:{{ $siteSettings['contact_email'] }}">{{ $siteSettings['contact_email'] }}</a></div>
          </div>

          <div class="line">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 21s-7-5.4-7-11a7 7 0 0 1 14 0c0 5.6-7 11-7 11Z"/><circle cx="12" cy="10" r="2.5"/></svg>
            <div>
              2657 Batchelder St, 1st Floor, Brooklyn, NY 11235<br>
              6806 5th Ave, Brooklyn, NY 11220
            </div>
          </div>

          <div class="line">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 3"/></svg>
            <div>Mornings, evenings, and weekend appointments available</div>
          </div>
        </div>

        <div>
          @if (session('status'))
            <div class="alert-success">{{ session('status') }}</div>
          @endif

          @if ($errors->any())
            <div class="alert-error">
              Please fix the following before sending:
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <form method="POST" action="{{ route('contact.store') }}" novalidate>
            @csrf

            <!-- honeypot: hidden from real visitors, bots tend to fill every field -->
            <div class="field honeypot">
              <label for="company_website">Leave this field empty</label>
              <input type="text" id="company_website" name="company_website" tabindex="-1" autocomplete="off">
            </div>

            <div class="form-grid">
              <div class="field">
                <label for="name">Full name</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required>
              </div>
              <div class="field">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
              </div>
              <div class="field">
                <label for="phone">Phone (optional)</label>
                <input type="tel" id="phone" name="phone" value="{{ old('phone') }}">
              </div>
              <div class="field">
                <label for="subject">Subject</label>
                <input type="text" id="subject" name="subject" value="{{ old('subject') }}" required>
              </div>
              <div class="field full">
                <label for="message">Message</label>
                <textarea id="message" name="message" required>{{ old('message') }}</textarea>
              </div>
              <div class="field full">
                <button type="submit" class="btn btn-primary">Send Message</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

  @include('partials.visit-us-today')

@endsection
