module.exports = {
  root: true,
  env: {
    node: true,
  },
  extends: 'vuetify',
  rules: {
    'no-debugger': process.env.NODE_ENV === 'production' ? 'off' : 'off',
    'no-console': process.env.NODE_ENV === 'production' ? 'off' : 'off',
  },
  parserOptions: {
    parser: 'babel-eslint',
  },
}
