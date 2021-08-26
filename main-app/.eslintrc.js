module.exports = {
  root: true,
  env: {
    node: true
  },
  extends: 'vuetify',
  rules: {
    'no-console': process.env.NODE_ENV === 'production' ? 'off' : 'off',
    'no-debugger': process.env.NODE_ENV === 'production' ? 'off' : 'off'
    // 'comma-dangle': [
    //   'off',
    //   {
    //     arrays: 'never',
    //     objects: 'never',
    //     imports: 'never',
    //     exports: 'never',
    //     functions: 'never'
    //   }
    // ]
  },
  parserOptions: {
    parser: 'babel-eslint'
  }
}
