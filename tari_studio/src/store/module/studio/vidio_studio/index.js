import axios from 'axios'

export default {
  namespaced: true,
  state: {
    comments: [],
  },
  getters: {},
  mutations: {
    GET_DATA_COMMENTS: (state, payload) => {
      state.comments = payload
    },
  },
  actions: {
    getDataComments: (state, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL
    },
  },
}
