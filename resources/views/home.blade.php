@extends('layouts.app')

@section('title', 'Integrated Rehab and Physical Therapy P.C. — We Treat You Like Family')

@section('content')

  <section class="hero hero--photo" aria-label="Welcome">
    <div class="hero-media" aria-hidden="true">
      <img
        src="{{ asset('images/hero-clinic.jpg') }}"
        alt=""
        class="hero-media-img"
        width="1920"
        height="1080"
        fetchpriority="high"
      >
      <div class="hero-media-overlay"></div>
    </div>

    <div class="container hero-content">
      <h1>Brooklyn’s Trusted Physical Therapists</h1>
      <p class="hero-sub">2 convenient clinics across Brooklyn · Near 40 years of experience</p>
      <div class="hero-actions hero-actions--stack">
        <a href="{{ route('contact') }}" class="btn btn-hero-primary">
          <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
            <rect x="4" y="3" width="12" height="18" rx="2"/>
            <path d="M8 7h4M8 11h4M8 15h2"/>
            <path d="M16 14c1.5 0 3 1.2 3 3v2h-6v-2c0-1.8 1.5-3 3-3Z"/>
            <circle cx="16" cy="11" r="2"/>
          </svg>
          Book a session online
        </a>
        <a href="tel:7183323401" class="btn btn-hero-ghost">
          <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
            <path d="M6.5 3.5h3.2l1.2 4.2-2 1.2a12.5 12.5 0 0 0 5.2 5.2l1.2-2 4.2 1.2v3.2c0 .9-.7 1.6-1.6 1.6C10.2 18.1 5.9 13.8 5.9 8.1c0-.9.7-1.6 1.6-1.6Z"/>
          </svg>
          Book a session via phone
        </a>
      </div>
    </div>
  </section>

  @include('partials.home-awards-header')

  <section class="section section-alt">
    <div class="container">
      <div class="grid grid-3">

        <div class="doctor-card">
          <div class="doctor-avatar">AS</div>
          <div>
            <h3 style="margin-bottom:2px;">Dr. Abdelrahman Salem</h3>
            <div class="role">Doctor of Physical Therapy, DPT, MCCP, IMT, MP, CST</div>
            <p style="margin-top:10px;">Over 37 years of professional experience providing expert care across hospitals, educational institutions, rehabilitation centers, and private practice.</p>
          </div>
        </div>

        <div class="doctor-card">
          <div class="doctor-avatar">NS</div>
          <div>
            <h3 style="margin-bottom:2px;">Dr. Nagat Salama</h3>
            <div class="role">PT, DPT</div>
            <p style="margin-top:10px;">Focused on individualized rehabilitation plans built
              around each patient's lifestyle and goals.</p>
          </div>
        </div>

        <div class="promo-panel">
          <span class="eyebrow" style="color:#fff;">Limited Offer</span>
          <h3>Phone / Video Consultation</h3>
          <div class="price">$49.99</div>
          <p style="color: rgba(255,255,255,0.85);">Mornings, evenings, and weekend appointments
            available.</p>
          <a href="{{ route('contact') }}" class="btn btn-primary">Setup an Appointment</a>
        </div>

      </div>
    </div>
  </section>

  <svg class="arc-divider" viewBox="0 0 1200 48" preserveAspectRatio="none" aria-hidden="true">
    <path d="M0 40 Q 300 0 600 30 T 1200 20" fill="none" stroke-width="1.5"/>
  </svg>

  <section class="section">
    <div class="container">
      <div class="section-header">
        <span class="eyebrow">Why Patients Choose Us</span>
        <h2>Care built around how you actually move and live</h2>
      </div>

      <div class="grid grid-3">
        <div class="card">
          <div class="icon-badge">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 21C12 21 4 15.5 4 9.8C4 6.6 6.4 4.5 9 4.5C10.5 4.5 11.6 5.2 12 6C12.4 5.2 13.5 4.5 15 4.5C17.6 4.5 20 6.6 20 9.8C20 15.5 12 21 12 21Z"/></svg>
          </div>
          <h3>Individualized Plans</h3>
          <p>Every person is different — your plan is built around your goals, lifestyle, and
            physicality, not a generic protocol.</p>
        </div>
        <div class="card">
          <div class="icon-badge">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4 12h4l2-8 4 16 2-8h4"/></svg>
          </div>
          <h3>State-of-the-Art Tools</h3>
          <p>We use modern assessment tools to identify what's really going on, quickly and
            accurately, so treatment starts on the right track.</p>
        </div>
        <div class="card">
          <div class="icon-badge">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 3"/></svg>
          </div>
          <h3>Flexible Scheduling</h3>
          <p>Morning, evening, and weekend appointments — plus phone and video consultations for
            $49.99 — so care fits around your week.</p>
        </div>
      </div>
    </div>
  </section>

  @include('partials.service-highlights')

  @include('partials.home-contact')

  @include('partials.home-resources')

@endsection
