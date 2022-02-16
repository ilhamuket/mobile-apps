<template>
  <v-app class="bg--login">
    <v-container>
      <v-row>
        <v-col>
          <v-container>
            <v-row class="d-flex justify-md-center">
              <v-col
                cols="12"
                md="4"
              >
                <v-card :color="$vuetify.theme.dark ? 'FFFFFF' : ''">
                  <!-- <v-card-title class="d-flex justify-center">
                    <h3 class="d-flex justify-center mr-4">
                      Login
                    </h3>
                  </v-card-title> -->
                  <div
                    style="width: 220px"
                    class="mx-auto pt-6"
                  >
                    <v-img
                      src="@/assets/img/ensiklotariLogo.svg"
                      class=""
                    />
                  </div>
                  <v-card-text class="pb-6">
                    <v-form @submit.enter="login">
                      <v-row>
                        <v-container>
                          <v-col>
                            <v-text-field
                              v-model="email"
                              outlined
                              dense
                              label="Input Your Emaill"
                              placeholder="E-mail"
                            />
                            <v-text-field
                              v-model="password"
                              outlined
                              dense
                              label="Input Your Password"
                              placeholder="Password"
                              append-icon="mdi-eye"
                              :type="show ? 'text' : 'password'"
                              @click:append="show = !show"
                            />
                            <v-btn
                              type="submit"
                              color="btn_primary"
                              width="100%"
                              class=""
                              @click.prevent="login"
                            >
                              Login
                            </v-btn>
                          </v-col>
                        </v-container>
                      </v-row>
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
// import navigations from '../landingpage/components/Navigation.vue'
  export default {
    components: {
    // 'app-navigations': navigations,
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
      this.$vuetify.theme.dark = false
    },
    methods: {
      login () {
        this.$store
          .dispatch('auth/login', {
            email: this.email,
            password: this.password,
          })
          .then((response) => {
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
                didOpen: (toast) => {
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
.bg--login
  background-color: #843839 !important
</style>
