// =========================================================
// * Vuetify Material Dashboard - v2.1.0
// =========================================================
//
// * Product Page: https://www.creative-tim.com/product/vuetify-material-dashboard
// * Copyright 2019 Creative Tim (https://www.creative-tim.com)
//
// * Coded by Creative Tim
//
// =========================================================
//
// * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

import Vue from "vue"
import App from "./App.vue"
import router from "./router/router"
import store from "./store/store"
import "./plugins/base"
import "./plugins/chartist"
import "./plugins/vee-validate"
import vuetify from "./plugins/vuetify"
import i18n from "./i18n"
import VueMoment from "vue-moment"

// import moment from 'moment-timezone'
import VueSweetalert2 from "vue-sweetalert2"
// import loader from 'vue-ui-preloader'
// "vue-ui-preloader": "^1.2.1",

// If you don't need the styles, do not connect
import "sweetalert2/dist/sweetalert2.min.css"

import VueQuillEditor from "vue-quill-editor"

// require styles
import "quill/dist/quill.core.css"
import "quill/dist/quill.snow.css"
import "quill/dist/quill.bubble.css"

Vue.use(VueQuillEditor /* { default global options } */)

// Vue.use(loader)

Vue.use(VueSweetalert2)

Vue.use(VueMoment, {})

Vue.config.productionTip = false

new Vue({
  router,
  store,
  vuetify,
  i18n,
  render: (h) => h(App),
}).$mount("#app")
