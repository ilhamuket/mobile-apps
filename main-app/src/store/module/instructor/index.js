import axios from "axios"

export default {
  namespaced: true,
  state: {
    data: [],
    detail: {
      name: "Default",
      region: "Bandung",
    },
  },
  getters: {},
  mutations: {
    GET_DATA: (state, payload) => {
      state.data = payload
    },
    FETCH_DATA_DETAIL: (state, payload) => (state.detail = payload),
  },
  actions: {
    getInstructor: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        "Bearer " + localStorage.getItem("access_token")
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        const params = { ...payload }
        axios
          .get("studio/instructor", { params: params })
          .then((res) => {
            commit("GET_DATA", res.data.data)
            resolve(res)
          })
          .catch((e) => {
            reject(e)
          })
      })
    },
    fetchDataDetailInstructor: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        "Bearer " + localStorage.getItem("access_token")
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        const params = { ...payload }
        axios
          .get(`studio/instructor/${payload.slug}`, { params: params })
          .then((res) => {
            commit("FETCH_DATA_DETAIL", res.data.data)
            resolve(res)
          })
          .catch((e) => {
            reject(e)
          })
      })
    },
  },
}
