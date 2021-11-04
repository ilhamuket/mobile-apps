import axios from "axios"

export default {
  namespaced: true,
  state: {
    data: [],
    auto_play: {},
  },
  getters: {},
  mutations: {
    GET_DATA: (state, payload) => {
      state.data = payload
    },
    GET_AUTO_PLAY: (state, payload) => {
      state.auto_play = payload
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
          .get(`studio/instructor/vidio-profile/${payload.slug}`, {
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
    getDataAutoPlay: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        "Bearer " + localStorage.getItem("access_token")
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        const params = { ...payload }
        axios
          .get(`studio/instructor/vidio-profile/auto-play/${payload.slug}`, {
            params: params,
          })
          .then((res) => {
            commit("GET_AUTO_PLAY", res.data.data)
            resolve(res)
          })
          .catch((e) => {
            reject(e)
          })
      })
    },
  },
}
