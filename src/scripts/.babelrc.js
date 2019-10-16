// console.log('src/scripts/.babelrc.js')
/**
 * Note: This is a file-relative configuration.
 *
 * See https://babeljs.io/docs/en/config-files#file-relative-configuration for
 * details.
 */
module.exports = function createBabelConfig (api) {
  // console.log('src/scripts/.babelrc.js#createBabelConfig')
  api.cache(true)

  const plugins = [
  ]
  const presets = [
    [
      '@babel/preset-env',
      {
        // spec: false, // The default value.
        spec: true,

        // Setting `targets` to undefined or not setting it causes the `.browserlistrc`
        // file to be used. Otherwise, the targets declared here would be used.
        // targets: undefined,

        // useBuiltIns: false, // The default value.

        // `'entry'` enables a new plugin that replaces broader `core-js` imports with
        // more specific imports depending on the target environment. Be sure CoreJS has
        // been installed: `npm install core-js@3 --save`
        useBuiltIns: 'entry',

        // `'usage'` causes specific imports for polyfills when browser features are used.
        // Be sure CoreJS has been installed: `npm install core-js@3 --save`
        // useBuiltIns: 'usage',

        // Applies when `useBuiltIns` is either `'entry'` or `'usage'`.
        corejs: {
          version: 3,
          // Setting `proposals` to true allows polyfilling of proposed ECMAScript.
          // proposals: true,
        },
      },
    ],
    // ['@babel/preset-react'],
  ]

  return {
    plugins,
    presets,
  }
}
