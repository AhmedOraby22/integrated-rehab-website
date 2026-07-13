@extends('layouts.app')

@section('title', 'Locations & Hours — Integrated Rehab and Physical Therapy P.C.')

@section('content')

  <section class="section" style="padding-top:56px;">
    <div class="container">
      <div class="section-header">
        <span class="eyebrow">Locations &amp; Hours</span>
        <h1>Two Brooklyn offices, mornings through weekends</h1>
        <p>Call ahead to confirm same-day availability, or set up an appointment online.</p>
      </div>

      <div class="grid grid-2">
        <div class="location-card">
          <div class="map-strip"></div>
          <div class="body">
            <span class="eyebrow">Sheepshead Bay Office</span>
            <h3>2657 Batchelder St, 1st Floor</h3>
            <dl>
              <dt>Address</dt>
              <dd>2657 Batchelder St, 1st Floor, Brooklyn, NY 11235</dd>
              <dt>Phone</dt>
              <dd><a href="tel:7183323401">718-332-3401</a></dd>
              <dt>Fax</dt>
              <dd>646-719-8631</dd>
              <dt>Hours</dt>
              <dd>Mon–Fri: 9:00 AM – 7:00 PM · Sat–Sun: By appointment</dd>
            </dl>
          </div>
        </div>

        <div class="location-card">
          <div class="map-strip"></div>
          <div class="body">
            <span class="eyebrow">Sunset Park Office</span>
            <h3>6806 5th Ave</h3>
            <dl>
              <dt>Address</dt>
              <dd>6806 5th Ave, Brooklyn, NY 11220</dd>
              <dt>Phone</dt>
              <dd><a href="tel:3474620980">347-462-0980</a></dd>
              <dt>Hours</dt>
              <dd>Mon–Fri: 9:00 AM – 7:00 PM · Sat–Sun: By appointment</dd>
            </dl>
          </div>
        </div>
      </div>

      <div class="promo-panel" style="margin-top:32px; display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:20px;">
        <div>
          <h3 style="margin-bottom:4px;">Prefer to skip the trip?</h3>
          <p style="color: rgba(255,255,255,0.85); margin-bottom:0;">A phone or video
            consultation is available for $14.99 — mornings, evenings, and weekends.</p>
        </div>
        <a href="{{ route('contact') }}" class="btn btn-primary">Setup an Appointment</a>
      </div>
    </div>
  </section>

@endsection
