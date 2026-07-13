@extends('admin.layout')

@section('title', 'Admin Sign Up')

@section('content')
  <div class="admin-login-wrap">
    <div class="admin-login-card">
      <div class="admin-login-header">
        <img src="{{ asset('images/logo.png') }}" alt="Integrated Rehab" class="admin-login-logo">
        <h1>Create Admin Account</h1>
        <p>Sign up to manage the website.</p>
      </div>

      @if ($errors->any())
        <div class="alert-error">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form method="POST" action="{{ route('admin.register.submit') }}" class="admin-login-form">
        @csrf

        <div class="field">
          <label for="name">Full name</label>
          <input
            type="text"
            id="name"
            name="name"
            value="{{ old('name') }}"
            autocomplete="name"
            required
            autofocus
          >
        </div>

        <div class="field">
          <label for="username">Username</label>
          <input
            type="text"
            id="username"
            name="username"
            value="{{ old('username') }}"
            autocomplete="username"
            required
          >
          <small class="field-hint">At least 3 characters. Spaces are allowed, e.g. ahmed orabi</small>
        </div>

        <div class="field">
          <label for="email">Email</label>
          <input
            type="email"
            id="email"
            name="email"
            value="{{ old('email') }}"
            autocomplete="email"
            required
          >
        </div>

        <div class="field">
          <label for="password">Password</label>
          <input
            type="password"
            id="password"
            name="password"
            autocomplete="new-password"
            required
          >
          <small class="field-hint">At least 8 characters.</small>
        </div>

        <div class="field">
          <label for="password_confirmation">Confirm password</label>
          <input
            type="password"
            id="password_confirmation"
            name="password_confirmation"
            autocomplete="new-password"
            required
          >
        </div>

        <button type="submit" class="btn btn-primary admin-login-btn">Create Account</button>
      </form>

      <p class="admin-login-footer">
        Already have an account? <a href="{{ route('admin.login') }}">Sign in</a><br>
        <a href="{{ route('home') }}">&larr; Back to website</a>
      </p>
    </div>
  </div>
@endsection
