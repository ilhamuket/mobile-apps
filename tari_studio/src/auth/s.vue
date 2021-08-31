<template>
  <v-app>
    <v-container>
      <v-row class="d-flex flex-row justify-space-around">
        <v-col
          cols="12"
          md="6"
          class="d-flex flex-column mt-6"
        >
          <v-card
            color="transparent"
            class="mt-12 bg-opocity"
          >
            <v-card-text>
              <h1>
                Sign-In
              </h1>
            </v-card-text>
            <v-card-subtitle>
              <h4>
                Enter your email and password to sign in
              </h4>
            </v-card-subtitle>
            <v-card-text color="transparent">
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

                <div class="d-flex flex-row justify-center ml-2">
                  <div class="d-flex flex-coloumn">
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
            <div class="d-flex flex-row justify-center">
              <div class="d-flex flex-column">
                <h5 class="text--blue">
                  Don't Have Account ?
                </h5>
              </div>
            </div>
            <v-card-actions class="d-flex flex-row justify-center mb-5">
              <v-btn
                color="pallet1"
                rounded
                outlined
                width="40%"
              >
                Sign-Up
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-col>
        <v-col
          cols="12"
          md="6"
          class="d-flex flex-column"
        >
          <v-container>
            <v-row>
              <v-col>
                <v-img
                  src="@/assets/img-signin.jpg"
                  width="440"
                />
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
      email: '',
      password: '',
    }),
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
    },
  }
</script>

<style lang="sass" scoped>
.bg-opocity
   background: linear-gradient(to right, rgba(226,226,226,1) 0%, rgba(254,254,254,1) 100%)
   border-color: white !important
</style>
