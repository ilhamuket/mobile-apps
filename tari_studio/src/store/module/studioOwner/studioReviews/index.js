import axios from 'axios'
export default {
  namespaced: true,
  state: {
    data: [],
  },
  getters: {},
  mutations: {
    GET_DATA: (state, payload) => (state.data = payload),
  },
  actions: {
    getDataReviewsStudio: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        const params = { ...payload }
        axios
          .get('owner/studio/responses', { params: params })
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
