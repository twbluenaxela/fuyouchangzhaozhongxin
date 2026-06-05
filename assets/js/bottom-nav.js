(function () {
  'use strict';

  function normPath(p) {
    // Strip trailing slash, collapse to '/' if root
    return p.replace(/\/+$/, '') || '/';
  }

  var current = normPath(window.location.pathname);

  document.querySelectorAll('.bottom-nav__item').forEach(function (el) {
    var raw = el.getAttribute('href') || '';
    // Handle absolute URLs on the same origin
    if (raw.indexOf('http') === 0) {
      try { raw = new URL(raw).pathname; } catch (e) {}
    }
    var href = normPath(raw);
    var isHome = href === '/';
    var active = isHome
      ? current === '/'
      : current === href || current.startsWith(href + '/');
    if (active) {
      el.classList.add('is-active');
      el.setAttribute('aria-current', 'page');
    }
  });
}());
