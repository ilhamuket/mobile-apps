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
      const data = state.data
      data.unshift(payload)
      state.data = data
    },
    EDIT_DATA: (state, payload) => {
      const indexSubClass = state.data.findIndex(x => x.id === payload.id)

      if (indexSubClass !== -1) {
        state.data[indexSubClass].title = payload.title
        state.data[indexSubClass].status = payload.status
        state.data[indexSubClass].about = payload.about
        state.data[indexSubClass].time_start = payload.time_start
        state.data[indexSubClass].time_end = payload.time_end
        state.data[indexSubClass].color = payload.color
      }
    },
    DELETES_DATA_BY_ID: (state, id) => {
      const indexSubClass = state.data.findIndex(x => x.id === id)
      if (indexSubClass !== -1) {
        state.data.splice(indexSubClass, 1)
      }
    },
    DELETES_DATA: (state, payload) => {
      for (const item in payload) {
        if (Object.hasOwnProperty.call(payload, item)) {
          const subClasses = payload[item]
          const index = state.data.findIndex(x => x.id === subClasses.id)
          if (index !== -1) {
            state.data.splice(index, 1)
          }
        }
      }
    },
    APPROVE_DATA: (state, payload) => {
      for (const item in payload) {
        if (Object.hasOwnProperty.call(payload, item)) {
          const subClasses = payload[item]
          const index = state.data.findIndex(x => x.id === subClasses.id)
          if (index !== -1) {
            state.data[index].is_verified = 1
          }
        }
      }
    },
  },
  actions: {
    getDataSubClass: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        const params = { ...payload }
        axios
          .get('owner/sub-classes/my-sub', { params: params })
          .then(response => {
            const res = response.data.data
            commit('GET_DATA', res)
            resolve(response)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
    insertDataSubClass: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .post('owner/sub-classes/my-sub', { ...payload })
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
    deletesDataSubclass: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        const params = payload.map(x => x.id)
        axios
          .post('owner/sub-classes/my-sub/delestes', { id: params })
          .then(res => {
            commit('DELETES_DATA', payload)
            resolve(res)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
    approvesDataSubclass: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        const params = payload.map(x => x.id)
        axios
          .post('owner/sub-classes/my-sub/approves', { id: params })
          .then(({ data }) => {
            commit('APPROVE_DATA', payload)
            resolve(data)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
    editDataSubClass: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .patch(`owner/sub-classes/my-sub/${payload.id}`, { ...payload })
          .then(res => {
            commit('EDIT_DATA', payload)
            resolve(res)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
    deletesDataSubclassbyId: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .delete(`owner/sub-classes/my-sub/${payload.id}`)
          .then(res => {
            commit('DELETES_DATA_BY_ID', payload.id)
            resolve(res)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
  },
}
