import axios from "axios"

export default {
  namespaced: true,
  state: {
    data: [],
  },
  getters: {},
  mutations: {
    GET_DATA: (state, payload) => (state.data = payload),
  },
  actions: {
    // EnsikloLive
    getDataMyClass: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        "Bearer " + localStorage.getItem("access_token")
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        const params = { ...payload }
        axios
          .get("owner/have-class/user", { params: params })
          .then((res) => {
            commit("GET_DATA", res.data.data)
            resolve(res)
          })
          .catch((e) => {
            reject(e)
          })
      })
    },
    formRegister: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        "Bearer " + localStorage.getItem("access_token")
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .post("/owner/form-register/", { ...payload })
          .then((res) => {
            resolve(res)
          })
          .catch((e) => {
            reject(e)
          })
      })
    },
    formRegisterEnsikloVideo: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        "Bearer " + localStorage.getItem("access_token")
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .post("/owner/form-register/video", { ...payload })
          .then((res) => {
            resolve(res)
          })
          .catch((e) => {
            reject(e)
          })
      })
    },
  },
}
