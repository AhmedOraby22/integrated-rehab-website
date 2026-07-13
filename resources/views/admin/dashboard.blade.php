@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')
  @include('admin.partials.topbar', ['title' => 'Admin Panel'])

  <main class="admin-main">
    <div class="container">
      <div class="admin-page-header">
        <h1>Dashboard</h1>
        <p>Welcome to the Integrated Rehab and Physical Therapy admin area.</p>
      </div>

      @if (session('status'))
        <div class="alert-success">{{ session('status') }}</div>
      @endif

      <div class="grid grid-3 admin-cards">
        <div class="card">
          <h3>Service Section</h3>
          <p>Edit the four footer service cards — titles and images.</p>
          <a href="{{ route('admin.service-highlights.edit') }}" class="btn btn-primary">Edit Service Section</a>
        </div>

        <div class="card">
          <h3>Website Pages</h3>
          <p>View the public site pages from here.</p>
          <a href="{{ route('home') }}" class="btn btn-dark" target="_blank" rel="noopener">Open Website</a>
        </div>

        <div class="card">
          <h3>Your Account</h3>
          <p>
            <strong>Username:</strong> {{ auth()->user()->username }}<br>
            <strong>Email:</strong> {{ auth()->user()->email }}
          </p>
        </div>
      </div>
    </div>
  </main>
@endsection
