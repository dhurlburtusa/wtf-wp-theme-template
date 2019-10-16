module.exports = {
  rules: {
    'brace-style': ['error', 'stroustrup', { allowSingleLine: true }],
    camelcase: ['error', { allow: ['_unused$'] }],
    'comma-dangle': ['error', {
      arrays: 'always-multiline',
      exports: 'always-multiline',
      functions: 'ignore',
      imports: 'always-multiline',
      objects: 'always-multiline',
    }],
    'no-multiple-empty-lines': ['error', { max: 2, maxBOF: 1, maxEOF: 1 }],
    'padded-blocks': ['off'],
  },
}
