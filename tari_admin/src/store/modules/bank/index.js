import axios from 'axios'

export default {
  namespaced: true,
  state: {
    data: [],
  },
  getters: {},
  mutations: {
    GET_DATA: (state, data) => (state.data = data),
  },
  actions: {
    getDataBankAccountStuio: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        const params = { ...payload }
        axios
          .get(`administrator/bank/studio/${payload.id}`, { params: params })
          .then((res) => {
            commit('GET_DATA', res.data.data)
            resolve(res)
          })
          .catch((e) => {
            reject(e)
          })
      })
    },
  },
}
