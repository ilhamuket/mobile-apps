import axios from 'axios'
export default {
  namespaced: true,
  state: {
    data: [],
    summary: {
      total: 0,
      paid: 0,
      waiting_confirmation: 0,
      waiting_payment: 0,
      waiting_proof: 0,
      pending: 0,
      cancelled: 0,
      new: 0,
    },
  },
  getters: {},
  mutations: {
    GET_DATA: (state, payload) => (state.data = payload),
    GET_SUMMARY: (state, payload) => (state.summary = payload),
    CONFIRMATION_ENSIKLOLIVE: (state, payload) => {
      const index = state.data.findIndex(
        (transaction) => transaction.id === payload.id,
      )
      state.data[index].status = 'paid'
    },
    REJECTED_ENSIKLOLIVE: (state, payload) => {
      const index = state.data.findIndex(
        (transaction) => transaction.id === payload.id,
      )
      state.data[index].status = 'pending'
      state.data[index].image_url = null
    },
  },
  actions: {
    getDataTransactionEnsikloLive: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        const params = { ...payload }
        axios
          .get('administrator/transaction/ensiklo-live/', { params: params })
          .then((res) => {
            resolve(res)
            commit('GET_DATA', res.data.data)
          })
          .catch((e) => {
            reject(e)
          })
      })
    },
    getDataSummaryTransactionEnsikloLive: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .get('administrator/transaction/ensiklo-live/summary')
          .then((res) => {
            resolve(res)
            commit('GET_SUMMARY', res.data.data)
          })
          .catch((e) => {
            reject(e)
          })
      })
    },
    confirmationCartEnsikloLive: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .post(`administrator/confirmation/live/${payload.id}`, { ...payload })
          .then((res) => {
            resolve(res)
            commit('CONFIRMATION_ENSIKLOLIVE', payload)
          })
          .catch((e) => {
            reject(e)
          })
      })
    },
    rejectedCartEnsikloLive: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .post(`administrator/confirmation/live/${payload.id}/rejected`, {
            ...payload,
          })
          .then((res) => {
            resolve(res)
            commit('REJECTED_ENSIKLOLIVE', payload)
          })
          .catch((e) => {
            reject(e)
          })
      })
    },
  },
}
