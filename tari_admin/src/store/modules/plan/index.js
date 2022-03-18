import axios from 'axios'
export default {
  namespaced: true,
  state: {
    data: [],
    summary: {
      total: 0,
      active: 0,
      inactive: 0,
      new: 0,
    },
  },
  getters: {},
  mutations: {
    GET_DATA: (state, data) => (state.data = data),
    GET_SUMMARY: (state, data) => (state.summary = data),
    SET_PLAN: (state, payload) => {
      const plan = state.data
      plan.push(payload)
      state.data = plan
    },
    ACTIVATED_PLAN: (state, payload) => {
      const indexPlan = state.data.findIndex((plan) => plan.id === payload.id)
      if (indexPlan !== -1) {
        state.data[indexPlan].status = 'active'
      }
    },
    INACTIVATE_PLAN: (state, payload) => {
      const indexPlan = state.data.findIndex((plan) => plan.id === payload.id)
      if (indexPlan !== -1) {
        state.data[indexPlan].status = 'inactive'
      }
    },
    EDIT_PLAN: (state, payload) => {
      const indexPlan = state.data.findIndex((plan) => plan.id === payload.id)
      if (indexPlan !== -1) {
        state.data[indexPlan].name = payload.name
        state.data[indexPlan].about = payload.about
        state.data[indexPlan].date_count = payload.duration
        state.data[indexPlan].type = payload.type
      }
    },
  },
  actions: {
    getDataPlan: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        const params = { ...payload }
        axios
          .get('plan', { params: params })
          .then((res) => {
            commit('GET_DATA', res.data.data)
            resolve(res)
          })
          .catch((e) => {
            reject(e)
          })
      })
    },
    getDataSummary: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .get('plan/summary', {})
          .then((res) => {
            commit('GET_SUMMARY', res.data.data)
            resolve(res)
          })
          .catch((e) => {
            reject(e)
          })
      })
    },
    storePlanSummary: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .post('plan', { ...payload })
          .then((res) => {
            resolve(res)
            commit('SET_PLAN', payload)
          })
          .catch((e) => {
            reject(e)
          })
      })
    },
    activatedPlan: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .post(`plan/${payload.id}`)
          .then((res) => {
            resolve(res)
            commit('ACTIVATED_PLAN', payload)
          })
          .catch((e) => {
            reject(e)
          })
      })
    },
    editPlan: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .patch(`plan/${payload.id}`, { ...payload })
          .then((res) => {
            resolve(res)
            commit('EDIT_PLAN', payload)
          })
          .catch((e) => {
            reject(e)
          })
      })
    },
    inactivatePlan: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .delete(`plan/${payload.id}`)
          .then((res) => {
            resolve(res)
            commit('INACTIVATE_PLAN', payload)
          })
          .catch((e) => {
            reject(e)
          })
      })
    },
  },
}
