<template>
  <v-app>
    <div class="d-flex flex-row justify-center">
      <div class="d-flex flex-column">
        <base-material-card
          title="Login"
          icon="mdi-login-variant"
        >
          <template v-slot:after-heading>
            <div class="d-flex flex-row justify-center">
              <div class="d-flex flex-column">
                <v-chip color="transparent">
                  <h1 class="">
                    Sign In To Joget-In
                  </h1>
                </v-chip>
              </div>
            </div>
          </template>

          <v-card
            width="400"
            height="400"
            class="mx-auto px-6 custumize-round"
          >
            <v-list>
              <v-list-item>
                <v-list-item-content>
                  <v-form>
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
                        color="primary"
                        width="100%"
                        type="submit"
                        @click="login"
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
          </v-card>
        </base-material-card>
      </div>
    </div>
  </v-app>
</template>

<script>
  export default {
    data: () => ({
      email: 'dikamahar884@malinator.com',
      password: 'password',
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
