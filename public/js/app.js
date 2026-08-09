document.addEventListener('DOMContentLoaded', function () {
  function applyCsrfToken(token) {
    if (!token) return;
    document.querySelectorAll('input[name="_token"]').forEach(function (input) {
      input.value = token;
    });
    var meta = document.querySelector('meta[name="csrf-token"]');
    if (meta) meta.setAttribute('content', token);
  }

  function refreshCsrfToken() {
    return fetch('/csrf-token', {
      credentials: 'same-origin',
      headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
    })
      .then(function (response) {
        if (!response.ok) throw new Error('CSRF refresh failed');
        return response.json();
      })
      .then(function (data) {
        applyCsrfToken(data.token);
        return data.token;
      })
      .catch(function () {
        return null;
      });
  }

  // Back-forward cache can restore a page with an expired CSRF token.
  window.addEventListener('pageshow', function (event) {
    if (event.persisted) refreshCsrfToken();
  });

  var csrfForms = document.querySelectorAll('form input[name="_token"]');
  if (csrfForms.length) {
    // Keep the session/token fresh while the contact form stays open.
    setInterval(refreshCsrfToken, 15 * 60 * 1000);

    document.querySelectorAll('form[method="post"], form[method="POST"]').forEach(function (form) {
      if (!form.querySelector('input[name="_token"]')) return;

      form.addEventListener('submit', function (event) {
        if (form.dataset.csrfReady === '1') {
          form.dataset.csrfReady = '';
          return;
        }

        event.preventDefault();
        refreshCsrfToken().finally(function () {
          form.dataset.csrfReady = '1';
          if (typeof form.requestSubmit === 'function') {
            form.requestSubmit();
          } else {
            form.submit();
          }
        });
      });
    });
  }

  var toggle = document.querySelector('.nav-toggle');
  var nav = document.querySelector('.main-nav');
  if (toggle && nav) {
    toggle.addEventListener('click', function () {
      nav.classList.toggle('open');
    });
  }

  var dropdowns = document.querySelectorAll('.nav-dropdown');

  function closeDropdown(dropdown) {
    dropdown.classList.remove('open');
    var button = dropdown.querySelector('.nav-dropdown-toggle');
    if (button) button.setAttribute('aria-expanded', 'false');
  }

  function closeAllDropdowns(except) {
    dropdowns.forEach(function (dropdown) {
      if (dropdown !== except) closeDropdown(dropdown);
    });
  }

  dropdowns.forEach(function (dropdown) {
    var button = dropdown.querySelector('.nav-dropdown-toggle');
    if (!button) return;

    button.addEventListener('click', function (event) {
      event.preventDefault();
      event.stopPropagation();

      var willOpen = !dropdown.classList.contains('open');
      closeAllDropdowns();

      if (willOpen) {
        dropdown.classList.add('open');
        button.setAttribute('aria-expanded', 'true');
      }
    });
  });

  document.addEventListener('click', function (event) {
    dropdowns.forEach(function (dropdown) {
      if (!dropdown.contains(event.target)) {
        closeDropdown(dropdown);
      }
    });
  });

  document.addEventListener('keydown', function (event) {
    if (event.key === 'Escape') closeAllDropdowns();
  });

  var backToTop = document.querySelector('.back-to-top');
  if (backToTop) {
    window.addEventListener('scroll', function () {
      backToTop.hidden = window.scrollY < 400;
    });
    backToTop.addEventListener('click', function () {
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });
  }

  var carousel = document.querySelector('.footer-services-carousel');
  if (carousel) {
    var track = carousel.querySelector('.footer-services-track');
    var prev = carousel.querySelector('.footer-services-prev');
    var next = carousel.querySelector('.footer-services-next');

    function scrollAmount() {
      var card = track.querySelector('.footer-service-card');
      if (!card) return track.clientWidth;
      var styles = window.getComputedStyle(track);
      var gap = parseFloat(styles.columnGap || styles.gap || '0') || 0;
      return card.getBoundingClientRect().width + gap;
    }

    function updateNav() {
      var maxScroll = track.scrollWidth - track.clientWidth - 2;
      if (prev) prev.disabled = track.scrollLeft <= 2;
      if (next) next.disabled = track.scrollLeft >= maxScroll;
    }

    if (prev) {
      prev.addEventListener('click', function () {
        track.scrollBy({ left: -scrollAmount(), behavior: 'smooth' });
      });
    }
    if (next) {
      next.addEventListener('click', function () {
        track.scrollBy({ left: scrollAmount(), behavior: 'smooth' });
      });
    }

    track.addEventListener('scroll', updateNav, { passive: true });
    window.addEventListener('resize', updateNav);
    updateNav();
  }

  initServicesShowcase();
  initResourcesShowcase();
  initLiveChat();
  initSocialMenus();
});

