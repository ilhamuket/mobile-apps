<template>
  <v-app :class="!isMobile ? 'app-isMobile' : 'app-not--isMobile'">
    <v-container>
      <v-row class="d-flex justify-center mt-12">
        <v-col
          cols="12"
          md="5"
          class="d-flex flex-column"
        >
          <!-- <v-col
            v-resize="onResize"
            cols="12"
            class="bg-auth"
          > -->
          <v-card :width="isMobile ? '' : '900'">
            <v-card-title class="font-spartan text-h6 mt-2 text-nowrap">
              Selamat datang di Studio EnsikloTari!👋
            </v-card-title>
            <v-card-text class="mb-2 font-spartan customize--subtitle">
              Masuk Dan Jelajahi Bersama Kami
            </v-card-text>

            <v-card-text
              class="mt-6"
              color="transparent"
            >
              <v-form @submit.prevent.enter="login">
                <v-row>
                  <v-col cols="12">
                    <v-text-field
                      v-model="email"
                      label="Email Or Username"
                      placeholder="E-mail Or Username"
                      outlined
                      dense
                    />
                  </v-col>
                  <v-col cols="12">
                    <v-text-field
                      v-model="password"
                      label="Password"
                      placeholder="Password"
                      outlined
                      dense
                      :append-icon="!show ? 'mdi-eye' : 'mdi-eye-off'"
                      :type="show ? 'text' : 'password'"
                      @click:append="show = !show"
                    />
                  </v-col>
                </v-row>

                <v-row class="d-flex flex-row-reverse">
                  <v-col
                    v-resize="onResize"
                    cols="12"
                    sm="6"
                  >
                    <v-btn
                      color="btn_primary"
                      type="submit"
                      :width="isMobile ? '298' : '100'"
                      :class="isMobile ? '' : 'custom--margin--btn'"
                      class="width--btn"
                    >
                      Masuk
                    </v-btn>
                  </v-col>
                  <v-col
                    cols="12"
                    sm="6"
                  >
                    <div class="d-flex flex-row justify-center">
                      <div class="d-flex flex-column">
                        <v-chip
                          color="transparent"
                          style="cursor: pointer"
                        >
                          <span class="font-spartan-small">
                            Lupa Password ?
                          </span>
                        </v-chip>
                      </div>
                    </div>
                  </v-col>
                </v-row>
                <div class="text-center font-questions mt-12">
                  <!-- <span class="color-black-2">New on our platform? </span> -->
                  <a
                    class="color-a"
                    style="text-decoration: underline"
                    @click="signUp"
                  >
                    <span>&nbsp;Daftar Sekarang</span>
                  </a>
                </div>
              </v-form>
            </v-card-text>
          </v-card>
          <!-- </v-col> -->
        </v-col>
      </v-row>
    </v-container>
  </v-app>
</template>

<script>
  export default {
    data: () => ({
      show: false,
      email: "",
      password: "",
      isMobile: false,
    }),
    computed: {
      imgUrl () {
        // eslint-disable-next-line vue/no-side-effects-in-computed-properties
        this.sideImg = require("@/assets/img/preview.jpg")
        return this.sideImg
      },
    },
    mounted () {
      this.$vuetify.theme.dark = false
    },
    methods: {
      onResize () {
        if (window.innerWidth < 769) this.isMobile = true
        else this.isMobile = false
      },
      login () {
        this.$store
          .dispatch("studioAuth/studioLogin", {
            email: this.email,
            password: this.password,
          })
          .then((res) => {
            if (res.meta.status) {
              this.$store.dispatch("user/me").then((response) => {
                if (response.data.data.isVerified === 0) {
                  this.$router.push("/waiting-email")
                } else {
                  const redirecturl = this.$route.query.redirect || "/"
                  this.$router.push(redirecturl)
                  // location.reload()
                  const Toast = this.$swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                      toast.addEventListener("mouseenter", this.$swal.stopTimer)
                      toast.addEventListener("mouseleave", this.$swal.resumeTimer)
                    },
                    popup: "swal2-show",
                    backdrop: "swal2-backdrop-show",
                    icon: "swal2-icon-show",
                  })

                  Toast.fire({
                    icon: "success",
                    title: `Succes Login As ${response.data.data.nickName}`,
                  })
                }
              })
            } else {
              this.isWrong = true
              this.alert = true
              const Toast = this.$swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                  toast.addEventListener("mouseenter", this.$swal.stopTimer)
                  toast.addEventListener("mouseleave", this.$swal.resumeTimer)
                },
                popup: "swal2-show",
                backdrop: "swal2-backdrop-show",
                icon: "swal2-icon-show",
              })

              Toast.fire({
                icon: "error",
                title: res.meta.message,
              })
            }
          })
      },
      signUp () {
        this.$router.push("/register")
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
  text-decoration: underline
.force--opacity
  opacity: 0
.v-label
  font-family: 'Spartan', sans-serif !important
.cord--login
  margin-left: 33% !important
.app-not--isMobile
  background-color: #843839 !important
.app-isMobile
  height: 20% !important
  background-color: #843839 !important
.custom--margin--btn
  margin-left: 28% !important
  margin-top: -2%
.width--btn
    margin-left: 78px !important
</style>
<style>
@media screen and (max-width: 322px) {
  .width--btn {
    margin-left: 10px !important;
    width: 242px !important;
  }
}

@media screen and (max-width: 412px) {
  .width--btn {
    width: 300px !important;
    margin-left: 15px !important;
  }
}
@media screen and (max-width: 415px) {
  .width--btn {
    width: 300px !important;
    margin-left: 33px !important;
  }
}
</style>
