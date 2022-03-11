import axios from 'axios'
export default {
  namespaced: true,
  state: {
    data: [],
    summary: {
      total: 0,
      waiting_transfer: 0,
      rejected: 0,
      new: 0,
      paid: 0,
    },
  },
  getters: {},
  mutations: {
    GET_DATA: (state, payload) => (state.data = payload),
    GET_SUMMARY: (state, payload) => (state.summary = payload),
    DELETE_DATA: (state, payload) => {
      const index = state.data.findIndex((item) => item.id === payload)
      if (index !== -1) {
        state.data.splice(index, 1)
      }
    },
    FILLED_BANK: (state, payload) => {
      const index = state.data.findIndex((item) => item.id === payload.id)
      if (index !== -1) state.data[index].to = payload.to
    },
    SEND_TRANSFER: (state, payload) => {
      const index = state.data.findIndex((item) => item.id === payload.id)
      if (index !== -1) state.data[index].status = 'paid'
    },
  },
  actions: {
    getDataPayment: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        const params = { ...payload }
        axios
          .get('payments/', { params: params })
          .then((res) => {
            resolve(res)
            commit('GET_DATA', res.data.data)
          })
          .catch((e) => {
            reject(e)
          })
      })
    },
    getSummaryPayment: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .get('payments/summary')
          .then((res) => {
            resolve(res)
            commit('GET_SUMMARY', res.data.data)
          })
          .catch((e) => {
            reject(e)
          })
      })
    },
    deleteDataPayment: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .delete(`payments/delete/${payload.id}`)
          .then((res) => {
            resolve(res)
            commit('DELETE_DATA', payload)
          })
          .catch((e) => {
            reject(e)
          })
      })
    },
    filledBank: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .patch(`payments/update/${payload.id}`, { ...payload })
          .then((res) => {
            resolve(res)
            commit('FILLED_BANK', payload)
          })
          .catch((e) => {
            reject(e)
          })
      })
    },
    sendTransfer ({ commit }, payload) {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .post(`payments/transfer/${payload.id}`, { ...payload })
          .then((res) => {
            resolve(res)
            commit('SEND_TRANSFER', payload)
          })
          .catch((e) => {
            reject(e)
          })
      })
    },
  },
}
