import axios from 'axios'
export default {
  namespaced: true,
  state: {
    data: [],
  },
  getters: {},
  mutations: {
    GET_DATA: (state, payload) => (state.data = payload),
    INSERT_DATA: (state, payload) => {
      const category = state.data
      category.unshift(payload)
      state.data = category
    },
    UPDATE_DATA: (state, payload) => {
      const indexCategory = state.data.findIndex(x => x.id === payload.id)
      if (indexCategory !== -1) {
        state.data[indexCategory].name = payload.name
        state.data[indexCategory].display_name = payload.display_name
      }
    },
    DELETE_DATA: (state, payload) => {
      const indexCategory = state.data.findIndex(x => x.id === payload.id)
      if (indexCategory !== -1) {
        state.data.splice(indexCategory, 1)
      }
    },
    DELETE_DATA_SELECTED: (state, payload) => {
      for (const item in payload) {
        if (Object.hasOwnProperty.call(payload, item)) {
          const categoryId = payload[item]
          const indexCategory = state.data.findIndex(x => x.id === categoryId)
          if (indexCategory !== -1) {
            state.data.splice(indexCategory, 1)
          }
        }
      }
    },
    APPROVE_CATEGORY: (state, payload) => {
      const indexCategory = state.data.findIndex(x => x.id === payload.id)
      if (indexCategory !== -1) {
        state.data[indexCategory].status = 'publish'
      }
    },
    APPROVE_CATEGORY_SELECTED: (state, payload) => {
      for (const item in payload) {
        if (Object.hasOwnProperty.call(payload, item)) {
          const categoryId = payload[item]
          const indexCategory = state.data.findIndex(x => x.id === categoryId)
          if (indexCategory !== -1) {
            state.data[indexCategory].status = 'publish'
          }
        }
      }
    },
  },
  actions: {
    getDataStudioCategories: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        const params = { ...payload }
        axios
          .get('owner/categories', { params: params })
          .then(res => {
            commit('GET_DATA', res.data.data)
            resolve(res)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
    insertDataCategory: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .post('owner/categories', { ...payload })
          .then(res => {
            commit('INSERT_DATA', payload)
            resolve(res)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
    updateDataCategory: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .patch(`owner/categories/update/${payload.id}`, { ...payload })
          .then(res => {
            commit('UPDATE_DATA', payload)
            resolve(res)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
    deleteDataCategory: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .delete(`owner/categories/delete/${payload.id}`)
          .then(res => {
            commit('DELETE_DATA', payload)
            resolve(res)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
    approveCategory: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .patch(`owner/categories/approve/${payload.id}`)
          .then(res => {
            commit('APPROVE_CATEGORY', payload)
            resolve(res)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
    deleteDataCategorySelected: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        const params = payload.map(x => x.id)
        axios
          .post('owner/categories/delete', { id: params })
          .then(res => {
            commit('DELETE_DATA_SELECTED', params)
            resolve(res)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
    approveCategorySelected: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        const params = payload.map(x => x.id)
        axios
          .post('owner/categories/approve', { id: params })
          .then(res => {
            commit('APPROVE_CATEGORY_SELECTED', params)
            resolve(res)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
  },
}
