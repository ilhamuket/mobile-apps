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
// ===  Owners ===

// StudioAuth
import studioAuth from "./module/auth/studio/index"

// StudioClasses
import ownerStudioClasses from "./module/studioOwner/classes/index"
import studioSummary from "./module/studioOwner/classes/class_summary/summary"

// Studio Reviews
import studioReviews from "./module/studioOwner/studioReviews/index"

// discusses
import studioDiscusses from "./module/studioOwner/studioDiscusses"
// Studio Sub-class
import studioSubclass from "./module/studioOwner/sub_class/index"
import studioSummarySubclass from "./module/studioOwner/sub_class/summary/index"
import studioInstructor from "./module/studioOwner/instructor/index"
import studioInstructorSummary from "./module/studioOwner/instructor/summary/index"

// Studio Categories
import studioCategories from "./module/studioOwner/studio_category/index"
import summary from "./module/studioOwner/studio_category/summary"
// Vidio
import studioOwnerVidio from "./module/studioOwner/vidio/index"

// Summary
import dashboardSummary from "./module/studioOwner/summary/index"
import studios from "./module/studioOwner/index"

// Bank Account
import BankAccount from "./module/studioOwner/bank_account/index"

// class Vidio
import classVidio from "./module/studioOwner/class_vidio/index"

// Vidio instructor
import vidioInstructor from "./module/studioOwner/instructor/vidio"
import student from "./module/student"
import studioHasStudio from "./module/studioOwner/studioHasStudent/index"
import article from "./module/article"
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
    ownerStudioClasses: ownerStudioClasses,
    studioSummary: studioSummary,
    subClassStudio: studioSubclass,
    subClassStudioSummary: studioSummarySubclass,
    studioInstructor: studioInstructor,
    studioInstructorSummary: studioInstructorSummary,
    studioOwnerVidio: studioOwnerVidio,
    studioCategories: studioCategories,
    dashboardSummary: dashboardSummary,
    studioReviews: studioReviews,
    studioDiscusses: studioDiscusses,
    categorySummary: summary,
    studios: studios,
    bank_account: BankAccount,
    classVidio: classVidio,
    vidioInstructor: vidioInstructor,
    student: student,
    studioHasStudio: studioHasStudio,
    article: article,
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
