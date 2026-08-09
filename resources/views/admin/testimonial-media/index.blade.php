@extends('admin.layout')

@section('title', 'Manage '.$typeLabel.' Testimonials')

@section('content')
  @include('admin.partials.topbar', ['title' => 'Testimonials — '.$typeLabel])

  <main class="admin-main">
    <div class="container">
      <div class="admin-page-header">
        <h1>{{ $typeLabel }} testimonials</h1>
        @if ($type === 'video')
          <p>Add YouTube video links to show on the public Videos page.</p>
        @else
          <p>Upload and manage {{ strtolower($typeLabel) }} files shown on the public Testimonials pages.</p>
        @endif
      </div>

      <div class="admin-media-tabs">
        <a href="{{ route('admin.testimonial-media.index', 'picture') }}" class="{{ $type === 'picture' ? 'active' : '' }}">Pictures</a>
        <a href="{{ route('admin.testimonial-media.index', 'video') }}" class="{{ $type === 'video' ? 'active' : '' }}">Videos</a>
        <a href="{{ route('admin.testimonial-media.index', 'audio') }}" class="{{ $type === 'audio' ? 'active' : '' }}">Audio</a>
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

      <div class="card admin-upload-card">
        <h3>{{ $type === 'video' ? 'Add YouTube video' : 'Upload new '.strtolower($typeLabel) }}</h3>
        <form
          method="POST"
          action="{{ route('admin.testimonial-media.store', $type) }}"
          @if ($type !== 'video') enctype="multipart/form-data" @endif
          class="admin-upload-form"
        >
          @csrf
          <div class="field">
            <label for="title">Title (optional)</label>
            <input type="text" id="title" name="title" value="{{ old('title') }}" maxlength="160" placeholder="e.g. Patient story 1">
          </div>

          @if ($type === 'video')
            <div class="field">
              <label for="external_url">YouTube URL</label>
              <input
                type="url"
                id="external_url"
                name="external_url"
                value="{{ old('external_url') }}"
                placeholder="https://www.youtube.com/watch?v=..."
                required
              >
              <small class="field-hint">{{ $hint }}</small>
            </div>
          @else
            <div class="field">
              <label for="file">File</label>
              <input type="file" id="file" name="file" accept="{{ $accept }}" required>
              <small class="field-hint">{{ $hint }}</small>
            </div>
          @endif

          <div class="field admin-remember">
            <label>
              <input type="checkbox" name="is_active" value="1" @checked(old('is_active', true))>
              Show on website
            </label>
          </div>
          <button type="submit" class="btn btn-primary">{{ $type === 'video' ? 'Add Video' : 'Upload' }}</button>
        </form>
      </div>

      <div class="admin-page-header" style="margin-top:36px; margin-bottom:16px;">
        <h2 style="font-size:1.35rem; margin:0;">
          {{ $type === 'video' ? 'Added videos' : 'Uploaded '.strtolower($typeLabel) }}
          ({{ $items->count() }})
        </h2>
      </div>

      @if ($items->isEmpty())
        <div class="card">
          <p style="margin:0; color: var(--ink-70);">
            No {{ strtolower($typeLabel) }} {{ $type === 'video' ? 'added' : 'uploaded' }} yet.
          </p>
        </div>
      @else
        <div class="admin-media-list">
          @foreach ($items as $item)
            <div class="card admin-media-item {{ $item->is_youtube ? 'admin-media-item-youtube' : '' }}">
              <div class="admin-media-preview">
                @if ($item->type === 'picture')
                  <img src="{{ $item->url }}" alt="{{ $item->title ?: 'Picture' }}">
                @elseif ($item->is_youtube)
                  <iframe
                    src="{{ $item->embed_url }}"
                    title="{{ $item->title ?: 'YouTube video' }}"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen
                    loading="lazy"
                  ></iframe>
                @elseif ($item->type === 'video')
                  <video src="{{ $item->url }}" controls preload="metadata"></video>
                @else
                  <audio src="{{ $item->url }}" controls preload="metadata"></audio>
                @endif
              </div>

              <form method="POST" action="{{ route('admin.testimonial-media.update', $item) }}" class="admin-media-meta">
                @csrf
                @method('PUT')
                <div class="field">
                  <label for="title-{{ $item->id }}">Title</label>
                  <input type="text" id="title-{{ $item->id }}" name="title" value="{{ old('title', $item->title) }}" maxlength="160">
                </div>

                @if ($item->type === 'video')
                  <div class="field">
                    <label for="url-{{ $item->id }}">YouTube URL</label>
                    <input
                      type="url"
                      id="url-{{ $item->id }}"
                      name="external_url"
                      value="{{ old('external_url', $item->external_url) }}"
                      placeholder="https://www.youtube.com/watch?v=..."
                    >
                  </div>
                @endif

                <div class="field">
                  <label for="sort-{{ $item->id }}">Sort order</label>
                  <input type="number" id="sort-{{ $item->id }}" name="sort_order" value="{{ old('sort_order', $item->sort_order) }}" min="0" max="9999">
                </div>
                <div class="field admin-remember">
                  <label>
                    <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $item->is_active))>
                    Show on website
                  </label>
                </div>
                <div class="admin-media-actions">
                  <button type="submit" class="btn btn-primary">Save</button>
                </div>
              </form>

              <form method="POST" action="{{ route('admin.testimonial-media.destroy', $item) }}" onsubmit="return confirm('Delete this item?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-dark">Delete</button>
              </form>
            </div>
          @endforeach
        </div>
      @endif

      <div class="admin-form-actions" style="margin-top:28px;">
        <a href="{{ route('admin.dashboard') }}" class="btn btn-dark">Back to Dashboard</a>
        <a href="{{ route('testimonials.'.($type === 'picture' ? 'pictures' : ($type === 'video' ? 'videos' : 'audio'))) }}" class="btn btn-dark" target="_blank" rel="noopener">Preview page</a>
      </div>
    </div>
  </main>
@endsection
