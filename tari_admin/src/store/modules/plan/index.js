import axios from 'axios'
export default {
  namespaced: true,
  state: {
    data: [],
    summary: {
      total: 0,
      active: 0,
      inactive: 0,
      new: 0,
    },
  },
  getters: {},
  mutations: {
    GET_DATA: (state, data) => (state.data = data),
    GET_SUMMARY: (state, data) => (state.summary = data),
    SET_PLAN: (state, payload) => {
      const plan = state.data
      plan.push(payload)
      state.data = plan
    },
  },
  actions: {
    getDataPlan: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        const params = { ...payload }
        axios
          .get('plan', { params: params })
          .then((res) => {
            commit('GET_DATA', res.data.data)
            resolve(res)
          })
          .catch((e) => {
            reject(e)
          })
      })
    },
    getDataSummary: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .get('plan/summary', {})
          .then((res) => {
            commit('GET_SUMMARY', res.data.data)
            resolve(res)
          })
          .catch((e) => {
            reject(e)
          })
      })
    },
    storePlanSummary: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .post('plan', { ...payload })
          .then((res) => {
            resolve(res)
            commit('SET_PLAN', payload)
          })
          .catch((e) => {
            reject(e)
          })
      })
    },
  },
}
