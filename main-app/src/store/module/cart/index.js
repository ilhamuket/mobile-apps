import axios from "axios"
export default {
  namespaced: true,
  state: {
    data: [],
    summary: {
      all: 0,
      paid: 0,
      pending: 0,
      cancelled: 0,
      waiting_payment: 0,
      waiting_confirmation: 0,
      waiting_proof: 0,
    },
    detail: {},
    cart_video: [],
    detail_cart_video: {},
  },
  getters: {},
  mutations: {
    GET_DATA: (state, payload) => (state.data = payload),
    GET_CART_VIDEO: (state, payload) => (state.cart_video = payload),
    GET_SUMMARY: (state, payload) => (state.summary = payload),
    GET_DETAIL_CART_VIDEO: (state, payload) =>
      (state.detail_cart_video = payload),
    GET_DETAIL_CART_ENSIKLO_LIVE: (state, payload) => (state.detail = payload),
  },
  actions: {
    getDataCart: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        "Bearer " + localStorage.getItem("access_token")
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        const params = { ...payload }
        axios
          .get("studio/cart", { params: params })
          .then((res) => {
            commit("GET_DATA", res.data.data)
            resolve(res)
          })
          .catch((e) => {
            reject(e)
          })
      })
    },
    getDataCartSummary: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        "Bearer " + localStorage.getItem("access_token")
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .get("studio/cart/summary")
          .then((res) => {
            commit("GET_SUMMARY", res.data.data)
            resolve(res)
          })
          .catch((e) => {
            reject(e)
          })
      })
    },
    // ensiklovideo cart
    getDataEnsikloVideoCart: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        "Bearer " + localStorage.getItem("access_token")
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        const params = { ...payload }
        axios
          .get("/studio/cart/video/user", {
            params: params,
          })
          .then((res) => {
            resolve(res)
            commit("GET_CART_VIDEO", res.data.data)
          })
          .catch((e) => {
            reject(e)
          })
      })
    },
    getDataDetailCartEnsikloVideo: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        "Bearer " + localStorage.getItem("access_token")
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        const params = { ...payload }
        axios
          .get(`studio/cart/video/${payload.id}`, { params: params })
          .then((res) => {
            commit("GET_DETAIL_CART_VIDEO", res.data.data)
            resolve(res)
          })
          .catch((e) => {
            reject(e)
          })
      })
    },
    getDetailCartEnsikloLive: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        "Bearer " + localStorage.getItem("access_token")
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        const params = { ...payload }
        axios
          .get(`studio/cart/detail-cart/${payload.id}`, { params: params })
          .then((res) => {
            resolve(res)
            commit("GET_DETAIL_CART_ENSIKLO_LIVE", res.data.data)
          })
          .catch((e) => {
            reject(e)
          })
      })
    },
  },
}
