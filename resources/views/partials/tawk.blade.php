@php
  $tawkProperty = config('services.tawk.property_id');
  $tawkWidget = config('services.tawk.widget_id', 'default');
@endphp

@if ($tawkProperty && $tawkWidget)
  {{-- Tawk.to real two-way live chat (24/7 with mobile app + browser dashboard) --}}
  <script type="text/javascript">
    var Tawk_API = Tawk_API || {};
    var Tawk_LoadStart = new Date();
    (function () {
      var s1 = document.createElement('script');
      var s0 = document.getElementsByTagName('script')[0];
      s1.async = true;
      s1.src = 'https://embed.tawk.to/{{ $tawkProperty }}/{{ $tawkWidget }}';
      s1.charset = 'UTF-8';
      s1.setAttribute('crossorigin', '*');
      s0.parentNode.insertBefore(s1, s0);
    })();
  </script>
@endif
