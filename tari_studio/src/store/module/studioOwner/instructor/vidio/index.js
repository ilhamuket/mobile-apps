import axios from "axios"

export default {
  namespaced: true,
  state: {
    data: [],
  },
  getters: {},
  mutations: {
    GET_DATA: (state, payload) => (state.data = payload),
    ADD_URL: (state, payload) => {
      const url = state.data
      url.unshift(payload)
      state.data = url
    },
  },
  actions: {
    getDataVidioProfile: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        "Bearer " + localStorage.getItem("access_token")
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        const params = { ...payload }
        axios
          .get(`owner/instructor/vidio-profile/instructor/${payload.slug}`, {
            params: params,
          })
          .then((res) => {
            commit("GET_DATA", res.data.data)
            resolve(res)
          })
          .catch((e) => {
            reject(e)
          })
      })
    },
    addDataVidioUrl: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        "Bearer " + localStorage.getItem("access_token")
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .post("owner/instructor/vidio-profile/create", { ...payload })
          .then((res) => {
            commit("ADD_URL", payload)
            resolve(res)
          })
          .catch((e) => {
            reject(e)
          })
      })
    },
    addDataVidioUrlVidioUrl: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        "Bearer " + localStorage.getItem("access_token")
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .post("owner/instructor/vidio-profile/create-vidio-profile", {
            ...payload,
          })
          .then((res) => {
            commit("ADD_URL", payload)
            resolve(res)
          })
          .catch((e) => {
            reject(e)
          })
      })
    },
  },
}
