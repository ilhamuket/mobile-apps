import Vue from 'vue'
import Vuex from 'vuex'
import auth from './module/auth'
import user from './module/user'
// Studio
import studio from './module/studio'
import studioVidio from './module/studio/vidio_studio'
import commentsStudioVidio from './module/studio/vidio_studio/comments/comments'
import studioArticle from './module/studio/studio_article/studio_article'
import studioClasses from './module/studio/studio_classes/studio_classes'
import schedulesStudioClasses from './module/studio/studio_classes/class_schedule/class_schedules'
import studioAuth from './module/auth/studio/index'

Vue.use(Vuex)

export default new Vuex.Store({
  modules: {
    auth: auth,
    user: user,
    studio: studio,
    studioChild: studioVidio,
    commentStudioVidio: commentsStudioVidio,
    studioArticle: studioArticle,
    studioClasses: studioClasses,
    schedulesStudioClass: schedulesStudioClasses,
    studioAuth: studioAuth,
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
