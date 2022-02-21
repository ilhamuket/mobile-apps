<template>
  <v-container>
    <v-row>
      <v-col class="d-flex align-center mt-5">
        <v-container>
          <v-row>
            <v-col>
              <div class="d-flex justify-center">
                <span class="font-spartan mb-2"> OTP </span>
              </div>
              <div>
                <div class="ma-auto mt-2 position-relative max--width">
                  <v-otp-input
                    v-model="otp"
                    :disabled="loading"
                    @finish="onFinish"
                  />
                  <v-overlay
                    absolute
                    :value="loading"
                  >
                    <v-progress-circular
                      indeterminate
                      color="primary"
                    />
                  </v-overlay>
                </div>
                <div>
                  i dont accept a OTP ?
                  <span class="font-weight-bold">Resend</span>
                </div>
                <div class="text--caption">
                  Check Your Email to accept OTP number
                </div>

                <v-snackbar
                  v-model="snackbar"
                  :color="snackbarColor"
                  :timeout="2000"
                >
                  {{ text }}
                </v-snackbar>
              </div>
            </v-col>
          </v-row>
        </v-container>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
  export default {
    props: {
      expectedOTP: {
        type: String,
        default: null,
      },
    },
    data: () => ({
      loading: false,
      snackbar: false,
      snackbarColor: "default",
      otp: "",
      text: "",
    // expectedOtp: "827878",
    }),
    methods: {
      onFinish (rsp) {
        this.loading = true
        setTimeout(() => {
          this.loading = false
          this.snackbarColor = rsp === this.expectedOTP ? "success" : "warning"
          this.text = `Processed OTP with "${rsp}" (${this.snackbarColor})`
          this.snackbar = true
          this.$emit("input", { code: rsp })
        }, 3500)
      },
    },
  }
</script>

<style></style>
<style scoped>
.position-relative {
  position: relative;
}
.max--width {
  max-width: 300px;
}
</style>
