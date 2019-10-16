/*
 |--------------------------------------------------------------------------
 | Browser-sync config file
 |--------------------------------------------------------------------------
 |
 | For up-to-date information about the options:
 |   http://www.browsersync.io/docs/options/
 |
 | There are more options than you see here, these are just the ones that are
 | set internally. See the website for more info.
 */
module.exports = {
  // The following assumes you access your WordPress site using
  // `http://wordpress.local`. Update to the correct value for your situation.
  // proxy: 'http://wordpress.local/',
  // host: 'wordpress.local',
  files: [
    './**/*.php',
    {
      // By default, CSS changes are injected instead of reloading the browser. This can
      // be changed by setting `injectChanges` to false. Or, you can determine what
      // happens when a file changes by declaring a function to be called when a file
      // changes.
      match: [
        './assets/styles/*.css',
      ],
      fn: function (event, file) {
        const browserSync = this
        browserSync.reload()
      },
    },
  ],
  watchEvents: [
    'add',
    'addDir',
    'change',
    'unlink',
    'unlinkDir',
  ],
  ui: false,
  // ui: {
  //   enabled: false,
  //   port: 3001,
  // },

  // Defaults:
  // ui: {
  //   port: 3001
  // },
  // files: false,
  // watchEvents: ['change'],
  // watch: false,
  // ignore: [],
  // single: false,
  // watchOptions: {
  //   ignoreInitial: true
  // },
  // server: false,
  // proxy: false,
  // port: 3000,
  // middleware: false,
  // serveStatic: [],
  // ghostMode: {
  //   clicks: true,
  //   scroll: true,
  //   location: true,
  //   forms: {
  //     submit: true,
  //     inputs: true,
  //     toggles: true
  //   }
  // },
  // logLevel: 'info',
  // logPrefix: 'Browsersync',
  // logConnections: false,
  // logFileChanges: true,
  // logSnippet: true,
  // rewriteRules: [],
  // open: 'local',
  // browser: 'default',
  // cors: false,
  // xip: false,
  // hostnameSuffix: false,
  // reloadOnRestart: false,
  // notify: true,
  // scrollProportionally: true,
  // scrollThrottle: 0,
  // scrollRestoreTechnique: 'window.name',
  // scrollElements: [],
  // scrollElementMapping: [],
  // reloadDelay: 0,
  // reloadDebounce: 500,
  // reloadThrottle: 0,
  // plugins: [],
  // injectChanges: true,
  // startPath: null,
  // minify: true,
  // host: null,
  // localOnly: false,
  // codeSync: true,
  // timestamps: true,
  // clientEvents: [
  //   'click',
  //   'form:reset',
  //   'form:submit',
  //   'input:text',
  //   'input:toggles',
  //   'scroll',
  //   'scroll:element',
  // ],
  // socket: {
  //   socketIoOptions: {
  //     log: false,
  //   },
  //   socketIoClientConfig: {
  //     reconnectionAttempts: 50,
  //   },
  //   path: '/browser-sync/socket.io',
  //   clientPath: '/browser-sync',
  //   namespace: '/browser-sync',
  //   clients: {
  //     heartbeatTimeout: 5000,
  //   },
  // },
  // tagNames: {
  //   less: 'link',
  //   scss: 'link',
  //   css: 'link',
  //   jpg: 'img',
  //   jpeg: 'img',
  //   png: 'img',
  //   svg: 'img',
  //   gif: 'img',
  //   js: 'script',
  // },
  // injectNotification: false
}
