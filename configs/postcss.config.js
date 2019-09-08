module.exports = (ctx) => {
  const { cwd, env, file, options } = ctx;
  const { basename, dirname, extname } = file;
  const { map, parser, stringifier, syntax } = options;
  return {
    ...options,
    // Needed to allow parsing of inline comments (i.e. //) in .scss files.
    syntax: require('postcss-syntax')(),
    plugins: [
      require('postcss-easy-import')({
        // Use the following extensions and prefixes to add to the name used in the @import
        // to try to find the file to import.
        extensions: ['.css', '.scss'],
        prefix: '_',
      }),
      // Properly rebases the URLs to be relative to the output style sheet.
      require('postcss-url')(
        // {
        //   url: 'rebase',
        // }
      ),
      // require('postcss-assets')({
      //   loadPaths: [
      //     'assets/fonts/',
      //     'assets/images/'
      //   ],
      // }),
      require('postcss-strip-inline-comments')(),
      require('precss')({
        // Set the `autoprefixer` options. See
        // https://github.com/csstools/postcss-preset-env#autoprefixer and
        // https://github.com/postcss/autoprefixer#options.
        autoprefixer: {
          // Whether Autoprefixer should use Visual Cascade, if CSS is uncompressed.
          // cascade: false,
          // cascade: true, // The default.

          // Environment for Browserslist. See
          // https://github.com/browserslist/browserslist#configuring-for-different-environments.
          // env: undefined, // The default.

          // Whether or how Autoprefixer should add prefixes for `flexbox` properties.
          // When set to `'no-2009'`, Autoprefixer will add prefixes only for final and
          // IE 10 versions of the specification.
          // flexbox: 'no-2009',
          // flexbox: false,
          // flexbox: true, // The default.

          // Whether Autoprefixer should add IE 10-11 prefixes for Grid Layout properties.
          //
          // - `false`: Prevent Autoprefixer from outputting CSS Grid translations. (default)
          // - `'autoplace'`: Enable Autoprefixer grid translations and include autoplacement
          //   support.
          // - `'no-autoplace'`: Enable Autoprefixer grid translations but exclude
          //   autoplacement support.
          // grid: 'autoplace',
          // grid: 'no-autoplace',
          // grid: false, // The default.

          // Whether Autoprefixer should remove outdated prefixes.
          // remove: false,
          // remove: true, // The default.

          // Whether Autoprefixer should add prefixes for `@supports` parameters.
          // supports: false,
          // supports: true, // The default.
        },

        // If not valid browserslist configuration is specified, the default browserslist
        // query will be used. See https://github.com/csstools/postcss-preset-env#browsers.
        // browsers: '> 0.5%, last 2 versions, Firefox ESR, not dead', // The default. See https://github.com/browserslist/browserslist#queries.
        // browsers: 'ie >= 9',

        // By default, plugin will bubble only `@media` and `@supports` at-rules. See
        // https://github.com/postcss/postcss-nested#bubble.
        // bubble: ['media', 'supports'], // The default.

        // The `disable` option defines which features should be disabled. The disable
        // option can be a string or an array, and the features that can be disabled
        // are `@content`, `@each`, `@else`, `@if`, `@include`, `@import`, `@for`, and
        // `@mixin`.
        //
        // The `postcss-advanced-variables` plugin that the `precss` plugin uses causes
        // a warning to be issued from `postcss` when importing files. The postcss
        // configuration doesn't seem to be passed to the postcss processor that handles
        // the imported file. So, we are configuring `postcss-advanced-variables` to not
        // handle `@import` at-rules. Instead, `postcss-easy-import` is being used.
        // Note: Because `postcss-easy-import` runs before the `precss` plugin, this
        // plugin should not ever see `@import`. But we are explicitly disabling for
        // robustness.
        disable: '@import',

        // The `features` option enables or disables specific polyfills by ID. See
        // https://github.com/csstools/postcss-preset-env#features.
        features: {
          // 'all-property': false,
          // 'any-link-pseudo-class': false,
          // 'blank-pseudo-class': false,
          // 'break-properties': false,
          // 'case-insensitive-attributes': false,
          // 'color-functional-notation': false,
          // 'color-mod-function': false,
          // 'custom-media-queries': false,
          // 'custom-properties': false,
          // 'custom-selectors': false,
          // 'dir-pseudo-class': false,
          // 'double-position-gradients': false,
          // 'environment-variables': false,
          // 'focus-visible-pseudo-class': false,
          // 'focus-within-pseudo-class': false,
          // 'font-variant-property': false,
          // 'gap-properties': false,
          // 'gray-function': false,
          // 'has-pseudo-class': false,
          // 'hexadecimal-alpha-notation': false,
          // 'image-set-function': false,
          // 'lab-function': false,
          // 'logical-properties-and-values': false,
          // 'matches-pseudo-class': false,
          // 'media-query-ranges': false,
          // 'nesting-rules': false,
          // 'not-pseudo-class': false,
          // 'overflow-property': false,
          // 'overflow-wrap-property': false,
          // 'place-properties': false,
          // 'prefers-color-scheme-query': false,
          // 'rebeccapurple-color': false,
          // 'system-ui-font-family': false,
        },

        // When a lookup cannot be resolved, this specifies whether to throw an error or
        // log a warning. In the case of a warning, the invalid lookup value will be
        // replaced with an empty string. See https://github.com/simonsmith/postcss-property-lookup#loglevel.
        // logLevel: 'error',
        // logLevel: 'warn', // The default.

        // The `name` option determines the at-rule name being used to extend selectors.
        // By default, this name is `extend`, meaning `@extend` rules are parsed. See
        // https://github.com/csstools/postcss-extend-rule#name.
        // name: 'extend', // The default.

        // The `onFunctionalSelector` option determines how functional selectors should be
        // handled. Its options are:
        //
        // - `remove` Removes any functional selector. (default)
        // - `ignore` Ignores any functional selector and moves on.
        // - `warn` Warns the user whenever it encounters a functional selector.
        // - `throw` Throws an error if ever it encounters a functional selector.
        //
        // See https://github.com/csstools/postcss-extend-rule#onfunctionalselector.
        // onFunctionalSelector: 'remove', // The default.

        // The `onRecursiveExtend` option determines how recursive extend at-rules should
        // be handled. Its options are:
        //
        // - `remove` Removes any recursive extend at-rules. (default)
        // - `ignore` Ignores any recursive extend at-rules and moves on.
        // - `warn` Warns the user whenever it encounters a recursive extend at-rules.
        // - `throw` Throws an error if ever it encounters a recursive extend.
        //
        // See https://github.com/csstools/postcss-extend-rule#onrecursiveextend.
        // onRecursiveExtend: 'remove', // The default.

        // The `onUnusedExtend` option determines how an unused extend at-rule should be
        // handled. Its options are:
        //
        // - `remove` Removes any unused extend at-rule. (default)
        // - `ignore` Ignores any unused extend at-rule and moves on.
        // - `warn` Warns the user whenever it encounters an unused extend at-rule.
        // - `throw` Throws an error if ever it encounters an unused extend at-rule.
        //
        // See https://github.com/csstools/postcss-extend-rule#onunusedextend.
        // onUnusedExtend: 'remove', // The default.

        // The `preserve` option determines whether all plugins should receive a
        // `preserve` option, which may preserve or remove otherwise polyfilled CSS. By
        // default, this option is not configured. See
        // https://github.com/csstools/postcss-preset-env#preserve.
        // preserve: false,
        // preserve: true,

        // By default, plugin will strip out any empty selector generated by intermediate
        // nesting levels. You can set `preserveEmpty` to true to preserve them. See
        // https://github.com/postcss/postcss-nested#preserveempty.
        // preserveEmpty: false, // The default.

        // The `stage` option determines which CSS features to polyfill, based upon their
        // stability in the process of becoming implemented web standards. Setting stage to
        // `false` will disable every polyfill. Doing this would only be useful if you
        // intended to exclusively use the `features` option. See
        // https://github.com/csstools/postcss-preset-env#stage.
        // stage: false,
        // stage: 0,
        // stage: 1,
        // stage: 2, // The default.
        // stage: 3,
        // stage: 4,

        // The unresolved option defines how unresolved variables, mixins, and imports
        // should be handled.
        // unresolved: 'ignore',
        // unresolved: 'throw', // The default.
        // unresolved: 'warn',

        // By default, plugin will unwrap only `@document`, `@font-face`, and `@keyframes`
        // at-rules. See https://github.com/postcss/postcss-nested#unwrap.
        // unwrap: ['document', 'font-face', 'keyframes'], // The default.

        // The variables option defines global variables used when they cannot be resolved
        // automatically.
        // variables: {
        //   'site-width': '960px'
        // },
      }),
      require('postcss-disabled')({ addClass: true }),
      require('postcss-sorting')({}),
      env === 'production'
        ? require('cssnano')({
          preset: [
            'default',
            {
              // Re-enable since `cssDeclarationSorter` is disabled by default.
              cssDeclarationSorter: true,
              // zindex: {
              //   exclude: true,
              // },
            }
          ],
        })
        : null,
    ].filter(Boolean),
  };
};
