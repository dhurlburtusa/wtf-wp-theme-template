const testRoot = '<rootDir>/__tests__/unit/'

module.exports = {
  coverageDirectory: `${testRoot}coverage/`,
  coverageThreshold: {
    global: {
      branches: 100,
      functions: 100,
      lines: 100,
      statements: 100,
    },
  },

  // Note: rootDir is relative to the directory containing this file.
  rootDir: '../../',
  roots: [
    `${testRoot}specs/`,
    '<rootDir>/src/',
  ],

  setupFiles: [
    `${testRoot}setup.js`,
  ],

  testPathIgnorePatterns: [
    // `${testRoot}specs/.../....spec.js`,
  ],
}
