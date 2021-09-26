import axios from 'axios'

export default {
  namespaced: true,
  state: {
    data: [],
    date: [],
  },
  getters: {},
  mutations: {
    GET_DATA: (state, payload) => {
      state.data = payload
    },
    GET_DATE: (state, payload) => {
      state.date = payload
    },
  },
  actions: {
    getDataStudioClasses: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        const params = { ...payload }
        axios
          .get(`studio/u/class/describe/${payload.slug}`, { params: params })
          .then(res => {
            const data = res.data.data
            commit('GET_DATA', data)
            resolve(res)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
    getDataStudioDate: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        const params = { ...payload }
        axios
          .get('studio/u/class/date', { params: params })
          .then(res => {
            commit('GET_DATE', res.data.data)
            resolve(res)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
  },
}
