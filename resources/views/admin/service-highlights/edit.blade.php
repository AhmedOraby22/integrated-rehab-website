@extends('admin.layout')

@section('title', 'Edit Service Section')

@section('content')
  @include('admin.partials.topbar', ['title' => 'Edit Service Section'])

  <main class="admin-main">
    <div class="container">
      <div class="admin-page-header">
        <h1>Services Showcase</h1>
        <p>Edit the Services carousel slides shown on the homepage (image, title, bullets, and button text).</p>
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
            @php
              $bulletsText = old(
                'highlights.'.$index.'.bullets',
                implode("\n", $highlight->bullets ?? [])
              );
            @endphp
            <div class="card admin-highlight-card">
              <div class="admin-highlight-preview">
                <img
                  class="footer-service-image js-highlight-preview"
                  src="{{ $highlight->image_url }}"
                  data-original-url="{{ $highlight->image_url }}"
                  alt="{{ $highlight->title }}"
                >
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
                <label for="cta-{{ $highlight->id }}">Button label</label>
                <input
                  type="text"
                  id="cta-{{ $highlight->id }}"
                  name="highlights[{{ $index }}][cta_label]"
                  value="{{ old('highlights.'.$index.'.cta_label', $highlight->cta_label) }}"
                  placeholder="{{ $highlight->title }} Service"
                >
              </div>

              <div class="field">
                <label for="bullets-{{ $highlight->id }}">Bullet points</label>
                <textarea
                  id="bullets-{{ $highlight->id }}"
                  name="highlights[{{ $index }}][bullets]"
                  rows="5"
                  placeholder="One benefit per line"
                >{{ $bulletsText }}</textarea>
                <small class="field-hint">One bullet per line.</small>
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

  <script>
    document.querySelectorAll('.admin-highlight-form input[type="file"]').forEach(function (input) {
      var preview = input.closest('.admin-highlight-card').querySelector('.js-highlight-preview');
      var originalUrl = preview.dataset.originalUrl;
      var objectUrl = null;

      input.addEventListener('change', function () {
        if (objectUrl) {
          URL.revokeObjectURL(objectUrl);
          objectUrl = null;
        }

        var file = input.files && input.files[0];
        if (file) {
          objectUrl = URL.createObjectURL(file);
          preview.src = objectUrl;
        } else {
          preview.src = originalUrl;
        }
      });
    });
  </script>
@endsection
