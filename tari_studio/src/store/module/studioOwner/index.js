import axios from 'axios'
export default {
  namespaced: true,
  state: {
    data: {},
  },
  getters: {},
  mutations: {
    UPDATE_DATA: (state, payload) => {
      state.data.name = payload.name
      state.data.prefix = payload.prefix
      state.data.email = payload.email
      state.data.contact = payload.contact
      state.data.address = payload.address
      state.data.about = payload.about
    },
  },
  actions: {
    updateDataStudios: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        axios
          .post('owner/studio/update', { ...payload })
          .then(res => {
            commit('UPDATE_DATA', res.data.data)
            resolve(res)
          })
          .catch(e => {
            reject(e)
          })
      })
    },
    inputPictureImgStudio: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        const URL = 'owner/files'
        const data = new FormData()
        data.append('name_thumbnail', 's')
        data.append('img', payload.files)
        data.append('studio_id', payload.studio_id)
        data.append('type', 'thumbnail')
        const config = {
          header: {
            'Content-Type': 'image/png',
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
    changePictureImgStudio: ({ commit }, payload) => {
      axios.defaults.headers.common.Authorization =
        'Bearer ' + localStorage.getItem('access_token')
      axios.defaults.baseURL = process.env.VUE_APP_API_URL

      return new Promise((resolve, reject) => {
        const URL = 'owner/files/update'
        const data = new FormData()
        data.append('name_thumbnail', 's')
        data.append('studio_id', payload.studio_id)
        data.append('img', payload.files)
        data.append('type', 'thumbnail')

        const config = {
          header: {
            'Content-Type': 'image/png',
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
