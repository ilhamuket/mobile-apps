<template>
  <v-container>
    <v-row>
      <v-col
        v-resize="onResize"
        cols="12"
      >
        <v-card>
          <v-card-title>
            <span class="font-spartan mt-2 mb-2">
              <v-icon class="mr-1">mdi-account-group</v-icon>Hurip Studio
            </span>
            <v-icon
              color="blue"
              class="actions__edit"
              @click="editProfile(data)"
            >
              mdi-pencil
            </v-icon>
          </v-card-title>
          <v-divider />
          <v-card-text>
            <v-row>
              <v-col
                cols="12"
                md="3"
                sm="12"
              >
                <v-img
                  v-if="data.img"
                  width="300"
                  height="300"
                  class="rounded-lg"
                  :src="`${data.img.url}`"
                />
                <v-img
                  v-else
                  width="300"
                  height="300"
                  class="rounded-lg"
                  src="https://ecs7.tokopedia.net/img/cache/300/default_picture_user/default_toped-22.jpg"
                />

                <div class="d-flex flex-row">
                  <div
                    v-if="!data.img"
                    class="d-flex flex-column"
                  >
                    <v-btn
                      width="170"
                      class="mt-4 ml-12"
                      outlined
                      small
                      color="primary"
                      @click="onPickFileInput"
                    >
                      <v-icon> mdi-camera </v-icon>
                    </v-btn>
                    <input
                      ref="fileUpload"
                      type="file"
                      style="display: none"
                      accept="image/*"
                      @change="onFilePickedInput"
                    >
                  </div>
                  <div
                    v-else
                    class="d-flex flex-column"
                  >
                    <v-btn
                      width="170"
                      class="mt-4 ml-12"
                      icon
                      dark
                      color="primary"
                      @click="change"
                    >
                      <v-tooltip
                        bottom
                        color="primary"
                      >
                        <template #activator="{ on, attrs }">
                          <v-icon
                            v-bind="attrs"
                            large
                            v-on="on"
                          >
                            mdi-camera-flip
                          </v-icon>
                        </template>
                        <span>Change Picture</span>
                      </v-tooltip>
                    </v-btn>
                    <input
                      ref="change"
                      type="file"
                      style="display: none"
                      accept="image/*"
                      @change="changePicture"
                    >
                  </div>
                  <div class="d-flex flex-column">
                    <v-tooltip
                      bottom
                      color="primary"
                    >
                      <template #activator="{ on, attrs }">
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

                <div class="d-flex flex-row mt-2">
                  <div class="d-flex flex-column">
                    <v-btn
                      width="170"
                      class="ml-12"
                      outlined
                      small
                      color="primary"
                    >
                      <v-icon class="mr-1">
                        mdi-lock-outline
                      </v-icon>
                      Ubah Kata Sandi
                    </v-btn>
                  </div>
                </div>
              </v-col>
              <v-col
                cols="12"
                md="9"
              >
                <div class="">
                  <span class="font-spartan font-weight-bold">
                    #Studio Profile
                  </span>
                </div>
                <v-divider class="mt-2 mb-2" />
                <div class="d-flex flex-row mt-2">
                  <div class="d-flex flex-column font-spartan-small">
                    Name Studio : {{ data.name }}
                  </div>
                </div>
                <div class="d-flex flex-row mt-2">
                  <div class="d-flex flex-column font-spartan-small">
                    Keyword : {{ data.prefix }}
                  </div>
                </div>
                <div class="d-flex flex-row mt-2">
                  <div class="d-flex flex-column font-spartan-small">
                    Email : {{ data.email }}
                  </div>
                </div>
                <div class="d-flex flex-row mt-2">
                  <div class="d-flex flex-column font-spartan-small">
                    Contact : {{ data.contact }}
                  </div>
                </div>
                <div class="d-flex flex-row mt-2">
                  <div class="d-flex flex-column font-spartan-small">
                    Address : {{ data.address ? data.address : " - " }}
                  </div>
                </div>
                <div class="d-flex flex-row mt-2">
                  <div class="d-flex flex-column font-spartan-small">
                    #About
                  </div>
                </div>
                <div class="d-flex flex-row mt-2">
                  <div class="d-flex flex-column font-spartan-small">
                    {{ data.about }}
                  </div>
                </div>
                <v-divider class="mt-2 mb-2" />
                <!-- Account Profile -->
                <div class="d-flex flex-row mt-6">
                  <div class="d-flex flex-column font-spartan font-weight-bold">
                    #Account Profile
                  </div>
                  <div class="d-flex flex-column actions__edit">
                    <v-tooltip
                      color="primary"
                      bottom
                    >
                      <template #activator="{ on, attrs }">
                        <v-icon
                          color="blue"
                          v-bind="attrs"
                          class=""
                          v-on="on"
                          @click="editProfileAccountName(user)"
                        >
                          mdi-account-edit-outline
                        </v-icon>
                      </template>
                      <span class="font-spartan-small blue--text">
                        Edit Account
                      </span>
                    </v-tooltip>
                  </div>
                </div>
                <v-divider class="mt-2 mb-2" />
                <div class="d-flex flex-row">
                  <div class="d-flex flex-column">
                    <span class="font-spartan-small">
                      FirstName : {{ user.firstName }}
                    </span>
                  </div>
                </div>
                <div class="d-flex flex-row mt-2">
                  <div class="d-flex flex-column">
                    <span class="font-spartan-small">
                      LastName : {{ user.lastName }}
                    </span>
                  </div>
                </div>
                <div class="d-flex flex-row mt-2">
                  <div class="d-flex flex-column">
                    <span class="font-spartan-small">
                      Username : {{ user.nickName }}
                    </span>
                  </div>
                </div>
                <div class="d-flex flex-row mt-2">
                  <div class="d-flex flex-column">
                    <span class="font-spartan-small">
                      Email : {{ user.email }}
                    </span>
                  </div>
                </div>
                <div class="d-flex flex-row mt-2">
                  <div class="d-flex flex-column">
                    <span class="font-spartan-small">
                      Contact : {{ user.noHp }}
                    </span>
                  </div>
                </div>
                <div class="d-flex flex-row mt-2">
                  <div class="d-flex flex-column">
                    <span class="font-spartan-small">
                      Regional : <v-icon color="blue">mdi-map-marker</v-icon>
                      {{ user.homeAddress }}
                    </span>
                  </div>
                </div>
                <div class="d-flex flex-row mt-2">
                  <div class="d-flex flex-column">
                    <span class="font-spartan-small">
                      Status :
                      <v-chip
                        color="btn_primary"
                        outlined
                        class="ml-2"
                      >
                        <v-icon
                          color="orange"
                          label
                          class="mr-1"
                        >mdi-crown-outline</v-icon>
                        Mahkota</v-chip>
                    </span>
                  </div>
                </div>

                <!-- end Account Profile -->
              </v-col>
            </v-row>
          </v-card-text>
          <v-card-text>
            <div class="d-flex justify-center icon--studio">
              <v-tooltip
                bottom
                color="btn_primary"
              >
                <template #activator="{ on, attrs }">
                  <a
                    v-bind="attrs"
                    :href="data.url_ig"
                    target="__blank"
                    v-on="on"
                  >
                    <v-icon color="red"> mdi-instagram </v-icon>
                  </a>
                </template>
                <span class="font-spartan-small">
                  {{ data.username_ig }}
                </span>
              </v-tooltip>

              <v-tooltip
                bottom
                color="btn_primary"
              >
                <template #activator="{ on, attrs }">
                  <a
                    target="__blank"
                    :href="data.url_fb"
                  >
                    <v-icon
                      class="ml-2"
                      v-bind="attrs"
                      color="blue"
                      v-on="on"
                    >
                      mdi-facebook
                    </v-icon>
                  </a>
                </template>
                <span class="font-spartan-small">
                  {{ data.username_fb }}
                </span>
              </v-tooltip>

              <v-tooltip
                bottom
                color="btn_primary"
              >
                <template #activator="{ on, attrs }">
                  <a
                    target="__blank"
                    :href="data.url_tw"
                  >
                    <v-icon
                      class="ml-2"
                      v-bind="attrs"
                      color="blue"
                      v-on="on"
                    >
                      mdi-twitter
                    </v-icon>
                  </a>
                </template>
                <span class="font-spartan-small">
                  {{ data.username_tw }}
                </span>
              </v-tooltip>
            </div>
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
  export default {
    props: {
      data: {
        type: Object,
        default: null,
      },
      user: {
        type: Object,
        default: null,
      },
    },
    data: () => ({
      files: null,
      imageUrl: null,
      isMobile: false,
    }),
    methods: {
      onResize () {
        if (window.innerWidth < 769) this.isMobile = true
        else this.isMobile = false
      },
      onPickFileInput () {
        this.$refs.fileUpload.click()
      },
      onFilePickedInput (event) {
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
          this.$emit("input", {
            item: {
              files: this.files,
              id: this.data.id,
            },
          })
        }
      },
      change () {
        this.$refs.change.click()
      },
      editProfile (item) {
        this.$emit("edit", { item: item })
      },
      changePicture (event) {
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
          this.$emit("change", {
            item: {
              files: this.files,
              id: this.data.id,
            },
          })
        }
      },
      editProfileAccountName (item) {
        this.$emit("edit-profile", { item: item })
      },
    },
  }
</script>

<style lang="sass">
.actions
  &__edit
    margin: 0 0 0 89%
.padding--text
    padding-left: 2px
.margin__icon__dashboard
  margin-left: 200px
a
  text-decoration: none
.icon--studio
  .v-icon.v-icon
    font-size: 50px
    transform: .9s
    &:hover
      transform: scale(1.2)
@media screen and (max-width: 500px)
  .actions
    &__edit
      margin: 0 0 0 41%
</style>
