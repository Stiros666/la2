/* LA2PLUS Landing — Main Application */

(function () {
  'use strict';

  const cfg = LA2PLUS_CONFIG;
  const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  const isMobile = window.innerWidth <= 1024;

  // ─── BACKGROUND IMAGES ───
  function initBackgrounds() {
    document.querySelectorAll('[data-bg]').forEach((el) => {
      const url = el.dataset.bg;
      if (url) el.style.backgroundImage = `url('${url}')`;
    });
  }

  // ─── PRELOADER ───
  function initPreloader() {
    const preloader = document.getElementById('preloader');
    const hide = () => {
      preloader.classList.add('done');
      initHeroAnimations();
    };
    if (document.readyState === 'complete') {
      setTimeout(hide, 800);
    } else {
      window.addEventListener('load', () => setTimeout(hide, 600));
    }
    setTimeout(hide, 3000);
  }

  // ─── HEADER SCROLL ───
  function initHeader() {
    const header = document.getElementById('header');
  const onScroll = () => header.classList.toggle('scrolled', window.scrollY > 60);
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();

    const burger = document.getElementById('burgerBtn');
    const nav = document.getElementById('mainNav');
    burger.addEventListener('click', () => {
      burger.classList.toggle('active');
      nav.classList.toggle('open');
      burger.setAttribute('aria-expanded', nav.classList.contains('open'));
    });
    nav.querySelectorAll('.header__link').forEach((link) => {
      link.addEventListener('click', () => {
        burger.classList.remove('active');
        nav.classList.remove('open');
      });
    });
  }

  // ─── SMOOTH SCROLL ───
  function initSmoothScroll() {
    document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
      anchor.addEventListener('click', (e) => {
        const id = anchor.getAttribute('href');
        if (id === '#') return;
        const target = document.querySelector(id);
        if (target) {
          e.preventDefault();
          target.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
      });
    });
  }

  // ─── HERO VIDEO ───
  function initHeroVideo() {
    const video = document.querySelector('.hero__video');
    if (!video) return;
    video.addEventListener('error', () => { video.style.display = 'none'; });
    if (isMobile) video.style.display = 'none';
  }

  // ─── PARTICLES ───
  function initParticles() {
    if (reducedMotion) return;
    const canvas = document.getElementById('heroParticles');
    if (!canvas) return;
    const ctx = canvas.getContext('2d');
    let particles = [];
    const count = isMobile ? 30 : 50;
    let w = 0;
    let h = 0;

    function createParticle() {
      return {
        x: Math.random() * w,
        y: Math.random() * h,
        r: Math.random() * 2 + 0.5,
        speedX: (Math.random() - 0.5) * 0.4,
        speedY: Math.random() * -0.6 - 0.1,
        opacity: Math.random() * 0.4 + 0.15,
        color: Math.random() > 0.35 ? '#6D73FF' : '#875CF6',
      };
    }

    function resize() {
      const hero = canvas.closest('.hero');
      if (!hero) return;
      w = hero.clientWidth;
      h = hero.clientHeight;
      if (w < 10 || h < 10) return;

      const dpr = Math.min(window.devicePixelRatio || 1, 2);
      canvas.width = Math.floor(w * dpr);
      canvas.height = Math.floor(h * dpr);
      canvas.style.width = w + 'px';
      canvas.style.height = h + 'px';
      ctx.setTransform(dpr, 0, 0, dpr, 0, 0);

      if (particles.length === 0) {
        for (let i = 0; i < count; i++) particles.push(createParticle());
      } else {
        particles.forEach((p) => {
          p.x = Math.random() * w;
          p.y = Math.random() * h;
        });
      }
    }

    function draw() {
      if (!w || !h) {
        requestAnimationFrame(draw);
        return;
      }
      ctx.clearRect(0, 0, w, h);
      particles.forEach((p) => {
        ctx.beginPath();
        ctx.arc(p.x, p.y, p.r, 0, Math.PI * 2);
        ctx.fillStyle = p.color;
        ctx.globalAlpha = p.opacity;
        ctx.fill();
        p.x += p.speedX;
        p.y += p.speedY;
        if (p.y < -10) { p.y = h + 10; p.x = Math.random() * w; }
        if (p.x < -10) p.x = w + 10;
        if (p.x > w + 10) p.x = -10;
      });
      ctx.globalAlpha = 1;
      requestAnimationFrame(draw);
    }

    resize();
    window.addEventListener('resize', resize);
    window.addEventListener('load', () => { resize(); setTimeout(resize, 200); });
    setTimeout(resize, 100);
    draw();
  }

  // ─── GSAP ANIMATIONS ───
  function initHeroAnimations() {
    if (typeof gsap === 'undefined') return;

    gsap.registerPlugin(ScrollTrigger);

    const heroTitle = document.getElementById('heroTitle');
    const heroLogo = document.querySelector('.hero__logo-img');

    if (heroTitle) {
      gsap.fromTo(heroTitle,
        { opacity: 0, y: 24 },
        { opacity: 1, y: 0, duration: 0.9, ease: 'power3.out' }
      );
    }
    if (heroLogo) {
      gsap.fromTo(heroLogo,
        { opacity: 0, scale: 0.9 },
        { opacity: 1, scale: 1, duration: 1.1, delay: 0.15, ease: 'power3.out' }
      );
    }

    const reveals = document.querySelectorAll('.hero .reveal');
    gsap.to(reveals, {
      opacity: 1,
      y: 0,
      duration: 0.8,
      stagger: 0.15,
      ease: 'power3.out',
    });

    gsap.utils.toArray('.section .reveal, .rate-card, .feature-card, .howto-step, .news-card, .gameplay-card').forEach((el) => {
      gsap.fromTo(el,
        { opacity: 0, y: 40 },
        {
          opacity: 1, y: 0, duration: 0.7, ease: 'power3.out',
          scrollTrigger: { trigger: el, start: 'top 85%', toggleActions: 'play none none none' },
        }
      );
    });

    const worldSection = document.getElementById('world');
    if (worldSection) {
      ScrollTrigger.create({
        trigger: worldSection,
        start: 'top 60%',
        onEnter: () => worldSection.classList.add('in-view'),
      });
    }

    if (!reducedMotion) {
      const heroLight = document.querySelector('.hero__light');
      if (heroLight) {
        gsap.to(heroLight, {
          opacity: 0.7,
          duration: 3,
          repeat: -1,
          yoyo: true,
          ease: 'sine.inOut',
        });
      }
    }
  }

  // ─── COUNTDOWN ───
  function initCountdown() {
    const opening = new Date(cfg.server.openingDate);
    const countdownEl = document.getElementById('countdown');
    const onlineBadge = document.getElementById('serverOnlineBadge');
    const openingDateEl = document.getElementById('openingDate');

    openingDateEl.textContent = cfg.server.openingDateDisplay;

    function update() {
      const now = new Date();
      const diff = opening - now;

      if (diff <= 0) {
        countdownEl.classList.add('hidden');
        onlineBadge.classList.remove('hidden');
        return;
      }

      const d = Math.floor(diff / 86400000);
      const h = Math.floor((diff % 86400000) / 3600000);
      const m = Math.floor((diff % 3600000) / 60000);
      const s = Math.floor((diff % 60000) / 1000);

      document.getElementById('cdDays').textContent = String(d).padStart(2, '0');
      document.getElementById('cdHours').textContent = String(h).padStart(2, '0');
      document.getElementById('cdMinutes').textContent = String(m).padStart(2, '0');
      document.getElementById('cdSeconds').textContent = String(s).padStart(2, '0');
    }

    update();
    setInterval(update, 1000);
  }

  // ─── RENDER DYNAMIC CONTENT ───
  window.renderDynamicContent = function () {
    const ratesGrid = document.getElementById('ratesGrid');
    if (ratesGrid) {
      ratesGrid.innerHTML = cfg.rates.map((r) => `
        <div class="rate-card reveal">
          <div class="rate-card__icon">${r.icon}</div>
          <div class="rate-card__value">${r.value}</div>
          <div class="rate-card__label">${t('rates.' + r.key)}</div>
        </div>
      `).join('');
    }

    const featuresGrid = document.getElementById('featuresGrid');
    if (featuresGrid) {
      featuresGrid.innerHTML = cfg.features.map((f) => `
        <div class="feature-card reveal">
          <div class="feature-card__icon">${f.icon}</div>
          <h3>${t(f.titleKey)}</h3>
          <p>${t(f.descKey)}</p>
        </div>
      `).join('');
    }

    const newsGrid = document.getElementById('newsGrid');
    if (newsGrid) {
      newsGrid.innerHTML = cfg.news.map((n) => `
        <article class="news-card reveal">
          <div class="news-card__image" style="background-image: url('${n.image}')"></div>
          <div class="news-card__body">
            <div class="news-card__date">${n.date}</div>
            <h3>${t(n.titleKey)}</h3>
            <p>${t(n.descKey)}</p>
          </div>
        </article>
      `).join('');
    }

    document.querySelectorAll('[data-config]').forEach((el) => {
      const key = el.dataset.config;
      if (cfg.server[key]) el.textContent = cfg.server[key].toUpperCase?.() || cfg.server[key];
    });
  };

  // ─── LINKS ───
  function initLinks() {
    const setHref = (id, url) => {
      const el = document.getElementById(id);
      if (el) el.href = url;
    };
    setHref('discordBtn', cfg.links.discord);
    setHref('telegramBtn', cfg.links.telegram);
    setHref('youtubeBtn', cfg.links.youtube);
    setHref('footerDiscord', cfg.links.discord);
    setHref('footerTelegram', cfg.links.telegram);

    document.querySelectorAll('[data-download]').forEach((el) => {
      const type = el.dataset.download;
      if (cfg.links.downloads[type]) el.href = cfg.links.downloads[type];
      el.addEventListener('click', () => trackEvent('download_' + type));
    });

    document.querySelectorAll('[data-mirror]').forEach((el) => {
      const mirror = el.dataset.mirror;
      if (cfg.links.downloads[mirror]) el.href = cfg.links.downloads[mirror];
    });



  }

  // ─── LANGUAGE ───
  function initLanguage() {
    document.querySelectorAll('.lang-switcher__btn').forEach((btn) => {
      btn.addEventListener('click', () => setLanguage(btn.dataset.lang));
    });
    let saved; try { saved = localStorage.getItem('la2plus_lang'); } catch (_) {}
    if (saved && I18N[saved]) setLanguage(saved);
    else setLanguage('ru');
  }

  // ─── ANALYTICS STUB ───
  function trackEvent(name) {
    if (typeof gtag === 'function') gtag('event', name);
    if (typeof dataLayer !== 'undefined') dataLayer.push({ event: name });
    console.log('[Analytics]', name);
  }

  document.getElementById('discordBtn')?.addEventListener('click', () => trackEvent('discord_click'));
  document.getElementById('telegramBtn')?.addEventListener('click', () => trackEvent('telegram_click'));

  // ─── TILT EFFECT ───
  function initTilt() {
    if (reducedMotion || isMobile) return;
    document.querySelectorAll('[data-tilt]').forEach((card) => {
      card.addEventListener('mousemove', (e) => {
        const rect = card.getBoundingClientRect();
        const x = (e.clientX - rect.left) / rect.width - 0.5;
        const y = (e.clientY - rect.top) / rect.height - 0.5;
        card.style.transform = `perspective(800px) rotateY(${x * 6}deg) rotateX(${-y * 6}deg)`;
      });
      card.addEventListener('mouseleave', () => {
        card.style.transform = '';
        card.style.transition = 'transform 0.5s ease';
      });
      card.addEventListener('mouseenter', () => { card.style.transition = ''; });
    });
  }

  // ─── INIT ───
  function init() {
    initBackgrounds();
    initPreloader();
    initHeader();
    initSmoothScroll();

    initParticles();
    initCountdown();


    renderDynamicContent();
    initLinks();



    initLanguage();
    initTilt();
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
})();
