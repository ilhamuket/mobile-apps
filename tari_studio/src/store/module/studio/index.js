import axios from 'axios'

export default {
  namespaced: true,
  state: {
    data: [],
    dataBySlug: {},
    me: {},
    isLoad: true,
    state_load: true,
  },
  getters: {
    data: state => state.data,
    slug: state => state.dataBySlug,
  },
  mutations: {
    GET_DATA_STUDIO: (state, payload) => (state.data = payload),
    GET_DATA_STUDIO_BY_SLUG: (state, payload) => (state.dataBySlug = payload),
    GET_OFF: state => (state.isLoad = false),
    STATE_LOAD: state => (state.state_load = false),
    GET_ME: (state, payload) => (state.me = payload),
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
    getDataMeStudio: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        const params = { ...payload }
        axios
          .get('owner/studio/me', { params: params })
          .then(res => {
            commit('GET_ME', res.data.data)
            resolve(res)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
  },
}
