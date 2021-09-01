import axios from 'axios'

export default {
  namespaced: true,
  state: {
    autoPlay: {},
    listVidio: [],
  },
  getters: {},
  mutations: {
    GET_DATA_AUTOPLAY: (state, paylaod) => (state.autoPlay = paylaod),
    GET_DATA_LIST_VIDIO: (state, payload) => (state.listVidio = payload),
  },
  actions: {
    getDataAutoplay: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        const params = { ...payload }
        axios
          .get('studio/vidio/auto-play', { params: params })
          .then(res => {
            const data = res.data.data
            commit('GET_DATA_AUTOPLAY', data)
            resolve(res)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
    getDataListVidio: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        const params = { ...payload }
        axios
          .get('studio/vidio/list-vidio', { params: params })
          .then(res => {
            const data = res.data.data
            commit('GET_DATA_LIST_VIDIO', data)
            resolve(res)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
  },
}
