<template>
  <v-app>
    <v-container class="">
      <v-banner
        single-line
        color="pallet1"
        @click:icon="alert"
      >
        <v-img
          width="140"
          class="ml-12 navbar-brand"
          src="@/assets/img/logo.svg"
        />

        <template v-slot:actions>
          <v-btn
            color="red"
            text
            class="btn__account"
            @click="toPush('/login')"
          >
            Sudah Punya Akun
          </v-btn>
        </template>
      </v-banner>
      <v-row
        v-resize="onResize"
        :class="isMobile ? 'mt-2' : 'row__margin'"
      >
        <v-col
          cols="12"
          md="8"
          sm="12"
          class=""
        >
          <v-stepper v-model="e1">
            <v-stepper-header>
              <v-stepper-step
                :editable="e1 > 1 || e1 < 1 ? true : false"
                :complete="e1 > 1"
                step="1"
              >
                Buat Akun
              </v-stepper-step>

              <v-divider />

              <v-stepper-step
                :editable="e1 > 2 || disable_state ? true : false"
                :complete="e1 > 2"
                step="2"
              >
                Buat Studio
                <!--  -->
              </v-stepper-step>

              <v-divider />

              <v-stepper-step
                :editable="e1 > 3 || disable_state_three ? true : false"
                :complete="e1 > 3"
                step="3"
              >
                Tahap Akhir
                <!--   -->
              </v-stepper-step>
            </v-stepper-header>

            <v-stepper-items>
              <v-stepper-content step="1">
                <app-card-creating-acc @next="nextToStepTwo" />
              </v-stepper-content>

              <v-stepper-content step="2">
                <app-card-creating-studio
                  :data="users"
                  @next="nextToStepThree"
                />
              </v-stepper-content>

              <v-stepper-content step="3">
                <app-card-final
                  :data="studio"
                  @register="registerAsStudio"
                />
              </v-stepper-content>
            </v-stepper-items>
          </v-stepper>
        </v-col>
      </v-row>
    </v-container>
  </v-app>
</template>

<script>
  import axios from "axios"
  import cardCreatingAccount from "./component/_creatingAccount.vue"
  import cardCreatingStudio from "./component/_creatingStudio.vue"
  import cardFinal from "./component/_waiting-verification.vue"
  axios.defaults.headers.common.Authorization =
    "Bearer " + localStorage.getItem("access_token")
  axios.defaults.baseURL = process.env.VUE_APP_API_URL
  export default {
    components: {
      "app-card-creating-acc": cardCreatingAccount,
      "app-card-creating-studio": cardCreatingStudio,
      "app-card-final": cardFinal,
    },
    data: () => ({
      show: false,
      email: "",
      password: "",
      e1: 1,
      invalid: false,
      disable_state: false,
      disable_state_three: false,
      users: {
        firstName: "Studio",
        lastName: "Bagus",
      },
      studio: {
        data: {
          item2: {},
          preifx: "as",
          fullnameStudio: "",
        },
      },
      isYet: false,
      region: "bandung",
      isMobile: false,
    }),
    computed: {
      imgUrl () {
        // eslint-disable-next-line vue/no-side-effects-in-computed-properties
        this.sideImg = require("@/assets/img/Secure login-bro.svg")
        return this.sideImg
      },
    //
    },
    mounted () {
      localStorage.setItem("yet", this.isYet)
    },
    methods: {
      toPush (link) {
        this.$router.push(link)
      },
      onResize () {
        if (window.innerWidth < 769) this.isMobile = true
        else this.isMobile = false
      },
      nextToStepTwo ({ item }) {
        this.e1 = 2
        this.disable_state = true
        this.users = item
        console.log(this.users)
      },
      alert () {
        alert("Hello, World!")
      },
      nextToStepThree ({ item }) {
        this.studio = item
        this.e1 = 3
        this.disable_state_three = true
        console.log(this.studio)
      },
      uploadFiles ({ item }) {
        console.log(item)
        const URL = "studio/files/thumbnail"
        const data = new FormData()
        data.append("file", item)
        const config = {
          header: {
            "Content-Type": "image/png",
          },
        }
        axios.post(URL, data, config).then((response) => {
          if (response.data.meta.status) {
            this.upload_state = false
            this.disable_state = false
            this.image_id = response.data.data.id
          } else {
            this.upload_state = false
            this.disable_state = false
          }
        })
      },
      registerAsStudio () {
        if (localStorage.getItem("yet") === "false") {
          this.$store
            .dispatch("studioAuth/registerAsStudio", {
              firstName: this.studio.data.item2.firstName,
              lastName: this.studio.data.item2.lastName,
              password: this.studio.data.item2.password,
              noHp: this.studio.data.item2.phoneNumber,
              email: this.studio.data.item2.email,
              nickName: this.studio.data.item2.userName,
              prefix: this.studio.data.prefix,
              name_studio: this.studio.data.item1.data.name,
              about: this.studio.data.item1.data.about,
              url: this.studio.data.item1.data.options,
            })
            .then((res) => {
              // this.$router.push('/')
              if (res.data.meta.status) {
                this.isYet = true
                localStorage.setItem("yet", this.isYet)
                const Toast = this.$swal.mixin({
                  toast: true,
                  position: "bottom-end",
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
                  title: "Send Verifications",
                })
                console.log("diverifikasi")
                this.$router.push("/")
              } else {
                // this.$router.push('/')
                const Toast = this.$swal.mixin({
                  toast: true,
                  position: "bottom-end",
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
                  title: "Gagal",
                })
              }
            })
        // this.isYet = true
        // localStorage.setItem('yet', this.isYet)
        //
        } else {
          this.$store.dispatch("studioAuth/resendOtp")
          console.log("sendUlang")
        }
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
.navbar-brand
  margin-left: 20px
</style>
