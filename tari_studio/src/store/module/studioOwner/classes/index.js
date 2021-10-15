import axios from "axios"

export default {
  namespaced: true,
  state: {
    data: [],
    dataBySlug: {},
  },
  getters: {
    data: state => state.data,
  },
  mutations: {
    SET_DATA: (state, payload) => (state.data = payload),
    INSERT_DATA: (state, payload) => {
      const classes = state.data
      classes.unshift(payload)
      state.data = classes
    },
    DELETES_DATA: (state, payload) => {
      // eslint-disable-next-line no-unused-vars
      for (const item in payload) {
        if (Object.hasOwnProperty.call(payload, item)) {
          const classes = payload[item]
          const index = state.data.findIndex(x => x.id === classes.id)
          if (index !== -1) {
            state.data.splice(index, 1)
          }
        }
      }
    },
    APPROVE_DATA: (state, payload) => {
      // eslint-disable-next-line no-unused-vars
      for (const item in payload) {
        if (Object.hasOwnProperty.call(payload, item)) {
          const classes = payload[item]
          const index = state.data.findIndex(x => x.id === classes.id)
          if (index !== -1) {
            state.data.status = payload.status
          }
        }
      }
    },
    UPDATE_DATA: (state, payload) => {
      const indexClasses = state.data.findIndex(x => x.id === payload.id)
      if (indexClasses !== -1) {
        state.data[indexClasses].name = payload.name
        state.data[indexClasses].levels = payload.levels
        state.data[indexClasses].about = payload.about
        state.data[indexClasses].durasi = payload.durasi
        state.data[indexClasses].meets = payload.meets
        state.data[indexClasses].keyword = payload.keyword
        state.data[indexClasses].harga = payload.harga
        state.data[indexClasses].kapasitas = payload.kapasitas
        state.data[indexClasses].category_id = payload.category_id
        state.data[indexClasses].instructor_id = payload.instructor_id
        state.data[indexClasses].start_at = payload.start_at
        state.data[indexClasses].end_at = payload.end_at
        state.data[indexClasses].time_start = payload.time_start
        state.data[indexClasses].time_end = payload.time_end
      }
    },
    DEL_DATA: (state, id) => {
      const index = state.data.findIndex(x => x.id === id)
      if (index !== -1) {
        state.data.splice(index, 1)
      }
    },
  },
  actions: {
    getDataClassesStudio: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        "Bearer " + localStorage.getItem("access_token")
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        const params = { ...payload }
        axios
          .get("owner/classes/myClass", { params: params })
          .then(res => {
            const data = res.data.data
            commit("SET_DATA", data)
            resolve(res)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
    insertDataClassesStudio: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        "Bearer " + localStorage.getItem("access_token")
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .post("owner/classes/create", { ...payload })
          .then(res => {
            const data = res.data.data
            commit("INSERT_DATA", data)
            resolve(res)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
    deleteDataClassesStudio: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        "Bearer " + localStorage.getItem("access_token")
      axios.defaults.baseURL = process.env.VUE_APP_API_URL
      const params = payload.map(x => x.id)
      return new Promise((resolve, reject) => {
        axios
          .post("owner/classes/delBroadcast", { id: params })
          .then(res => {
            commit("DELETES_DATA", payload)
            resolve(res)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
    approvesDataClassesStudio: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        "Bearer " + localStorage.getItem("access_token")
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        const params = payload.map(x => x.id)
        axios
          .post("owner/classes/approveBroadcast", { id: params })
          .then(res => {
            // const data = res.data.data
            commit("APPROVE_DATA", payload)
            resolve(res)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
    updateDataClassesStudio: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        "Bearer " + localStorage.getItem("access_token")
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .patch(`owner/classes/update/${payload.id}`, { ...payload })
          .then(res => {
            // const data = res.data.data
            commit("UPDATE_DATA", payload)
            resolve(res)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
    delDataClassesStudio: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        "Bearer " + localStorage.getItem("access_token")
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .delete(`owner/classes/destroy/${payload.id}`)
          .then(res => {
            commit("DEL_DATA", payload.id)
            resolve(res)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
  },
}
