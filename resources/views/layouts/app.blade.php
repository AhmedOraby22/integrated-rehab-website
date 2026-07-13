<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Integrated Rehab and Physical Therapy P.C. — Brooklyn, NY')</title>
  <meta name="description" content="@yield('meta_description', 'Physical therapy and rehabilitation care in Brooklyn, NY. Two convenient locations, mornings/evenings/weekend appointments, and phone or video consultations.')">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

  <div class="utility-bar">
    <div class="container">
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
    </div>
  </div>

  @include('partials.header')

  <main>
    @yield('content')
  </main>

  @include('partials.footer')

  <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
