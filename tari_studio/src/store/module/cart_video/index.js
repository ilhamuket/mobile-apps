import axios from "axios"

export default {
  namespaced: true,
  state: {
    data: [],
    summary: {
      all: 13,
      paid: 2,
      waiting_confirmation: 1,
      waiting_payment: 2,
    },
  },
  mutations: {
    GET_DATA: (state, payload) => (state.data = payload),
    GET_SUMMARY: (state, payload) => (state.summary = payload),
  },
  actions: {
    getData: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        "Bearer " + localStorage.getItem("access_token")
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        const params = { ...payload }
        axios
          .get("owner/cart-video", { params: params })
          .then((res) => {
            commit("GET_DATA", res.data.data)
            resolve(res)
          })
          .catch((e) => {
            reject(e)
          })
      })
    },
    getSummary ({ commit }, payload) {
      axios.defaults.headers.common.Authorization =
        "Bearer " + localStorage.getItem("access_token")
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .get("owner/cart-video/summary")
          .then((res) => {
            resolve(res)
            commit("GET_SUMMARY", res.data.data)
          })
          .catch((e) => {
            reject(e)
          })
      })
    },
  },
}
