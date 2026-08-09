@if ($items->hasPages())
  <nav class="videos-pagination" aria-label="Video pages">
    <div class="videos-pagination-meta">
      <span class="videos-pagination-label">Page {{ $items->currentPage() }} of {{ $items->lastPage() }}</span>
      <span class="videos-pagination-range">
        Videos {{ $items->firstItem() }}–{{ $items->lastItem() }} of {{ number_format($items->total()) }}
      </span>
    </div>

    <div class="videos-pagination-controls">
      @if ($items->onFirstPage())
        <span class="videos-pagination-btn disabled">Previous</span>
      @else
        <a href="{{ $items->previousPageUrl() }}" class="videos-pagination-btn">Previous</a>
      @endif

      <div class="videos-pagination-links">
        @php
          $current = $items->currentPage();
          $last = $items->lastPage();
          $window = 4;
          $start = max(1, $current - 1);
          $end = min($last, $start + $window - 1);
          $start = max(1, $end - $window + 1);
        @endphp

        @for ($page = $start; $page <= $end; $page++)
          @if ($page == $current)
            <span class="current" aria-current="page">{{ $page }}</span>
          @else
            <a href="{{ $items->url($page) }}">{{ $page }}</a>
          @endif
        @endfor
      </div>

      @if ($items->hasMorePages())
        <a href="{{ $items->nextPageUrl() }}" class="videos-pagination-btn">Next</a>
      @else
        <span class="videos-pagination-btn disabled">Next</span>
      @endif
    </div>
  </nav>
@endif
