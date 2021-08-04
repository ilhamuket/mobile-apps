import axios from 'axios'
export default {
  namespaced: true,
  state: {
    list: [],
  },
  getters: {},
  mutations: {
    GET_DATA: (state, payload) => (state.list = payload),
    INSERT_DATA: (state, payload) => {
      const category = state.list
      category.unshift(payload)
      state.list = category
    },
    EDIT_DATA: (state, payload) => {
      const indexCategory = state.list.findIndex(x => x.id === payload.id)

      if (indexCategory !== -1) {
        state.list[indexCategory].name = payload.name
        state.list[indexCategory].display_name = payload.display_name
        state.list[indexCategory].status = payload.status
      }
    },
    REMOVE_DATA: (state, id) => {
      const index = state.list.indexOf(id)
      state.list.splice(index, 1)
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
          .get('media/category', { params: params })
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
    insertData: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .post('media/category', { ...payload })
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
    editData: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .patch(`media/category/${payload.id}`, { ...payload })
          .then(res => {
            const data = res.data.data
            commit('EDIT_DATA', data)
            resolve(res)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
    removeData: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .delete(`media/category/${payload.id}`)
          .then(res => {
            commit('REMOVE_DATA', payload.id)
            resolve(res)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
  },
}
