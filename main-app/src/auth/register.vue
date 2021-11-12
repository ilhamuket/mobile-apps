<template>
  <v-app>
    <v-container fluid>
      <v-row dense>
        <!-- <v-col
          cols="12"
          md="8"
          class="d-flex flex-column bg-img"
        >
          <v-row>
            <v-col>
              <v-img
                width="1000"
                class="mr-2"
                :src="imgUrl"
              />
            </v-col>
          </v-row>
        </v-col> -->
        <v-col
          cols="12"
          md="4"
          class="cols__form"
        >
          <v-col
            cols="12"
            class="bg-auth"
          >
            <v-card>
              <v-card-title
                class="font-spartan"
                title-tag="h2"
              >
                Welcome to EnsikloTari! 👋
              </v-card-title>
              <v-card-text class="mb-2 font-subtitle">
                Please sign-Up to your account and start the adventure
              </v-card-text>

              <!-- <v-alert
              dense
              text
              color="#2E4DA7"
            >
              <p class="font-title">
                The Key To Happiness Is Login To Life, As a Guest And Not as An
                Administartor
              </p>
              - Chintoo Agl
            </v-alert> -->
              <v-card-text
                class="card--margin"
                color="transparent"
              >
                <validation-observer
                  ref="observer"
                  v-slot="{ invalid }"
                >
                  <v-form @submit.prevent.enter="register">
                    <validation-provider
                      v-slot="{ errors }"
                      name="UserName"
                      rules="required|max:20"
                    >
                      <v-text-field
                        v-model="username"
                        label="UserName"
                        placeholder="UserName"
                        outlined
                        :error-messages="errors"
                        dense
                        prepend-icon="mdi-account-box"
                      />
                    </validation-provider>
                    <validation-provider
                      v-slot="{ errors }"
                      name="phoneNumber"
                      :rules="{
                        required: true,
                        digits: 12,
                      }"
                    >
                      <v-text-field
                        v-model="phoneNumber"
                        label="Phone Number"
                        placeholder="Phone Number"
                        outlined
                        :error-messages="errors"
                        type="text"
                        dense
                        prepend-icon="mdi-cellphone-settings"
                      />
                    </validation-provider>
                    <validation-provider
                      v-slot="{ errors }"
                      name="email"
                      rules="required|email"
                    >
                      <v-text-field
                        v-model="email"
                        label="E-mail"
                        placeholder="E-mail"
                        :error-messages="errors"
                        outlined
                        dense
                        prepend-icon="mdi-at"
                      />
                    </validation-provider>
                    <validation-provider
                      v-slot="{ errors }"
                      name="Password"
                      rules="required"
                    >
                      <v-text-field
                        v-model="password"
                        label="Password"
                        placeholder="Password"
                        outlined
                        :error-messages="errors"
                        dense
                        prepend-icon="mdi-lock"
                        :append-icon="!show ? 'mdi-eye' : 'mdi-eye-off'"
                        :type="show ? 'text' : 'password'"
                        @click:append="show = !show"
                      />
                    </validation-provider>
                    <validation-provider
                      v-slot="{ errors }"
                      name="Password"
                      rules="required"
                    >
                      <v-text-field
                        v-model="confirmPassword"
                        label="Confirm Password"
                        placeholder="Confirm Password"
                        outlined
                        :rules="[rules.required, passwordMatch]"
                        dense
                        :error-messages="errors"
                        required
                        prepend-icon="mdi-lock"
                        :append-icon="!show ? 'mdi-eye' : 'mdi-eye-off'"
                        :type="show ? 'text' : 'password'"
                        @click:append="show = !show"
                      />
                    </validation-provider>

                    <div class="d-flex flex-row justify-center ml-8 mt-12">
                      <div class="d-flex flex-coloumn">
                        <v-btn
                          color="pallet1"
                          width="370"
                          type="submit"
                          :disabled="invalid"
                        >
                          Sign-Up
                        </v-btn>
                      </div>
                    </div>

                    <div class="text-center font-spartan mt-8">
                      <span class="font-spartan">Sudah Punya Akun ? </span>
                      <a
                        class="color-a"
                        @click="signIn"
                      >
                        <span>&nbsp;Masuk</span>
                      </a>
                    </div>

                    <div class="d-flex flex-row justify-center mt-2">
                      <div class="d-flex flex-column">
                        <v-chip
                          color="transparent"
                          text-color="red"
                        >
                          <h4>Lupa Password</h4>
                        </v-chip>
                      </div>
                    </div>
                  </v-form>
                </validation-observer>
              </v-card-text>
            </v-card>
          </v-col>
        </v-col>
      </v-row>
    </v-container>
  </v-app>
</template>

<script>
  import { required, digits, email, max, regex } from "vee-validate/dist/rules"
  import {
    extend,
    ValidationObserver,
    ValidationProvider,
    setInteractionMode,
  } from "vee-validate"

  setInteractionMode("eager")

  extend("digits", {
    ...digits,
    message: "{_field_} needs to be {length} digits. ({_value_})",
  })

  extend("required", {
    ...required,
    message: "{_field_} can not be empty",
  })

  extend("max", {
    ...max,
    message: "{_field_} may not be greater than {length} characters",
  })

  extend("regex", {
    ...regex,
    message: "{_field_} {_value_} does not match {regex}",
  })

  extend("email", {
    ...email,
    message: "Email must be valid",
  })

  export default {
    components: {
      ValidationProvider,
      ValidationObserver,
    },
    data: () => ({
      show: false,
      username: "",
      phoneNumber: "",
      email: "",
      password: "",
      confirmPassword: "",
      rules: {
        required: (value) => !!value || "Required.",
        min: (v) => (v && v.length >= 8) || "Min 8 characters",
      },
    }),
    computed: {
      imgUrl () {
        // eslint-disable-next-line vue/no-side-effects-in-computed-properties
        this.sideImg = require("@/assets/asset-web-sp-6.png")
        return this.sideImg
      },
      randomString (id) {
        let result = ""
        const character =
          "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789"
        var charactersLength = character.length
        for (let i = 0; i < id; i++) {
          result += character.charAt(Math.floor(Math.random() * charactersLength))
        }
        return result
      },
      passwordMatch () {
        return () =>
          this.password === this.confirmPassword || "Password must match"
      },
    },
    mounted () {
    //   this.randomString(7)
    },
    methods: {
      register () {
        this.$store
          .dispatch("auth/register", {
            email: this.email,
            firstName: this.username + "_",
            lastName: "##USERSENSIKLO_",
            password: this.password,
            nickName: this.username,
            noHp: this.phoneNumber,
          })
          .then((res) => {
            if (res.data.meta.status === true) {
              this.$store.dispatch("user/me").then((res) => {
                if (res.data.data.isVerified === 0) {
                  this.$router.push("/waiting-email")
                } else {
                  this.$router.push("/")
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
      },
      signIn () {
        this.$router.push("/login")
      },
    //   randomString (id) {
    //     for (let i = 0; i < id; i++) {
    //       this.result = this.character.charAt(
    //         Math.floor(Math.random() * this.character.length),
    //       )
    //     }
    //     return this.result
    //   },
    },
  }
</script>

<style lang="sass">
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
.text-custome
  font-size: 23px !important
  color: #2E4DA7 !important
.text-custome-2
  color: #2E4DA7 !important
.card--margin
  margin-top: 10% !important
.cols__form
  margin-top: -2%
  margin-left: 30%
</style>
