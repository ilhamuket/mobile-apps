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
    getDataSummaryTeachers: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        "Bearer " + localStorage.getItem("access_token")
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .get("owner/instructor/summary/index")
          .then(({ data }) => {
            const summary = data.data
            commit("GET_DATA", summary)
            resolve(data)
          })
          .catch((e) => {
            reject(e)
          })
      })
    },
  },
}
