// This is the top-level ESLint configuration for this project. Only add
// configuration that is common to all files. Otherwise, the configuration will
// need to be overridden at a lower level.
module.exports = {
  extends: [
    'standard',
  ],
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
    'no-var': ['error'],
    'padded-blocks': ['off'],
  },
}
