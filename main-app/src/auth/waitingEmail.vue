<template>
  <v-app>
    <v-container>
      <v-row class="mt-12">
        <v-col cols="12">
          <v-card
            class="mx-auto mt-12"
            width="344"
            outlined
          >
            <v-list-item three-line>
              <v-list-item-content>
                <div class="text-overline mb-4">
                  Verification Email
                </div>
                <v-list-item-title class="text-h5 mb-1">
                  {{ users.firstName + ' ' + users.lastName }}
                </v-list-item-title>
                <v-list-item-subtitle>
                  {{ users.email }}
                </v-list-item-subtitle>
              </v-list-item-content>

              <!-- <v-avatar
                color="brown"
                size="48"
              >
                <span class="white--text text-h5">{{
                  users.firstName.charAt(0)
                }}</span>
              </v-avatar> -->
            </v-list-item>

            <v-card-actions>
              <v-btn
                outlined
                rounded
                text
                :disabled="isDisable"
                @click="sendVerifications"
              >
                Send Verification {{ time }}
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
  </v-app>
</template>

<script>
  import axios from 'axios'
  export default {
    data: () => ({
      isDisable: false,
      time: 60,
      timer: null,
    }),
    computed: {
      users () {
        return this.$store.state.user.me
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
          'Bearer ' + localStorage.getItem('access_token')
        axios.defaults.baseURL = process.env.VUE_APP_API_URL

        this.isDisable = true

        axios.get('auth/verifications/resend').then(res => {
          if (res.data.meta.status) {
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
              icon: 'success',
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

<style></style>
