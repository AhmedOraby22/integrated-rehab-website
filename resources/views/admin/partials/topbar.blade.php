<header class="admin-topbar">
  <div class="admin-topbar-inner">
    <div class="admin-topbar-brand">
      <img src="{{ asset('images/logo.png') }}" alt="Integrated Rehab" class="admin-topbar-logo">
      <span>{{ $title ?? 'Admin Panel' }}</span>
    </div>
    <div class="admin-topbar-actions">
      <span class="admin-user">Hello, {{ auth()->user()->name }}</span>
      <form method="POST" action="{{ route('admin.logout') }}">
        @csrf
        <button type="submit" class="btn btn-dark admin-logout-btn">Logout</button>
      </form>
    </div>
  </div>
</header>

<nav class="admin-subnav" aria-label="Admin navigation">
  <div class="container admin-subnav-inner">
    <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">Dashboard</a>
    <a href="{{ route('admin.service-highlights.edit') }}" class="{{ request()->routeIs('admin.service-highlights.*') ? 'active' : '' }}">Service Section</a>
    <a href="{{ route('home') }}" target="_blank" rel="noopener">View Website</a>
  </div>
</nav>
