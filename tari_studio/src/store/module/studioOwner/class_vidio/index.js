/* eslint-disable no-unused-vars */
import axios from "axios"
export default {
  namespaced: true,
  state: {
    data: [],
  },
  mutations: {
    GET_DATA: (state, payload) => (state.data = payload),
    PUBLISH_DATA: (state, payload) => {
      for (const item in payload) {
        if (Object.hasOwnProperty.call(payload, item)) {
          const classVidio = payload[item]
          const indexClassVidio = state.data.findIndex(
            x => x.id === classVidio.id,
          )
          if (indexClassVidio !== -1) {
            state.data[indexClassVidio].status = "publish"
          }
        }
      }
    },
    HIDE_DATA: (state, payload) => {
      const indexClassVidio = state.data.findIndex(x => x.id === payload.id)
      if (indexClassVidio !== -1) {
        state.data[indexClassVidio].status = "hide"
      }
    },
  },
  actions: {
    getDataClassVidio: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        "Bearer " + localStorage.getItem("access_token")
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        const params = { ...payload }
        axios
          .get("owner/class-vidio", { params: params })
          .then(res => {
            commit("GET_DATA", res.data.data)
            resolve(res)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
    publishDataClassVidio: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        "Bearer " + localStorage.getItem("access_token")
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        const params = payload.map(x => x.id)
        axios
          .post("owner/class-vidio/publish", { id: params })
          .then(res => {
            resolve(res)
            commit("PUBLISH_DATA", payload)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
    hideDataClassVidio: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        "Bearer " + localStorage.getItem("access_token")
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .patch(`owner/class-vidio/${payload.id}`, {
            ...payload,
          })
          .then(res => {
            commit("HIDE_DATA", payload)
            resolve(res)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
  },
}
