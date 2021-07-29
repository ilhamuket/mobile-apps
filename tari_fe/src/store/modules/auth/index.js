import axios from 'axios'
export default {
  namespaced: true,
  state: {
    token: localStorage.getItem('access_token') || null,
  },
  getters: {},
  mutations: {
    TOKEN: (state, paylaod) => (state.token = paylaod),
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
            commit('removeToken')
            resolve(response)
          })
          .catch(error => {
            reject(error)
            localStorage.removeItem('access_token')
            commit('removeToken')
          })
      })
    },
  },
}
