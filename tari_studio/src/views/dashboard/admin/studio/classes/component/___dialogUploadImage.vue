<template>
  <v-container>
    <v-dialog
      v-model="dialog.open"
      width="70%"
    >
      <v-card>
        <v-card-title class="text-h2 primary--text font-spartan">
          Add Matery

          <v-spacer />

          <v-icon
            aria-label="Close"
            @click="dialog.open = false"
          >
            mdi-close
          </v-icon>
        </v-card-title>
        <v-container v-if="dialog.data.list_img">
          <v-row v-if="dialog.data.list_img.length !== 0">
            <v-col
              v-for="(item, i) in dialog.data.list_img"
              :key="i"
              cols="12"
              sm="12"
              md="4"
            >
              <v-img
                height="200"
                :src="item.url"
                gradient="to top right, rgba(100,115,201,.33), rgba(25,32,72,.7)"
              />
            </v-col>
          </v-row>
          <v-row v-else>
            <v-col
              cols="12"
              class="d-flex justify-center"
            >
              <span class="font-spartan">
                No Image
              </span>
            </v-col>
          </v-row>
          <v-row>
            <v-col
              cols="12"
              md="12"
              class="row__list d-flex justify-center"
            >
              <label
                v-if="dialog.data.list_img.length <= 0"
                class="custom-file-upload v-btn__info"
              >
                <button
                  class="btn btn-info"
                  @click="onPickFileInput"
                >
                  <v-icon
                    color="primary"
                    class="mr-1"
                  >mdi-camera</v-icon>Change
                  profile picture
                </button>
                <input
                  ref="fileUpload"
                  type="file"
                  style="display: none"
                  accept="image/*"
                  @change="onFilePickedInput"
                >
              </label>
              <span
                v-else
                class="font-spartan"
              >
                change the image by clicking on the image
              </span>
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
    }),
    methods: {
      onPickFileInput () {
        this.$refs.fileUpload.click()
      },
      onFilePickedInput (event) {
        const files = event.target.files
        const filename = files[0].name
        console.log(filename)
        const fileReader = new FileReader()
        fileReader.addEventListener('load', () => {
          this.imageUrl = fileReader.result
        //   console.log(this.imageUrl)
        })
        fileReader.readAsDataURL(files[0])
        this.files = files[0]

        if (this.files.size > 2000000) {
          console.log('too big')
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
            icon: 'error',
            title: 'file too big',
          })
        } else {
          this.$emit('input', {
            item: {
              files: this.files,
              id: this.dialog.data.id,
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
</style>
