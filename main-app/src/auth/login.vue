<template>
  <v-app v-if="imgUrl">
    <v-container fluid>
      <v-row
        dense
        class=""
      >
        <v-col
          cols="12"
          md="4"
          sm="12"
          class="d-flex flex-column"
        >
          <v-col
            cols="12"
            class="bg-auth"
          >
            <v-card-title
              class="font-size-ather-roboto-mono primary--text text-custome mt-6"
              title-tag="h2"
            >
              Selamat Datang Di EnsikloTari 👋
            </v-card-title>
            <v-card-text class="mb-2 secondary--text font-subtitle">
              Masuk Dengan Akun Mu Dan Mulai Pertualangan Mu
            </v-card-text>

            <v-alert
              dense
              text
              color="secondary"
            >
              <p class="font-size-ather-roboto-mono black--text text-custome-2">
                The Key To Happiness Is Login To Life, As a Guest And Not as An
                Administartor
              </p>
              - Chintoo Agl
            </v-alert>
            <v-card-text class="">
              <v-form @submit.prevent.enter="login">
                <v-text-field
                  v-model="email"
                  label="Email Or Username *"
                  color="btn_primary"
                  placeholder="E-mail Or Username"
                  outlined
                  dense
                />
                <v-text-field
                  v-model="password"
                  label="Password *"
                  placeholder="Password"
                  outlined
                  color="btn_primary"
                  dense
                  :append-icon="!show ? 'mdi-eye' : 'mdi-eye-off'"
                  :type="show ? 'text' : 'password'"
                  @click:append="show = !show"
                />

                <div class="d-flex flex-row justify-center ml-8 mt-7">
                  <div class="d-flex flex-coloumn">
                    <v-btn
                      color="primary"
                      width="370"
                      type="submit"
                    >
                      Sign-In
                    </v-btn>
                  </div>
                </div>

                <div class="d-flex flex-row justify-center mt-4">
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
                <div class="text-center font-questions mt-8">
                  <span class="color-black-2">Baru Di Platform Kami? </span>
                  <br>
                  <a
                    class="color-a"
                    @click="pushToRegister"
                  >
                    <span>&nbsp;Create an account</span>
                  </a>
                </div>
              </v-form>
            </v-card-text>
            <!-- <div class="d-flex flex-row mt-2 justify-center">
              <div class="d-flex flex-column">
                <p class="font-title-rampart-one-small">
                  Or
                </p>
              </div>
            </div>

            <div class="d-flex flex-row justify-center mt-1">
              <div class="d-flex flex-column">
                <v-btn
                  small
                  outlined
                  color="primary"
                >
                  <v-icon color="">
                    mdi-google
                  </v-icon>
                </v-btn>
              </div>
              <div class="d-flex flex-column ml-2">
                <v-btn
                  small
                  outlined
                  color="primary"
                >
                  <v-icon color="blue">
                    mdi-facebook
                  </v-icon>
                </v-btn>
              </div>
            </div> -->
          </v-col>
        </v-col>
        <v-col
          cols="12"
          md="8"
          class="d-flex flex-column bg-img"
        >
          <v-row>
            <v-col cols="12">
              <v-img
                width="1200"
                class="mr-2"
                :src="imgUrl"
              />
            </v-col>
          </v-row>
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
        this.sideImg = require('@/assets/img/login2.jpg')
        return this.sideImg
      },
    },
    mounted () {
      this.$vuetify.theme.dark = false
    },
    methods: {
      login () {
        this.$store
          .dispatch('auth/login', {
            email: this.email,
            password: this.password,
          })
          .then(response => {
            if (response.data.meta.status === true) {
              this.$store.dispatch('user/me').then(res => {
                if (res.data.data.isVerified === 0) {
                  this.$router.push('/waiting-email')
                } else {
                  const redirecturl = this.$route.query.redirect || '/'
                  this.$router.push(redirecturl)
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
                title: 'Password atau Email Anda salah',
              })
            }
          })
          .catch(() => {})
      },
      pushToRegister () {
        this.$router.push('/register')
      },
    },
  }
</script>

<style lang="sass">
@import url('https://fonts.googleapis.com/css2?family=Spartan&display=swap')
.bg-opocity
   background: linear-gradient(to right, rgba(226,226,226,1) 0%, rgba(254,254,254,1) 100%)
   border-color: white !important
.bg-auth
  background-color: #fff
// .bg-img
//   background-color: #E1F3F9
.tmp-opacity
  opacity: 0
.font-title
  font-family: 'Spartan', sans-serif
  color: #6B75AA !important
.font-subtitle
  font-family: 'Spartan', sans-serif
  font-size: 15px
// .cols
//   padding: 26px !important
.font-questions
  font-family: 'Spartan', sans-serif
.color-black-2
  color: black !important
  font-weight: bold !important
.color-a
  color: #6B75AA !important
  font-weight: bold !important
.text-custome
  font-size: 26px !important
  font-weight: 200 !important
  color: #2E4DA7 !important
.text-custome-2
  color: #2E4DA7 !important
</style>
