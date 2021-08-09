<template>
  <v-app>
    <v-img
      src="https://aws1.discourse-cdn.com/elastic/original/3X/9/0/90df22ab443662d632838fd82f6ea38b2cba025a.png"
      max-height="620"
      class="my-auto"
    >
      <app-navigations
        color="#DD5B87"
        class="mb-12"
        :page-login="true"
      />

      <v-container>
        <v-row>
          <v-col>
            <v-container>
              <v-row class="d-flex justify-center">
                <v-col cols="4">
                  <v-card>
                    <v-card-title class="d-flex justify-center">
                      <h3 class="d-flex justify-center mr-4">
                        Login
                      </h3>
                    </v-card-title>
                    <v-card-text class="mt-12">
                      <v-form @submit.enter="login">
                        <v-text-field
                          v-model="email"
                          outlined
                          dense
                          label="Input Your Emaill"
                          placeholder="E-mail"
                          prepend-icon="mdi-email"
                        />
                        <v-text-field
                          v-model="password"
                          outlined
                          dense
                          label="Input Your Password"
                          placeholder="Password"
                          prepend-icon="mdi-lock"
                          append-icon="mdi-eye"
                          :type="show ? 'text' : 'password'"
                          @click:append="show = !show"
                        />
                        <div class="d-flex flex-row justify-center mr-2">
                          <div class="d-flex flex-column">
                            <v-chip
                              class="transparent"
                              text-color="primary"
                              style="cursor:pointer"
                            >
                              {{ $t('categories.login.forget') }}
                            </v-chip>
                          </div>
                        </div>
                        <div class="d-flex flex-row justify-center mt-2">
                          <div class="d-flex flex-column">
                            <v-btn
                              type="submit"
                              color="#DD5B87"
                              @click.prevent="login"
                            >
                              Login
                            </v-btn>
                          </div>
                        </div>

                        <div class="d-flex flex-row justify-center mt-6">
                          <div class="d-flex flex-column">
                            <h5 class="text--blue">
                              {{ $t('categories.login.haveAcc') }}
                            </h5>
                          </div>
                        </div>
                        <div class="d-flex flex-row justify-center mt-2">
                          <div class="d-flex flex-column">
                            <v-btn
                              outlined
                              rounded
                              color="info"
                              width="200"
                              to="sign-up"
                            >
                              Sign-Up
                            </v-btn>
                          </div>
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
    </v-img>
  </v-app>
</template>

<script>
  import navigations from '../landingpage/components/Navigation.vue'
  export default {
    components: {
      'app-navigations': navigations,
    },
    data: () => ({
      email: '',
      password: '',
      isWrong: false,
      show: false,
    }),
    computed: {
      passwordMatch () {
        return () => this.password === this.verify || 'Password must match'
      },
    },
    mounted () {
      this.$vuetify.theme.light = true
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
                position: 'bottom-end',
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
    },
  }
</script>
<style lang="sass" scoped>
@import url('https://fonts.googleapis.com/css2?family=Zen+Loop&display=swap')
@mixin font($size, $color , $family)
  font-size: $size
  color: $color
  font-family: $family
.font-size-2
  font-size: 14px
.bg-dark
  background-color: #1D1C1C !important
.bg-material
  background-color: #BBCED6
  // box-shadow: -10px -11px 10px 3px grey !important
.custumize-round
  border-top-left-radius: 20px !important
  border-top-right-radius: 20px
  border-bottom-left-radius: 20px !important
  border-bottom-right-radius: 20px !important
  padding: 20px
.font
  @include font(330% , #1B35DD, 'Zen Loop')
.width-row
  width: 100px
.text--blue
  color: blue !important
</style>
