<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'Integrated Rehab and Physical Therapy P.C. — Brooklyn, NY')</title>
  <meta name="description" content="@yield('meta_description', 'Physical therapy and rehabilitation care in Brooklyn, NY. Two convenient locations, mornings/evenings/weekend appointments, and phone or video consultations.')">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}?v={{ filemtime(public_path('css/app.css')) }}">
</head>
<body class="{{ request()->routeIs('home') ? 'page-home' : '' }}">

  <div class="utility-bar">
    <div class="container">
      @if (request()->routeIs('home'))
        <p class="utility-bar-announce">
          Insurance &amp; referrals —
          <a href="{{ route('insurance') }}">Click here for details</a>
        </p>
      @else
        <span>2657 Batchelder St, 1st Floor, Brooklyn, NY 11235 — Call 718-332-3401</span>
        <span>6806 5th Ave, Brooklyn, NY 11220 — Call 347-462-0980</span>
        <a href="{{ route('contact') }}">Send us an email</a>
        @auth
          @if (auth()->user()->is_admin)
            <a href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
          @endif
        @else
          <a href="{{ route('admin.login') }}">Admin Login</a>
        @endauth
      @endif
    </div>
  </div>

  @include('partials.header')

  <main>
    @yield('content')
  </main>

  @include('partials.footer')

  @php
    $tawkEnabled = filled(config('services.tawk.property_id')) && filled(config('services.tawk.widget_id'));
  @endphp

  @if ($tawkEnabled)
    @include('partials.tawk')
  @elseif (request()->routeIs('home'))
    @include('partials.live-chat')
  @endif

  <script src="{{ asset('js/app.js') }}?v={{ filemtime(public_path('js/app.js')) }}"></script>
</body>
</html>
