module.exports = {
  root: true,
  env: {
    node: true,
  },
  extends: 'vuetify',
  rules: {
    'no-console': process.env.NODE_ENV === 'production' ? 'off' : 'off',
    'no-debugger': process.env.NODE_ENV === 'production' ? 'off' : 'off',
    'eslint-plugin-vue': '^4.3.0',
    'babel-eslint': '^8.2.1',
  },
  parserOptions: {
    parser: 'babel-eslint',
  },
}
