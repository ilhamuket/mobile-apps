import axios from "axios"
export default {
  namespaced: true,
  state: {
    data: [],
    load_data: true,
  },
  getters: {},
  mutations: {
    GET_DATA: (state, payload) => (state.data = payload),
    LOAD: (state) => (state.load_data = false),
  },
  actions: {
    getDataMostPopuler: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        "Bearer " + localStorage.getItem("access_token")
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        const params = { ...payload }
        axios
          .get("studio/populer", { params: params })
          .then((res) => {
            const data = res.data.data
            commit("GET_DATA", data)
            resolve(res)
          })
          .catch((e) => {
            reject(e)
          })
      })
    },
  },
}
