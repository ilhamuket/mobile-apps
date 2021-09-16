import axios from 'axios'

export default {
  namespaced: true,
  state: {
    data: {
      classes: 10,
      instructor: 8,
      category: 1,
      vidio_profile: 4,
    },
  },
  getters: {},
  mutations: {
    GET_DATA: (state, payload) => (state.data = payload),
  },
  actions: {
    getDataSummary: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .get('owner/studio/summary')
          .then(res => {
            commit('GET_DATA', res.data.data)
            resolve(res)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
  },
}