function initSocialMenus() {
  var menus = Array.prototype.slice.call(document.querySelectorAll('[data-social-menu]'));
  if (!menus.length) return;

  function closeMenu(menu) {
    menu.classList.remove('is-open');
    var toggle = menu.querySelector('.social-menu-toggle');
    var panel = menu.querySelector('.social-menu-panel');
    if (toggle) toggle.setAttribute('aria-expanded', 'false');
    if (panel) panel.hidden = true;
  }

  function closeAll(except) {
    menus.forEach(function (menu) {
      if (menu !== except) closeMenu(menu);
    });
  }

  menus.forEach(function (menu) {
    var toggle = menu.querySelector('.social-menu-toggle');
    var panel = menu.querySelector('.social-menu-panel');
    if (!toggle || !panel) return;

    toggle.addEventListener('click', function (event) {
      event.preventDefault();
      event.stopPropagation();
      var willOpen = !menu.classList.contains('is-open');
      closeAll();
      if (willOpen) {
        menu.classList.add('is-open');
        toggle.setAttribute('aria-expanded', 'true');
        panel.hidden = false;
      }
    });
  });

  document.addEventListener('click', function (event) {
    if (event.target.closest('[data-social-menu]')) return;
    closeAll();
  });

  document.addEventListener('keydown', function (event) {
    if (event.key === 'Escape') closeAll();
  });
}

function initServicesShowcase() {
  var root = document.querySelector('[data-services-carousel]');
  if (!root) return;

  var track = root.querySelector('.services-showcase-track');
  var slides = root.querySelectorAll('.services-showcase-slide');
  var prev = root.querySelector('.services-showcase-prev');
  var next = root.querySelector('.services-showcase-next');
  if (!track || !slides.length) return;

  var index = 0;

  function goTo(i) {
    index = (i + slides.length) % slides.length;
    track.style.transform = 'translateX(' + (-index * 100) + '%)';
  }

  if (prev) prev.addEventListener('click', function () { goTo(index - 1); });
  if (next) next.addEventListener('click', function () { goTo(index + 1); });

  var startX = 0;
  var deltaX = 0;
  track.addEventListener('touchstart', function (e) {
    startX = e.changedTouches[0].clientX;
    deltaX = 0;
  }, { passive: true });
  track.addEventListener('touchmove', function (e) {
    deltaX = e.changedTouches[0].clientX - startX;
  }, { passive: true });
  track.addEventListener('touchend', function () {
    if (Math.abs(deltaX) < 40) return;
    if (deltaX < 0) goTo(index + 1);
    else goTo(index - 1);
  });

  goTo(0);
}

