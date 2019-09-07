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
    'comment-empty-line-before': null,
    'indentation': 'tab',
    'max-empty-lines': 2,
  },
};

module.exports = config;
