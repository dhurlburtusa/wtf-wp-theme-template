// console.log('webpack.config.js')
const path = require('path')

const TerserPlugin = require('terser-webpack-plugin')
// const webpack = require('webpack')
const WebpackAssetsManifest = require('webpack-assets-manifest')

const defaultRuntimeEnv = 'production'

/**
 * @param {Object} env - The environment options.
 * @param {boolean} env.debug Optional. Defaults to false.
 * @param {Object} argv - An options map. From what I have read, it sounds like these
 *   come from many of the command line options. It is stated in the Webpack
 *   documentation that command-line options override configuration options. So, I am
 *   not sure the benefit of using `argv` is if it will just be overridden. More
 *   investigation is required.
 */
const configFactory = (env = {}, argv) => {
  // console.log('env:')
  // console.dir(env)
  // console.log('argv:')
  // console.dir(argv)
  // const { /* Depends on how the command-line was called. */ } = env
  // const option1 = argv['option1']
  // const optimizeMinimize = argv['optimize-minimize']

  const debug = env.debug || false

  const SRC_DIR = path.resolve(__dirname, 'src', 'scripts')
  const DEST_DIR = path.resolve(__dirname, 'assets', 'scripts')

  const bail = argv.bail === null ? false : argv.bail
  const mode = argv.mode || defaultRuntimeEnv

  const runtimeEnv = ['development', 'production'].includes(mode) ? mode : defaultRuntimeEnv
  ensureEnv({ runtimeEnv })

  // Source maps are resource heavy and can cause out of memory issue for large source files.
  const generateSourceMap = process.env.GENERATE_SOURCEMAP !== 'false'

  const settings = {
    generateSourceMap,
    imageInlineSizeLimit: 4096,
    isEnvDevelopment: runtimeEnv === 'development',
    isEnvProduction: runtimeEnv === 'production',
    wordpress: {
      // eslint-disable-next-line camelcase
      site_url: '',
      // eslint-disable-next-line camelcase
      theme_name: 'wtf',
      // eslint-disable-next-line camelcase
      themes_url: 'wp-content/themes',
    },
  }

  return new Promise((resolve, reject) => {
    // console.log('config#promise#executor')
    const name = 'default'

    const context = SRC_DIR

    // const entry = './index.js'
    // const entry = {
    //   main: './index.js',
    //   chunk1: './chunk1-entry.js',
    //   chunk2: ['./polyfill.js', './chunk2-entry.js'],
    // }
    const entry = {
      main: ['./index.js'],
    }

    const externals = undefined
    // const externals = {
    //   bootstrap: '$',
    //   jquery: 'jQuery',
    // }

    // const moduleResolve = undefined
    const moduleResolve = {
      alias: {
        App: context,
      },
      modules: [context, 'node_modules'],
    }

    const target = undefined

    // Transformation Related:
    // -----------------------

    // Process application JS with Babel.
    // The preset includes JSX, Flow, TypeScript, and some ESnext features.
    const appJsRule = {
      resource: {
        test: /\.(js|mjs|jsx|ts|tsx)$/,
        include: context,
      },
      use: {
        loader: require.resolve('babel-loader'),
        options: {
          // babel-loader Options:
          // ---------------------

          // See create-react-app#6846 for context on why cacheCompression is disabled
          cacheCompression: false,
          // This is a feature of `babel-loader` for webpack (not Babel itself).
          // It enables caching results in ./node_modules/.cache/babel-loader/
          // directory for faster rebuilds.
          cacheDirectory: true,
          // customize: require.resolve(
          //   'babel-preset-react-app/webpack-overrides'
          // ),

          // babel Options:
          // --------------

          // TODO: Test how setting `compact` to true affects TerserPlugin. I am hoping that we can set this to false since we are relying on Terser to do compression.
          // compact: settings.isEnvProduction,
          // plugins: [
          //   // [
          //   //   require.resolve('babel-plugin-named-asset-import'),
          //   //   {
          //   //     loaderMap: {
          //   //       svg: {
          //   //         ReactComponent:
          //   //           '@svgr/webpack?-svgo,+titleProp,+ref![path]',
          //   //       },
          //   //     },
          //   //   },
          //   // ],
          // ],
          // presets: [
          //   // require.resolve('@babel/preset-env'),
          //   require.resolve('@babel/preset-react'),
          //   require.resolve('@babel/preset-typescript'),
          // ],
          // Setting `rootMode` to `'upward'` allows the `babel.config.js` project-wide Babel
          // configuration to be found if the current working directory is not the
          // repository's root.
          // rootMode: 'upward',
        },
      },
    }

    // "file" loader makes sure those assets get served by WebpackDevServer.
    // When you `import` an asset, you get its (virtual) filename.
    // In production, they would get copied to the `build` folder.
    // This loader doesn't use a "test" so it will catch all modules
    // that fall through the other loaders.
    const fallbackFileRule = {
      loader: require.resolve('file-loader'),
      // Exclude `js` files to keep "css" loader working as it injects
      // its runtime that would otherwise be processed through "file" loader.
      // Also exclude `html` and `json` extensions so they get processed
      // by webpacks internal loaders.
      exclude: [/\.(js|mjs|jsx|ts|tsx)$/, /\.html$/, /\.json$/],
      options: {
        name: `${settings.wordpress.site_url}/assets/media/[name].[hash:8].[ext]`,
      },
    }

    // "url" loader works like "file" loader except that it embeds assets
    // smaller than specified limit in bytes as data URLs to avoid requests.
    // A missing `test` is equivalent to a match.
    const imageRule = {
      test: [/\.bmp$/, /\.gif$/, /\.jpe?g$/, /\.png$/],
      loader: require.resolve('url-loader'),
      options: {
        limit: settings.imageInlineSizeLimit,
        name: `${settings.wordpress.site_url}/assets/images/[name].[hash:8].[ext]`,
      },
    }

    const loaders = {
      noParse: /jquery/,
      strictExportPresence: true,

      rules: [
        // Disable require.ensure as it's not a standard language feature.
        { parser: { requireEnsure: false } },

        {
          // "oneOf" will traverse all following loaders until one will
          // match the requirements. When no loader matches it will fall
          // back to the "file" loader at the end of the loader list.
          oneOf: [
            imageRule,
            appJsRule,
            fallbackFileRule,
            // ** STOP ** Are you adding a new loader?
            // Make sure to add the new loader(s) before the "fallback-file" loader.
          ],
          // TODO: Since we have a reference to the "fallback-file" loader rule, we can issue an error if someone adds a new rule after it.
        },

        // {
        //   resource: {
        //     test: /\.(js|jsx|mjs)$/,
        //   },

        //   use: [
        //     {
        //       loader: 'babel-loader',
        //       options: {
        //         // ident: 'some-unique-identifier', // Almost never needed.
        //       },
        //     },
        //   ],

        // },
        // {
        //   // Conditions:

        //   /*
        //   * A Condition in the following documentation is shorthand for the following
        //   * parameter declarations.
        //   *
        //   * @param {string}
        //   * @param {!RegExp}
        //   * @param {function (input: string): boolean}
        //   * @param {Condition[]}
        //   * @param {{ test: Condition, included: Condition, excluded: Condition, and: Condition, or: Condition, not: Condition}}
        //   */

        //   /*
        //   * @param {Condition}
        //   */
        //   issuer: undefined,

        //   /*
        //   * Shorthand for `resource.test`.
        //   *
        //   * @param {Condition}
        //   */
        //   test: undefined,
        //   /*
        //   * Shorthand for `resource.include`.
        //   *
        //   * @param {Condition}
        //   */
        //   include: undefined,
        //   /*
        //   * Shorthand for `resource.exclude`.
        //   *
        //   * @param {Condition}
        //   */
        //   exclude: undefined,

        //   /*
        //   * Longhand for `Rule.test`, `Rule.include`, `Rule.exclude`.
        //   * @param {Condition}
        //   */
        //   resource: {
        //     test: undefined,
        //     include: undefined,
        //     exclude: undefined,
        //     and: [],
        //     or: [],
        //     not: [],
        //   },
        //   /*
        //   * Could be used to treat imports with a "query" differently.
        //   *
        //   * @param {Condition}
        //   */
        //   resourceQuery: undefined,
        //   // Could be used on CSS imports to declare that the CSS should be inlined.
        //   resourceQuery: /inline/,

        //   // Meta:

        //   /*
        //   * Aids with tree-shaking. See
        //   * https://webpack.js.org/guides/tree-shaking/#mark-the-file-as-side-effect-free
        //   * for more info.
        //   */
        //   sideEffects: false,
        //   sideEffects: [
        //     'glob',
        //   ],

        //   // Results:

        //   /*
        //   * @param {'pre'|'post'}
        //   */
        //   enforce: undefined,

        //   /*
        //   * A shortcut for `Rule.use: [ { loader } ]`.
        //   * @param {string}
        //   */
        //   loader: undefined,
        //   /*
        //   * A shortcut for `Rule.use: [ { options } ]`.
        //   * @param {Object}
        //   */
        //   options: {},

        //   use: [
        //     {
        //       /*
        //       * @param {string}
        //       */
        //       loader: 'foo-loader',
        //       /*
        //       * @param {Object=}
        //       */
        //       options: {
        //         // ident: 'some-unique-identifier', // Almost never needed.
        //       },
        //     },
        //     // May use a function instead
        //     ({ compiler, issuer, realResource, resource }) => {
        //       // ...
        //       return {
        //         loader: 'foo-loader',
        //         options: { /* ... */ },
        //       }
        //     },
        //   ],

        //   /*
        //   * @param {Object=}
        //   */
        //   parser: undefined,

        //   /*
        //   * See https://webpack.js.org/configuration/module/#ruletype for more info.
        //   *
        //   * @param {'javascript/auto'|'javascript/dynamic'|'javascript/esm'|'json'|'webassembly/experimental'}
        //   */
        //   type: undefined,

        //   // Nested Rules:

        //   /*
        //   * @param {Rule[]=}
        //   */
        //   oneOf: undefined,

        //   /*
        //   * An array of Rules that is also used when the Rule matches.
        //   * @param {Rule[]=}
        //   */
        //   rules: undefined,
        // },
        // {
        //   test: /\.css$/,
        //   use: [
        //     'style-loader',
        //     'css-loader',
        //   ]
        // },
        // {
        //   test: /\.(gif|jpg|jpeg|png|svg|webp)$/,
        //   use: [
        //     {
        //       loader: 'url-loader',
        //       options: {
        //         limit: 4096
        //       },
        //     }
        //   ],
        // },
        // {
        //   test: /\.(eot|otf|ttf|woff|woff2)$/,
        //   use: [
        //     'file-loader',
        //   ],
        // },
        // ...
      ],
    }

    // Output Related:
    // ---------------

    // The `devtool` option controls if and how source maps are generated.
    // See https://webpack.js.org/configuration/devtool/ for details.
    let devtool = false // The default value.
    if (settings.isEnvProduction) {
      if (settings.generateSourceMap) {
        // devtool = 'cheap-module-source-map' // build: slow, rebuild: slower
        // devtool = 'cheap-source-map' // build: fast, rebuild: slow
        // devtool = 'hidden-source-map' // build: slowest, rebuild: slowest
        // devtool = 'nosources-source-map' // build: slowest, rebuild: slowest
        devtool = 'source-map' // build: slowest, rebuild: slowest
      }
      else {
        devtool = false
      }
    }
    else if (settings.isEnvDevelopment) {
      // The following options are ideal for development.
      // devtool = 'cheap-eval-source-map'
      // devtool = 'cheap-module-eval-source-map'
      // devtool = 'eval'
      // devtool = 'eval-source-map'

      // The following is what Create-React-App has chosen for `devtool` despite it not
      // being recommended for development.
      devtool = 'cheap-module-source-map'
    }
    else {
      // The following options for `devtool` are not idea for development nor production.
      // They are needed for some special cases, i.e., for some 3rd party tools.
      // devtool = 'cheap-module-source-map'
      // devtool = 'cheap-source-map'
      // devtool = 'inline-cheap-module-source-map'
      // devtool = 'inline-cheap-source-map'
      // devtool = 'inline-source-map'
    }

    const output = {
      chunkFilename: '[name].[chunkhash].chunk.js',

      filename: '[name].[chunkhash].js',

      path: DEST_DIR,

      publicPath: `${settings.wordpress.themes_url}/${settings.wordpress.theme_name}/assets/scripts/`,
    }

    const optimization = {
      minimize: settings.isEnvProduction,
      minimizer: [
        // This is only used in production mode
        new TerserPlugin({
          // Enable file caching
          // cache: true, // The default value.
          // extractComments: true, // The default value.
          // parallel: true, // The default value.
          sourceMap: settings.generateSourceMap,
          terserOptions: {
            // // TODO: Test how this affects the code.
            // module: true,
            // // TODO: Test how this affects the code. May need to include `top_retain` option. Does it remove references to `window`?
            // toplevel: true,
            parse: {
              // We want terser to parse ecma 8 code. However, we don't want it
              // to apply any minification steps that turns valid ecma 5 code
              // into invalid ecma 5 code. This is why the 'compress' and 'output'
              // sections only apply transformations that are ecma 5 safe
              // https://github.com/facebook/create-react-app/pull/4234
              // ecma: 8, // The default value.
            },
            compress: {
              // Disabled because of an issue with Uglify breaking seemingly valid code:
              // https://github.com/facebook/create-react-app/issues/2376
              // Pending further investigation:
              // https://github.com/mishoo/UglifyJS2/issues/2011
              comparisons: false,
              // eslint-disable-next-line camelcase
              drop_debugger: !debug,
              // ecma: 5, // The default value.
              // eslint-disable-next-line camelcase
              global_defs: {
                // '@alert': 'console.log',
                DEBUG: debug,
              },
              // Disabled because of an issue with Terser breaking valid code:
              // https://github.com/facebook/create-react-app/issues/5250
              // Pending further investigation:
              // https://github.com/terser-js/terser/issues/120
              inline: 2,
              // module: true,
              // toplevel: true,
              // warnings: false, // The default value.
            },
            mangle: {
              safari10: true,
            },
            output: {
              // Turned on because emoji and regex is not minified properly using default
              // https://github.com/facebook/create-react-app/issues/2488
              // eslint-disable-next-line camelcase
              ascii_only: true,
              // comments: false, // The default value.
              // ecma: 5, // The default value.
              semicolons: false,
            },
          },
        }),
      ],
      // Keep the runtime chunk separated to enable long term caching
      // https://twitter.com/wSokra/status/969679223278505985
      // https://github.com/facebook/create-react-app/issues/5358
      runtimeChunk: {
        name: entrypoint => `runtime-${entrypoint.name}`,
      },
      // Automatically split vendor and commons
      // https://twitter.com/wSokra/status/969633336732905474
      // https://medium.com/webpack/webpack-4-code-splitting-chunk-graph-and-the-splitchunks-optimization-be739a861366
      splitChunks: {
        chunks: 'all',
        name: false,
      },
    }

    const performance = {
      hints: 'error',
      maxEntrypointSize: 250000,
      maxAssetSize: 250000,
    }

    const plugins = [
      new WebpackAssetsManifest({
        // Filter out *.map files. We don't need them.
        customize: ({ key, value }) => {
          // You can prevent adding items to the manifest by returning false.
          if (key.toLowerCase().endsWith('.map')) return false
          return { key, value }
        },
        integrity: true,
      }),
    ]

    const defaultConfig = {
      bail,
      context,
      devtool,
      entry,
      externals,
      mode,
      module: loaders,
      name,
      optimization,
      output,
      performance,
      plugins,
      resolve: moduleResolve,
      target,
    }

    const webpackConfigs = [
      defaultConfig,
    ]

    // console.log(webpackConfigs)

    resolve(webpackConfigs)
  })
}

function ensureEnv ({ runtimeEnv }) {
  process.env.BABEL_ENV = process.env.BABEL_ENV || runtimeEnv
  process.env.NODE_ENV = process.env.NODE_ENV || runtimeEnv
}

module.exports = configFactory
