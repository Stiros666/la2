const LA2PLUS_CONFIG = {
  server: {
    name: 'LA2PLUS',
    chronicle: 'Interlude',
    rate: 'x5',
    rateExp: 'x5',
    rateAdena: 'x3',
    rateDrop: 'x3',
    windows: '1+1',
    onlineMultiplier: 1,
    openingDate: '2026-09-25T20:00:00+05:00',
    openingDateDisplay: '25 SEPTEMBER • 20:00',
  },

  rates: [
    { key: 'exp', icon: '⚔', value: 'x5' },
    { key: 'sp', icon: '✦', value: 'x5' },
    { key: 'adena', icon: '◎', value: 'x3' },
    { key: 'drop', icon: '▼', value: 'x3' },
    { key: 'spoil', icon: '◈', value: 'x3' },
    { key: 'quest', icon: '☰', value: 'x1' },
    { key: 'party', icon: '⚑', value: 'x1.5' },
    { key: 'premium', icon: '★', value: 'x2' },
  ],

  features: [
    { icon: '◎', titleKey: 'features.economy.title', descKey: 'features.economy.desc' },
    { icon: '⚔', titleKey: 'features.fair.title', descKey: 'features.fair.desc' },
    { icon: '✦', titleKey: 'features.classic.title', descKey: 'features.classic.desc' },
    { icon: '⚑', titleKey: 'features.global.title', descKey: 'features.global.desc' },
    { icon: '◈', titleKey: 'features.infra.title', descKey: 'features.infra.desc' },
    { icon: '★', titleKey: 'features.community.title', descKey: 'features.community.desc' },
  ],

  news: [],

  links: {
    discord: '/page/community/',
    telegram: '/page/community/',
    youtube: '/page/community/',
    downloads: {
      client: '/page/downloads/',
      patch: '/page/downloads/',
      torrent: '/page/downloads/',
      gdrive: '/page/downloads/',
      mega: '/page/downloads/',
    },
  },

  discord: {
    members: 4253,
    online: 327,
  },


};
