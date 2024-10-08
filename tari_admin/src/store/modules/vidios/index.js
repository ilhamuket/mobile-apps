import axios from 'axios'
export default {
  namespaced: true,
  state: {
    playlist: [],
    vidios: {},
  },
  getters: {},
  mutations: {
    PLAYLIST: (state, payload) => (state.playlist = payload),
    SHOW_VIDIOS: (state, payload) => (state.vidios = payload),
    INSERT_CLASS: (state, payload) => {
      const schedule = state.vidios
      schedule.unshift(payload)
      state.vidios = schedule
    },
  },
  actions: {
    getPlayList: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        const params = { ...payload }
        axios
          .get('classes/schedule/me', { params: params })
          .then(response => {
            const data = response.data.data
            commit('PLAYLIST', data)
            resolve(response)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
    showVidios: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        const params = { ...payload }
        axios
          .get('classes/schedule/show', { params: params })
          .then(response => {
            const data = response.data.data
            commit('SHOW_VIDIOS', data)
            resolve(response)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
    insertClass: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .post('classes/schedule', { ...payload })
          .then(res => {
            const data = res.data.data
            commit('INSERT_CLASS', data)
            resolve(res)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
  },
}
