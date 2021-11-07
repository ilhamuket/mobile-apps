import axios from "axios"

export default {
  namespaced: true,
  state: {
    data: [],
    show: {},
    summary: {
      all: 0,
      publish: 0,
      draft: 0,
      new: 0,
    },
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
    GET_SUMMARY: (state, payload) => (state.summary = payload),
    APPROVED_DATA_BYID: (state, payload) => {
      const indexVidio = state.data.findIndex((x) => x.id === payload.id)
      if (indexVidio !== -1) {
        state.data[indexVidio].is_verified = 1
        state.data[indexVidio].status = "publish"
      }
    },
    DELETE_DATA: (state, payload) => {
      // eslint-disable-next-line no-unused-vars
      for (const item in payload) {
        if (Object.hasOwnProperty.call(payload, item)) {
          const vidio = payload[item]
          const indexVidio = state.data.findIndex((x) => x.id === vidio.id)
          if (indexVidio !== -1) {
            state.data.splice(indexVidio, 1)
          }
        }
      }
    },
    DELETE_DATA_BYID: (state, payload) => {
      const indexVidio = state.data.findIndex((x) => x.id === payload.id)
      if (indexVidio !== -1) {
        state.data.splice(indexVidio, 1)
      }
    },
  },
  actions: {
    // SummarY
    getDataSummaryVideoProfile: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        "Bearer " + localStorage.getItem("access_token")
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .get(`owner/instructor/vidio-profile/summary/${payload.slug}`, {})
          .then((res) => {
            commit("GET_SUMMARY", res.data.data)
            resolve(res)
          })
          .catch((e) => {
            reject(e)
          })
      })
    },
    // Show
    showData: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        "Bearer " + localStorage.getItem("access_token")
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        const params = { ...payload }
        axios
          .get(`owner/instructor/${payload.slug}`, { params: params })
          .then((res) => {
            resolve(res)
          })
          .catch((e) => {
            reject(e)
          })
      })
    },
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
            commit("ADD_URL", res.data.data)
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
          .post("owner/instructor/vidio-profile/approved", { id: params })
          .then((res) => {
            commit("APPROVE_DATA_SELECTED", payload)
            resolve(res)
          })
          .catch((e) => {
            reject(e)
          })
      })
    },
    approveDataVidioById: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        "Bearer " + localStorage.getItem("access_token")
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .patch(`owner/instructor/vidio-profile/approve/${payload.id}`)
          .then((res) => {
            commit("APPROVED_DATA_BYID", payload)
            resolve(res)
          })
          .catch((e) => {
            reject(e)
          })
      })
    },
    deleteDataVidioProfileSelected: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        "Bearer " + localStorage.getItem("access_token")
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        const params = payload.map((x) => x.id)
        axios
          .post("owner/instructor/vidio-profile/destroy", { id: params })
          .then((res) => {
            commit("DELETE_DATA", payload)
            resolve(res)
          })
          .catch((e) => {
            reject(e)
          })
      })
    },
    deleteDataVidioProfileById: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        "Bearer " + localStorage.getItem("access_token")
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .delete(`owner/instructor/vidio-profile/${payload.id}`)
          .then((res) => {
            commit("DELETE_DATA_BYID", payload)
            resolve(res)
          })
          .catch((e) => {
            reject(e)
          })
      })
    },
  },
}
