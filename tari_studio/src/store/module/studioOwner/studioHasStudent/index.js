import axios from "axios"
export default {
  namespaced: true,
  state: {
    summary: {
      all: 0,
      paid: 0,
      pending: 0,
      new: 0,
    },
    data: [],
  },
  getters: {},
  mutations: {
    GET_DATA: (state, payload) => (state.data = payload),
    SET_DATA_SUMMARY: (state, payload) => (state.summary = payload),
  },
  actions: {
    getDataUserHasStudio: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        "Bearer " + localStorage.getItem("access_token")
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        const params = { ...payload }
        axios
          .get(`owner/user-and-studio/${payload.id}`, { params: params })
          .then((res) => {
            commit("GET_DATA", res.data.data)
            resolve(res)
          })
          .catch((e) => {
            reject(e)
          })
      })
    },
    getDataSummaryStudioHasUser: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        "Bearer " + localStorage.getItem("access_token")
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .get(`owner/user-and-studio/summary/${payload.id}`, {})
          .then((res) => {
            commit("SET_DATA_SUMMARY", res.data.data)
            resolve(res)
          })
          .catch((e) => {
            reject(e)
          })
      })
    },
  },
}
