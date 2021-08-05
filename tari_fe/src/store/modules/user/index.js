import axios from 'axios'
export default {
  namespaced: true,
  state: {
    me: {},
    data: [],
  },
  getters: {},
  mutations: {
    ME: (state, payload) => (state.me = payload),
    GET_DATA: (state, payload) => (state.data = payload),
  },
  actions: {
    me: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .get('user/me')
          .then(response => {
            const data = response.data.data
            commit('ME', data)
            localStorage.setItem('ME', JSON.stringify(data))
            resolve(response)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
    getDataUser: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        const params = { ...payload }
        axios
          .get('user', { params: params })
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
  },
}
