import Vue from 'vue'
import Vuex from 'vuex'
import auth from './modules/auth'
import user from './modules/user'
import vidios from './modules/vidios'
import classes from './modules/media/class'
import category from './modules/media/category'
import studio from './modules/studio'
import article from './modules/article'
import transaction from './modules/transaction'
import transactionVideo from './modules/transaction-video'
import payment from './modules/payment'
import plan from './modules/plan'
import bank from './modules/bank'

Vue.use(Vuex)

export default new Vuex.Store({
  modules: {
    auth: auth,
    user: user,
    vidios: vidios,
    class: classes,
    category: category,
    studio: studio,
    article: article,
    transaction: transaction,
    payment: payment,
    transaction_video: transactionVideo,
    plan: plan,
    bank: bank,
  },
  state: {
    barColor: 'rgba(0, 0, 0, .8), rgba(0, 0, 0, .8)',
    barImage:
      'https://demos.creative-tim.com/material-dashboard/assets/img/sidebar-1.jpg',
    drawer: null,
  },
  mutations: {
    SET_BAR_IMAGE (state, payload) {
      state.barImage = payload
    },
    SET_DRAWER (state, payload) {
      state.drawer = payload
    },
  },
  actions: {},
})
