/* eslint-disable no-undef */
import axios from "axios"
export default {
  namespaced: true,
  state: {
    data: {
      all: 0,
      approved: 0,
      non_approved: 0,
      new: 0,
    },
  },
  getters: {},
  mutations: {
    GET_DATA: (state, payload) => (state.data = payload),
  },
  actions: {
    getDataSummarySubClass: ({ commit }) => {
      axios.defaults.headers.common.Authorization =
        "Bearer " + localStorage.getItem("access_token")
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .get("owner/sub-classes/summary")
          .then(res => {
            const summary = res.data.data
            commit("GET_DATA", summary)
            resolve(res)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
  },
}