function initResourcesShowcase() {
  var root = document.querySelector('[data-resources-carousel]');
  if (!root) return;

  var track = root.querySelector('.resources-showcase-track');
  var prev = root.querySelector('.resources-showcase-prev');
  var next = root.querySelector('.resources-showcase-next');
  if (!track) return;

  function cardStep() {
    var card = track.querySelector('.resources-card');
    if (!card) return track.clientWidth;
    var styles = window.getComputedStyle(track);
    var gap = parseFloat(styles.columnGap || styles.gap || '0') || 0;
    return card.getBoundingClientRect().width + gap;
  }

  function updateNav() {
    var maxScroll = track.scrollWidth - track.clientWidth - 2;
    if (prev) prev.disabled = track.scrollLeft <= 2;
    if (next) next.disabled = track.scrollLeft >= maxScroll;
  }

  if (prev) {
    prev.addEventListener('click', function () {
      track.scrollBy({ left: -cardStep(), behavior: 'smooth' });
    });
  }
  if (next) {
    next.addEventListener('click', function () {
      track.scrollBy({ left: cardStep(), behavior: 'smooth' });
    });
  }

  track.addEventListener('scroll', updateNav, { passive: true });
  window.addEventListener('resize', updateNav);
  updateNav();
}
function initLiveChat() {
  var root = document.getElementById('live-chat');
  if (!root) return;

  var launcher = document.getElementById('live-chat-launcher');
  var panel = document.getElementById('live-chat-panel');
  var closeBtn = document.getElementById('live-chat-close');
  var messages = document.getElementById('live-chat-messages');
  var quick = document.getElementById('live-chat-quick');
  var compose = document.getElementById('live-chat-compose');
  var input = document.getElementById('live-chat-input');
  var lead = document.getElementById('live-chat-lead');
  var leadCancel = document.getElementById('live-chat-lead-cancel');
  var leadStatus = document.getElementById('live-chat-lead-status');
  var endpoint = root.getAttribute('data-endpoint');
  var contactUrl = root.getAttribute('data-contact') || '/contact';
  var csrf = document.querySelector('meta[name="csrf-token"]');
  var csrfToken = csrf ? csrf.getAttribute('content') : '';
  var greeted = false;

  var replies = {
    book:
      'You can book online anytime:\n' + contactUrl + '\n\nOr call Sheepshead Bay: 718-332-3401\nBay Ridge: 347-462-0980\n\nMorning, evening, and weekend appointments are available.',
    locations:
      'We have 2 Brooklyn clinics:\n\n• 2657 Batchelder St, 1st Floor, Brooklyn, NY 11235 — 718-332-3401\n• 6806 5th Ave, Brooklyn, NY 11220 — 347-462-0980\n\nWant directions or hours? Ask here, or visit Locations & Hours on the site.',
    insurance:
      'We accept practically all major insurance carriers, and self-pay plans are available.\n\nFor coverage questions, call 718-332-3401 or leave a message and our team will follow up.',
    call:
      'Call us anytime:\n\nSheepshead Bay: 718-332-3401\nBay Ridge: 347-462-0980\n\nPrefer we call you back? Tap “Leave a message”.',
    message:
      'Sure — share your details and we’ll get back to you as soon as possible.',
    hours:
      'We offer morning, evening, and weekend appointments, plus $49.99 phone/video consultations.\n\nCall 718-332-3401 or leave a message to find a time that works.',
    hello:
      'Hi! Welcome to Integrated Rehab and Physical Therapy. How can we help you today?',
    default:
      'Thanks for your message. I can help with appointments, locations, insurance, or taking a message for our team.\n\nTry a quick option below, or leave a message and we’ll follow up.'
  };

  function openChat() {
    root.classList.add('is-open');
    panel.hidden = false;
    panel.setAttribute('aria-hidden', 'false');
    launcher.setAttribute('aria-expanded', 'true');
    if (!greeted) {
      greeted = true;
      addBubble(replies.hello, 'bot');
    }
    if (!root.classList.contains('is-lead')) {
      setTimeout(function () { input.focus(); }, 50);
    }
  }

  function closeChat() {
    root.classList.remove('is-open');
    panel.hidden = true;
    panel.setAttribute('aria-hidden', 'true');
    launcher.setAttribute('aria-expanded', 'false');
  }

  function toggleChat() {
    if (root.classList.contains('is-open')) closeChat();
    else openChat();
  }

  function addBubble(text, who) {
    var bubble = document.createElement('div');
    bubble.className = 'live-chat-bubble live-chat-bubble--' + who;
    bubble.textContent = text;
    // Autolink plain URLs and phone numbers lightly
    bubble.innerHTML = bubble.textContent
      .replace(/(https?:\/\/[^\s]+)/g, '<a href="$1" target="_blank" rel="noopener noreferrer">$1</a>')
      .replace(/(\b\d{3}-\d{3}-\d{4}\b)/g, '<a href="tel:$1">$1</a>');
    messages.appendChild(bubble);
    messages.scrollTop = messages.scrollHeight;
  }

  function showLead() {
    root.classList.add('is-lead');
    lead.hidden = false;
    leadStatus.hidden = true;
    leadStatus.textContent = '';
    leadStatus.classList.remove('is-error');
    var nameField = lead.querySelector('input[name="name"]');
    if (nameField) nameField.focus();
  }

  function hideLead() {
    root.classList.remove('is-lead');
    lead.hidden = true;
    if (input) input.focus();
  }

  function respondTo(text) {
    var q = (text || '').toLowerCase().trim();
    if (!q) return;

    addBubble(text, 'user');

    var key = 'default';
    if (/book|appoint|schedule|session|visit/.test(q)) key = 'book';
    else if (/location|address|clinic|where|direction|bay ridge|sheepshead/.test(q)) key = 'locations';
    else if (/insur|coverage|accept|plan|copay/.test(q)) key = 'insurance';
    else if (/call|phone|number|speak/.test(q)) key = 'call';
    else if (/hour|open|weekend|morning|evening/.test(q)) key = 'hours';
    else if (/message|callback|contact|email|leave/.test(q)) key = 'message';
    else if (/^(hi|hello|hey|good (morning|afternoon|evening))\b/.test(q)) key = 'hello';

    setTimeout(function () {
      addBubble(replies[key], 'bot');
      if (key === 'message') showLead();
    }, 350);
  }

  launcher.addEventListener('click', toggleChat);
  closeBtn.addEventListener('click', closeChat);

  quick.addEventListener('click', function (event) {
    var btn = event.target.closest('button[data-quick]');
    if (!btn) return;
    var key = btn.getAttribute('data-quick');
    var labels = {
      book: 'Book appointment',
      locations: 'Locations & hours',
      insurance: 'Insurance',
      call: 'Call us',
      message: 'Leave a message'
    };
    addBubble(labels[key] || key, 'user');
    setTimeout(function () {
      addBubble(replies[key] || replies.default, 'bot');
      if (key === 'message') showLead();
    }, 300);
  });

  compose.addEventListener('submit', function (event) {
    event.preventDefault();
    var value = (input.value || '').trim();
    if (!value) return;
    input.value = '';
    respondTo(value);
  });

  leadCancel.addEventListener('click', hideLead);

  lead.addEventListener('submit', function (event) {
    event.preventDefault();
    var formData = new FormData(lead);
    var submitBtn = lead.querySelector('.live-chat-lead-submit');
    leadStatus.hidden = true;
    leadStatus.classList.remove('is-error');
    if (submitBtn) submitBtn.disabled = true;

    fetch(endpoint, {
      method: 'POST',
      headers: {
        'Accept': 'application/json',
        'X-CSRF-TOKEN': csrfToken,
        'X-Requested-With': 'XMLHttpRequest'
      },
      body: formData
    })
      .then(function (res) {
        return res.json().then(function (data) {
          return { ok: res.ok, data: data };
        });
      })
      .then(function (result) {
        if (submitBtn) submitBtn.disabled = false;
        if (!result.ok) {
          leadStatus.hidden = false;
          leadStatus.classList.add('is-error');
          leadStatus.textContent = (result.data && result.data.message) || 'Something went wrong. Please try again or call us.';
          return;
        }
        hideLead();
        lead.reset();
        addBubble(result.data.message || 'Thanks — your message was sent.', 'bot');
      })
      .catch(function () {
        if (submitBtn) submitBtn.disabled = false;
        leadStatus.hidden = false;
        leadStatus.classList.add('is-error');
        leadStatus.textContent = 'We could not send your message right now. Please call 718-332-3401.';
      });
  });

  document.addEventListener('keydown', function (event) {
    if (event.key === 'Escape' && root.classList.contains('is-open')) closeChat();
  });
}