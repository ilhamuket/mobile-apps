import axios from "axios"

export default {
  namespaced: true,
  state: {
    data: [],
    summary: {
      all: 0,
      publish: 0,
      draft: 0,
      new: 0,
    },
    show: {},
  },
  getters: {},
  mutations: {
    GET_DATA: (state, payload) => (state.data = payload),
    SHOW_DATA: (state, payload) => (state.show = payload),
    GET_SUMMARY: (state, payload) => (state.summary = payload),
    INSERT_DATA: (state, payload) => {
      state.data.push(payload)
    },
    DELETE_DATA_ARTICLES: (state, payload) => {
      // eslint-disable-next-line no-unused-vars
      for (const item in payload) {
        if (Object.hasOwnProperty.call(payload, item)) {
          const article = payload[item]
          const indexArticle = state.data.findIndex((x) => x.id === article.id)
          if (indexArticle !== -1) {
            state.data.splice(indexArticle, 1)
          }
        }
      }
    },
    PUBLISH_DATA_ARTICLES: (state, payload) => {
      // eslint-disable-next-line no-unused-vars
      for (const item in payload) {
        if (Object.hasOwnProperty.call(payload, item)) {
          const article = payload[item]
          const indexArticle = state.data.findIndex((x) => x.id === article.id)
          if (indexArticle !== -1) {
            state.data[indexArticle].status = "publish"
          }
        }
      }
    },
    UPDATE_DATA: (state, payload) => {
      const indexArticle = state.data.findIndex((x) => x.id === payload.id)
      if (indexArticle !== -1) {
        state.data[indexArticle].title = payload.title
        state.data[indexArticle].content = payload.content
      }
    },
    DELETE_DATA_ARTICLE: (state, payload) => {
      const index = state.data.findIndex((x) => x.id === payload.id)
      console.log("index", index)
      if (index !== -1) {
        state.data.splice(index, 1)
      }
    },
    HIDE_DATA_ARTICLE: (state, payload) => {
      const index = state.data.findIndex((x) => x.id === payload.id)
      if (index !== -1) {
        state.data[index].status = "hide"
      }
    },
  },
  actions: {
    getDataArticle ({ commit }, payload) {
      axios.defaults.headers.common.Authorization =
        "Bearer " + localStorage.getItem("access_token")
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        const params = { ...payload }
        axios
          .get("media/article", { params: params })
          .then((res) => {
            commit("GET_DATA", res.data.data)
            resolve(res)
          })
          .catch((e) => {
            reject(e)
          })
      })
    },
    showDataArticle: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        "Bearer " + localStorage.getItem("access_token")
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        const params = { ...payload }
        axios
          .get(`media/article/${payload.id}`, { params: params })
          .then((res) => {
            resolve(res)
            commit("SHOW_DATA", res.data.data)
          })
          .catch((e) => {
            reject(e)
          })
      })
    },
    getArticleSummary: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        "Bearer " + localStorage.getItem("access_token")
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        const params = { ...payload }
        axios
          .get("media/article/summary", { params: params })
          .then((res) => {
            commit("GET_SUMMARY", res.data.data)
            resolve(res)
          })
          .catch((e) => {
            reject(e)
          })
      })
    },
    insertDataArticle: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        "Bearer " + localStorage.getItem("access_token")
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .post("media/article", { ...payload })
          .then((res) => {
            commit("INSERT_DATA", res.data.data)
            resolve(res)
          })
          .catch((e) => {
            reject(e)
          })
      })
    },
    deleteDataArticles: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        "Bearer " + localStorage.getItem("access_token")
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        const id = payload.map((x) => x.id)
        axios
          .post("media/article/deletes", { id: id })
          .then((res) => {
            commit("DELETE_DATA_ARTICLES", payload)
            resolve(res)
          })
          .catch((e) => {
            reject(e)
          })
      })
    },
    publishDataArticles: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        "Bearer " + localStorage.getItem("access_token")
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        const id = payload.map((x) => x.id)
        axios
          .post("media/article/approves", { id: id })
          .then((res) => {
            commit("PUBLISH_DATA_ARTICLES", payload)
            resolve(res)
          })
          .catch((e) => {
            reject(e)
          })
      })
    },
    updateDataArticle: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        "Bearer " + localStorage.getItem("access_token")
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .patch(`media/article/${payload.id}`, { ...payload })
          .then((res) => {
            commit("UPDATE_DATA", payload)
            resolve(res)
          })
          .catch((e) => {
            reject(e)
          })
      })
    },
    hideDataArticle: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        "Bearer " + localStorage.getItem("access_token")
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .patch(`media/article/${payload.id}`, { ...payload })
          .then((res) => {
            commit("HIDE_DATA_ARTICLE", payload)
            resolve(res)
          })
          .catch((e) => {
            reject(e)
          })
      })
    },
    deleteDataArticle: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        "Bearer " + localStorage.getItem("access_token")
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .delete(`media/article/${payload.id}`)
          .then((res) => {
            resolve(res)
            commit("DELETE_DATA_ARTICLE", payload)
          })
          .catch((e) => {
            reject(e)
          })
      })
    },
  },
}
