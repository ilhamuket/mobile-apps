import axios from 'axios'

export default {
  namespaced: true,
  state: {
    data: [],
    load_first: true,
  },
  getters: {},
  mutations: {
    GET_DATA_CATEGORY: (state, payload) => {
      state.data = payload
    },
    STOP_LOAD: state => (state.load_first = false),
  },
  actions: {
    getDataCategory: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        const params = { ...payload }
        axios
          .get('studio/u/categories', { params: params })
          .then(res => {
            commit('GET_DATA_CATEGORY', res.data.data)
            resolve(res)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
  },
}
