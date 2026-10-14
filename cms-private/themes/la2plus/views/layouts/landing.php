<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="LA2PLUS — классический Lineage 2 Interlude x5. Современный приватный сервер с честной игрой, стабильной экономикой и активным сообществом.">
  <meta name="theme-color" content="#080A0D">
  <title><?php echo e(config("meta.title")); ?></title>

  <meta property="og:type" content="website">
  <meta property="og:title" content="LA2PLUS — Lineage 2 Private Server">
  <meta property="og:description" content="Классический Lineage 2 в современном исполнении. Interlude x5. Grand Opening скоро.">
  <meta property="og:image" content="assets/images/og-image.png">
  <meta property="og:site_name" content="LA2PLUS">

  <link rel="icon" href="/design/assets/favicon.png" type="image/png">
  <link rel="apple-touch-icon" href="/design/assets/images/logo.png">
  <link rel="preload" href="/design/assets/images/env-hero.png" as="image">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="/design/css/style.css">
<link rel="stylesheet" href="/design/css/cms.css">
</head>
<body>
<?php $this->widget("app.widgets.UserNotifications.UserNotifications"); ?>
  <!-- PRELOADER -->
  <div id="preloader" class="preloader" aria-hidden="true">
    <div class="preloader__inner">
      <img src="/design/assets/images/logo.png" alt="LA2PLUS" class="preloader__logo-img" width="320" height="120">
      <div class="preloader__bar"><span class="preloader__progress"></span></div>
      <p class="preloader__text">LOADING WORLD...</p>
    </div>
  </div>

  <!-- HEADER -->
  <header class="header" id="header">
    <div class="header__container container">
      <a href="#hero" class="header__logo">
        <img src="/design/assets/images/logo.png" alt="LA2PLUS" class="header__logo-img" width="160" height="48">
      </a>

      <nav class="header__nav" id="mainNav" aria-label="Главная навигация">
        <a href="#hero" class="header__link" data-i18n="nav.home">Главная</a>
        <a href="#about" class="header__link" data-i18n="nav.about">О сервере</a>
        <a href="#features" class="header__link" data-i18n="nav.features">Особенности</a>
        <a href="#howto" class="header__link" data-i18n="nav.howto">Как начать</a>
        <a href="#community" class="header__link" data-i18n="nav.community">Сообщество</a>
      </nav>

      <div class="header__actions">
        <div class="lang-switcher" role="group" aria-label="Язык">
          <button class="lang-switcher__btn active" data-lang="ru">RU</button>
          <button class="lang-switcher__btn" data-lang="en">EN</button>
          <button class="lang-switcher__btn" data-lang="ua">UA</button>
        </div>
        <a  class="btn btn--ghost btn--sm" id="loginBtn" data-i18n="btn.login" href="<?php echo app()->createUrl('/login/default/index'); ?>">ВОЙТИ</a>
        <a  class="btn btn--gold btn--sm" id="registerBtnHeader" data-i18n="btn.register" href="<?php echo app()->createUrl('/register/default/index'); ?>">СОЗДАТЬ АККАУНТ</a>
        <button class="burger" id="burgerBtn" aria-label="Меню" aria-expanded="false">
          <span></span><span></span><span></span>
        </button>
      </div>
    </div>
  </header>

  <main>
    <!-- HERO -->
    <section class="hero" id="hero">
      <div class="hero__bg">
        
        <div class="hero__bg-image hero__bg-image--desktop" data-bg="/design/assets/images/env-hero.png"></div>
        <div class="hero__bg-image hero__bg-image--mobile" data-bg="/design/assets/images/env-hero-mobile.png"></div>
        <div class="hero__gradient"></div>
        <div class="hero__fog hero__fog--1"></div>
        <div class="hero__fog hero__fog--2"></div>
        <canvas class="hero__particles" id="heroParticles"></canvas>
        <div class="hero__light"></div>
      </div>

      <div class="hero__content container">
        <p class="hero__eyebrow reveal" data-i18n="hero.eyebrow">THE WORLD OF LINEAGE II</p>
        <h1 class="hero__title" id="heroTitle">
          <img src="/design/assets/images/logo.png" alt="LA2PLUS" class="hero__logo-img" width="560" height="200">
        </h1>
        <p class="hero__subtitle reveal" data-i18n="hero.subtitle">Классический Lineage 2 в современном исполнении</p>
        <p class="hero__rates reveal" id="heroRates"><span class="hero__rates-badge">INTERLUDE • x5</span></p>

        <div class="hero__opening reveal">
          <span class="hero__opening-label" data-i18n="hero.opening">GRAND OPENING</span>
          <div class="hero__opening-date" id="openingDate">25 SEPTEMBER • 20:00</div>
          <div class="countdown" id="countdown">
            <div class="countdown__item"><span class="countdown__value" id="cdDays">00</span><span class="countdown__label" data-i18n="countdown.days">ДНЕЙ</span></div>
            <span class="countdown__sep">:</span>
            <div class="countdown__item"><span class="countdown__value" id="cdHours">00</span><span class="countdown__label" data-i18n="countdown.hours">ЧАСОВ</span></div>
            <span class="countdown__sep">:</span>
            <div class="countdown__item"><span class="countdown__value" id="cdMinutes">00</span><span class="countdown__label" data-i18n="countdown.minutes">МИНУТ</span></div>
            <span class="countdown__sep">:</span>
            <div class="countdown__item"><span class="countdown__value" id="cdSeconds">00</span><span class="countdown__label" data-i18n="countdown.seconds">СЕКУНД</span></div>
          </div>
          <div class="hero__online-badge hidden" id="serverOnlineBadge" data-i18n="hero.serverOnline">SERVER ONLINE</div>
        </div>

        <div class="hero__cta reveal">
          <a class="btn btn--gold btn--lg btn--shine" id="startGameBtn" data-i18n="btn.startGame" href="#howto">НАЧАТЬ ИГРАТЬ</a>
          <a href="#about" class="btn btn--outline btn--lg" data-i18n="btn.aboutServer">О СЕРВЕРЕ</a>
        </div>

        <div class="server-status reveal" id="serverStatus"><?php $this->widget('app.widgets.ServerStatus.ServerStatus'); ?></div>

      <a href="#about" class="hero__scroll" id="scrollExplore">
        <span data-i18n="hero.scroll">SCROLL TO EXPLORE</span>
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 5v14M5 12l7 7 7-7"/></svg>
      </a>
    </section>

    <!-- ABOUT -->
    <section class="section about" id="about">
      <div class="about__bg" data-bg="/design/assets/images/env-about.png"></div>
      <div class="about__overlay"></div>
      <div class="section__fog"></div>
      <div class="container">
        <div class="section__header reveal">
          <h2 class="section__title" data-i18n="about.title">ИГРА, КОТОРУЮ МЫ ПОМНИМ</h2>
          <p class="section__subtitle" data-i18n="about.subtitle">Классическая атмосфера Lineage 2 с современным подходом к комфорту, стабильности и развитию сервера.</p>
        </div>
        <div class="about__stats reveal" id="aboutStats">
          <div class="stat-card"><span class="stat-card__value" data-config="chronicle">INTERLUDE</span><span class="stat-card__label" data-i18n="about.chronicle">Хроники</span></div>
          <div class="stat-card"><span class="stat-card__value" data-config="rateExp">x5</span><span class="stat-card__label">EXP</span></div>
          <div class="stat-card"><span class="stat-card__value" data-config="rateAdena">x3</span><span class="stat-card__label">ADENA</span></div>
          <div class="stat-card"><span class="stat-card__value" data-config="rateDrop">x3</span><span class="stat-card__label">DROP</span></div>
          <div class="stat-card"><span class="stat-card__value" data-config="windows">1+1</span><span class="stat-card__label" data-i18n="about.windows">Окна</span></div>
        </div>
      </div>
    </section>

    <!-- SERVER RATES -->
    <section class="section rates" id="rates">
      <div class="rates__bg" data-bg="/design/assets/images/env-path.png"></div>
      <div class="rates__overlay"></div>
      <div class="rates__glow rates__glow--1"></div>
      <div class="rates__glow rates__glow--2"></div>
      <div class="container">
        <div class="section__header reveal">
          <span class="section__eyebrow" data-i18n="rates.eyebrow">SERVER RATES</span>
          <h2 class="section__title" data-i18n="rates.title">РЕЙТЫ СЕРВЕРА</h2>
          <p class="section__subtitle" data-i18n="rates.subtitle">Сбалансированные множители для комфортного и честного прогресса</p>
        </div>
        <div class="rates__grid" id="ratesGrid"></div>
      </div>
    </section>

    <!-- WHY LA2PLUS -->
    <section class="section features" id="features">
      <div class="container">
        <div class="section__header reveal">
          <h2 class="section__title" data-i18n="features.title">ПОЧЕМУ LA2PLUS</h2>
        </div>
        <div class="features__grid" id="featuresGrid"></div>
      </div>
    </section>

    <!-- CINEMATIC WORLD -->
    <section class="section world" id="world">
      <div class="world__bg" data-bg="/design/assets/images/env-world.png"></div>
      <div class="world__overlay"></div>
      <div class="container world__inner">
        <div class="world__visual reveal">
          <img src="/design/assets/images/env-world.png" alt="Рыцарь и маг смотрят на замок LA2PLUS" class="world__character" loading="lazy">
        </div>
        <div class="world__text reveal">
          <h2 class="section__title" data-i18n="world.title">ТВОЯ ИСТОРИЯ</h2>
          <p data-i18n="world.text">Создай персонажа. Найди союзников. Построй клан. Захвати замок. Стань частью истории LA2PLUS.</p>
        </div>
      </div>
    </section>

    <!-- PVP / CLANS / BOSSES -->
    <section class="section gameplay" id="gameplay">
      <div class="container">
        <div class="gameplay__grid">
          <article class="gameplay-card reveal" data-tilt>
            <div class="gameplay-card__bg" data-bg="/design/assets/images/env-pvp.png"></div>
            <div class="gameplay-card__overlay"></div>
            <div class="gameplay-card__particles"></div>
            <div class="gameplay-card__content">
              <h3>PVP</h3>
              <p data-i18n="gameplay.pvp">Докажи своё превосходство</p>
            </div>
          </article>
          <article class="gameplay-card reveal" data-tilt>
            <div class="gameplay-card__bg" data-bg="/design/assets/images/env-clans.png"></div>
            <div class="gameplay-card__overlay"></div>
            <div class="gameplay-card__particles"></div>
            <div class="gameplay-card__content">
              <h3>CLANS</h3>
              <p data-i18n="gameplay.clans">Создай сильнейший альянс</p>
            </div>
          </article>
          <article class="gameplay-card reveal" data-tilt>
            <div class="gameplay-card__bg" data-bg="/design/assets/images/env-bosses.png"></div>
            <div class="gameplay-card__overlay"></div>
            <div class="gameplay-card__particles"></div>
            <div class="gameplay-card__content">
              <h3>EPIC BOSSES</h3>
              <p data-i18n="gameplay.bosses">Сражайся за легендарные награды</p>
            </div>
          </article>
        </div>
      </div>
    </section>

    <!-- HOW TO START -->
    <section class="section howto" id="howto">
      <div class="howto__bg" data-bg="/design/assets/images/env-path.png"></div>
      <div class="howto__overlay"></div>
      <div class="container">
        <div class="section__header reveal">
          <h2 class="section__title" data-i18n="howto.title">НАЧНИ ИГРАТЬ</h2>
          <p class="section__subtitle" data-i18n="howto.subtitle">Всего три шага до мира LA2PLUS</p>
        </div>
        <div class="howto__steps">
          <div class="howto-step reveal">
            <span class="howto-step__num">01</span>
            <h3 data-i18n="howto.step1.title">СОЗДАЙ АККАУНТ</h3>
            <a  class="btn btn--gold" id="registerBtnHowto" data-i18n="btn.registration" href="<?php echo app()->createUrl('/register/default/index'); ?>">Регистрация</a>
          </div>
          <div class="howto-step reveal">
            <span class="howto-step__num">02</span>
            <h3 data-i18n="howto.step2.title">СКАЧАЙ ИГРУ</h3>
            <div class="howto-step__downloads">
              <a href="/page/downloads/" class="btn btn--outline" data-download="client" data-i18n="btn.downloadClient">Скачать клиент</a>
              <a href="/page/downloads/" class="btn btn--outline" data-download="patch" data-i18n="btn.downloadPatch">Скачать патч</a>
            </div>
            <div class="howto-step__mirrors">
              <a href="/page/downloads/" data-mirror="torrent">Torrent</a>
              <a href="/page/downloads/" data-mirror="gdrive">Google Drive</a>
              <a href="/page/downloads/" data-mirror="mega">Mega</a>
            </div>
          </div>
          <div class="howto-step reveal">
            <span class="howto-step__num">03</span>
            <h3 data-i18n="howto.step3.title">ВОЙДИ В ИГРУ</h3>
            <p data-i18n="howto.step3.text">Установи патч, запусти LA2PLUS Launcher и начинай играть.</p>
            <a class="btn btn--gold btn--shine" data-i18n="btn.startGame" href="#howto">НАЧАТЬ ИГРАТЬ</a>
          </div>
        </div>
      </div>
    </section>

    <!-- NEWS -->
    <section class="section news" id="news">
      <div class="container">
        <div class="section__header reveal">
          <h2 class="section__title" data-i18n="news.title">ПОСЛЕДНИЕ СОБЫТИЯ</h2>
        </div>
        <div class="cms-content"><?php echo $content; ?></div>
        <div class="news__more reveal">
          <a class="btn btn--outline" data-i18n="news.all" href="/news/">Все новости</a>
        </div>
      </div>
    </section>

    <!-- COMMUNITY -->
    <section class="section community" id="community">
      <div class="community__bg" data-bg="/design/assets/images/env-community.png"></div>
      <div class="community__overlay"></div>
      <div class="container community__inner reveal">
        <h2 class="section__title" data-i18n="community.title">ВСТУПАЙ В СООБЩЕСТВО</h2>
        <p class="section__subtitle" data-i18n="community.text">Следи за новостями LA2PLUS, участвуй в обсуждениях и находи союзников ещё до старта.</p>
        
        <div class="community__buttons">
          <a href="/page/community/" class="btn btn--discord btn--lg" id="discordBtn" data-i18n="btn.discord">DISCORD</a>
          <a href="/page/community/" class="btn btn--telegram btn--lg" id="telegramBtn" data-i18n="btn.telegram">TELEGRAM</a>
          <a href="/page/community/" class="btn btn--outline btn--lg" id="youtubeBtn">YouTube</a>
        </div>
      </div>
    </section>

    <!-- FINAL CTA -->
    <section class="section final-cta" id="finalCta">
      <div class="final-cta__bg" data-bg="/design/assets/images/env-final.png"></div>
      <div class="final-cta__overlay"></div>
      <div class="container final-cta__inner reveal">
        <h2 class="section__title" data-i18n="finalCta.title">ТВОЯ ИСТОРИЯ НАЧИНАЕТСЯ СЕЙЧАС</h2>
        <div class="final-cta__buttons">
          <a  class="btn btn--gold btn--lg btn--shine" id="registerBtnFinal" data-i18n="btn.register" href="<?php echo app()->createUrl('/register/default/index'); ?>">СОЗДАТЬ АККАУНТ</a>
          <a href="/page/community/" class="btn btn--discord btn--lg" data-i18n="btn.discord">DISCORD</a>
        </div>
      </div>
    </section>
  </main>

  <!-- FOOTER -->
  <footer class="footer">
    <div class="container footer__inner">
      <div class="footer__brand">
        <img src="/design/assets/images/logo.png" alt="LA2PLUS" class="footer__logo-img" width="180" height="54">
      </div>
      <nav class="footer__links">
        <a href="/page/community/" id="footerDiscord">Discord</a>
        <a href="/page/community/" id="footerTelegram">Telegram</a>
        <a href="/page/rules/" data-i18n="footer.rules">Правила</a>
        <a href="/page/terms/" data-i18n="footer.terms">Пользовательское соглашение</a>
        <a href="/page/privacy/" data-i18n="footer.privacy">Политика конфиденциальности</a>
        <a href="/cabinet/tickets/" data-i18n="footer.support">Поддержка</a>
      </nav>
      <p class="footer__disclaimer">LA2PLUS is an independent game project.</p>
      <p class="footer__legal" data-i18n="footer.legal">Lineage II is a registered trademark of NCSOFT Corporation. This project is not affiliated with NCSOFT.</p>
    </div>
  </footer>

  <!-- TOAST CONTAINER -->
  <div class="toast-container" id="toastContainer" aria-live="polite"></div>

  <script src="/design/js/config.js"></script>
  <script src="/design/js/i18n.js"></script>
  <script src="/design/js/app.js"></script>
</body>
</html>
