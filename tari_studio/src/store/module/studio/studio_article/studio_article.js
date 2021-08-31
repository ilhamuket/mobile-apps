import axios from 'axios'

export default {
  namespaced: true,
  state: {
    article: [],
  },
  getters: {},
  mutations: {
    GET_ARTICLES: (state, payload) => (state.article = payload),
  },
  actions: {
    getArticles: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        const params = { ...payload }
        axios
          .get(`studio/u/article/${payload.slug}`, { params: params })
          .then(res => {
            const data = res.data.data
            commit('GET_ARTICLES', data)
            resolve(res)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
  },
}
