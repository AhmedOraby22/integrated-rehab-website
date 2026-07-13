@extends('admin.layout')

@section('title', 'Edit Service Section')

@section('content')
  @include('admin.partials.topbar', ['title' => 'Edit Service Section'])

  <main class="admin-main">
    <div class="container">
      <div class="admin-page-header">
        <h1>Footer Service Cards</h1>
        <p>Edit the four service cards shown above the footer on every page.</p>
      </div>

      @if (session('status'))
        <div class="alert-success">{{ session('status') }}</div>
      @endif

      @if ($errors->any())
        <div class="alert-error">
          Please fix the following:
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form method="POST" action="{{ route('admin.service-highlights.update') }}" enctype="multipart/form-data" class="admin-highlight-form">
        @csrf
        @method('PUT')

        <div class="admin-highlight-grid">
          @foreach ($highlights as $index => $highlight)
            <div class="card admin-highlight-card">
              <div class="admin-highlight-preview">
                <div
                  class="service-highlight-photo"
                  style="background-image: url('{{ $highlight->image_url }}');"
                ></div>
              </div>

              <input type="hidden" name="highlights[{{ $index }}][id]" value="{{ $highlight->id }}">

              <div class="field">
                <label for="title-{{ $highlight->id }}">Title</label>
                <input
                  type="text"
                  id="title-{{ $highlight->id }}"
                  name="highlights[{{ $index }}][title]"
                  value="{{ old('highlights.'.$index.'.title', $highlight->title) }}"
                  required
                >
              </div>

              <div class="field">
                <label for="image-{{ $highlight->id }}">Replace image</label>
                <input
                  type="file"
                  id="image-{{ $highlight->id }}"
                  name="highlights[{{ $index }}][image]"
                  accept="image/*"
                >
                <small class="field-hint">JPG, PNG, or WebP. Max 4 MB. Leave empty to keep current image.</small>
              </div>

              <div class="field admin-remember">
                <label>
                  <input
                    type="checkbox"
                    name="highlights[{{ $index }}][is_active]"
                    value="1"
                    @checked(old('highlights.'.$index.'.is_active', $highlight->is_active))
                  >
                  Show on website
                </label>
              </div>
            </div>
          @endforeach
        </div>

        <div class="admin-form-actions">
          <button type="submit" class="btn btn-primary">Save Changes</button>
          <a href="{{ route('admin.dashboard') }}" class="btn btn-dark">Back to Dashboard</a>
          <a href="{{ route('home') }}" class="btn btn-dark" target="_blank" rel="noopener">Preview Website</a>
        </div>
      </form>
    </div>
  </main>
@endsection
