<header class="site-header">
  <div class="container">
    <a href="{{ route('home') }}" class="brand">
      <img
        src="{{ asset('images/logo.png') }}"
        alt="Integrated Rehab and Physical Therapy — We treat you like family"
        class="brand-logo"
      >
    </a>

    <button class="nav-toggle" aria-label="Toggle navigation">
      <span></span><span></span><span></span>
    </button>

    <nav class="main-nav">
      <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
      <a href="{{ route('services') }}" class="{{ request()->routeIs('services') ? 'active' : '' }}">Services</a>
      <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">About Us</a>
      <a href="{{ route('locations') }}" class="{{ request()->routeIs('locations') ? 'active' : '' }}">Locations &amp; Hours</a>
      <a href="{{ route('insurance') }}" class="{{ request()->routeIs('insurance') ? 'active' : '' }}">Insurance</a>
      <a href="{{ route('contact') }}" class="nav-cta {{ request()->routeIs('contact') ? 'active' : '' }}">Send Us an Email</a>
      @auth
        @if (auth()->user()->is_admin)
          <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">Admin</a>
        @endif
      @else
        <a href="{{ route('admin.login') }}" class="{{ request()->routeIs('admin.login') ? 'active' : '' }}">Login</a>
      @endauth
    </nav>
  </div>
</header>
