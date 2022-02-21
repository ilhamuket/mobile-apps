import axios from 'axios'

export default {
  namespaced: true,
  state: {
    data: [],
    summary: {
      all: 0,
      approved: 0,
      non_approved: 0,
      new: 0,
    },
  },
  getters: {},
  mutations: {
    GET_DATA: (state, payload) => (state.data = payload),
    GET_SUMMARY: (state, payload) => (state.summary = payload),
    VERIFICATION_DATAS: (state, payload) => {
      // eslint-disable-next-line no-unused-vars
      for (const item in payload) {
        if (Object.hasOwnProperty.call(payload, item)) {
          const element = payload[item]
          const indexStudio = state.data.findIndex((x) => x.id === element.id)
          if (indexStudio !== -1) {
            state.data[indexStudio].author.isVerified = 1
          }
        }
      }
    },
    VERIFICATION_DATA: (state, payload) => {
      const indexStudio = state.data.findIndex(
        (x) => x.author_id === payload.id,
      )
      if (indexStudio !== -1) {
        state.data[indexStudio].author.isVerified = 1
      }
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
          .get('administrator/studio', { params: params })
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
    getDataStudioSummary: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .get('administrator/studio/summary')
          .then((res) => {
            commit('GET_SUMMARY', res.data.data)
            resolve(res)
          })
          .catch((e) => {
            reject(e)
          })
      })
    },
    verificationDataStudios: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        const userId = payload.map((x) => x.author.id)
        axios
          .post('administrator/studio/verifications', {
            user_id: userId,
          })
          .then((res) => {
            commit('VERIFICATION_DATAS', payload)
            resolve(res)
          })
          .catch((e) => {
            reject(e)
          })
      })
    },
    verificationDataStudio: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .patch(`administrator/studio/${payload.id}`)
          .then((res) => {
            commit('VERIFICATION_DATA', payload)
            resolve(res)
          })
          .catch((e) => {
            reject(e)
          })
      })
    },
  },
}
