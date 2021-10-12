<template>
  <v-app>
    <v-container>
      <v-row class="mt-12">
        <v-col cols="12">
          <v-card
            class="mx-auto rounded-xl"
            width="500"
            outlined
            color="pallet1"
          >
            <v-list-item
              class="opacity-1"
              three-line
            >
              <v-list-item-content class="text-justify-letter">
                <!-- <div
                  class="text-overline mb-4 text-center font-title-rampart-one text-custome"
                >
                  Verification Email
                </div> -->
                <div
                  class="text-overline mb-4 text-center font-spartan text-justify-letter white--text"
                >
                  <!-- ENSIKLOTARI -->
                  <v-img
                    width="180"
                    src="@/assets/img/logo.svg"
                  />
                </div>
                <div
                  class="d-flex flex-row justify-center text-justify-letter mb-3"
                >
                  <div class="d-flex flex-column">
                    <span
                      class="text-center mb-2 font-spartan-small white--text"
                    >
                      Nama : {{ users.nickName }}
                    </span>
                    <span class="font-spartan-small white--text">
                      Email : {{ users.email }}
                    </span>
                  </div>
                </div>
                <div class="d-flex flex-row justify-center text-justify-letter">
                  <div class="d-flex flex-column">
                    <p class="text-center font-spartan-small white--text">
                      Hai, silahkan periksa email anda untuk <br>
                      <br>
                      memverifikasi akun EnsikloTari
                    </p>
                    <p class="text-center font-spartan-small" />
                  </div>
                </div>

                <div class="d-flex flex-row justify-center mt-2">
                  <div class="d-flex flex-column">
                    <p class="text-center font-spartan-small white--text">
                      Terima kasih
                    </p>
                  </div>
                </div>

                <div class="d-flex flex-row justify-center">
                  <div class="d-flex flex-column">
                    <p class="text-center font-spartan-small white--text">
                      EnsikloTari
                    </p>
                  </div>
                </div>
                <div class="d-flex flex-row justify-center">
                  <div class="d-flex flex-column">
                    <p class="text-center font-spartan-small white--text">
                      {{ users.created_at | moment("MMMM Do YYYY") }}
                    </p>
                  </div>
                </div>
              </v-list-item-content>
            </v-list-item>

            <v-card-actions class="d-flex justify-center">
              <v-btn
                rounded
                color="primary"
                :disabled="isDisable"
                class="pallet1--text font-weight-bold"
                @click="sendVerifications"
              >
                KIRIM VERIFIKASI
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
  </v-app>
</template>

<script>
  import axios from "axios"
  export default {
    data: () => ({
      isDisable: false,
      time: 60,
      timer: null,
    }),
    computed: {
      users () {
        const Me = localStorage.getItem("ME")
        const users = JSON.parse(Me)

        return users
      },
    },
    methods: {
      click () {
        this.isDisable = true
        // const time = this.time
        setInterval(function () {
          if (this.time === 60) clearInterval(this)
          this.time++
        }, 1000)
        setTimeout(() => {
          this.isDisable = false
        //   if (this.time === 60) clearInterval(this)
        }, 60000)
      // this.counter()
      // setTimeout(() => {
      //   this.thi
      // })
      },
      counter () {
        if (this.time < 60) {
          return this.time
        }
        if (this.time > 0) return this.time--
        else {
          clearInterval(this.timer)
        }
        console.log(this.time)
      },
      sendVerifications () {
        axios.defaults.headers.common.Authorization =
          "Bearer " + localStorage.getItem("access_token")
        axios.defaults.baseURL = process.env.VUE_APP_API_URL

        this.isDisable = true

        axios.get("auth/verifications/resend/studio").then(res => {
          if (res.data.meta.status) {
            const Toast = this.$swal.mixin({
              toast: true,
              position: "bottom-end",
              showConfirmButton: false,
              timer: 3000,
              timerProgressBar: true,
              didOpen: toast => {
                toast.addEventListener("mouseenter", this.$swal.stopTimer)
                toast.addEventListener("mouseleave", this.$swal.resumeTimer)
              },
              popup: "swal2-show",
              backdrop: "swal2-backdrop-show",
              icon: "swal2-icon-show",
            })
            Toast.fire({
              icon: "success",
              title: res.data.data,
            })

            if (!this.timer) {
              this.timer = window.setInterval(function () {
                if (this.time < 60) {
                  return this.time
                }
                if (this.time > 0) return this.time--
                else {
                  clearInterval(this.timer)
                }
              }, 1000)
            }
          }
          setTimeout(() => {
            this.isDisable = false
          }, 60000)
        })
      },
    },
  }
</script>

<style lang="sass" scoped>
.text-custome
  color: blue
  font-size: 30px !important
.text-custome-brand
  color: blue
  font-size: 27px !important
.text-justify-letter
  text-align: justify !important
  text-justify: inter-word !important
.v-btn__content
  color: #843839 !important
// .opacity
//   /* Add the blur effect */
//   filter: blur(5px)
//   -webkit-filter: blur(8px)

//   /* Full height */
//   height: 100%

//   /* Center and scale the image nicely */
//   background-position: center
//   background-repeat: no-repeat
//   background-size: cover
</style>
