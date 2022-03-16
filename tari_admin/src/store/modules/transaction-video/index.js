import axios from 'axios'
export default {
  namespaced: true,
  state: {
    data: [],
    summary: {
      total: 0,
      paid: 0,
      pending: 0,
      new: 0,
      waiting_confirmation: 0,
      waiting_payment: 0,
    },
  },
  getters: {},
  mutations: {
    GET_DATA: (state, payload) => (state.data = payload),
    GET_SUMMARY: (state, payload) => (state.summary = payload),
    CONFIRMATION_DATA: (state, payload) => {
      const index = state.data.findIndex((x) => x.id === payload.id)
      if (index !== -1) state.data[index].status = 'paid'
    },
    REJECTED_DATA: (state, payload) => {
      const index = state.data.findIndex((x) => x.id === payload.cart_id)
      if (index !== -1) state.data[index].status = 'pending'
    },
  },
  actions: {
    getDataTransactionEnsikloVideo: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        const params = { ...payload }
        axios
          .get('administrator/transaction/ensiklo-video/', {
            params: params,
          })
          .then((res) => {
            resolve(res)
            commit('GET_DATA', res.data.data)
          })
          .catch((e) => {
            reject(e)
          })
      })
    },
    getDataSummaryTransactionEnsikloVideo: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .get('administrator/transaction/ensiklo-video/summary/')
          .then((res) => {
            resolve(res)
            commit('GET_SUMMARY', res.data.data)
          })
          .catch((e) => {
            reject(e)
          })
      })
    },
    confirmationData: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .post(`administrator/confirmation/video/${payload.id}`, {
            ...payload,
          })
          .then((res) => {
            resolve(res)
            commit('CONFIRMATION_DATA', payload)
          })
          .catch((e) => {
            reject(e)
          })
      })
    },
    rejectData: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .post(`administrator/confirmation/video/${payload.cart_id}/rejected`)
          .then((res) => {
            resolve(res)
            commit('REJECTED_DATA', payload)
          })
          .catch((e) => {
            reject(e)
          })
      })
    },
  },
}
