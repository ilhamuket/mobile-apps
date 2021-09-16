import Vue from 'vue'
import VueI18n from 'vue-i18n'

import en from 'vuetify/lib/locale/en'
import id from 'vuetify/lib/locale/id'

Vue.use(VueI18n)

const messages = {
  en: {
    ...require('@/locales/en.json'),
    // ...require('moment/locale/es'),
    $vuetify: en,
  },
  id: {
    ...require('@/locales/id.json'),
    // ...require('moment/locale/id'),
    $vuetify: id,
  },
}

export default new VueI18n({
  locale: 'en',
  fallbackLocale: 'en',
  messages,
})
