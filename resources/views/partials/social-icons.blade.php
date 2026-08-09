@php
  $platformLabels = \App\Models\SiteSetting::PLATFORMS;
  $links = collect($links ?? [])
    ->filter(fn ($link) => ! empty($link['url']) && ! empty($link['platform']))
    ->groupBy('platform');

  $ordered = collect(array_keys($platformLabels))
    ->filter(fn ($platform) => $links->has($platform))
    ->mapWithKeys(fn ($platform) => [$platform => $links->get($platform)]);
@endphp

@foreach ($ordered as $platform => $platformLinks)
  @php
    $platformLabel = $platformLabels[$platform] ?? ucfirst($platform);
    $count = $platformLinks->count();
    $first = $platformLinks->first();
  @endphp

  @if ($count === 1)
    <a
      href="{{ $first['url'] }}"
      class="social-icon-btn"
      target="_blank"
      rel="noopener noreferrer"
      aria-label="{{ $first['label'] ?: $platformLabel }}"
    >
      @include('partials.social-icon-svg', ['platform' => $platform])
    </a>
  @else
    <div class="social-menu" data-social-menu>
      <button
        type="button"
        class="social-icon-btn social-menu-toggle"
        aria-expanded="false"
        aria-haspopup="true"
        aria-label="{{ $platformLabel }} links"
      >
        @include('partials.social-icon-svg', ['platform' => $platform])
      </button>
      <div class="social-menu-panel" role="menu" hidden>
        <p class="social-menu-title">{{ $platformLabel }}</p>
        @foreach ($platformLinks as $link)
          <a
            href="{{ $link['url'] }}"
            class="social-menu-item"
            role="menuitem"
            target="_blank"
            rel="noopener noreferrer"
          >
            {{ $link['label'] ?: ($platformLabel.' link') }}
          </a>
        @endforeach
      </div>
    </div>
  @endif
@endforeach
