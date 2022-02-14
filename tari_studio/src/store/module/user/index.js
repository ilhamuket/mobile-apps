import axios from "axios"

export default {
  namespaced: true,
  state: {
    me: {},
  },
  getters: {
    me: (state) => state.me,
  },
  mutations: {
    GET_ME: (state, payload) => (state.me = payload),
    UPDATE_DATA: (state, payload) => {
      state.me.firstName = payload.firstName
      state.me.lastName = payload.lastName
      state.me.nickName = payload.nickName
      state.me.email = payload.email
      state.me.homeAddress = payload.homeAddress
      state.me.noHp = payload.noHp
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
          .then((response) => {
            const data = response.data.data
            commit("GET_ME", data)
            localStorage.setItem("ME", JSON.stringify(data))
            resolve(response)
          })
          .catch((e) => {
            reject(e)
          })
      })
    },
    updateDataAccount: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        "Bearer " + localStorage.getItem("access_token")
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .patch(`user/edit`, {
            ...payload,
          })
          .then((res) => {
            commit("UPDATE_DATA", payload)
            resolve(res)
            console.log(res.data.data)
          })
          .catch((e) => {
            reject(e)
          })
      })
    },
  },
}
