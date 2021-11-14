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
          .post("payments/pay", {
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
  },
}
