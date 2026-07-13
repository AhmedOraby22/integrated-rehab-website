@extends('layouts.app')

@section('title', 'Services — Integrated Rehab and Physical Therapy P.C.')

@section('content')

  <section class="section" style="padding-top:56px;">
    <div class="container">
      <div class="section-header">
        <span class="eyebrow">Services</span>
        <h1>Physical therapy, rehabilitation, and cranial therapy</h1>
        <p>Every treatment plan starts with an assessment of how you move today, and where you
          want to get back to.</p>
      </div>

      <div class="grid grid-3">
        <div class="card">
          <div class="icon-badge">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 21C12 21 4 15.5 4 9.8C4 6.6 6.4 4.5 9 4.5C10.5 4.5 11.6 5.2 12 6C12.4 5.2 13.5 4.5 15 4.5C17.6 4.5 20 6.6 20 9.8C20 15.5 12 21 12 21Z"/></svg>
          </div>
          <h3>Physical Therapy</h3>
          <p>Hands-on treatment and guided exercise to restore strength, mobility, and range of
            motion after injury, surgery, or a chronic condition.</p>
        </div>

        <div class="card">
          <div class="icon-badge">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4 12h4l2-8 4 16 2-8h4"/></svg>
          </div>
          <h3>Rehabilitation</h3>
          <p>Structured recovery programs for patients returning from hospitalization, surgery,
            or long-term conditions — paced to your body, not a calendar.</p>
        </div>

        <div class="card">
          <div class="icon-badge">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 3v18M5 8c0 5 3 5 3 9M19 8c0 5-3 5-3 9"/></svg>
          </div>
          <h3>Cranial Therapy</h3>
          <p>A gentle, hands-on technique used to relieve tension and support the body's natural
            healing process alongside your regular treatment plan.</p>
        </div>
      </div>

      <div class="promo-panel" style="margin-top:40px; display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:20px;">
        <div>
          <span class="eyebrow" style="color:#fff;">Not sure where to start?</span>
          <h3 style="margin-bottom:4px;">Get a phone or video consultation for $14.99</h3>
          <p style="color: rgba(255,255,255,0.85); margin-bottom:0;">Mornings, evenings, and
            weekend appointments available.</p>
        </div>
        <a href="{{ route('contact') }}" class="btn btn-primary">Setup an Appointment</a>
      </div>
    </div>
  </section>

@endsection
