import axios from 'axios'
export default {
  namespaced: true,
  state: {
    classes: [],
  },
  getters: {},
  mutations: {
    GET_DATA: (state, payload) => (state.classes = payload),
    INSERT_CLASS: (state, payload) => {
      const classes = state.classes
      classes.unshift(payload)
      state.classes = classes
    },
    DELETE_CLASS: (state, payload) => {
      const index = state.classes.indexOf(x => x.id === payload.id)
      state.classes.splice(index, 1)
    },
  },
  actions: {
    getClasses: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        const params = { ...payload }
        axios
          .get('classes', { params: params })
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
    insertClass: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .post('classes', { ...payload })
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
    deleteClass: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .delete(`classes/${payload.id}`)
          .then(res => {
            commit('DELETE_CLASS', payload.id)
            resolve(res)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
  },
}
