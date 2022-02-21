<template>
  <v-app :class="!isMobile ? 'app-isMobile' : 'app-not--isMobile'">
    <v-container>
      <v-row class="">
        <v-col
          cols="12"
          class=""
        >
          <v-container>
            <v-row class="d-flex justify-center mt-12">
              <v-col
                cols="12"
                md="4"
              >
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

                  <v-card-text class="mt-6">
                    <v-form @submit.prevent.enter="login">
                      <v-row>
                        <v-container>
                          <v-col>
                            <v-text-field
                              v-model="email"
                              label="Email Or Username"
                              placeholder="E-mail Or Username"
                              outlined
                              dense
                            />
                            <v-text-field
                              v-model="password"
                              label="Password"
                              placeholder="Password"
                              outlined
                              dense
                              :append-icon="!show ? 'mdi-eye' : 'mdi-eye-off'"
                              :type="show ? 'text' : 'password'"
                              @click:append="show = !show"
                            />
                            <v-btn
                              color="btn_primary"
                              type="submit"
                              width="100%"
                            >
                              Masuk
                            </v-btn>
                            <div class="d-flex justify-end mt-2">
                              <span class="font-spartan-small forgot-password">
                                Lupa Password
                              </span>
                            </div>
                          </v-col>
                        </v-container>
                      </v-row>

                      <!-- <v-row class="d-flex flex-row-reverse">
                        <v-col
                          v-resize="onResize"
                          cols="12"
                          sm="6"
                          md="6"
                        >
                          <v-btn
                            color="btn_primary"
                            type="submit"
                            :width="isMobile ? '298' : '100'"
                            :class="isMobile ? '' : 'custom--margin--btn'"
                            class="width--btn layout__FHD"
                          >
                            Masuk
                          </v-btn>
                        </v-col>
                        <v-col
                          cols="12"
                          sm="6"
                        >
                          <div class="d-flex flex-row justify-center">
                            <div class="d-flex flex-column">
                              <v-chip
                                color="transparent"
                                style="cursor: pointer"
                              >
                                <span class="font-spartan-small">
                                  Lupa Password ?
                                </span>
                              </v-chip>
                            </div>
                          </div>
                        </v-col>
                      </v-row> -->
                      <div
                        class="text-center create--studio"
                        style="padding: 10px"
                      >
                        <!-- <span class="color-black-2">New on our platform? </span> -->
                        <a
                          class="color-a p-5"
                          @click="signUp"
                        >
                          <span>&nbsp;Buat Studio</span>
                        </a>
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
    <dashboard-core-settings />
  </v-app>
</template>

<script>
  export default {
    components: {
      DashboardCoreSettings: () =>
      import("./registerStudio/component/settings/settings.vue"),
    },
    data: () => ({
      show: false,
      email: "",
      password: "",
      isMobile: false,
    }),
    computed: {
      imgUrl () {
        // eslint-disable-next-line vue/no-side-effects-in-computed-properties
        this.sideImg = require("@/assets/img/preview.jpg")
        return this.sideImg
      },
    },
    mounted () {
      this.$vuetify.theme.dark = false
    },
    methods: {
      onResize () {
        if (window.innerWidth < 769) this.isMobile = true
        else this.isMobile = false
      },
      login () {
        this.$store
          .dispatch("studioAuth/studioLogin", {
            email: this.email,
            password: this.password,
          })
          .then((res) => {
            if (res.meta.status) {
              this.$store.dispatch("user/me").then((response) => {
                if (response.data.data.isVerified === 0) {
                  this.$router.push("/waiting-email")
                } else {
                  const redirecturl = this.$route.query.redirect || "/"
                  this.$router.push(redirecturl)
                  // location.reload()
                  const Toast = this.$swal.mixin({
                    toast: true,
                    position: "top-end",
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
                    title: `Succes Login As ${response.data.data.nickName}`,
                  })
                }
              })
            } else {
              this.isWrong = true
              this.alert = true
              const Toast = this.$swal.mixin({
                toast: true,
                position: "top-end",
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
                icon: "error",
                title: res.meta.message,
              })
            }
          })
      },
      signUp () {
        this.$router.push("/register")
      },
    },
  }
</script>

<style lang="sass"></style>
<style>
@media screen and (max-width: 322px) {
  .width--btn {
    margin-left: 10px !important;
    width: 242px !important;
  }
}

@media screen and (min-width: 374px) and (max-width: 415px) {
  .width--btn {
    width: 300px !important;
    margin-left: 15px !important;
  }
}

@media screen and (width: 360px) and (height: 740px) {
  .width--btn {
    margin-left: 2px !important;
  }
}
</style>
