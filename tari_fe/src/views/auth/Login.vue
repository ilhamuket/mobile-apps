<template>
  <v-app>
    <div class="d-flex flex-row justify-center my-auto">
      <div class="d-flex flex-column">
        <base-material-card
          icon="mdi-login-variant"
          color="pallet1"
        >
          <template v-slot:heading>
            <div class="d-flex flex-row justify-center">
              <div class="d-flex flex-column">
                <v-chip color="transparent">
                  <h1 class="">
                    Sign In
                  </h1>
                </v-chip>
              </div>
            </div>
          </template>
          <div
            v-if="isWrong == true"
            class="d-flex flex-row justify-center"
          >
            <div class="d-flex flex-column">
              <v-alert
                v-model="isWrong"
                dismissible
                dark
                dense
                class="text-nowrap"
                outlined
                type="error"
                close
                close-text="Close Alert"
              >
                password atau email Anda salah
              </v-alert>
            </div>
          </div>
          <v-list class="mx-auto px-2">
            <v-list-item>
              <v-list-item-content>
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
                </v-form>
              </v-list-item-content>
            </v-list-item>
            <v-list-item>
              <v-list-item-content>
                <div class="d-flex flex-row justify-center ml-2">
                  <div class="d-flex flex-column align-center">
                    <v-chip
                      class="mr-4"
                      color="transparent"
                    >
                      <v-btn
                        text
                        color="primary"
                      >
                        Lupa Password
                      </v-btn>
                    </v-chip>
                    <v-btn
                      color="pallet1"
                      width="100%"
                      type="submit"
                      @click.prevent="login"
                    >
                      Login
                    </v-btn>
                  </div>
                </div>
              </v-list-item-content>
            </v-list-item>
          </v-list>

          <div class="d-flex flex-row justify-center mt-2">
            <div class="d-flex flex-column">
              <v-chip
                color="transparent"
                class="d-flex justify-center"
              >
                <h3 class="text--primary">
                  Tidak Punya Akun ?
                </h3>
              </v-chip>
              <v-btn
                class="mt-2"
                height="40"
                outlined
                rounded
                color="info"
                width="200"
              >
                SignUp
              </v-btn>
            </div>
          </div>
        </base-material-card>
      </div>
    </div>
  </v-app>
</template>

<script>
  export default {
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
</style>
