<template>
  <v-container>
    <v-row>
      <v-col cols="12">
        <v-card>
          <v-container>
            <v-row>
              <v-col
                cols="12"
                class="d-flex justify-center"
              >
                <span class="font-spartan">Send Proof Of Transfer</span>
              </v-col>
              <v-col
                cols="12"
                class="d-flex justify-center"
              >
                <span
                  v-if="detail.video"
                  class="font-spartan"
                >Name : {{ detail.video.name }} <br>
                  levels : {{ detail.video.levels }}</span>
              </v-col>
              <v-divider />
              <v-col
                class="d-flex justify-center"
                cols="12"
              >
                <v-card>
                  <v-img
                    v-if="detail.image_url"
                    width="240"
                    height="200"
                    gradient="to top right, rgba(0,0,0,.33), rgba(0,0,0,.7)"
                    style="cursor: pointer"
                    :src="detail.image_url"
                    class="img__hover"
                    @click="onClick"
                  >
                    <template v-slot:placeholder>
                      <v-row
                        class="fill-height ma-0"
                        align="center"
                        justify="center"
                      >
                        <v-progress-circular
                          indeterminate
                          color="grey lighten-5"
                        />
                      </v-row>
                    </template>
                    <v-container>
                      <v-row>
                        <v-col cols="12">
                          <v-icon
                            large
                            class="mt-5 ml-10 show-btn"
                            color="transparent"
                          >
                            mdi-camera-flip
                          </v-icon>
                        </v-col>
                      </v-row>
                    </v-container>
                  </v-img>
                  <v-img
                    v-else
                    width="240"
                    height="200"
                    gradient="to top right, rgba(0,0,0,.33), rgba(0,0,0,.7)"
                    style="cursor: pointer"
                    src="https://assets.tokopedia.net/assets-tokopedia-lite/v2/zeus/kratos/62cb37c4.png"
                    class="img__hover"
                    @click="onClick"
                  >
                    <template v-slot:placeholder>
                      <v-row
                        class="fill-height ma-0"
                        align="center"
                        justify="center"
                      >
                        <v-progress-circular
                          indeterminate
                          color="grey lighten-5"
                        />
                      </v-row>
                    </template>
                    <v-container>
                      <v-row>
                        <v-col cols="12">
                          <v-icon
                            large
                            class="mt-5 ml-10 show-btn"
                            color="transparent"
                          >
                            mdi-camera-flip
                          </v-icon>
                        </v-col>
                      </v-row>
                    </v-container>
                  </v-img>
                  <input
                    ref="fileUpload"
                    type="file"
                    style="display: none"
                    accept="image/*"
                    @change="onFileChange"
                  >
                </v-card>
              </v-col>
              <v-col
                cols="12"
                class="d-flex justify-center"
              >
                <v-btn
                  v-if="!detail.image_url"
                  color="btn_primary"
                  small
                  @click="onClick"
                >
                  Send A Picture
                </v-btn>
                <v-chip
                  v-else
                  color="btn_primary"
                >
                  Waiting Verification
                </v-chip>
              </v-col>
              <v-col class="d-flex justify-center">
                <v-btn
                  color="btn_primary"
                  outlined
                >
                  <v-icon large>
                    mdi-whatsapp
                  </v-icon>
                  <span class="mt-1 ml-2">Contact EnsikloTari</span>
                </v-btn>
              </v-col>
              <v-col
                cols="12"
                class="d-flex justify-center"
              >
                <span
                  v-if="detail.bank"
                  class="font-spartan font-weight-bold"
                >
                  from : {{ detail.user ? detail.user.nickName : "" }} <br>
                  To : {{ detail.bank.bank_name }} - {{ detail.bank.name }}
                  <br>
                  Account Number : {{ detail.bank.account_bank_number }}
                </span>
              </v-col>
            </v-row>
          </v-container>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
  export default {
    props: {},
    data: () => ({
      imageUrl: null,
      files: null,
    }),
    computed: {
      detail () {
        return this.$store.state.cart.detail_cart_video
      },
    },
    mounted () {
      this.getDataDetailCartEnsikloVideo()
    },
    methods: {
      onFileChange (event) {
        const files = event.target.files
        const filename = files[0].name
        console.log(filename)
        const fileReader = new FileReader()
        fileReader.addEventListener("load", () => {
          this.imageUrl = fileReader.result
          console.log(this.imageUrl)
        })
        fileReader.readAsDataURL(files[0])
        this.files = files[0]
        if (this.files.size > 2000000) {
          console.log("too big")
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
            icon: "error",
            title: "file too big",
          })
        } else {
          this.$store
            .dispatch("payment/sendProofPaymentVideo", {
              files: this.files,
              id: this.$route.params.id,
            })
            .then((res) => {
              if (res.data.meta.status) {
                this.getDataDetailCartEnsikloVideo()
                this.$router.push("/cart")
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
                  title: "Upload Img Successfully",
                })
              } else {
                console.log(res.data.meta.message)
              }
            })
        }
      },
      getDataDetailCartEnsikloVideo () {
        this.$store
          .dispatch("cart/getDataDetailCartEnsikloVideo", {
            id: this.$route.params.id,
            entities: "bank,user,video",
          })
          .then((res) => {
            console.log(res)
          })
      },
      onClick () {
        this.$refs.fileUpload.click()
      },
    },
  }
</script>

<style></style>
