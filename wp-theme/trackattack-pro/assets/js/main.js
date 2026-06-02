/* TrackAttack Pro — main.js */
(function () {

  /* ─── Header scroll effect ─── */
  const header = document.getElementById('header');
  if (header) {
    window.addEventListener('scroll', function () {
      header.classList.toggle('scrolled', window.scrollY > 50);
    });
  }

  /* ─── Scroll reveal ─── */
  const reveals = document.querySelectorAll('.reveal');
  const revealObserver = new IntersectionObserver(function (entries) {
    entries.forEach(function (entry) {
      if (entry.isIntersecting) entry.target.classList.add('visible');
    });
  }, { threshold: 0.15 });
  reveals.forEach(function (el) { revealObserver.observe(el); });

  /* ─── Tire size multi-select (data injected via wp_localize_script) ─── */
  function initTireSelect () {
    if (typeof tapTheme === 'undefined' || !tapTheme.tireSizes) return;

    var dropdown   = document.getElementById('tireSizeDropdown');
    var trigger    = document.getElementById('tireSizeTrigger');
    var tagsEl     = document.getElementById('tireSizeTags');
    var hidden     = document.getElementById('tireSizesHidden');
    var wrapper    = document.getElementById('tireSizeSelect');

    if (!dropdown || !trigger) return;

    var selected  = {};
    var i18n      = tapTheme.i18n || {};

    /* Group by rim diameter */
    var groups = {};
    tapTheme.tireSizes.forEach(function (size) {
      var m = size.match(/R(\d+)$/i);
      if (!m) return;
      var rim = m[1];
      if (!groups[rim]) groups[rim] = [];
      groups[rim].push(size);
    });

    /* Build dropdown HTML */
    Object.keys(groups).sort(function (a, b) { return a - b; }).forEach(function (rim) {
      var header = document.createElement('div');
      header.style.cssText = 'padding:8px 16px;font-family:Anton;font-style:italic;font-size:14px;color:#e31837;background:#1c1b1b;border-bottom:1px solid #5d3f3e;direction:ltr;';
      header.textContent = rim + '"';
      dropdown.appendChild(header);

      groups[rim].forEach(function (size) {
        var label = document.createElement('label');
        var cb    = document.createElement('input');
        cb.type   = 'checkbox';
        cb.value  = size;
        cb.addEventListener('change', function () {
          if (cb.checked) selected[size] = true; else delete selected[size];
          updateUI();
        });
        label.appendChild(cb);
        label.appendChild(document.createTextNode(' ' + size));
        dropdown.appendChild(label);
      });
    });

    function updateUI () {
      var arr = Object.keys(selected);
      hidden.value = arr.join(', ');
      var triggerText = trigger.querySelector('.trigger-text');
      triggerText.textContent = arr.length
        ? arr.length + ' ' + (i18n.selected || 'גדלים נבחרו')
        : (i18n.selectSizes || 'בחרו גדלים');
      trigger.classList.toggle('has-selection', arr.length > 0);

      tagsEl.innerHTML = '';
      arr.forEach(function (size) {
        var tag = document.createElement('span');
        tag.className = 'selected-tag';
        var removeBtn = document.createElement('span');
        removeBtn.className = 'remove-tag';
        removeBtn.textContent = '×';
        removeBtn.addEventListener('click', function () {
          delete selected[size];
          var cb = dropdown.querySelector('input[value="' + size + '"]');
          if (cb) cb.checked = false;
          updateUI();
        });
        tag.textContent = size + ' ';
        tag.appendChild(removeBtn);
        tagsEl.appendChild(tag);
      });
    }

    trigger.addEventListener('click', function (e) {
      e.stopPropagation();
      var isOpen = dropdown.classList.toggle('open');
      trigger.classList.toggle('open', isOpen);
    });

    document.addEventListener('click', function (e) {
      if (wrapper && !wrapper.contains(e.target)) {
        dropdown.classList.remove('open');
        trigger.classList.remove('open');
      }
    });
  }

  /* ─── Contact form AJAX submission ─── */
  function initContactForm () {
    var form    = document.getElementById('contactForm');
    var notice  = document.getElementById('formNotice');
    if (!form || typeof tapTheme === 'undefined') return;

    form.addEventListener('submit', function (e) {
      e.preventDefault();

      var submitBtn = form.querySelector('.submit-btn');
      submitBtn.disabled = true;
      submitBtn.textContent = '...';
      notice.className = 'form-notice';
      notice.textContent = '';

      var data = new FormData(form);
      data.set('action', 'tap_contact');
      data.set('nonce',  tapTheme.nonce);

      fetch(tapTheme.ajaxUrl, { method: 'POST', body: data })
        .then(function (res) { return res.json(); })
        .then(function (json) {
          if (json.success) {
            notice.textContent = tapTheme.i18n.success || 'הטופס נשלח בהצלחה!';
            notice.classList.add('success');
            form.reset();
            // clear tire tags
            var hidden = document.getElementById('tireSizesHidden');
            var tagsEl = document.getElementById('tireSizeTags');
            var trigText = document.querySelector('#tireSizeTrigger .trigger-text');
            if (hidden) hidden.value = '';
            if (tagsEl) tagsEl.innerHTML = '';
            if (trigText) trigText.textContent = tapTheme.i18n.selectSizes || 'בחרו גדלים';
            document.querySelectorAll('#tireSizeDropdown input[type="checkbox"]').forEach(function (cb) { cb.checked = false; });
          } else {
            notice.textContent = (json.data) || (tapTheme.i18n.error || 'שגיאה בשליחה — נסה שוב.');
            notice.classList.add('error');
          }
        })
        .catch(function () {
          notice.textContent = tapTheme.i18n.error || 'שגיאה בשליחה — נסה שוב.';
          notice.classList.add('error');
        })
        .finally(function () {
          submitBtn.disabled = false;
          submitBtn.textContent = 'שלח';
        });
    });
  }

  /* ─── Init ─── */
  document.addEventListener('DOMContentLoaded', function () {
    initTireSelect();
    initContactForm();
  });

}());
