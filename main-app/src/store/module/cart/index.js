import axios from "axios"
export default {
  namespaced: true,
  state: {
    data: [],
    summary: { all: 0, paid: 0, pending: 0 },
  },
  getters: {},
  mutations: {
    GET_DATA: (state, payload) => (state.data = payload),
    GET_SUMMARY: (state, payload) => (state.summary = payload),
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
  },
}
