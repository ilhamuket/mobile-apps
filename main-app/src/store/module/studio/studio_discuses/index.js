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
      const discusses = state.data
      discusses.push(payload)
      state.data = discusses
    },
  },
  actions: {
    getDataDiscusses: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        const params = { ...payload }
        axios
          .get(`studio/u/discuss/${payload.class_slug}`, { params: params })
          .then(res => {
            commit('GET_DATA', res.data.data)
            resolve(res)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
    replyDataDiscusses: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .post('studio/u/discuss', { ...payload })
          .then(res => {
            commit('REPLY_DATA', res.data.data)
            console.log(res.data.data)
            resolve(res)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
  },
}
