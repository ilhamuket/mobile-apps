<template>
  <v-container
    fluid
    class="auth-bg-1"
  >
    <v-row>
      <v-col
        cols="12"
        lg="8"
        class="d-lg-flex align-items-center p-5 "
      >
        <div
          class="w-100 d-lg-flex align-items-center justify-content-center px-5"
        >
          <v-img
            :src="imgUrl"
            width="800"
            alt="Login V2"
          />
        </div>
      </v-col>
      <v-col
        cols="4"
        lg="4"
        class="d-flex align-items-center auth-bg px-2"
      >
        <v-col
          sm="8"
          md="6"
          lg="12"
        >
          <v-card-title
            class="mb-1 font-weight-bold"
            title-tag="h2"
          >
            Welcome to Vuexy! 👋
          </v-card-title>

          <v-card-text class="mb-2">
            Please sign-in to your account and start the adventure
          </v-card-text>

          <v-alert
            dense
            text
            type="success"
            show
          >
            <div class="alert-body font-small-2">
              <p>
                <small
                  class="mr-50"
                ><span class="font-weight-bold">Admin:</span> admin@demo.com |
                  admin</small>
              </p>
              <p>
                <small
                  class="mr-50"
                ><span class="font-weight-bold">Client:</span> client@demo.com
                  | client</small>
              </p>
            </div>
          </v-alert>

          <v-card-text>
            <v-form>
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
                label="Email Or Username"
                placeholder="E-mail Or Username"
                outlined
                dense
                prepend-icon="mdi-lock"
                :append-icon="!show ? 'mdi-eye' : 'mdi-eye-off'"
                :type="show ? 'text' : 'password'"
                @click:append="show = !show"
              />

              <div class="d-flex flex-row justify-center ml-12">
                <div class="d-flex flex-coloumn justify-center">
                  <v-btn
                    color="pallet1"
                    rounded
                    @click="login"
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
            </v-form>
          </v-card-text>
        </v-col>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
  import { required, digits, email, max, regex } from 'vee-validate/dist/rules'
  import { extend, setInteractionMode } from 'vee-validate'

  setInteractionMode('eager')

  extend('digits', {
    ...digits,
    message: '{_field_} needs to be {length} digits. ({_value_})',
  })

  extend('required', {
    ...required,
    message: '{_field_} can not be empty',
  })

  extend('max', {
    ...max,
    message: '{_field_} may not be greater than {length} characters',
  })

  extend('regex', {
    ...regex,
    message: '{_field_} {_value_} does not match {regex}',
  })

  extend('email', {
    ...email,
    message: 'Email must be valid',
  })

  export default {
    data: () => ({
      show: false,
      email: '',
      password: '',
      name: '',
      phoneNumber: '',

      select: null,
      items: ['Item 1', 'Item 2', 'Item 3', 'Item 4'],
      checkbox: null,
    }),
    computed: {
      imgUrl () {
        // eslint-disable-next-line vue/no-side-effects-in-computed-properties
        this.sideImg = require('@/assets/login-v2-dark.svg')
        return this.sideImg
      },
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
              this.$router.push('/')
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
      },
      submit () {
        this.$refs.observer.validate()
      },
      clear () {
        this.name = ''
        this.phoneNumber = ''
        this.email = ''
        this.select = null
        this.checkbox = null
        this.$refs.observer.reset()
      },
    },
  }
</script>

<style lang="sass" scoped>
.bg-opocity
   background: linear-gradient(to right, rgba(226,226,226,1) 0%, rgba(254,254,254,1) 100%)
   border-color: white !important
.auth-bg
  background-color: grey !important
.auth-bg-1
  background-color: #F8F8F8 !important
// .bg-btn
//   background-color: red !important
</style>
