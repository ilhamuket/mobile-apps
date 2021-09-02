import axios from 'axios'

export default {
  namespaced: true,
  state: {
    data: [],
  },
  getters: {},
  mutations: {
    GET_DATA: (state, payload) => (state.data = payload),
    INSERT_DATA: (state, payload) => {
      const data = state.data
      data.unshift(payload)
      state.data = data
    },
  },
  actions: {
    getDataSubClass: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        const params = { ...payload }
        axios
          .get('owner/sub-classes/my-sub', { params: params })
          .then(response => {
            const res = response.data.data
            commit('GET_DATA', res)
            resolve(response)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
    insertDataSubClass: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .post('owner/sub-classes/my-sub', { ...payload })
          .then(res => {
            const data = res.data.data
            commit('INSERT_DATA', data)
            resolve(res)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
  },
}
