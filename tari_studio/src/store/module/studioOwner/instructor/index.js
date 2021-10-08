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
      const dataInstructor = state.data
      dataInstructor.unshift(payload)
      state.data = dataInstructor
    },
    UPDATE_DATA: (state, payload) => {
      const indexInstructor = state.data.findIndex(x => x.id === payload.id)
      if (indexInstructor !== -1) {
        state.data[indexInstructor].name = payload.name
        state.data[indexInstructor].email = payload.email
        state.data[indexInstructor].region = payload.region
        state.data[indexInstructor].contact = payload.contact
        state.data[indexInstructor].profession = payload.profession
        state.data[indexInstructor].about = payload.about
      }
    },
    DESTROY_DATA: (state, id) => {
      const indexInstructor = state.data.findIndex(x => x.id === id)
      if (indexInstructor !== -1) {
        state.data.splice(indexInstructor, 1)
      }
    },
    DELETES_DATA: (state, payload) => {
      for (const item in payload) {
        if (Object.hasOwnProperty.call(payload, item)) {
          const instructor = payload[item]
          const index = state.data.findIndex(x => x.id === instructor.id)
          if (index !== -1) {
            state.data.splice(index, 1)
          }
        }
      }
    },
    APPROVE_DATA: (state, payload) => {
      for (const item in payload) {
        if (Object.hasOwnProperty.call(payload, item)) {
          const instructor = payload[item]
          const index = state.data.findIndex(x => x.id === instructor.id)
          if (index !== -1) {
            state.data[index].is_verified = 1
          }
        }
      }
    },
  },
  actions: {
    getDataTeacherStudio: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        const params = { ...payload }
        axios
          .get('owner/instructor', { params: params })
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
    insertDataTeacherStudio: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .post('owner/instructor', { ...payload })
          .then(res => {
            commit('INSERT_DATA', payload)
            resolve(res)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
    updateDataTeacherStudio: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .patch(`owner/instructor/edit/${payload.id}`, { ...payload })
          .then(res => {
            // const data = res.data.data
            commit('UPDATE_DATA', payload)
            resolve(res)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
    deleteDataTeacherStudioById: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .delete(`owner/instructor/delete/${payload.id}`)
          .then(res => {
            commit('DESTROY_DATA', payload.id)
            resolve(res)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
    deletesDataTeacherStudioBroadCast: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        const params = payload.map(x => x.id)
        axios
          .post('owner/instructor/deletes', { id: params })
          .then(res => {
            // const data = res.data.data
            commit('DELETES_DATA', payload)
            resolve(res)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
    approveDataTeacherStudioBoadCast: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        const params = payload.map(x => x.id)
        axios
          .post('owner/instructor/approved', { id: params })
          .then(res => {
            // const data = res.data.data
            commit('APPROVE_DATA', payload)
            resolve(res)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
  },
}
