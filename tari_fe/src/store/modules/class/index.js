// import axios from 'axios'
export default {
  namespaced: true,
  state: {
    classes: [],
  },
  getters: {},
  mutations: {
    GET_DATA: (state, payload) => (state.classes = payload),
  },
  actions: {
    // getClasses: ({ commit }, payload) => {
    //   axios.defaults.headers.common.Authorization =
    //     'Bearer ' + localStorage.getItem('access_token')
    //   axios.defaults.baseURL = process.env.VUE_APP_API_URL
    //   return new Promise((resolve, reject) => {})
    // },
  },
}
