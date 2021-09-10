<template>
  <v-app>
    <v-container fluid>
      <v-row
        dense
        class="d-flex flex-row-reverse justify-space-around"
      >
        <v-col
          cols="12"
          md="7"
          class="d-flex flex-column bg-img"
        >
          <v-row>
            <v-col>
              <v-img
                class="ml-2"
                width="800"
                :src="imgUrl"
              >
                <!-- <v-app-bar
                  absolute
                  color="#F8F8F8"
                  elevate-on-scroll
                >
                  <v-toolbar-title
                    class="mr-12"
                    dark
                  >
                    <v-img
                      src="@/assets/logo-e-color (2).png"
                      width="200"
                      class="mr-12"
                    />
                  </v-toolbar-title>
                </v-app-bar> -->
                <!-- <v-container fluid /> -->
              </v-img>
            </v-col>
          </v-row>
        </v-col>
        <v-col
          cols="12"
          md="4"
          class="d-flex flex-column dense"
        >
          <v-col
            cols="12"
            class="bg-auth"
          >
            <v-card-title
              class="font-spartan primary--text mt-6 text-nowrap"
              title-tag="h2"
            >
              Selamat datang di Studio EnsikloTari! 👋
            </v-card-title>
            <v-card-text class="mb-2 font-spartan customize--subtitle">
              Masuk Dan Jelajahi Bersama Kami
            </v-card-text>

            <v-alert
              dense
              text
              color="primary"
              class=""
            >
              <p class="font-spartan customize--subtitle force--opacity">
                The Key To Happiness Is Login To Life, As a Guest And Not as An
                Administartor
              </p>
            </v-alert>
            <v-card-text
              class=""
              color="transparent"
            >
              <v-form @submit.prevent.enter="login">
                <v-text-field
                  v-model="email"
                  label="Email Or Username"
                  placeholder="E-mail Or Username"
                  outlined
                  dense
                  prepend-icon="mdi-login-variant"
                />
                <v-text-field
                  v-model="password"
                  label="Password"
                  placeholder="Password"
                  outlined
                  dense
                  prepend-icon="mdi-lock"
                  :append-icon="!show ? 'mdi-eye' : 'mdi-eye-off'"
                  :type="show ? 'text' : 'password'"
                  @click:append="show = !show"
                />

                <div class="d-flex flex-row justify-center ml-8">
                  <div class="d-flex flex-coloumn">
                    <v-btn
                      color="pallet1"
                      width="370"
                      type="submit"
                    >
                      Sign-In
                    </v-btn>
                  </div>
                </div>
                <div class="d-flex flex-row justify-center">
                  <div class="d-flex flex-column">
                    <v-chip
                      color="transparent"
                      text-color="red"
                    >
                      <h4>
                        Forgott Password ?
                      </h4>
                    </v-chip>
                  </div>
                </div>
                <div class="text-center font-questions">
                  <span class="color-black-2">New on our platform? </span>
                  <a
                    class="color-a"
                    @click="signUp"
                  >
                    <span>&nbsp;Create an account</span>
                  </a>
                </div>
              </v-form>
            </v-card-text>
          </v-col>
        </v-col>
      </v-row>
    </v-container>
  </v-app>
</template>

<script>
  export default {
    data: () => ({
      show: false,
      email: '',
      password: '',
    }),
    computed: {
      imgUrl () {
        // eslint-disable-next-line vue/no-side-effects-in-computed-properties
        this.sideImg = require('@/assets/asetlogin.png')
        return this.sideImg
      },
    },
    mounted () {
      this.$vuetify.theme.dark = false
    },
    methods: {
      login () {
        this.$store
          .dispatch('studioAuth/studioLogin', {
            email: this.email,
            password: this.password,
          })
          .then(res => {
            if (res.meta.status) {
              this.$store.dispatch('user/me').then(response => {
                if (response.data.data.isVerified === 0) {
                  this.$router.push('/verification')
                } else {
                  this.$router.push('/')
                  const Toast = this.$swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: toast => {
                      toast.addEventListener('mouseenter', this.$swal.stopTimer)
                      toast.addEventListener('mouseleave', this.$swal.resumeTimer)
                    },
                    popup: 'swal2-show',
                    backdrop: 'swal2-backdrop-show',
                    icon: 'swal2-icon-show',
                  })

                  Toast.fire({
                    icon: 'success',
                    title: `Succes Login As ${response.data.data.nickName}`,
                  })
                }
              })
            } else {
              this.isWrong = true
              this.alert = true
              const Toast = this.$swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: toast => {
                  toast.addEventListener('mouseenter', this.$swal.stopTimer)
                  toast.addEventListener('mouseleave', this.$swal.resumeTimer)
                },
                popup: 'swal2-show',
                backdrop: 'swal2-backdrop-show',
                icon: 'swal2-icon-show',
              })

              Toast.fire({
                icon: 'error',
                title: res.meta.message,
              })
            }
          })
      },
      signUp () {
        this.$router.push('/register')
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
.customize--subtitle
  font-size: 12px !important
a
  text-decoration: underline
.force--opacity
  opacity: 0
</style>
