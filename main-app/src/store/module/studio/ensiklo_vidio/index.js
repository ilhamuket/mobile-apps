import axios from "axios"
export default {
  namespaced: true,
  state: {
    data: [],
    show: {},
  },
  getters: {},
  mutations: {
    GET_DATA: (state, payload) => (state.data = payload),
    SHOW_DATA: (state, payload) => (state.show = payload),
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
  },
}
