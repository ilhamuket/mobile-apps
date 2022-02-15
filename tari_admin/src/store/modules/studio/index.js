import axios from 'axios'

export default {
  namespaced: true,
  state: {
    data: [],
  },
  getters: {},
  mutations: {
    GET_DATA: (state, payload) => (state.data = payload),
    APPROVED_DATA: (state, payload) => {
      const indexData = state.data.findIndex(x => x.id === payload.id)
      if (indexData !== -1) {
        state.data[indexData].isVerified = true
      }
    },
    DELETE_DATA: (state, id) => {
      const index = state.data.findIndex(x => x.id === id)
      state.data.splice(index, 1)
    },
    INSERT_DATA: (state, payload) => {
      const data = state.data
      data.unshift(payload)
      state.data = data
    },
  },
  actions: {
    getData: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        const params = { ...payload }
        axios
          .get('studio', { params: params })
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
    approvedData: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .post('studio/approve', { ...payload })
          .then(res => {
            //   const data = res.data.data
            commit('APPROVED_DATA', payload.id)
            resolve(res)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
    DeleteDataStudios: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .patch('studio', { ...payload })
          .then(res => {
            // const data = res.data.data
            commit('DELETE_DATA', payload.id)
            resolve(res)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
    deleteStudio: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .delete(`studio/${payload.id}`)
          .then(res => {
            commit('DELETE_DATA', payload.id)
            resolve(res)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
    insertData: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .post('studio', { ...payload })
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
    approvedDataById: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .patch(`studio/${payload.id}`)
          .then(res => {
            // const data = res.data.data
            commit('APPROVED_DATA', payload.id)
            resolve(res)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
  },
}
