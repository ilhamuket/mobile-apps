import axios from 'axios'

export default {
  namespaced: true,
  state: {
    comments: [],
    childs: [],
  },
  getters: {},
  mutations: {
    GET_DATA_COMMENTS: (state, payload) => {
      state.comments = payload
    },
    INSERT_COMMENTS: (state, payload) => {
      const comment = state.comments
      comment.unshift(payload)
      state.comments = comment
    },
    GET_CHILDS_COMMENTS: (state, payload) => (state.childs = payload),
  },
  actions: {
    getDataComments: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        const params = { ...payload }
        axios
          .get('studio/comments/index', { params: params })
          .then(res => {
            const data = res.data.data
            commit('GET_DATA_COMMENTS', data)
            resolve(res)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
    insertComments: ({ commit }, paylaod) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .post('studio/comments/post', { ...paylaod })
          .then(res => {
            const data = res.data.data
            commit('INSERT_COMMENTS', data)
            resolve(res)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
    getDataChildComments: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        const params = { ...payload }
        axios
          .get('studio/comments/index/child', { params: params })
          .then(res => {
            const data = res.data.data
            commit('GET_CHILDS_COMMENTS', data)
            resolve(res)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
  },
}
