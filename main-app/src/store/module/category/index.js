import axios from "axios"

export default {
  namespaced: true,
  state: {
    data: [],
    category: {},
    load_first: true,
    ratings: {},
  },
  getters: {},
  mutations: {
    GET_DATA_CATEGORY: (state, payload) => {
      state.data = payload
    },
    STOP_LOAD: state => (state.load_first = false),
    RATINGS: (state, payload) => (state.ratings = payload),
    GET_DATA_CATEGORY_OBJECT: (state, payload) => (state.category = payload),
  },
  actions: {
    getDataCategory: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        "Bearer " + localStorage.getItem("access_token")
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        const params = { ...payload }
        axios
          .get("studio/u/categories", { params: params })
          .then(res => {
            commit("GET_DATA_CATEGORY", res.data.data)
            resolve(res)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
    getDataCategoryShow: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        "Bearer " + localStorage.getItem("access_token")
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        const params = { ...payload }
        axios
          .get(`studio/u/categories/${payload.name}`, { params: params })
          .then(res => {
            commit("GET_DATA_CATEGORY_OBJECT", res.data.data)
            resolve(res)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
    ratingCategory: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        "Bearer " + localStorage.getItem("access_token")
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .get(`studio/reviews/avarage/${payload.studio_slug}`)
          .then(res => {
            commit("RATINGS", res.data.data)
            resolve(res)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
    followCategory: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        "Bearer " + localStorage.getItem("access_token")
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .post(`studio/u/categories/follow/${payload.id}`)
          .then(res => {
            resolve(res)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
    likeCategory: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        "Bearer " + localStorage.getItem("access_token")
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .post(`studio/u/categories/likes/${payload.id}`)
          .then(res => {
            resolve(res)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
    unfollowCategory: (_, payload) => {
      axios.defaults.headers.common.Authorization =
        "Bearer " + localStorage.getItem("access_token")
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .post(`studio/u/categories/unfollow/${payload.id}`)
          .then(res => {
            resolve(res)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
  },
}
