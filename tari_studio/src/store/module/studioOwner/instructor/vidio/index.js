import axios from "axios"

export default {
  namespaced: true,
  state: {
    data: [],
  },
  getters: {},
  mutation: {
    ADD_URL: (state, payload) => {
      const url = state.data
      url.push(payload)
      state.data = url
    },
  },
  actions: {
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
  },
}
