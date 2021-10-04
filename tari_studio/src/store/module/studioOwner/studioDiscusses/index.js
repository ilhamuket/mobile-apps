import axios from 'axios'
export default {
  namespaced: true,
  state: {
    data: [],
  },
  getters: {},
  mutations: {
    GET_DATA: (state, payload) => (state.data = payload),
    REPLY_DATA: (state, payload) => {
      const index = state.data.findIndex(x => x.id === payload.parent_id)
      if (index !== -1) {
        state.data[index].status = 'ditanggapi'
      }
    },
    DELETE_DATA: (state, payload) => {
      const index = state.data.findIndex(x => x.id === payload.id)
      if (index !== -1) {
        state.data.splice(index, 1)
      }
    },
    DELETE_DATA_SELECTED: (state, payload) => {
      for (const item in payload) {
        if (Object.hasOwnProperty.call(payload, item)) {
          const discusses = payload[item]
          const index = state.data.findIndex(x => x.id === discusses)
          if (index !== -1) {
            state.data.splice(index, 1)
          }
        }
      }
    },
    HIDE_STATUS_DATA: (state, payload) => {
      for (const item in payload) {
        if (Object.hasOwnProperty.call(payload, item)) {
          const discusses = payload[item]
          // console.log('id : ', discusses)
          const indexDiscusses = state.data.findIndex(x => x.id === discusses)
          // console.log('status : ', indexDiscusses)
          if (indexDiscusses !== -1) {
            state.data[indexDiscusses].status = 'sembunyikan'
          }
        }
      }
    },
  },
  actions: {
    getDataStudioDiscusses: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        const params = { ...payload }
        axios
          .get('owner/discusses/index', { params: params })
          .then(res => {
            commit('GET_DATA', res.data.data)
            resolve(res)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
    replyDataStudioDiscuss: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .post('owner/discusses/replies', { ...payload })
          .then(res => {
            commit('REPLY_DATA', res.data.data)
            resolve(res)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
    deleteDataDiscusses: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .delete(`owner/discusses/${payload.id}`)
          .then(res => {
            commit('DELETE_DATA', payload)
            resolve(res)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
    deleteDataDiscussesSelected: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        const params = payload.map(x => x.id)
        axios
          .post('owner/discusses/delete', { id: params })
          .then(res => {
            commit('DELETE_DATA_SELECTED', params)
            resolve(res)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
    hideDataDiscussesSelected: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        const params = payload.map(x => x.id)
        axios
          .post('owner/discusses/hide', { id: params })
          .then(res => {
            commit('HIDE_STATUS_DATA', params)
            resolve(res)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
  },
}
