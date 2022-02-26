import axios from 'axios'
export default {
  namespaced: true,
  state: {
    data: [],
    summary: {
      total: 0,
      paid: 0,
      waiting: 0,
      new: 0,
    },
  },
  getters: {},
  mutations: {
    GET_DATA: (state, payload) => (state.data = payload),
    GET_SUMMARY: (state, payload) => (state.summary = payload),
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
  },
}
