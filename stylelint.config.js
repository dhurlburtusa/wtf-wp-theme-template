const config = {
  extends: [
    'stylelint-config-wordpress',
  ],
  plugins: [
    'stylelint-scss',
  ],
  rules: {
    'at-rule-empty-line-before': [
      'always',
      {
        except: [
          // 'after-same-name',
          // 'blockless-after-same-name-blockless',
          // 'blockless-after-blockless',
          // 'first-nested',
          // 'inside-block',
        ],
        ignore: [
          'after-comment',
          'blockless-after-blockless',
          // 'blockless-after-same-name-blockless',
          // 'first-nested',
          // 'inside-block',
        ],
        ignoreAtRules: [
          'else',
          'extend',
        ],
      },
    ],
    // Disabling since using `scss/at-rule-no-unknown` rule instead.
    'at-rule-no-unknown': null,
    // When using Autoprefixer, no need to use prefixes in source.
    'at-rule-no-vendor-prefix': true,
    'block-closing-brace-newline-after': 'always',
    'block-closing-brace-newline-before': 'always-multi-line',
    'block-opening-brace-newline-after': 'always-multi-line',
    'color-named': null,
    'comment-empty-line-before': null,
    indentation: 'tab',
    'max-empty-lines': 2,
    'max-line-length': null,
    // When using Autoprefixer, no need to use prefixes in source.
    'media-feature-name-no-vendor-prefix': true,
    // When using Autoprefixer, no need to use prefixes in source.
    'property-no-vendor-prefix': true,
    'rule-empty-line-before': [
      'always',
      {
        ignore: [
          'after-comment',
          'first-nested',
        ],
      },
    ],
    // When using Autoprefixer, no need to use prefixes in source.
    'selector-no-vendor-prefix': true,
    'string-quotes': null,
    // When using Autoprefixer, no need to use prefixes in source.
    'value-no-vendor-prefix': true,
    'scss/at-else-empty-line-before': 'never',
    'scss/at-extend-no-missing-placeholder': true,
    'scss/at-import-no-partial-leading-underscore': true,
    'scss/at-import-partial-extension': 'never',
    // Conditions in @if are not evaluated correctly when parentheses are present.
    // This appears to be a known bug with the https://github.com/jonathantneal/postcss-advanced-variables
    // PostCSS plugin which is used by https://github.com/jonathantneal/precss.
    'scss/at-rule-conditional-no-parentheses': true,
    'scss/at-rule-no-unknown': true,
    'scss/dollar-variable-colon-newline-after': 'always-multi-line',
    'scss/dollar-variable-colon-space-after': 'always-single-line',
    'scss/dollar-variable-colon-space-before': 'never',
    'scss/dollar-variable-empty-line-before': 'always',
    'scss/function-quote-no-quoted-strings-inside': true,
    'scss/operator-no-newline-before': true,
    'scss/operator-no-unspaced': true,
    // 'scss/selector-nest-combinators': 'always',
    'scss/selector-no-redundant-nesting-selector': true,
  },
}

module.exports = config
