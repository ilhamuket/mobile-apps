import axios from 'axios'
export default {
  namespaced: true,
  state: {
    data: [],
  },
  getters: {},
  mutations: {
    GET_DATA: (state, payload) => (state.data = payload),
    REPLY_DATA: (state, payload) => {
      const index = state.data.findIndex(x => x.id === payload.parent_id)
      if (index !== -1) {
        state.data[index].status = 'ditanggapi'
      }
    },
    DELETE_DATA: (state, payload) => {
      const index = state.data.findIndex(x => x.id === payload.id)
      if (index !== -1) {
        state.data.splice(index, 1)
      }
    },
  },
  actions: {
    getDataStudioDiscusses: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        const params = { ...payload }
        axios
          .get('owner/discusses/index', { params: params })
          .then(res => {
            commit('GET_DATA', res.data.data)
            resolve(res)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
    replyDataStudioDiscuss: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .post('owner/discusses/replies', { ...payload })
          .then(res => {
            commit('REPLY_DATA', res.data.data)
            resolve(res)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
    deleteDataDiscusses: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .delete(`owner/discusses/${payload.id}`)
          .then(res => {
            commit('DELETE_DATA', payload)
            resolve(res)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
  },
}
