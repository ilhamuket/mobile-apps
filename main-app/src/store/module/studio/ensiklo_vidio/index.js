import axios from "axios"
export default {
  namespaced: true,
  state: {
    data: [],
    show: {},
    value: {},
    reviews: [],
  },
  getters: {},
  mutations: {
    GET_DATA: (state, payload) => (state.data = payload),
    SHOW_DATA: (state, payload) => (state.show = payload),
    GET_VALUE: (state, payoad) => (state.value = payoad),
    GET_DATA_REVIEWS: (state, payload) => (state.reviews = payload),
  },
  actions: {
    getDataEnsikloVidio: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        "Bearer " + localStorage.getItem("access_token")
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        const params = { ...payload }
        axios
          .get("studio/u/classes/vidio", { params: params })
          .then(res => {
            commit("GET_DATA", res.data.data)
            resolve(res)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
    showDataEnsikloVidio: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        "Bearer " + localStorage.getItem("access_token")
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        const params = { ...payload }
        axios
          .get(`studio/u/class-vidio/${payload.slug}`, { params: params })
          .then(res => {
            commit("SHOW_DATA", res.data.data)
            resolve(res)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
    getValueReviewsEnsiloVidio: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        "Bearer " + localStorage.getItem("access_token")
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .get(`owner/reviews/summary-class/${payload.class_id}`)
          .then(res => {
            commit("GET_VALUE", res.data.data)
            resolve(res)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
    getDataEnsikloVidioReviews: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        "Bearer " + localStorage.getItem("access_token")
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        const params = { ...payload }
        axios
          .get(`studio/reviews/class-vidio/${payload.class_slug}`, {
            params: params,
          })
          .then(res => {
            commit("GET_DATA_REVIEWS", res.data.data)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
  },
}
