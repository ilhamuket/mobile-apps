import Vue from "vue"
import Vuex from "vuex"
import auth from "./module/auth"
import user from "./module/user"
// Studio
import studio from "./module/studio"
import studioVidio from "./module/studio/vidio_studio"
import commentsStudioVidio from "./module/studio/vidio_studio/comments/comments"
import studioArticle from "./module/studio/studio_article/studio_article"
import studioClasses from "./module/studio/studio_classes/studio_classes"
import schedulesStudioClasses from "./module/studio/studio_classes/class_schedule/class_schedules"
import studioPopuler from "./module/studio/studio_populer/index"
import studioReviews from "./module/studio/studio_reviews/index"
// clsases
import classes from "./module/classes/index"
import classesPopuler from "./module/classes/class_populer/index"
import classesReviews from "./module/classes/class_reviews/index"
// Cart
import cart from "./module/cart/index"
import studioDiscuses from "./module/studio/studio_discuses"

// Category
import category from "./module/category"

// EnsikloVidio
import ensikloVidio from "./module/studio/ensiklo_vidio/index"
// etc

import etc from "./module/etc"
// instructor
import instructor from "./module/instructor"
import instructorVidioProfile from "./module/instructor/vidio-profile/index"
import myclass from "./module/myclass/index"
import invoice from "./module/invoice"
import payment from "./module/payment"
import studioHasInstructor from "./module/studio/studioHasInstructor/index"
import studioHasEnsikloVideo from "./module/studio/studioHasEnsikloVideo/index"
import myVideo from "./module/my_video"
import bank from "./module/bank"
import plan from "./module/plan"

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
    studioPopuler: studioPopuler,
    classes: classes,
    classesPopuler: classesPopuler,
    classesReviews: classesReviews,
    cart: cart,
    studioReviews: studioReviews,
    studioDiscuses: studioDiscuses,
    category: category,
    ensikloVidio: ensikloVidio,
    etc: etc,
    instructor: instructor,
    instructorVidio: instructorVidioProfile,
    my_class: myclass,
    invoice: invoice,
    payment: payment,
    studioHasInstructor: studioHasInstructor,
    studioHasEnsikloVideo: studioHasEnsikloVideo,
    my_video: myVideo,
    bank: bank,
    plan: plan,
  },
  state: {
    barColor: "rgba(0, 0, 0, .8), rgba(0, 0, 0, .8)",
    barImage:
      "https://demos.creative-tim.com/material-dashboard/assets/img/sidebar-1.jpg",
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
