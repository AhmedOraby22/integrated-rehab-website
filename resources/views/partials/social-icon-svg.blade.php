@if (($platform ?? '') === 'youtube')
  <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M21.6 7.2s-.2-1.5-.8-2.1c-.8-.8-1.7-.8-2.1-.9C15.9 4 12 4 12 4h0s-3.9 0-6.7.2c-.4 0-1.3.1-2.1.9-.6.6-.8 2.1-.8 2.1S2 9 2 10.7v1.6C2 14 2.2 15.7 2.2 15.7s.2 1.5.8 2.1c.8.8 1.8.8 2.3.9 1.7.1 6.7.2 6.7.2s3.9 0 6.7-.2c.4 0 1.3-.1 2.1-.9.6-.6.8-2.1.8-2.1s.2-1.7.2-3.4v-1.6c0-1.7-.2-3.5-.2-3.5ZM9.9 14.1V8.9l5 2.6-5 2.6Z"/></svg>
@elseif (($platform ?? '') === 'x')
  <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M18.9 4.5h3.4l-7.4 8.5 8.7 11.5h-6.8l-5.3-7-6.1 7H2.1l7.9-9.1L2.3 4.5h7l4.8 6.4 4.8-6.4Z"/></svg>
@elseif (($platform ?? '') === 'facebook')
  <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M13.5 21v-7.5H16l.5-3H13.5V8.2c0-.9.3-1.5 1.6-1.5H16.6V4.2C16.3 4.2 15.3 4 14.2 4 11.9 4 10.3 5.4 10.3 8V10.5H7.8v3H10.3V21H13.5Z"/></svg>
@endif
