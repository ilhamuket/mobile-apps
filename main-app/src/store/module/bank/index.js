import axios from "axios"
export default {
  namespaced: true,
  state: {
    data: [],
  },
  getters: {},
  mutations: {
    SET_DATA: (state, data) => (state.data = data),
  },
  actions: {
    getDataBank: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        "Bearer " + localStorage.getItem("access_token")
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        const params = { ...payload }
        axios
          .get("administrator/bank", { params: params })
          .then((res) => {
            resolve(res)
            commit("SET_DATA", res.data.data)
          })
          .catch((e) => {
            reject(e)
          })
      })
    },
  },
}
