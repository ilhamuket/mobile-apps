/* eslint-disable no-unused-vars */
import axios from "axios"

export default {
  namespaced: true,
  state: {
    data: [],
    summary: {
      all: 5,
      publish: 1,
      new: 1,
    },
  },
  getters: {},
  mutations: {
    GET_DATA: (state, payload) => (state.data = payload),
    INSERT_DATA: (state, payload) => {
      const vidio = state.data
      vidio.unshift(payload)
      state.data = vidio
    },
    GO_PUBLISH: (state, payload) => {
      for (const item in payload) {
        // console.log(item)
        if (Object.hasOwnProperty.call(payload, item)) {
          const vidio = payload[item]
          const index = state.data.findIndex(x => x.id === vidio.id)
          if (index !== -1) {
            state.data[index].status = "publish"
          }
        }
      }
    },
    DELETES_DATA: (state, payload) => {
      for (const item in payload) {
        if (Object.hasOwnProperty.call(payload, item)) {
          const vidio = payload[item]
          const index = state.data.findIndex(x => x.id === vidio.id)
          if (index !== -1) {
            state.data.splice(index, 1)
          }
        }
      }
    },
    DELETES_DATA_BY_ID: (state, id) => {
      const index = state.data.findIndex(x => x.id === id)
      if (index !== -1) {
        state.data.splice(index, 1)
      }
    },
    GET_DATA_SUMMARY: (state, payload) => (state.summary = payload),
  },
  actions: {
    getDataVidio: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        "Bearer " + localStorage.getItem("access_token")
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        const params = { ...payload }
        axios
          .get("owner/vidio", { params: params })
          .then(res => {
            const data = res.data.data
            commit("GET_DATA", data)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
    insertDataVidio: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        "Bearer " + localStorage.getItem("access_token")
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .post("owner/vidio", { ...payload })
          .then(res => {
            const data = res.data.data
            commit("INSERT_DATA", data)
            resolve(res)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
    publishVidio: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        "Bearer " + localStorage.getItem("access_token")
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        const params = payload.map(x => x.id)
        axios
          .post("owner/vidio/go-publish", { id: params })
          .then(res => {
            commit("GO_PUBLISH", payload)
            resolve(res)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
    deletesDataVidio: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        "Bearer " + localStorage.getItem("access_token")
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        const params = payload.map(x => x.id)
        axios
          .post("owner/vidio/deletes", { id: params })
          .then(res => {
            commit("DELETES_DATA", payload)
            resolve(res)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
    deleteDataById: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        "Bearer " + localStorage.getItem("access_token")
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .delete(`owner/vidio/${payload.id}`)
          .then(res => {
            commit("DELETES_DATA_BY_ID", payload.id)
            resolve(res)
          })
          .catch(e => {
            reject(e)
          })
      })
    },

    // Summary
    getDataSummary: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        "Bearer " + localStorage.getItem("access_token")
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .get("owner/vidio/summary")
          .then(res => {
            commit("GET_DATA_SUMMARY", res.data.data)
            resolve(res)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
  },
}
