<header class="site-header">
  <div class="container">
    <a href="{{ route('home') }}" class="brand" aria-label="Integrated Rehab and Physical Therapy — We treat you like family">
      <img
        src="{{ asset('images/logo-mark.png') }}"
        alt=""
        class="brand-mark"
        width="56"
        height="56"
      >
      <span class="brand-copy">
        <span class="brand-name">Integrated Rehab<br>and Physical Therapy P.C.</span>
        <span class="brand-tagline">We treat you like family.</span>
      </span>
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

      <div class="nav-dropdown {{ request()->routeIs('testimonials.*') ? 'active' : '' }}">
        <button
          type="button"
          class="nav-dropdown-toggle {{ request()->routeIs('testimonials.*') ? 'active' : '' }}"
          aria-expanded="false"
          aria-haspopup="true"
          aria-controls="testimonials-menu"
        >
          Testimonials
          <svg class="nav-chevron" viewBox="0 0 12 8" width="10" height="7" aria-hidden="true" focusable="false">
            <path d="M1 1.5L6 6.5L11 1.5" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </button>
        <div class="nav-dropdown-menu" id="testimonials-menu" role="menu">
          <a href="{{ route('testimonials.reviews') }}" role="menuitem" class="{{ request()->routeIs('testimonials.reviews') ? 'active' : '' }}">Reviews</a>
          <a href="{{ route('testimonials.pictures') }}" role="menuitem" class="{{ request()->routeIs('testimonials.pictures') ? 'active' : '' }}">Pictures</a>
          <a href="{{ route('testimonials.videos') }}" role="menuitem" class="{{ request()->routeIs('testimonials.videos') ? 'active' : '' }}">Videos</a>
          <a href="{{ route('testimonials.audio') }}" role="menuitem" class="{{ request()->routeIs('testimonials.audio') ? 'active' : '' }}">Audio</a>
        </div>
      </div>

      <a href="{{ route('contact') }}" class="nav-cta {{ request()->routeIs('contact') ? 'active' : '' }}">Request Appointment</a>
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
