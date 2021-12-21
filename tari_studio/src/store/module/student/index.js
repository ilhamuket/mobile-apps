import axios from "axios"

export default {
  namespaced: true,
  state: {
    data: [],
    summary: {
      all: 4,
      present: 1,
      miss_absent: 3,
    },
  },
  getters: {},
  mutations: {
    GET_DATA: (state, payload) => (state.data = payload),
    GET_SUMMARY: (state, payload) => (state.summary = payload),
    ABSENT: (state, payload) => {
      const indexStudent = state.data.findIndex((x) => x.id === payload.id)
      if (indexStudent != -1) {
        state.data[indexStudent].absent = payload.absent
      }
    },
    SEND_REVIEWS: (state, payload) => {
      // eslint-disable-next-line no-unused-vars
      for (const item in payload) {
        if (Object.hasOwnProperty.call(payload, item)) {
          const student = payload[item]
          const indexStudent = state.data.findIndex((x) => x.id === student.id)
          if (indexStudent !== -1) {
            state.data[indexStudent].status_responded = "pending"
          }
        }
      }
    },
  },
  actions: {
    getDataStudent: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        "Bearer " + localStorage.getItem("access_token")
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        const params = { ...payload }
        axios
          .get(`owner/have-class/student/${payload.keyword}/class`, {
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
    getDataStudentSummary: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        "Bearer " + localStorage.getItem("access_token")
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        const params = { ...payload }
        axios
          .get("owner/have-class/summary", { params: params })
          .then((res) => {
            commit("GET_SUMMARY", res.data.data)
            resolve(res)
          })
          .catch((e) => {
            reject(e)
          })
      })
    },
    getAbsentDataStudent: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        "Bearer " + localStorage.getItem("access_token")
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .post("owner/have-class/student/absent", { ...payload })
          .then((res) => {
            // commit("ABSENT", payload)
            resolve(res)
          })
          .catch((e) => {
            reject(e)
          })
      })
    },
    sendReviewsDataStudent: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        "Bearer " + localStorage.getItem("access_token")
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        const id = payload.map((x) => x.id)
        axios
          .post("owner/have-class/send-reviews", { id: id })
          .then((res) => {
            commit("SEND_REVIEWS", payload)
            resolve(res)
          })
          .catch((e) => {
            reject(e)
          })
      })
    },
  },
}
