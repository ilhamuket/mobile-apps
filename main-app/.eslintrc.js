module.exports = {
  root: true,
  env: {
    node: true
  },
  extends: ["vuetify", "eslint:recommended"],
  rules: {
    "no-console": process.env.NODE_ENV === "production" ? "off" : "off",
    "no-debugger": process.env.NODE_ENV === "production" ? "off" : "off",
    eqeqeq: "off",
    curly: "off",
    quotes: ["off", "off"],
    semicolon: ["off"],
    "plugin1/rule1": "off"
  },
  parserOptions: {
    parser: "babel-eslint"
    // ecmaFeatures: {
    //   jsx: true
    // },
    // sourceType: "module"
  }
};
