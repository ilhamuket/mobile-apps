<template>
  <v-container>
    <v-row>
      <v-col cols="12">
        <v-card>
          <v-card-text>
            <v-row>
              <v-col
                cols="12"
                md="4"
              >
                <v-img
                  v-if="user.img"
                  width="600"
                  height="300"
                  class="rounded-lg"
                  :src="user.img.url"
                />
                <v-img
                  v-else
                  class="rounded-lg"
                  width="600"
                  height="300"
                  src="https://ecs7.tokopedia.net/img/cache/300/default_picture_user/default_toped-22.jpg"
                />
                <div class="d-flex flex-row">
                  <div
                    v-if="user.img"
                    class="d-flex flex-column"
                  >
                    <v-btn
                      width="170"
                      class="mt-4 ml-12"
                      outlined
                      dark
                      color="btn_primary"
                      @click="changePict"
                    >
                      {{ $t("profile.btn.change") }}
                    </v-btn>
                    <input
                      ref="change"
                      type="file"
                      style="display: none"
                      accept="image/*"
                      @change="change"
                    >
                  </div>
                  <div
                    v-else
                    class="d-flex flex-column"
                  >
                    <v-btn
                      width="170"
                      class="mt-4 ml-12"
                      outlined
                      dark
                      color="btn_primary"
                      @click="pict"
                    >
                      {{ $t("profile.btn.choose") }}
                    </v-btn>
                    <input
                      ref="pict"
                      type="file"
                      style="display: none"
                      accept="image/*"
                      @change="choosePicture"
                    >
                  </div>
                  <div class="d-flex flex-column">
                    <v-tooltip
                      bottom
                      color="primary"
                    >
                      <template #activator="{on,attrs}">
                        <v-btn
                          v-bind="attrs"
                          dark
                          icon
                          v-on="on"
                        >
                          <v-icon color="blue">
                            mdi-alert-decagram-outline
                          </v-icon>
                        </v-btn>
                      </template>
                      <span class="font-spartan-small">
                        Besar file: maksimum 10.000.000 bytes (10 Megabytes).
                        Ekstensi file yang diperbolehkan: .JPG .JPEG .PNG
                      </span>
                    </v-tooltip>
                  </div>
                </div>
                <div class="d-flex flex-row">
                  <div class="d-flex flex-column">
                    <v-btn
                      outlined
                      small
                      color="btn_primary"
                      width="250"
                      class="mt-4"
                    >
                      {{ $t("profile.cp") }}
                      <v-icon>
                        mdi-lock
                      </v-icon>
                    </v-btn>
                  </div>
                </div>
              </v-col>
              <v-col
                cols="12"
                md="8"
              >
                <span class="font-spartan-text font-weight-bold mb-2">
                  {{ $t("profile.personal") }}
                </span>

                <v-divider class="mt-2 mb-2" />
                <div class="d-flex flex-row mt-2">
                  <div class="d-flex flex-column">
                    <span class="font-spartan-text">
                      {{ $t("profile.first_name") }} : {{ user.firstName }}
                      <v-chip
                        v-if="user.firstName"
                        small
                        color="transparent"
                        text-color="btn_primary"
                        @click="editProfile(user)"
                      >{{ $t("change") }}</v-chip>
                      <v-chip
                        v-else
                        small
                        color="transparent"
                        text-color="btn_primary"
                        @click="editProfile(user)"
                      >Tambahkan Nama Depan</v-chip>
                    </span>
                  </div>
                </div>
                <div class="d-flex flex-row mt-3">
                  <div class="d-flex flex-column">
                    <span class="font-spartan-text">
                      {{ $t("profile.last_name") }} : {{ user.lastName }}
                      <v-chip
                        v-if="user.lastName"
                        small
                        color="transparent"
                        text-color="btn_primary"
                        @click="editProfile(user)"
                      >{{ $t("change") }}</v-chip>
                      <v-chip
                        v-else
                        small
                        color="transparent"
                        text-color="btn_primary"
                        @click="editProfile(user)"
                      >Tambahkan Nama Belakang</v-chip>
                    </span>
                  </div>
                </div>
                <div class="d-flex flex-row mt-3">
                  <div class="d-flex flex-column">
                    <span class="font-spartan-text">
                      {{ $t("profile.username") }} : {{ user.nickName }}
                      <v-chip
                        v-if="user.nickName"
                        small
                        color="transparent"
                        text-color="btn_primary"
                        @click="editProfile(user)"
                      >{{ $t("change") }}</v-chip>
                      <v-chip
                        v-else
                        small
                        color="transparent"
                        text-color="btn_primary"
                        @click="editProfile(user)"
                      >Tambahkan Username</v-chip>
                    </span>
                  </div>
                </div>
                <div class="d-flex flex-row mt-3">
                  <div class="d-flex flex-column">
                    <span class="font-spartan-text">
                      {{ $t("profile.date") }} :
                      {{ user.dateOfBirth | moment("MMMM Do YYYY") }}
                      <v-chip
                        v-if="user.dateOfBirth"
                        small
                        color="transparent"
                        text-color="btn_primary"
                        @click="editProfile(user)"
                      >{{ $t("change") }}</v-chip>
                      <v-chip
                        v-else
                        small
                        color="transparent"
                        text-color="btn_primary"
                        @click="editProfile(user)"
                      >{{ $t("profile.add.date") }}</v-chip>
                    </span>
                  </div>
                </div>

                <div class="d-flex flex-row mt-6">
                  <div class="d-flex flex-column">
                    <span class="font-spartan-text font-weight-bold">
                      {{ $t("profile.contact") }}
                    </span>
                  </div>
                </div>
                <v-divider class="mt-2 mb-2" />
                <div class="d-flex flex-row mt-3">
                  <div class="d-flex flex-column">
                    <span class="font-spartan-text">
                      {{ $t("profile.contact") }} :
                      {{ user.noHp }}
                      <v-chip
                        v-if="user.noHp"
                        small
                        color="transparent"
                        text-color="btn_primary"
                        @click="editProfileContact(user)"
                      >{{ $t("change") }}</v-chip>
                      <v-chip
                        v-else
                        small
                        color="transparent"
                        text-color="btn_primary"
                        @click="editProfileContact(user)"
                      >Tambahkan Contact</v-chip>
                    </span>
                  </div>
                </div>
                <div class="d-flex flex-row mt-3">
                  <div class="d-flex flex-column">
                    <span class="font-spartan-text">
                      Email :
                      {{ user.email }}
                      <v-chip
                        v-if="user.email"
                        small
                        color="transparent"
                        text-color="btn_primary"
                        @click="editProfileContact(user)"
                      >{{ $t("change") }}</v-chip>
                      <v-chip
                        v-else
                        small
                        color="transparent"
                        text-color="btn_primary"
                        @click="editProfileContact(user)"
                      >Tambahkan Contact</v-chip>
                    </span>
                  </div>
                </div>
                <div class="d-flex flex-row mt-6">
                  <div class="d-flex flex-column">
                    <span class="font-spartan-text font-weight-bold">
                      Media Social
                    </span>
                  </div>
                </div>
                <v-divider class="mt-2 mb-2" />
                <div class="d-flex flex-row mt-3">
                  <div class="d-flex flex-column">
                    <span class="font-spartan-text">
                      <v-icon color="red">mdi-instagram</v-icon>
                      {{ user.username_ig }}
                      <v-chip
                        v-if="user.username_ig"
                        small
                        color="transparent"
                        text-color="btn_primary"
                        @click="editProfile(user)"
                      >{{ $t("change") }}</v-chip>
                      <v-chip
                        v-else
                        small
                        color="transparent"
                        text-color="btn_primary"
                        @click="editProfileSocmed(user)"
                      >Tambahkan Username Instagram</v-chip>
                    </span>
                  </div>
                </div>
                <div class="d-flex flex-row mt-3">
                  <div class="d-flex flex-column">
                    <span class="font-spartan-text">
                      <v-icon color="blue">mdi-facebook</v-icon>
                      {{ user.username_fb }}
                      <v-chip
                        v-if="user.username_fb"
                        small
                        color="transparent"
                        text-color="btn_primary"
                        @click="editProfileSocmed(user)"
                      >{{ $t("change") }}</v-chip>
                      <v-chip
                        v-else
                        small
                        color="transparent"
                        text-color="btn_primary"
                        @click="editProfileSocmed(user)"
                      >Tambahkan Username Facabook</v-chip>
                    </span>
                  </div>
                </div>
                <div class="d-flex flex-row mt-3">
                  <div class="d-flex flex-column">
                    <span class="font-spartan-text">
                      <v-icon color="blue">mdi-twitter</v-icon>
                      {{ user.username_tw }}
                      <v-chip
                        v-if="user.username_tw"
                        small
                        color="transparent"
                        text-color="btn_primary"
                        @click="editProfileSocmed(user)"
                      >{{ $t("change") }}</v-chip>
                      <v-chip
                        v-else
                        small
                        color="transparent"
                        text-color="btn_primary"
                        @click="editProfileSocmed(user)"
                      >Tambahkan Username Twitter</v-chip>
                    </span>
                  </div>
                </div>
                <div class="d-flex flex-row margin--socmed">
                  <div class="d-flex flex-column">
                    <v-icon
                      large
                      color="red"
                    >
                      mdi-instagram
                    </v-icon>
                  </div>
                  <div class="d-flex flex-column">
                    <v-icon
                      color="blue"
                      large
                    >
                      mdi-facebook
                    </v-icon>
                  </div>
                  <div class="d-flex flex-column">
                    <v-icon
                      color="blue"
                      large
                    >
                      mdi-twitter
                    </v-icon>
                  </div>
                </div>
              </v-col>
            </v-row>
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
  export default {
    props: {
      user: {
        type: Object,
        default: null,
      },
    },
    data: () => ({
      files: null,
    }),
    methods: {
      changePict () {
        this.$refs.change.click()
      },
      pict () {
        this.$refs.pict.click()
      },
      choosePicture (event) {
        const files = event.target.files
        const filename = files[0].name
        console.log(filename)
        const fileReader = new FileReader()
        fileReader.addEventListener("load", () => {
          this.imageUrl = fileReader.result
        //   console.log(this.imageUrl)
        // console.log(this.imageUrl)
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
            didOpen: toast => {
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
          this.$emit("input", {
            item: {
              files: this.files,
            },
          })
        }
      },
      change (event) {
        const files = event.target.files
        const filename = files[0].name
        console.log(filename)
        const fileReader = new FileReader()
        fileReader.addEventListener("load", () => {
          this.imageUrl = fileReader.result
        //   console.log(this.imageUrl)
        // console.log(this.imageUrl)
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
            didOpen: toast => {
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
          this.$emit("change", {
            item: {
              files: this.files,
            },
          })
        }
      },
      editProfile (item) {
        this.$emit("edit", { item: item })
      },
      editProfileContact (item) {
        this.$emit("editContact", { item: item })
      },
      editProfileSocmed ({ item }) {
        this.$emit("updateSocmed", { item: item })
      },
    },
  }
</script>

<style lang="sass" scoped>
.margin--socmed
    margin-top: 96px
    margin-left: 176px
    .v-icon
        font-size: 40px !important
</style>
