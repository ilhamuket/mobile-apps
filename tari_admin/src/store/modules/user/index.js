import axios from 'axios'
export default {
  namespaced: true,
  state: {
    me: {},
    data: [],
    indexAll: [],
    summary: {
      total: 0,
      superadministrator: 0,
      owner: 0,
      student: 0,
    },
  },
  getters: {},
  mutations: {
    ME: (state, payload) => (state.me = payload),
    GET_DATA: (state, payload) => (state.data = payload),
    GET_DATA_ALL: (state, payload) => {
      state.indexAll = payload
    },
    GET_SUMMARY: (state, payload) => (state.summary = payload),
  },
  actions: {
    me: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .get('user/me')
          .then((response) => {
            const data = response.data.data
            commit('ME', data)
            localStorage.setItem('ME', JSON.stringify(data))
            resolve(response)
          })
          .catch((e) => {
            reject(e)
          })
      })
    },
    getIndexUser: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        const params = { ...payload }
        axios
          .get('administrator/user', { params: params })
          .then((res) => {
            const data = res.data.data
            commit('GET_DATA_ALL', data)
            resolve(res)
          })
          .catch((e) => {
            reject(e)
          })
      })
    },
    getDataUser: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        const params = { ...payload }
        axios
          .get('user', { params: params })
          .then((res) => {
            const data = res.data.data
            commit('GET_DATA', data)
            resolve(res)
          })
          .catch((e) => {
            reject(e)
          })
      })
    },
    updateDataUser: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .patch(`user/${payload.id}`, { ...payload })
          .then((res) => {
            const data = res.data.data
            commit('ME', data)
            resolve(res)
          })
          .catch((e) => {
            reject(e)
          })
      })
    },
    getSummary: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .get('user/summary')
          .then((res) => {
            const data = res.data.data
            commit('GET_SUMMARY', data)
            resolve(res)
          })
          .catch((e) => {
            reject(e)
          })
      })
    },
  },
}
