@extends('layouts.app')

@section('title', 'Locations & Hours — Integrated Rehab and Physical Therapy P.C.')

@section('content')

  <section class="section" style="padding-top:56px;">
    <div class="container">
      <div class="section-header">
        <span class="eyebrow">Locations &amp; Hours</span>
        <h1>Our Brooklyn offices</h1>
        <p>Call ahead to confirm same-day availability, or set up an appointment online.</p>
      </div>

      <div class="locations-list">

        <article class="location-block">
          <div class="location-block-info">
            <a
              class="location-address"
              href="https://maps.google.com/?q=2657+Batchelder+St,+Brooklyn,+NY+11235"
              target="_blank"
              rel="noopener noreferrer"
            >2657 Batchelder St 1st Floor, Brooklyn, NY 11235</a>
            <p class="location-phone">
              <a href="tel:7183323401">718-332-3401</a>
              <span aria-hidden="true"> | </span>
              Fax 646-719-8631
            </p>
            <h3 class="location-hours-title">Office hours</h3>
            <ul class="location-hours">
              <li><span>Monday</span><span>10 AM – 7 PM</span></li>
              <li><span>Tuesday</span><span>10 AM – 7 PM</span></li>
              <li><span>Wednesday</span><span>10 AM – 7 PM</span></li>
              <li><span>Thursday</span><span>10 AM – 7 PM</span></li>
              <li><span>Friday</span><span>10 AM – 7 PM</span></li>
            </ul>
          </div>
          <iframe
            class="location-map"
            title="Map — 2657 Batchelder St, Brooklyn"
            src="https://maps.google.com/maps?q=2657+Batchelder+St,+Brooklyn,+NY+11235&output=embed"
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"
          ></iframe>
        </article>

        <article class="location-block">
          <div class="location-block-info">
            <a
              class="location-address"
              href="https://maps.google.com/?q=6806+5th+Avenue,+Brooklyn,+NY+11220"
              target="_blank"
              rel="noopener noreferrer"
            >6806 5th Avenue, Brooklyn, NY 11220</a>
            <p class="location-phone">
              <a href="tel:3474620980">347-462-0980</a>
            </p>
            <ul class="location-hours">
              <li><span>Mondays</span><span>9:30 AM – 7:30 PM</span></li>
              <li><span>Wednesdays</span><span>9:30 AM – 7:30 PM</span></li>
              <li><span>Thursdays</span><span>9:30 AM – 7:30 PM</span></li>
              <li><span>Fridays</span><span>9:30 AM – 7:30 PM</span></li>
              <li><span>Saturdays</span><span>9:30 AM – 7:30 PM</span></li>
            </ul>
          </div>
          <iframe
            class="location-map"
            title="Map — 6806 5th Avenue, Brooklyn"
            src="https://maps.google.com/maps?q=6806+5th+Avenue,+Brooklyn,+NY+11220&output=embed"
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"
          ></iframe>
        </article>

      </div>

      <div class="promo-panel" style="margin-top:32px; display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:20px;">
        <div>
          <h3 style="margin-bottom:4px;">Prefer to skip the trip?</h3>
          <p style="color: rgba(255,255,255,0.85); margin-bottom:0;">A phone or video
            consultation is available for $49.99 — mornings, evenings, and weekends.</p>
        </div>
        <a href="{{ route('contact') }}" class="btn btn-primary">Setup an Appointment</a>
      </div>
    </div>
  </section>

@endsection
