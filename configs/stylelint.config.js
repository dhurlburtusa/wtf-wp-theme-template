const config = {
  extends: [
    'stylelint-config-standard',
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
        ignoreAtRules: [],
      },
    ],
    // When using Autoprefixer, no need to use prefixes in source.
    'at-rule-no-vendor-prefix': true,
    'comment-empty-line-before': null,
    'indentation': 'tab',
    'max-empty-lines': 2,
    // When using Autoprefixer, no need to use prefixes in source.
    'media-feature-name-no-vendor-prefix': true,
    // When using Autoprefixer, no need to use prefixes in source.
    'property-no-vendor-prefix': true,
    // When using Autoprefixer, no need to use prefixes in source.
    'selector-no-vendor-prefix': true,
    // When using Autoprefixer, no need to use prefixes in source.
    'value-no-vendor-prefix': true,
  },
};

module.exports = config;
