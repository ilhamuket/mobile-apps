/* eslint-disable no-unused-vars */
import axios from "axios"
export default {
  namespaced: true,
  state: {
    data: [],
  },
  getters: {},
  mutations: {
    GET_DATA: (state, payload) => (state.data = payload),
    DELETE_DATA_BY_ID: (state, payload) => {
      const indexReviews = state.data.findIndex((x) => x.id === payload.id)
      if (indexReviews !== -1) {
        state.data.splice(indexReviews, 1)
      }
    },
    DELETE_REVIEW_SELECTED: (state, payload) => {
      for (const item in payload) {
        if (Object.hasOwnProperty.call(payload, item)) {
          const reviews = payload[item]
          const indexReviews = state.data.findIndex((x) => x.id === reviews)
          if (indexReviews !== -1) {
            state.data.splice(indexReviews, 1)
          }
        }
      }
    },
    HIDE_REVIEWS_SELECTED: (state, payload) => {
      for (const item in payload) {
        if (Object.hasOwnProperty.call(payload, item)) {
          const reviews = payload[item]
          const indexReviews = state.data.findIndex((x) => x.id === reviews)
          if (indexReviews !== -1) {
            state.data[indexReviews].status = "sembunyikan"
          }
        }
      }
    },
    SHOW_REVIEWS_SELECTED: (state, payload) => {
      for (const item in payload) {
        if (Object.hasOwnProperty.call(payload, item)) {
          const reviews = payload[item]
          const indexReviews = state.data.findIndex((x) => x.id === reviews)
          if (indexReviews !== -1) {
            if (state.data[indexReviews].is_response === true) {
              state.data[indexReviews].status = "ditanggapai"
            } else {
              state.data[indexReviews].status = "belum ditanggapai"
            }
          }
        }
      }
    },
    SEND_REPLIES: (state, payload) => {
      const indexReviews = state.data.findIndex((x) => x.id === payload.id)
      if (indexReviews !== -1) {
        state.data[indexReviews].status = "ditanggapi"
      }
    },
  },
  actions: {
    getDataReviewsStudio: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        "Bearer " + localStorage.getItem("access_token")
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        const params = { ...payload }
        axios
          .get("owner/reviews", { params: params })
          .then((res) => {
            commit("GET_DATA", res.data.data)
            resolve(res)
          })
          .catch((e) => {
            reject(e)
          })
      })
    },
    deleteReviewsById: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        "Bearer " + localStorage.getItem("access_token")
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .delete(`owner/reviews/${payload.id}`)
          .then((res) => {
            commit("DELETE_DATA_BY_ID", payload)
            resolve(res)
          })
          .catch((e) => {
            reject(e)
          })
      })
    },
    deleteReviewSelected: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        "Bearer " + localStorage.getItem("access_token")
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        const params = payload.map((x) => x.id)
        axios
          .post("owner/reviews/delete", { id: params })
          .then((res) => {
            commit("DELETE_REVIEW_SELECTED", params)
            resolve(res)
          })
          .catch((e) => {
            reject(e)
          })
      })
    },
    hideReviewSelected: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        "Bearer " + localStorage.getItem("access_token")
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        const params = payload.map((x) => x.id)
        axios
          .post("owner/reviews/hide", { id: params })
          .then((res) => {
            commit("HIDE_REVIEWS_SELECTED", params)
            resolve(res)
          })
          .catch((e) => {
            reject(e)
          })
      })
    },
    showReviewSelected: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        "Bearer " + localStorage.getItem("access_token")
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        const params = payload.map((x) => x.id)
        axios
          .post("owner/reviews/show", { id: params })
          .then((res) => {
            commit("SHOW_REVIEWS_SELECTED", params)
            resolve(res)
          })
          .catch((e) => {
            reject(e)
          })
      })
    },
    sendReplieReviews: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        "Bearer " + localStorage.getItem("access_token")
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .post(`owner/reviews/reply/${payload.id}`, { ...payload })
          .then((res) => {
            commit("SEND_REPLIES", payload)
            resolve(res)
          })
          .catch((e) => {
            reject(e)
          })
      })
    },
  },
}
