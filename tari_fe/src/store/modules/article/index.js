import axios from 'axios'

export default {
  namespaced: true,
  state: {
    data: [],
    article: {},
  },
  getters: {},
  mutations: {
    GET_DATA: (state, payload) => {
      state.data = payload
    },
    INSERT_DATA: (state, payload) => {
      const journal = state.data
      journal.unshift(payload)
      state.data = journal
    },
    GET_DATA_ARTICLE: (state, payload) => {
      state.article = payload
    },
    DELETE_ARTICLE: (state, payload) => {
      const indexJurnal = state.data.findIndex(x => x.id === payload.id)
      if (indexJurnal !== -1) {
        state.data.splice(indexJurnal, 1)
      }
    },
    APPROVE_DATA: (state, payload) => {
      const indexArticle = state.data.findIndex(x => x.id === payload.id)
      if (indexArticle !== -1) {
        state.data[indexArticle].isVerified = 1
      }
    },
  },
  actions: {
    getDataArticle: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        const params = { ...payload }
        axios
          .get('media/article', { params: params })
          .then(res => {
            const data = res.data.data
            commit('GET_DATA', data)
            resolve(res)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
    insertDataArticle: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .post('media/article', { ...payload })
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
    getDataArticleById: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .get(`media/article/${payload.id}`)
          .then(res => {
            const data = res.data.data
            commit('GET_DATA_ARTICLE', data)
            resolve(res)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
    updateDataArticleById: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .patch(`media/article/${payload.id}`, { ...payload })
          .then(res => {
            const data = res.data.data
            commit('GET_DATA_ARTICLE', data)
            resolve(res)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
    deleteArticleById: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .delete(`media/article/${payload.id}`)
          .then(res => {
            commit('DELETE_ARTICLE', payload.id)
            resolve(res)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
    deletesArticle: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        console.log(payload)
        axios
          .post('media/article/deletes', { ...payload })
          .then(res => {
            commit('DELETE_ARTICLE', payload.id)
            resolve(res)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
    approveArticles: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .post('media/article/approves', { ...payload })
          .then(res => {
            resolve(res)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
    approveArticle: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .patch('media/article/approve/' + payload.id)
          .then(res => {
            commit('APPROVE_DATA', payload.id)
            resolve(res)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
  },
}
