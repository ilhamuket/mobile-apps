<template>
  <v-container>
    <v-dialog
      v-model="dialog.open"
      width="70%"
    >
      <v-card>
        <v-system-bar
          :color="$vuetify.theme.dark ? '#141C31' : '#F0F8FF'"
          window
        >
          <v-toolbar-title
            :class="$vuetify.theme.dark ? 'white--text' : ' black--text'"
            class="font-size-ather-roboto-mono"
          >
            <v-icon :color="$vuetify.theme.dark ? 'white' : 'black'">
              mdi-camera-flip-outline
            </v-icon>
            Add Some Picture
          </v-toolbar-title>

          <v-spacer />

          <v-icon @click="dialog.open = false">
            mdi-close
          </v-icon>
        </v-system-bar>

        <v-container>
          <div v-if="dialog.data.list_img">
            <v-row v-if="dialog.data.list_img.length !== 0">
              <v-col
                v-for="(item, i) in dialog.data.list_img"
                :key="i"
                cols="12"
                sm="12"
                md="4"
              >
                <v-hover v-slot="{ hover }">
                  <v-card
                    :elevation="hover ? 12 : 2"
                    :class="{ 'on-hover': hover }"
                  >
                    <v-img
                      height="200"
                      :src="item.url"
                      gradient="to top right, rgba(0,0,0,.33), rgba(0,0,0,.7)"
                      @click="changePictInput(i, item)"
                    >
                      <v-container>
                        <v-row
                          class="fill-height flex-column"
                          justify="space-between"
                        >
                          <v-col
                            cols="12"
                            class="col__camera"
                          >
                            <div class="align-self-center">
                              <v-btn
                                :class="{ 'show-btns': hover }"
                                :color="transparent"
                                icon
                                dark
                              >
                                <v-icon
                                  :class="{ 'show-btns': hover }"
                                  :color="transparent"
                                  large
                                >
                                  mdi-camera-flip-outline
                                </v-icon>
                              </v-btn>
                            </div>
                          </v-col>
                        </v-row>
                      </v-container>
                    </v-img>
                    <input
                      ref="change"
                      type="file"
                      style="display: none"
                      accept="image/*"
                      @change="changePict"
                    >
                  </v-card>
                </v-hover>
              </v-col>
            </v-row>
          </div>
          <v-row v-else>
            <v-col
              cols="12"
              class="d-flex justify-center"
            >
              <!-- <span class="font-spartan">
                No Image
              </span> -->
              <v-card>
                <v-img
                  src="https://assets.tokopedia.net/assets-tokopedia-lite/v2/zeus/kratos/62cb37c4.png"
                  gradient="to top right, rgba(0, 0, 0, 0.05), rgba(20, 20, 20, 0.05)"
                  style="background-color:rgba(0, 0, 0, 0.05);"
                  @click="onPickFileInput"
                />
              </v-card>
            </v-col>
          </v-row>
          <v-row>
            <v-col
              cols="12"
              md="12"
              class="row__list d-flex justify-center"
            >
              <!-- <span
                v-if="dialog.data.list_img.length === 3"
                class="font-spartan"
              >

              </span> -->

              <v-btn
                dark
                icon
                @click="onPickFileInput"
              >
                <v-tooltip
                  bottom
                  color="primary"
                >
                  <template #activator="{on, attrs}">
                    <v-icon
                      v-bind="attrs"
                      large
                      color="primary"
                      v-on="on"
                    >
                      mdi-camera
                    </v-icon>
                  </template>
                  <span class="font-spartan-small">
                    Upload Pict
                  </span>
                </v-tooltip>
              </v-btn>
              <input
                ref="fileUpload"
                type="file"
                style="display: none"
                accept="image/*"
                @change="onFilePickedInput"
              >
              <!-- </label> -->
            </v-col>
          </v-row>
        </v-container>
      </v-card>
    </v-dialog>
  </v-container>
</template>

<script>
  export default {
    props: {
      dialog: {
        type: Object,
        default: null,
      },
    },
    data: () => ({
      isTrue: true,
      files: null,
      icons: ["mdi-rewind", "mdi-play", "mdi-fast-forward"],
      transparent: "rgba(255, 255, 255, 0)",
      pict_id: 0,
    }),
    methods: {
      onPickFileInput () {
        this.$refs.fileUpload.click()
      },
      changePictInput (i, item) {
        this.$refs.change[i].click()
        this.pict_id = item.id
      },
      onFilePickedInput (event) {
        const files = event.target.files
        const filename = files[0].name
        console.log(filename)
        const fileReader = new FileReader()
        fileReader.addEventListener("load", () => {
          this.imageUrl = fileReader.result
        //   console.log(this.imageUrl)
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
              id: this.dialog.data.id,
            },
          })
        }
      },
      changePict (event) {
        const files = event.target.files
        const filename = files[0].name
        console.log(filename)
        const fileReader = new FileReader()
        fileReader.addEventListener("load", () => {
          this.imageUrl = fileReader.result
        //   console.log(this.imageUrl)
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
              id: this.pict_id,
            },
          })
        }
      },
    },
  }
</script>

<style lang="sass" scoped>
.row__list
  // border: 2px double grey !important
.custom-file-upload
  width: 200px
  border: 2px double #ccc !important
  display: inline-block
  padding: 6px 12px
  cursor: pointer
.col__camera
  margin-top: 69px
  margin-left: 110px
</style>
<style scoped>
.v-card {
  transition: opacity 0.7s ease-in-out;
}

.v-card:not(.on-hover) {
  opacity: 1;
}
.v-card:hover {
  opacity: 0.9;
  cursor: pointer;
}

.show-btns {
  color: rgba(255, 255, 255, 1) !important;
}
</style>
