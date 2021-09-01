<template>
  <v-card>
    <v-card-text>
      <v-list-item
        class="opacity-1"
        three-line
      >
        <v-list-item-content>
          <!-- <div
                  class="text-overline mb-4 text-center font-title-rampart-one text-custome"
                >
                  Verification Email
                </div> -->
          <div
            class="text-overline mb-4 text-center font-size-ather-roboto-mono text-custome-brand"
          >
            ENSIKLOTARI
          </div>
          <div class="d-flex flex-row justify-center">
            <div
              v-if="data.data.item2"
              class="d-flex flex-column"
            >
              <v-list-item-title
                class="text-h5 mb-1 text-center font-size-ather-roboto-mono"
              >
                Username : {{ data.data.item2.userName }}
              </v-list-item-title>
              <v-list-item-subtitle>
                Email : {{ data.data.item2.email }}
              </v-list-item-subtitle>
            </div>
          </div>
          <div class="d-flex flex-row justify-center">
            <div class="d-flex flex-column">
              <v-list-item-title
                class="text-h5 mb-1 text-center font-size-ather-roboto-mono"
              >
                Nama Studio : {{ data.data.fullnameStudio }}
              </v-list-item-title>
            </div>
          </div>
          <div class="d-flex flex-row justify-center">
            <div class="d-flex flex-column">
              <v-list-item-title
                class="text-h5 mb-1 text-center font-size-ather-roboto-mono"
              >
                prefix Studio : {{ data.data.prefix }}
              </v-list-item-title>
            </div>
          </div>
          <div class="d-flex flex-row justify-center mt-2">
            <div class="d-flex flex-column">
              <p class="text-center font-size-ather-roboto-mono">
                Hai, Silahkan Periksa Email Anda Untuk Mengverifikasi Akun Anda
                Terimakasih
              </p>
            </div>
          </div>

          <div class="d-flex flex-row justify-center mt-2">
            <div class="d-flex flex-column">
              <p class="text-center font-size-ather-roboto-mono">
                Terima Kasih
              </p>
            </div>
          </div>

          <div class="d-flex flex-row justify-center">
            <div class="d-flex flex-column">
              <p class="text-center font-size-ather-roboto-mono">
                ENSIKLOTARI
              </p>
            </div>
          </div>
          <div class="d-flex flex-row justify-center">
            <div class="d-flex flex-column">
              <p class="text-center font-size-ather-roboto-mono">
                {{ now | moment('MMMM Do YYYY') }}
              </p>
            </div>
          </div>
        </v-list-item-content>
      </v-list-item>

      <v-card-actions class="d-flex justify-center">
        <v-btn
          text
          @click="getRegister"
        >
          SendVerifikasi
        </v-btn>
      </v-card-actions>
    </v-card-text>
  </v-card>
</template>

<script>
  export default {
    props: {
      data: {
        type: Object,
        default: null,
      },
    },
    computed: {
      now () {
        let date = null
        date = new Date()
        return date
      },
      yet () {
        let bool = 'false'
        if (localStorage.getItem('yet') === 'true') {
          bool = 'true'
        }
        return bool
      },
      syet () {
        let bool = ''
        if (localStorage.getItem('yet') === 'false') {
          bool = 'false'
        }
        return bool
      },
    },
    mounted () {},
    methods: {
      getRegister () {
        this.$emit('register')
      },
      resendVerifications () {
        this.$emit('resend')
      },
    },
  }
</script>

<style></style>
