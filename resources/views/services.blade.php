@extends('layouts.app')

@section('title', 'Services — Integrated Rehab and Physical Therapy P.C.')

@section('content')

  <section class="section" style="padding-top:56px;">
    <div class="container">
      <div class="section-header" style="max-width:720px;">
        <span class="eyebrow">Services</span>
        <h1>Our Services</h1>
        <p>Welcome to the Integrated Rehab and Physical Therapy information page. We are the
          premier provider of Physical Therapy and Rehabilitation. Our goal is to provide the
          very best care in spine and joint care, acute and chronic pain, functional limitations,
          cardiac and pulmonary rehabilitation, pelvic floor rehabilitation, geriatric and
          pediatric care, mobility restoration, and posture correction. Because our quality
          control standards are high, our Physical Therapists are among the best in the business.
          Our goal is to always deliver the best individualized care possible. We want you, our
          valued customer, to be happy. Here is a general list of our services.</p>
      </div>

      <div class="grid grid-2">
        <div class="card">
          <h3>Spine and Joint Care</h3>
          <ul>
            <li>Disk Bulge and Disk Herniations</li>
            <li>Stiffness</li>
            <li>Acute and Chronic Pains</li>
            <li>Muscle Spasms</li>
          </ul>
        </div>

        <div class="card">
          <h3>Pulmonary Rehabilitation</h3>
          <ul>
            <li>Shortness of breath, easy fatigability, oxygen weaning</li>
            <li>Sarcoidosis, Pulmonary Fibrosis</li>
            <li>Chronic Obstructive Pulmonary Disease (COPD)</li>
            <li>Respiratory Failure, Types 1 &amp; 2</li>
          </ul>
        </div>

        <div class="card">
          <h3>Cardiac Rehabilitation</h3>
          <ul>
            <li>Ischemic/Coronary Heart Disease</li>
            <li>Arrhythmias</li>
            <li>Heart Failure</li>
            <li>Hypertension and rehab after heart surgery</li>
          </ul>
        </div>

        <div class="card">
          <h3>General Weakness</h3>
          <ul>
            <li>Recovery after hospitalization or surgery</li>
            <li>Muscle Weakness</li>
            <li>Functional Limitation</li>
            <li>Restoring day to day activities</li>
          </ul>
        </div>
      </div>

      <div class="promo-panel" style="margin-top:40px; display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:20px;">
        <div>
          <span class="eyebrow" style="color:#fff;">Not sure where to start?</span>
          <h3 style="margin-bottom:4px;">Get a phone or video consultation for $49.99</h3>
          <p style="color: rgba(255,255,255,0.85); margin-bottom:0;">Mornings, evenings, and
            weekend appointments available.</p>
        </div>
        <a href="{{ route('contact') }}" class="btn btn-primary">Setup an Appointment</a>
      </div>
    </div>
  </section>

@endsection
