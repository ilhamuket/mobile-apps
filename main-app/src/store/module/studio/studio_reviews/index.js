import axios from "axios"
export default {
  namespaced: true,
  state: {
    data: [],
    value: {
      five: 0,
      four: 0,
      third: 0,
      two: 0,
      one: 0,
      all: 0,
    },
    need_reviews: {},
    load_data: true,
    load_page_tabs: true,
  },
  getters: {},
  mutations: {
    GET_DATA: (state, payload) => (state.data = payload),
    GET_VALUE: (state, payload) => (state.value = payload),
    GET_DATA_NEED_REVIEWS: (state, payload) => (state.need_reviews = payload),
    LOAD: (state) => (state.load_data = false),
    LOAD_PAGE: (state) => (state.load_page_tabs = false),
  },
  actions: {
    getDataReviewsStudio: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        "Bearer " + localStorage.getItem("access_token")
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        const params = { ...payload }
        axios
          .get(`studio/reviews/studio/${payload.slug}`, { params: params })
          .then((res) => {
            const data = res.data.data
            commit("GET_DATA", data)
            resolve(res)
          })
          .catch((e) => {
            reject(e)
          })
      })
    },
    getDataValueReviewsStudio: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        "Bearer " + localStorage.getItem("access_token")
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        const params = { ...payload }
        axios
          .get(`studio/reviews/studio/summary/${payload.id}`, {
            params: params,
          })
          .then((res) => {
            commit("GET_VALUE", res.data.data)
            resolve(res)
          })
          .catch((e) => {
            reject(e)
          })
      })
    },
    getDataNeedReviews: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        "Bearer " + localStorage.getItem("access_token")
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        const params = { ...payload }
        axios
          .get("studio/reviews/need-reviews/", { params: params })
          .then((res) => {
            commit("GET_DATA_NEED_REVIEWS", res.data)
            resolve(res)
          })
          .catch((e) => {
            reject(e)
          })
      })
    },
  },
}
