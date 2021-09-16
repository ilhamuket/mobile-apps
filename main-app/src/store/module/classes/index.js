import axios from 'axios'

export default {
  namespaced: true,
  state: {
    data: [],
    dataBySlug: {},
  },
  getters: {},
  mutations: {
    GET_DATA: (state, payload) => (state.data = payload),
    GET_DATA_BY_SLUG: (state, payload) => (state.dataBySlug = payload),
  },
  actions: {
    getDataClasses: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL
      return new Promise((resolve, reject) => {
        const params = { ...payload }
        axios
          .get('studio/u/classes', { params: params })
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
    getDataClassesBySlug: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        const params = { ...payload }
        axios
          .get(`studio/u/class/${payload.studio_slug}/${payload.slug}`, {
            params: params,
          })
          .then(res => {
            const data = res.data.data
            commit('GET_DATA_BY_SLUG', data)
            resolve(res)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
  },
}
