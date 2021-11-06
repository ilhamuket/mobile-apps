import axios from "axios"

export default {
  namespaced: true,
  state: {
    data: [],
  },
  getters: {},
  mutations: {
    GET_DATA: (state, payload) => (state.data = payload),
    ADD_URL: (state, payload) => {
      const url = state.data
      url.unshift(payload)
      state.data = url
    },
    APPROVE_DATA_SELECTED: (state, payload) => {
      // eslint-disable-next-line no-unused-vars
      for (const item in payload) {
        if (Object.hasOwnProperty.call(payload, item)) {
          const vidio = payload[item]
          const indexVidio = state.data.findIndex((x) => x.id === vidio.id)
          if (indexVidio !== -1) {
            state.data[indexVidio].is_verified = 1
            state.data[indexVidio].status = "publish"
          }
        }
      }
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
          .get(`owner/instructor/vidio-profile/instructor/${payload.slug}`, {
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
    addDataVidioUrlVidioUrl: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        "Bearer " + localStorage.getItem("access_token")
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .post("owner/instructor/vidio-profile/create-vidio-profile", {
            ...payload,
          })
          .then((res) => {
            commit("ADD_URL", payload)
            resolve(res)
          })
          .catch((e) => {
            reject(e)
          })
      })
    },
    approveDataVidioProfileSelected: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        "Bearer " + localStorage.getItem("access_token")
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        const params = payload.map((x) => x.id)
        axios
          .post("owner/instructor/vidio-profile", { id: params })
          .then((res) => {
            commit("APPROVE_DATA_SELECTED", payload)
            resolve(res)
          })
          .catch((e) => {
            reject(e)
          })
      })
    },
  },
}
