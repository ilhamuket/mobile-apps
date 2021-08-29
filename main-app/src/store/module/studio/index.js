import axios from 'axios'

export default {
  namespaced: true,
  state: {
    data: [],
    dataBySlug: {},
    isLoad: true,
  },
  getters: {
    data: state => state.data,
    slug: state => state.dataBySlug,
  },
  mutations: {
    GET_DATA_STUDIO: (state, payload) => (state.data = payload),
    GET_DATA_STUDIO_BY_SLUG: (state, payload) => (state.dataBySlug = payload),
    GET_OFF: state => (state.isLoad = false),
  },
  actions: {
    getDataStudio: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        const params = { ...payload }
        axios
          .get('studio', { params: params })
          .then(res => {
            const data = res.data.data
            commit('GET_DATA_STUDIO', data)
            commit('GET_OFF')
            resolve(res)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
    getDataStudioBySlug: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        const params = { ...payload }
        axios
          .get(`studio/u/${payload.slug}`, { params: params })
          .then(res => {
            const data = res.data.data
            commit('GET_DATA_STUDIO_BY_SLUG', data)
            resolve(res)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
    // Follow
    followStudio: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        // const params = { ...payload }
        axios
          .post(`studio/u/following/${payload.slug}`)
          .then(res => {
            const data = res.data.data
            commit('GET_DATA_STUDIO_BY_SLUG', data)
            resolve(res)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
    unfollStudio: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .post(`studio/u/unfollow/${payload.slug}`)
          .then(res => {
            const data = res.data.data
            commit('GET_DATA_STUDIO_BY_SLUG', data)
            resolve(res)
          })
          .catch(e => {
            reject(e)
          })
      })
    },

    // Likes
    likeStudio: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .post(`studio/u/likes/${payload.slug}`)
          .then(res => {
            const data = res.data.data
            commit('GET_DATA_STUDIO_BY_SLUG', data)
            resolve(res)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
    unLikeStudio: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .post(`studio/u/unlike/${payload.slug}`)
          .then(res => {
            const data = res.data.data
            commit('GET_DATA_STUDIO_BY_SLUG', data)
            resolve(res)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
  },
}
