// console.log('babel.config.js')
/**
 * Note: This is the project-wide Babel configuration. File-relative configuration
 * may exist in sub directories in `.babelrc`, `.babelrc.js`, or `package.json`
 * files. Whether the file-relative configuration is applied depends on other
 * factors such as the `babelrc` and `babelrcRoots` options.
 *
 * See https://babeljs.io/docs/en/config-files#project-wide-configuration for
 * details.
 *
 * See https://babeljs.io/docs/en/config-files#file-relative-configuration for
 * details.
 */
module.exports = function createBabelConfig(api) {
  // console.log('babel.config.js#createBabelConfig')
  api.cache(true)

  const plugins = [
  ]
  const presets = [
  ]

  return {
    plugins,
    presets,
  }
}
