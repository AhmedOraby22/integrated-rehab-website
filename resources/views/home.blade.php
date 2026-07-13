@extends('layouts.app')

@section('title', 'Integrated Rehab and Physical Therapy P.C. — We Treat You Like Family')

@section('content')

  <section class="hero">
    <div class="container">
      <span class="eyebrow">Brooklyn, NY · Physical Therapy &amp; Rehabilitation</span>
      <h1>We Treat You Like Family</h1>
      <p class="lede">
        Find the right solutions to your health and medical needs with Integrated Rehab and
        Physical Therapy P.C. We take a customized approach to help you reach your specific
        goals — and decrease or eliminate the impacts an injury or condition has on your life.
      </p>
      <div class="hero-actions">
        <a href="{{ route('contact') }}" class="btn btn-primary">Setup an Appointment</a>
        <a href="{{ route('services') }}" class="btn btn-ghost">See Our Services</a>
      </div>
      <div class="hero-stats">
        <div><strong>24</strong><span>Years in Practice</span></div>
        <div><strong>2</strong><span>Brooklyn Locations</span></div>
        <div><strong>$14.99</strong><span>Phone / Video Consult</span></div>
      </div>
    </div>

    <svg class="hero-arc" viewBox="0 0 400 400" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
      <path d="M40 340 A 220 220 0 0 1 360 200" stroke="#5B8C7B" stroke-width="1.5" stroke-dasharray="4 8" opacity="0.55"/>
      <path d="M60 300 A 170 170 0 0 1 330 160" stroke="#CFE1D6" stroke-width="1.5" opacity="0.7"/>
      <circle cx="60" cy="300" r="5" fill="#E15B45"/>
      <circle cx="330" cy="160" r="5" fill="#CFE1D6"/>
    </svg>
  </section>

  <section class="section section-alt">
    <div class="container">
      <div class="grid grid-3">

        <div class="doctor-card">
          <div class="doctor-avatar">AS</div>
          <div>
            <h3 style="margin-bottom:2px;">Dr. Abdelrahman Salem</h3>
            <div class="role">Director of Physical Therapy, PT, DPT, PhD, CCI</div>
            <p style="margin-top:10px;">Over two decades treating patients in hospitals, nursing
              homes, schools, and private practice.</p>
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
          <div class="price">$14.99</div>
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
            $14.99 — so care fits around your week.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="section section-alt">
    <div class="container">
      <div class="testimonial">
        <p>"They understand how it feels when you're not at your best, and they work with you at
          your own pace to get the most benefit out of every visit."</p>
        <div class="who">— Patient review, via Yelp</div>
      </div>
    </div>
  </section>

@endsection
