import axios from "axios"
export default {
  namespaced: true,
  state: {
    data: [],
  },
  getters: {},
  mutations: {
    GET_DATA: () => {},
  },
  actions: {
    paymentData: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        "Bearer " + localStorage.getItem("access_token")
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .post(`payments/pay-live/${payload.id}`, {
            ...payload,
          })
          .then((res) => {
            resolve(res)
          })
          .catch((e) => {
            reject(e)
          })
      })
    },
    paymentDataVideo: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        "Bearer " + localStorage.getItem("access_token")
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .post(`payments/pay-video/${payload.cart_id}`, { ...payload })
          .then((res) => {
            resolve(res)
          })
          .catch((e) => {
            reject(e)
          })
      })
    },
    sendProofPayment: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        "Bearer " + localStorage.getItem("access_token")
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        const URL = `payments/photo/${payload.id}`
        const data = new FormData()
        console.log("files : ", payload.files)
        data.append("img", payload.files)

        const config = {
          header: {
            "Content-Type": "image/png",
          },
        }

        axios
          .post(URL, data, config)
          .then((res) => {
            resolve(res)
          })
          .catch((e) => {
            reject(e)
          })
      })
    },
    sendProofPaymentVideo: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        "Bearer " + localStorage.getItem("access_token")
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        const URL = `payments/photo/${payload.id}/video`
        const data = new FormData()
        data.append("img", payload.files)

        const config = {
          "Content-Type": "multipart/form-data",
        }
        axios
          .post(URL, data, config)
          .then((res) => {
            resolve(res)
          })
          .catch((e) => {
            reject(e)
          })
      })
    },
  },
}
