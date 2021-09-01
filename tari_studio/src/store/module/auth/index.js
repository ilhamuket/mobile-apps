import axios from 'axios'

export default {
  namespaced: true,
  state: {
    token: localStorage.getItem('access_token') || null,
  },
  getters: {
    token: state => state.token,
  },
  mutations: {
    GET_TOKEN: (state, payload) => (state.token = payload),
    REMOVE_TOKEN: state => (state.token = null),
  },
  actions: {
    login: ({ commit }, payload) => {
      axios.defaults.baseURL = process.env.VUE_APP_API_URL
      return new Promise((resolve, reject) => {
        axios
          .post('auth/login', { ...payload })
          .then(response => {
            const token = response.data.data
            commit('TOKEN', token)
            localStorage.setItem('access_token', token)
            resolve(response)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
    logout: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .get('auth/logout')
          .then(response => {
            localStorage.removeItem('access_token')
            localStorage.removeItem('ME')
            localStorage.removeItem('dark_theme')
            commit('REMOVE_TOKEN')
            resolve(response)
          })
          .catch(error => {
            reject(error)
            localStorage.removeItem('access_token')
            commit('REMOVE_TOKEN')
          })
      })
    },
  },
}
