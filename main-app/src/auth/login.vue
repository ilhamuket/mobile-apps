<template>
  <v-app class="bg--login overflow-hidden">
    <v-container class="">
      <v-row class="">
        <v-col class="">
          <v-container>
            <v-row class="d-flex justify-center my-auto">
              <v-col
                cols="12"
                md="4"
                sm="12"
                class=""
              >
                <v-card class="position__card">
                  <!-- <v-card-title class="d-flex justify-center pt-8"> -->
                  <!-- <span class="font-spartan-title">
                      Daftarkan diri dan mulai pertualanganmu 👋
                    </span> -->
                  <div
                    style="width: 220px"
                    class="mx-auto pt-6"
                  >
                    <v-img
                      src="@/assets/img/ensiklotariLogo.svg"
                      class=""
                    />
                  </div>
                  <!-- </v-card-title> -->
                  <v-card-text class="pt-6">
                    <v-form @submit.prevent.enter="login">
                      <v-row>
                        <v-container>
                          <v-col cols="12">
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
                            <v-btn
                              color="btn_primary"
                              type="submit"
                              width="100%"
                            >
                              Masuk
                            </v-btn>
                          </v-col>
                          <v-col
                            cols="12"
                            md="12"
                            class="d-flex justify-center"
                          >
                            <v-chip
                              color="transparent"
                              to="/forgot-password"
                              style="cursor: pointer"
                            >
                              <span
                                style="font-size: 1rem"
                                class="text--forgot font-weight-bold black--text"
                              >
                                Lupa Password ?
                              </span>
                            </v-chip>
                          </v-col>
                        </v-container>
                      </v-row>

                      <div class="text-center font-questions mt-8 pb-6">
                        <span
                          class="color-black-2"
                        >Baru Di Platform Kami?
                        </span>
                        <br>
                        <a
                          class="color-a"
                          @click="pushToRegister"
                        >
                          <span>&nbsp;Daftar Sekarang</span>
                        </a>
                      </div>
                    </v-form>
                  </v-card-text>
                </v-card>
              </v-col>
            </v-row>
          </v-container>
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
      login () {
        this.$store
          .dispatch("auth/login", {
            email: this.email,
            password: this.password,
          })
          .then((response) => {
            if (response.data.meta.status === true) {
              this.$store.dispatch("user/me").then((res) => {
                if (res.data.data.isVerified === 0) {
                  this.$router.push("/waiting-email")
                } else {
                  const redirecturl = this.$route.query.redirect || "/"
                  this.$router.push(redirecturl)
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
                title: "Password atau Email Anda salah",
              })
            }
          })
          .catch(() => {})
      },
      pushToRegister () {
        this.$router.push("/register")
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
.bg--login
  background-color: #843839 !important
  // width: max-content !important
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
.card--margin
 margin-top: 15% !important
.row
  margin: 0 !important
.position_text
  position: absolute
  left: 15px
  top: 24px
.col
  padding: 5px !important
.overflow-hidden
  overflow: hidden !important
.text--forgot
  &:hover
    text-decoration: underline
@media screen and (max-width:813px)
  .position__card
    position: absolute
    right: 0px
</style>
