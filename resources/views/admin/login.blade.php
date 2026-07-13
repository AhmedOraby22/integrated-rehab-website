@extends('admin.layout')

@section('title', 'Admin Login')

@section('content')
  <div class="admin-login-wrap">
    <div class="admin-login-card">
      <div class="admin-login-header">
        <img src="{{ asset('images/logo.png') }}" alt="Integrated Rehab" class="admin-login-logo">
        <h1>Admin Login</h1>
        <p>Sign in to manage the website.</p>
      </div>

      @if ($errors->any())
        <div class="alert-error">
          {{ $errors->first() }}
        </div>
      @endif

      <form method="POST" action="{{ route('admin.login.submit') }}" class="admin-login-form">
        @csrf

        <div class="field">
          <label for="username">Username or email</label>
          <input
            type="text"
            id="username"
            name="username"
            value="{{ old('username') }}"
            autocomplete="username"
            required
            autofocus
          >
        </div>

        <div class="field">
          <label for="password">Password</label>
          <input
            type="password"
            id="password"
            name="password"
            autocomplete="current-password"
            required
          >
        </div>

        <div class="field admin-remember">
          <label>
            <input type="checkbox" name="remember" value="1">
            Remember me
          </label>
        </div>

        <button type="submit" class="btn btn-primary admin-login-btn">Sign In</button>
      </form>

      <p class="admin-login-footer">
        @if ($signupEnabled)
          Don't have an account? <a href="{{ route('admin.register') }}">Sign up</a><br>
        @endif
        <a href="{{ route('home') }}">&larr; Back to website</a>
      </p>
    </div>
  </div>
@endsection
