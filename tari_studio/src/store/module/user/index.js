import axios from 'axios'

export default {
  namespaced: true,
  state: {
    me: {},
  },
  getters: {
    me: state => state.me,
  },
  mutations: {
    GET_ME: (state, payload) => (state.me = payload),
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
            commit('GET_ME', data)
            localStorage.setItem('ME', JSON.stringify(data))
            resolve(response)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
  },
}
