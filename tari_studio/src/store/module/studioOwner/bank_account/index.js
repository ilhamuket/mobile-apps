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
    DELETE_BYID: (state, payload) => {
      const indexBankAccount = state.data.findIndex(x => x.id === payload.id)
      if (indexBankAccount !== -1) {
        state.data.splice(indexBankAccount, 1)
      }
    },
    ACTIVATED_DATA: (state, payload) => {
      // eslint-disable-next-line no-unused-vars
      for (const item in payload) {
        if (Object.hasOwnProperty.call(payload, item)) {
          const bankAccount = payload[item]
          const indexBankAccount = state.data.findIndex(
            x => x.id === bankAccount.id,
          )
          if (indexBankAccount !== -1) {
            state.data[indexBankAccount].status = "active"
          }
        }
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
    deleteDataBankAccountById: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        "Bearer " + localStorage.getItem("access_token")
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .delete(`owner/bank-account/${payload.id}`)
          .then(res => {
            commit("DELETE_BYID", payload)
            resolve(res)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
    activatedDataBankAccount: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        "Bearer " + localStorage.getItem("access_token")
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        const params = payload.map(x => x.id)
        axios
          .post("owner/bank-account/activated", { id: params })
          .then(res => {
            commit("ACTIVATED_DATA", payload)
            resolve(res)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
  },
}
