import axios from "axios"

export default {
  namespaced: true,
  state: {
    me: {},
  },
  getters: {
    me: state => state.me,
  },
  mutations: {
    GET_ME: (state, payload) => (state.me = payload),
    EDIT_PROFILE: (state, payload) => {
      state.me.firstName = payload.firstName
      state.me.lastName = payload.lastName
      state.me.email = payload.email
      state.me.homeAddress = payload.homeAddress
      state.me.dateOfBirth = payload.dateOfBirth
      state.me.nickName = payload.nickName
      state.me.noHp = payload.noHp
      state.me.about = payload.about
    },
  },
  actions: {
    me: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        "Bearer " + localStorage.getItem("access_token")
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        const params = { ...payload }
        axios
          .get("user/me", { params: params })
          .then(response => {
            const data = response.data.data
            commit("GET_ME", data)
            localStorage.setItem("ME", JSON.stringify(data))
            resolve(response)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
    updateProfile: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        "Bearer " + localStorage.getItem("access_token")
      axios.defaults.baseURL = process.env.VUE_APP_API_URL
      return new Promise((resolve, reject) => {
        axios
          .patch(`user/${payload.id}`, { ...payload })
          .then(res => {
            const data = res.data.data
            commit("EDIT_PROFILE", data)
            resolve(res)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
    choosePicture: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        "Bearer " + localStorage.getItem("access_token")
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        const URL = "user/img"
        const data = new FormData()
        data.append("img", payload.files)
        const config = {
          header: {
            "Content-Type": "image/png",
          },
        }

        axios
          .post(URL, data, config)
          .then(res => {
            resolve(res)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
    changePicture: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        "Bearer " + localStorage.getItem("access_token")
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        const URL = "user/change-thumbnail"
        const data = new FormData()
        data.append("img", payload.files)
        const config = {
          header: {
            "Content-Type": "image/png",
          },
        }

        axios
          .post(URL, data, config)
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
