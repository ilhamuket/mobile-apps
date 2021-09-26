<template>
  <v-card>
    <v-card-text>
      <v-list-item
        class="opacity-1"
        three-line
      >
        <v-list-item-content>
          <!-- <div
                  class="text-overline mb-4 text-center font-title-rampart-one text-custome"
                >
                  Verification Email
                </div> -->
          <div
            class="text-overline mb-4 text-center font-size-ather-roboto-mono text-custome-brand"
          >
            ENSIKLOTARI
          </div>
          <div class="d-flex flex-row justify-center">
            <div
              v-if="data.data.item2"
              class="d-flex flex-column"
            >
              <v-list-item-title
                class="text-h5 mb-1 text-center font-size-ather-roboto-mono"
              >
                Username : {{ data.data.item2.userName }}
              </v-list-item-title>
              <v-list-item-subtitle>
                Email : {{ data.data.item2.email }}
              </v-list-item-subtitle>
            </div>
          </div>
          <div class="d-flex flex-row justify-center">
            <div class="d-flex flex-column">
              <v-list-item-title
                class="text-h5 mb-1 text-center font-size-ather-roboto-mono"
              >
                Nama Studio : {{ data.data.fullnameStudio }}
              </v-list-item-title>
            </div>
          </div>
          <div class="d-flex flex-row justify-center">
            <div class="d-flex flex-column">
              <v-list-item-title
                class="text-h5 mb-1 text-center font-size-ather-roboto-mono"
              >
                prefix Studio : {{ data.data.prefix }}
              </v-list-item-title>
            </div>
          </div>
          <div class="d-flex flex-row justify-center mt-2">
            <div class="d-flex flex-column">
              <p class="text-center font-size-ather-roboto-mono">
                Hai, Akun Anda EnsikloStudio Anda Sudah Dibuat
              </p>
            </div>
          </div>

          <div class="d-flex flex-row justify-center mt-2">
            <div class="d-flex flex-column">
              <p class="text-center font-size-ather-roboto-mono">
                Terima Kasih
              </p>
            </div>
          </div>

          <div class="d-flex flex-row justify-center">
            <div class="d-flex flex-column">
              <p class="text-center font-size-ather-roboto-mono">
                ENSIKLOTARI
              </p>
            </div>
          </div>
          <div class="d-flex flex-row justify-center">
            <div class="d-flex flex-column">
              <p class="text-center font-size-ather-roboto-mono">
                {{ now | moment('MMMM Do YYYY') }}
              </p>
            </div>
          </div>
        </v-list-item-content>
      </v-list-item>

      <v-card-actions class="d-flex justify-center">
        <v-btn
          text
          @click="getRegister"
        >
          Masuk
        </v-btn>
      </v-card-actions>
    </v-card-text>
  </v-card>
</template>

<script>
  export default {
    props: {
      data: {
        type: Object,
        default: null,
      },
    },
    computed: {
      now () {
        let date = null
        date = new Date()
        return date
      },
      yet () {
        let bool = 'false'
        if (localStorage.getItem('yet') === 'true') {
          bool = 'true'
        }
        return bool
      },
      syet () {
        let bool = ''
        if (localStorage.getItem('yet') === 'false') {
          bool = 'false'
        }
        return bool
      },
    },
    mounted () {},
    methods: {
      getRegister () {
        this.$emit('register')
      },
      resendVerifications () {
        this.$emit('resend')
      },
    },
  }
</script>

<style lang="sass">
@import url('https://fonts.googleapis.com/css2?family=Rampart+One&display=swap')
@import url('https://fonts.googleapis.com/css2?family=Rampart+One&family=Roboto+Condensed:wght@300&display=swap')
@import url('https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&family=Roboto+Mono:wght@100&family=Shadows+Into+Light&display=swap')
@import url('https://fonts.googleapis.com/css2?family=Roboto+Mono:ital,wght@1,700&display=swap')
.bg-opocity
   background: linear-gradient(to right, rgba(226,226,226,1) 0%, rgba(254,254,254,1) 100%)
   border-color: white !important
.bg-auth
  background-color: #ffff
.bg-img
  background-color: #F8F8F8
.tmp-opacity
  opacity: 0
.font-title
  font-family: 'Rampart One', cursive !important
  color: #6B75AA !important
.font-subtitle
  font-family: 'Rampart One', cursive
  font-family: 'Roboto Condensed', sans-serif
.cols
  padding: 26px !important
.font-questions
  font-family: 'Roboto Mono', monospace
.color-black-2
  color: black !important
  font-weight: bold !important
.color-a
  color: #6B75AA !important
  font-weight: bold !important
.row__margin
  margin-left: 200px
  margin-top: 20px
.theme--light.v-banner.v-sheet
    background-color: #8f2929
    width: 1300px
    margin-left: -80px
    border-radius: 10px
.btn__account
  .v-btn__content
    color: #9dc5d1
</style>
