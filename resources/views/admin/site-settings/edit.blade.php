@php
  $platformLabels = $platforms ?? \App\Models\SiteSetting::PLATFORMS;
  $footerLinks = old('footer_links', $settings['footer_social_links'] ?? []);
  $awardsLinks = old('awards_links', $settings['awards_social_links'] ?? []);
@endphp

@extends('admin.layout')

@section('title', 'Contact & Social')

@section('content')
  @include('admin.partials.topbar', ['title' => 'Contact & Social'])

  <main class="admin-main">
    <div class="container">
      <div class="admin-page-header">
        <h1>Contact & Social</h1>
        <p>Edit the footer social links and the public contact email shown across the site.</p>
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

      <form method="POST" action="{{ route('admin.site-settings.update') }}" class="admin-settings-form">
        @csrf
        @method('PUT')

        <div class="card admin-settings-card">
          <h3>Contact email</h3>
          <p class="field-hint">Shown in the footer, contact page, and homepage contact section.</p>
          <div class="field">
            <label for="contact_email">Email address</label>
            <input
              type="email"
              id="contact_email"
              name="contact_email"
              value="{{ old('contact_email', $settings['contact_email'] ?? '') }}"
              required
            >
          </div>
        </div>

        <div class="card admin-settings-card">
          <div class="admin-settings-card-head">
            <div>
              <h3>Footer social links</h3>
              <p class="field-hint">Add, edit, or remove icons shown in the website footer. Same platform (e.g. multiple Facebook links) shows as one icon — click it to choose a link. Use Label to name each option.</p>
            </div>
            <button type="button" class="btn btn-dark js-add-social-link" data-target="footer-links-list" data-name="footer_links">
              Add link
            </button>
          </div>

          <div id="footer-links-list" class="admin-social-list" data-next-index="{{ count($footerLinks) }}">
            <p class="admin-social-empty js-social-empty" @if (count($footerLinks) > 0) hidden @endif>
              No footer social links yet. Click “Add link” to create one.
            </p>
            @foreach ($footerLinks as $index => $link)
              @include('admin.site-settings.partials.social-link-row', [
                'name' => 'footer_links',
                'index' => $index,
                'link' => $link,
                'platforms' => $platformLabels,
              ])
            @endforeach
          </div>
        </div>

        <div class="card admin-settings-card">
          <div class="admin-settings-card-head">
            <div>
              <h3>Homepage awards social links</h3>
              <p class="field-hint">Icons under the awards section. Multiple links on the same platform share one icon and open a menu. Labels appear in that menu.</p>
            </div>
            <button type="button" class="btn btn-dark js-add-social-link" data-target="awards-links-list" data-name="awards_links">
              Add link
            </button>
          </div>

          <div id="awards-links-list" class="admin-social-list" data-next-index="{{ count($awardsLinks) }}">
            <p class="admin-social-empty js-social-empty" @if (count($awardsLinks) > 0) hidden @endif>
              No homepage social links yet. Click “Add link” to create one.
            </p>
            @foreach ($awardsLinks as $index => $link)
              @include('admin.site-settings.partials.social-link-row', [
                'name' => 'awards_links',
                'index' => $index,
                'link' => $link,
                'platforms' => $platformLabels,
              ])
            @endforeach
          </div>
        </div>

        <div class="admin-form-actions">
          <button type="submit" class="btn btn-primary">Save changes</button>
          <a href="{{ route('admin.dashboard') }}" class="btn btn-dark">Cancel</a>
        </div>
      </form>
    </div>
  </main>

  <template id="social-link-row-template">
    @include('admin.site-settings.partials.social-link-row', [
      'name' => '__NAME__',
      'index' => '__INDEX__',
      'link' => ['platform' => 'youtube', 'url' => '', 'label' => ''],
      'platforms' => $platformLabels,
    ])
  </template>

  <script>
    (function () {
      var template = document.getElementById('social-link-row-template');

      function refreshEmptyState(list) {
        var empty = list.querySelector('.js-social-empty');
        var rows = list.querySelectorAll('.admin-social-row');
        if (! empty) return;
        empty.hidden = rows.length > 0;
      }

      document.querySelectorAll('.js-add-social-link').forEach(function (button) {
        button.addEventListener('click', function () {
          var list = document.getElementById(button.dataset.target);
          if (! list || ! template) return;

          var index = parseInt(list.dataset.nextIndex || '0', 10);
          var html = template.innerHTML
            .replaceAll('__NAME__', button.dataset.name)
            .replaceAll('__INDEX__', String(index));

          list.insertAdjacentHTML('beforeend', html);
          list.dataset.nextIndex = String(index + 1);
          refreshEmptyState(list);

          var urlInput = list.querySelector('.admin-social-row:last-child input[type="url"]');
          if (urlInput) urlInput.focus();
        });
      });

      document.addEventListener('click', function (event) {
        var removeBtn = event.target.closest('.js-remove-social-link');
        if (! removeBtn) return;

        var row = removeBtn.closest('.admin-social-row');
        var list = removeBtn.closest('.admin-social-list');
        if (row) row.remove();
        if (list) refreshEmptyState(list);
      });
    })();
  </script>
@endsection
