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
        extensions: ['.css', '.scss'],
        prefix: '_',
      }),
      require('postcss-url')({
      }),
      require('postcss-assets')({
        loadPaths: [
          'assets/fonts/',
          'assets/images/'
        ],
      }),
      require('postcss-strip-inline-comments')(),
      require('precss')({
        // The `postcss-advanced-variables` plugin that the `precss` plugin uses causes a
        // warning to be issued from `postcss` when importing files. The postcss
        // configuration doesn't seem to be passed to the postcss processor that handles
        // the imported file. So, we are configuring `postcss-advanced-variables` to not
        // handle `@import` at-rules. Instead, `postcss-easy-import` is being used.
        // Note: Because `postcss-easy-import` runs before the `precss` plugin, this
        // plugin should not ever see `@import`. But we are explicitly disabling for
        // posterity.
        disable: '@import',
      }),
      require('postcss-disabled')({ addClass: true }),
      require('postcss-sorting')({}),
      env === 'production' ? require('cssnano')() : null,
    ].filter(Boolean),
  };
};

