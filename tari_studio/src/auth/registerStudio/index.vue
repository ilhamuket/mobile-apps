<template>
  <v-app class="app-not--isMobile">
    <v-container>
      <v-row>
        <v-col>
          <v-container>
            <v-row>
              <v-col>
                <v-card>
                  <div
                    style="width: 220px"
                    class="mx-auto pt-6"
                  >
                    <v-img
                      src="@/assets/img/logo.svg"
                      class=""
                    />
                  </div>
                  <v-stepper
                    v-model="step"
                    vertical
                    color="btn_primary"
                  >
                    <v-stepper-step
                      step="1"
                      color="btn_primary"
                      :editable="step > 1 || step < 1 ? true : false"
                      :complete="step > 1"
                    >
                      Owner
                    </v-stepper-step>

                    <v-stepper-content step="1">
                      <app-stepp-owner @continue="fromOwnerToStudio" />
                    </v-stepper-content>

                    <v-stepper-step
                      step="2"
                      :editable="step > 2 || disable_state ? true : false"
                      :complete="step > 2"
                      color="btn_primary"
                    >
                      Studio
                    </v-stepper-step>

                    <v-stepper-content step="2">
                      <app-stepp-studio @continue="studioToFinish" />
                    </v-stepper-content>

                    <v-stepper-step
                      :editable="step > 3 || disable_state_three ? true : false"
                      :complete="step > 3"
                      step="3"
                      color="btn_primary"
                    >
                      Verifications
                      <small>Alert message</small>
                    </v-stepper-step>

                    <v-stepper-content step="3">
                      <app-stepp-otp
                        :expected-o-t-p="otp"
                        @input="excecuteOtp"
                      />
                    </v-stepper-content>
                  </v-stepper>
                </v-card>
              </v-col>
            </v-row>
          </v-container>
        </v-col>
      </v-row>
    </v-container>
    <dashboard-core-settings />
  </v-app>
</template>

<script>
  import owner from "./component/_owner.vue"
  import studio from "./component/_studio.vue"
  import otp from "./component/_otp.vue"
  export default {
    components: {
      "app-stepp-owner": owner,
      "app-stepp-studio": studio,
      "app-stepp-otp": otp,
      DashboardCoreSettings: () => import("./component/settings/settings.vue"),
    },
    data: () => ({
      step: 1,
      user: {},
      studio: {},
      disable_state: false,
      disable_state_three: false,
      otp: "",
    }),
    methods: {
      fromOwnerToStudio ({ item }) {
        this.step = 2
        this.user = item
      },
      studioToFinish ({ item }) {
        this.studio = item
        this.disable_state = true
        this.$store
          .dispatch("studioAuth/registerAsStudio", {
            firstName: this.user.firstname,
            lastName: this.user.lastname,
            password: this.user.password,
            noHp: this.user.contact,
            email: this.user.email,
            nickName: this.user.username,
            name_studio: this.studio.name,
            about: this.studio.about,
            url: this.studio.url,
          })
          .then((res) => {
            console.log(res)
            if (res.data.meta.status) {
              this.step = 3
              const Toast = this.$swal.mixin({
                toast: true,
                position: "bottom-end",
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
                icon: "success",
                title: "Send OTP",
              })
              console.log("diverifikasi")
              this.otp = res.data.data.otp
              console.log("OTP : ", this.otp)
            }
          })
      },
      excecuteOtp ({ code }) {
        this.$store
          .dispatch("studioAuth/excecuteOtp", {
            otp: code,
          })
          .then((res) => {
            if (res.data.meta.status) {
              this.$router.push("/")
              const Toast = this.$swal.mixin({
                toast: true,
                position: "bottom-end",
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
                icon: "success",
                title: "Created Account Succesfully",
              })
            }
          })
      },
    },
  }
</script>

<style></style>
