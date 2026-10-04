/* Delamoda Active: site.js
   Step 1 (foundation). Needs bootstrap.bundle.min.js loaded first.
   More behaviour (sticky navbar, carousels, zoom, back-to-top) is added
   in later steps. */
(function () {
  'use strict';

  // Sticky header: adds .is-stuck once the page scrolls past the header,
  // which site.css uses to switch to a translucent, blurred background.
  var header = document.querySelector('.site-header');
  if (header) {
    var toggleStuck = function () {
      header.classList.toggle('is-stuck', window.scrollY > 4);
    };
    toggleStuck();
    window.addEventListener('scroll', toggleStuck, { passive: true });
  }

  // Tooltips: any element with data-bs-toggle="tooltip"
  document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(function (el) {
    new bootstrap.Tooltip(el);
  });

  // Product gallery: clicking a thumbnail swaps the main image and its
  // Drift zoom target, and marks the thumbnail active.
  document.querySelectorAll('.product-gallery').forEach(function (gallery) {
    var mainImg = gallery.querySelector('.product-gallery-main img');
    var thumbs = gallery.querySelectorAll('.product-gallery-thumbs a');
    if (!mainImg || !thumbs.length) return;

    var drift = (typeof Drift !== 'undefined')
      ? new Drift(mainImg, {
          paneContainer: gallery.querySelector('.product-gallery-main'),
          inlinePane: false,
          containInline: true,
          zoomFactor: 2.2
        })
      : null;

    thumbs.forEach(function (thumb) {
      thumb.addEventListener('click', function (e) {
        e.preventDefault();
        var full = thumb.getAttribute('href');
        mainImg.src = full;
        mainImg.setAttribute('data-zoom', full);
        if (drift) drift.setZoomImageURL(full);
        thumbs.forEach(function (t) { t.classList.remove('active'); });
        thumb.classList.add('active');
      });
    });
  });

  // Star ratings: reads data-rating (e.g. "4.5") and colours in that many
  // of the child <i> icons, so the markup only needs plain star icons.
  document.querySelectorAll('.star-rating[data-rating]').forEach(function (el) {
    var rating = parseFloat(el.getAttribute('data-rating')) || 0;
    var stars = el.querySelectorAll('i');
    stars.forEach(function (star, i) {
      if (rating >= i + 1) star.classList.add('filled');
      else if (rating > i) star.classList.add('half');
    });
  });

  // Horizontal product carousels: prev/next buttons scroll one card width,
  // and disable themselves at either end.
  document.querySelectorAll('.hscroll-group').forEach(function (group) {
    var track = group.querySelector('.hscroll');
    var prev = group.querySelector('.hscroll-prev');
    var next = group.querySelector('.hscroll-next');
    if (!track) return;

    var step = function () {
      var card = track.querySelector(':scope > *');
      return card ? card.getBoundingClientRect().width + 20 : track.clientWidth;
    };
    var updateButtons = function () {
      var max = track.scrollWidth - track.clientWidth - 2;
      if (prev) prev.disabled = track.scrollLeft <= 2;
      if (next) next.disabled = track.scrollLeft >= max;
    };
    if (prev) prev.addEventListener('click', function () { track.scrollBy({ left: -step(), behavior: 'smooth' }); });
    if (next) next.addEventListener('click', function () { track.scrollBy({ left: step(), behavior: 'smooth' }); });
    track.addEventListener('scroll', updateButtons, { passive: true });
    updateButtons();
  });

  // Wishlist heart: toggles a filled/outline icon and an aria-pressed
  // state. Visual only for now; wire it to a real wishlist endpoint later.
  document.querySelectorAll('.btn-wishlist').forEach(function (btn) {
    btn.setAttribute('aria-pressed', 'false');
    btn.addEventListener('click', function () {
      var pressed = btn.getAttribute('aria-pressed') === 'true';
      btn.setAttribute('aria-pressed', String(!pressed));
      btn.classList.toggle('active', !pressed);
      var icon = btn.querySelector('i');
      if (icon) {
        icon.classList.toggle('bi-heart', pressed);
        icon.classList.toggle('bi-heart-fill', !pressed);
      }
    });
  });

  // Back to top: appears once the page has scrolled a bit
  var scrollTopBtn = document.querySelector('.btn-scroll-top');
  if (scrollTopBtn) {
    var toggleScrollTop = function () {
      scrollTopBtn.classList.toggle('is-visible', window.scrollY > 400);
    };
    toggleScrollTop();
    window.addEventListener('scroll', toggleScrollTop, { passive: true });
  }

  // Form validation: any form with class "needs-validation"
  document.querySelectorAll('.needs-validation').forEach(function (form) {
    form.addEventListener('submit', function (e) {
      if (!form.checkValidity()) {
        e.preventDefault();
        e.stopPropagation();
      }
      form.classList.add('was-validated');
    });
  });

  // Sticky navbar: adds .is-stuck once the page has scrolled past the
  // topbar, so site.css can swap in the translucent/blurred background.
  var header = document.querySelector('.site-header');
  if (header) {
    var onScroll = function () {
      header.classList.toggle('is-stuck', window.scrollY > 8);
    };
    onScroll();
    window.addEventListener('scroll', onScroll, { passive: true });
  }
})();
