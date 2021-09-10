import Vue from 'vue'
import Vuetify from 'vuetify/lib'
import i18n from '@/i18n'
import '@/sass/overrides.sass'

Vue.use(Vuetify)

const theme = {
  primary: '#9DC4D1',
  secondary: '#8F8F38',
  third: '294F50',
  accent: '#9C27b0',
  info: '#00CAE3',
  pallet1: '#843839',
  landingpage: '#171B34',
  btn_primary: '#4CAF50',
}

export default new Vuetify({
  lang: {
    t: (key, ...params) => i18n.t(key, params),
  },
  theme: {
    themes: {
      dark: theme,
      light: theme,
    },
  },
})
