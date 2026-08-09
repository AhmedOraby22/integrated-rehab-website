<div class="admin-social-row">
  <div class="field">
    <label>Platform</label>
    <select name="{{ $name }}[{{ $index }}][platform]" required>
      @foreach ($platforms as $value => $label)
        <option value="{{ $value }}" @selected(($link['platform'] ?? '') === $value)>{{ $label }}</option>
      @endforeach
    </select>
  </div>

  <div class="field admin-social-url">
    <label>URL</label>
    <input
      type="url"
      name="{{ $name }}[{{ $index }}][url]"
      value="{{ $link['url'] ?? '' }}"
      placeholder="https://..."
      required
    >
  </div>

  <div class="field">
    <label>Label <span class="field-optional">(menu name)</span></label>
    <input
      type="text"
      name="{{ $name }}[{{ $index }}][label]"
      value="{{ $link['label'] ?? '' }}"
      placeholder="e.g. Facebook group, Academy page"
    >
  </div>

  <button type="button" class="btn btn-dark admin-social-remove js-remove-social-link" aria-label="Delete link">
    Delete
  </button>
</div>
