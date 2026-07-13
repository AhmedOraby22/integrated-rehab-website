@extends('layouts.app')

@section('title', 'Insurance — Integrated Rehab and Physical Therapy P.C.')

@section('content')

  <section class="section" style="padding-top:56px;">
    <div class="container">
      <div class="contact-split">

        <div class="contact-info-card">
          <span class="eyebrow" style="color:#CFE1D6;">Insurance</span>
          <h3>Questions about coverage?</h3>
          <div class="line">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.5 19.5 0 0 1-6-6 19.8 19.8 0 0 1-3.1-8.7A2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1.9.3 1.8.6 2.7a2 2 0 0 1-.4 2.1L8.1 9.7a16 16 0 0 0 6 6l1.2-1.2a2 2 0 0 1 2.1-.4c.9.3 1.8.5 2.7.6a2 2 0 0 1 1.9 2.2Z"/></svg>
            <div><a href="tel:7183323401">718-332-3401</a></div>
          </div>
          <p style="color: rgba(255,255,255,0.75);">As professional care service providers, we
            do our best to accommodate your individual needs.</p>
          <a href="{{ route('contact') }}" class="btn btn-primary" style="margin-top:8px;">Send Us an Email</a>
        </div>

        <div>
          <div class="section-header" style="margin-bottom:24px;">
            <span class="eyebrow">Coverage</span>
            <h1>We accept practically all major insurance carriers</h1>
          </div>

          <p>Integrated Rehab and Physical Therapy P.C. accepts practically all major insurance
            carriers. Patient benefits are confirmed prior to treatment. Individualized payment
            plans are also available to those without insurance coverage.</p>

          <p>If you have questions about insurance please call us at
            <a href="tel:7183323401" style="color: var(--coral-dark); font-weight:600;">718-332-3401</a>.
            As professional care service providers, we do our best to accommodate your
            individual needs.</p>

          <ul class="insurance-list" style="margin-top:28px;">
            <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 6L9 17l-5-5"/></svg> Benefits confirmed before treatment</li>
            <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 6L9 17l-5-5"/></svg> Most major carriers accepted</li>
            <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 6L9 17l-5-5"/></svg> Individualized payment plans available</li>
            <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 6L9 17l-5-5"/></svg> Guidance for patients without coverage</li>
          </ul>
        </div>

      </div>
    </div>
  </section>

@endsection
