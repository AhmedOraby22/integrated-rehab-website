<div class="live-chat" id="live-chat" data-endpoint="{{ route('chat.store') }}" data-contact="{{ route('contact') }}">
  <button
    type="button"
    class="live-chat-launcher"
    id="live-chat-launcher"
    aria-expanded="false"
    aria-controls="live-chat-panel"
  >
    <span class="live-chat-launcher-icon" aria-hidden="true">
      <svg class="live-chat-icon-open" viewBox="0 0 24 24" width="26" height="26" fill="none" stroke="currentColor" stroke-width="1.8">
        <path d="M4 6.5A2.5 2.5 0 0 1 6.5 4h11A2.5 2.5 0 0 1 20 6.5v7A2.5 2.5 0 0 1 17.5 16H12l-4.5 3.5V16H6.5A2.5 2.5 0 0 1 4 13.5v-7Z"/>
      </svg>
      <svg class="live-chat-icon-close" viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M6 6l12 12M18 6L6 18"/>
      </svg>
    </span>
    <span class="live-chat-launcher-label">Chat with us</span>
    <span class="live-chat-pulse" aria-hidden="true"></span>
  </button>

  <section
    class="live-chat-panel"
    id="live-chat-panel"
    role="dialog"
    aria-label="Live chat"
    aria-hidden="true"
    hidden
  >
    <header class="live-chat-header">
      <div class="live-chat-avatar" aria-hidden="true">
        <img src="{{ asset('images/logo-mark.png') }}" alt="" width="40" height="40">
      </div>
      <div class="live-chat-header-text">
        <strong>Integrated Rehab</strong>
        <span><span class="live-chat-online-dot"></span> Online 24/7</span>
      </div>
      <button type="button" class="live-chat-close" id="live-chat-close" aria-label="Close chat">
        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 6l12 12M18 6L6 18"/></svg>
      </button>
    </header>

    <div class="live-chat-messages" id="live-chat-messages" aria-live="polite"></div>

    <div class="live-chat-quick" id="live-chat-quick">
      <button type="button" data-quick="book">Book appointment</button>
      <button type="button" data-quick="locations">Locations &amp; hours</button>
      <button type="button" data-quick="insurance">Insurance</button>
      <button type="button" data-quick="call">Call us</button>
      <button type="button" data-quick="message">Leave a message</button>
    </div>

    <form class="live-chat-compose" id="live-chat-compose" autocomplete="off">
      <label class="visually-hidden" for="live-chat-input">Type a message</label>
      <input
        type="text"
        id="live-chat-input"
        name="message"
        placeholder="Type your question…"
        maxlength="500"
      >
      <button type="submit" class="live-chat-send" aria-label="Send message">
        <svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor" aria-hidden="true"><path d="M3.4 20.6 21 12 3.4 3.4l-.1 6.7L14 12 3.3 13.9l.1 6.7Z"/></svg>
      </button>
    </form>

    <form class="live-chat-lead" id="live-chat-lead" hidden>
      <p class="live-chat-lead-intro">Leave your details and we’ll follow up as soon as possible.</p>
      <input type="text" name="company_website" value="" tabindex="-1" autocomplete="off" class="live-chat-honeypot" aria-hidden="true">
      <label>
        <span>Name</span>
        <input type="text" name="name" required maxlength="120" placeholder="Your name">
      </label>
      <label>
        <span>Email</span>
        <input type="email" name="email" required maxlength="180" placeholder="you@email.com">
      </label>
      <label>
        <span>Phone <em>(optional)</em></span>
        <input type="tel" name="phone" maxlength="40" placeholder="718-332-3401">
      </label>
      <label>
        <span>Message</span>
        <textarea name="message" required maxlength="3000" rows="3" placeholder="How can we help?"></textarea>
      </label>
      <div class="live-chat-lead-actions">
        <button type="button" class="live-chat-lead-cancel" id="live-chat-lead-cancel">Back</button>
        <button type="submit" class="live-chat-lead-submit">Send message</button>
      </div>
      <p class="live-chat-lead-status" id="live-chat-lead-status" role="status" hidden></p>
    </form>
  </section>
</div>
