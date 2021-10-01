import axios from 'axios'
export default {
  namespaced: true,
  state: {
    data: {},
  },
  getters: {},
  mutations: {
    UPDATE_DATA: (state, payload) => {
      state.data.name = payload.name
      state.data.prefix = payload.prefix
      state.data.email = payload.email
      state.data.contact = payload.contact
      state.data.address = payload.address
      state.data.about = payload.about
    },
  },
  actions: {
    updateDataStudios: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .post('owner/studio/update', { ...payload })
          .then(res => {
            commit('UPDATE_DATA', res.data.data)
            resolve(res)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
  },
}
