module.exports = {
  root: true,
  env: {
    node: true,
  },
  extends: 'vuetify',
  rules: {
    'no-console': process.env.NODE_ENV === 'production' ? 'off' : 'off',
    'no-debugger': process.env.NODE_ENV === 'production' ? 'off' : 'off',
    strict: 0,
  },
  parserOptions: {
    parser: 'babel-eslint',
    sourceType: 'module',
    ecmaVersion: 2021,
    allowImportExportEverywhere: false,
    codeFrame: true,
    ecmaFeatures: {
      globalReturn: false,
    },
    babelOptions: {
      configFile: 'path/to/config.js',
    },
  },
}
