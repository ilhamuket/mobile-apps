import axios from 'axios'
export default {
  namespaced: true,
  state: {
    token: localStorage.getItem('access_token') || null,
  },
  getters: {},
  mutations: {
    GET_TOKEN: (state, payload) => (state.token = payload),
  },
  actions: {
    studioLogin: ({ commit }, payload) => {
      axios.defaults.baseURL = process.env.VUE_APP_API_URL
      return new Promise((resolve, reject) => {
        axios
          .post('auth/login/studio', { ...payload })
          .then(({ data }) => {
            const token = data.data
            commit('GET_TOKEN', token)
            localStorage.setItem('access_token', token)
            resolve(data)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
    registerAsStudio: ({ commit }, payload) => {
      axios.defaults.baseURL = process.env.VUE_APP_API_URL
      return new Promise((resolve, reject) => {
        axios
          .post('auth/register/studio', { ...payload })
          .then(res => {
            const token = res.data.data
            commit('GET_TOKEN', token)
            localStorage.setItem('access_token', token)
            resolve(res)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
    resendOtp () {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .get('auth/verifications/resend')
          .then(({ data }) => {
            resolve(data)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
  },
}
