import axios from "axios"

export default {
  namespaced: true,
  state: {
    data: [],
    dataBySlug: {},
    class_user: [],
  },
  getters: {},
  mutations: {
    GET_DATA: (state, payload) => (state.data = payload),
    GET_DATA_BY_SLUG: (state, payload) => (state.dataBySlug = payload),
    GET_CLASS_USER: (state, payload) => (state.class_user = payload),
  },
  actions: {
    getDataClasses: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        "Bearer " + localStorage.getItem("access_token")
      axios.defaults.baseURL = process.env.VUE_APP_API_URL
      return new Promise((resolve, reject) => {
        const params = { ...payload }
        axios
          .get("studio/u/classes", { params: params })
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
    getDataClassesSearch: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        "Bearer " + localStorage.getItem("access_token")
      axios.defaults.baseURL = process.env.VUE_APP_API_URL
      return new Promise((resolve, reject) => {
        const params = { ...payload }
        axios
          .get("studio/u/c/search", { params: params })
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
    getDataClassesBySlug: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        "Bearer " + localStorage.getItem("access_token")
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        const params = { ...payload }
        axios
          .get(
            `studio/u/class/${payload.studio_slug}/${payload.slug}/${payload.keyword}`,
            {
              params: params,
            },
          )
          .then((res) => {
            const data = res.data.data
            commit("GET_DATA_BY_SLUG", data)
            resolve(res)
          })
          .catch((e) => {
            reject(e)
          })
      })
    },
    getDataClassHasUser: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        "Bearer " + localStorage.getItem("access_token")
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        const params = { ...payload }
        axios
          .get(`owner/have-class/student/${payload.slug}/class`, {
            params: params,
          })
          .then((res) => {
            commit("GET_CLASS_USER", res.data.data)
            resolve(res)
          })
          .catch((e) => {
            reject(e)
          })
      })
    },
  },
}
