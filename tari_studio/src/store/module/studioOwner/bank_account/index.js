import axios from "axios"

export default {
  namespaced: true,
  state: {
    data: [],
  },
  getters: {},
  mutations: {
    GET_DATA: (state, payload) => (state.data = payload),
    INSERT_DATA: (state, payload) => {
      const data = state.data
      data.unshift(payload)
      state.data = data
    },
    UPDATE_DATA: (state, payload) => {
      const indexBankAccount = state.data.findIndex(x => x.id === payload.id)
      if (indexBankAccount !== -1) {
        state.data[indexBankAccount].name = payload.name
        state.data[indexBankAccount].no_rek = payload.no_rek
        state.data[indexBankAccount].bank_name = payload.bank_name
      }
    },
  },
  actions: {
    getDataBankAccount: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        "Bearer " + localStorage.getItem("access_token")
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        const params = { ...payload }
        axios
          .get("owner/bank-account/", { params: params })
          .then(res => {
            commit("GET_DATA", res.data.data)
            resolve(res)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
    insertDataBankAccont: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        "Bearer " + localStorage.getItem("access_token")
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .post("owner/bank-account", { ...payload })
          .then(res => {
            commit("INSERT_DATA", payload)
            resolve(res)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
    updateDataBankAccount: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        "Bearer " + localStorage.getItem("access_token")
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .patch(`owner/bank-account/${payload.id}`, { ...payload })
          .then(res => {
            commit("UPDATE_DATA", payload)
            resolve(res)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
  },
}
