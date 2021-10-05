<template>
  <v-container>
    <v-dialog
      v-model="dialog.open"
      width="40%"
    >
      <v-card>
        <v-avatar
          v-if="dialog.data.img"
          size="128"
          class="mx-auto v-card--material__avatar__info elevation-6"
          color="grey"
        >
          <v-img :src="dialog.data.img.url" />
        </v-avatar>
        <br>

        <label
          v-if="!dialog.data.img"
          class="custom-file-upload v-btn__info"
        >
          <button
            class="btn btn-info"
            @click="onPickFileInput"
          >
            <v-icon
              color="primary"
              class="mr-1"
            >mdi-camera</v-icon>Upload
            profile picture & Publish Classes
          </button>
          <input
            ref="fileUpload"
            type="file"
            style="display: none"
            accept="image/*"
            @change="onFilePickedInput"
          >
        </label>

        <label
          v-if="dialog.data.img"
          class="custom-file-upload v-btn__info"
        >
          <button
            class="btn btn-info"
            @click="onPickFile"
          >
            <v-icon
              color="primary"
              class="mr-1"
            >mdi-camera</v-icon>Change
            profile picture
          </button>
          <input
            ref="fileInput"
            type="file"
            style="display: none"
            accept="image/*"
            @change="onFilePicked"
          >
        </label>

        <v-card-title class="text-h3 primary--text font-spartan">
          Info Class

          <v-spacer />

          <v-icon
            aria-label="Close"
            @click="dialog.open = false"
          >
            mdi-close
          </v-icon>
        </v-card-title>
        <v-container>
          <v-row class="text-center">
            <v-col>
              <div class="font-spartan text-subtitle-2">
                Name Class : <span class="">{{ dialog.data.name }}</span>
              </div>
              <div
                v-if="dialog.data.category"
                class="font-spartan text-subtitle-2"
              >
                Category : <span class="">{{ dialog.data.category.name }}</span>
              </div>
              <div class="font-spartan text-subtitle-2">
                Levels : <span class="">{{ dialog.data.levels }}</span>
              </div>
              <div class="font-spartan text-subtitle-2">
                Capacity : <span class="">0 / {{ dialog.data.kapasitas }}</span>
              </div>
              <div class="font-spartan text-subtitle-2">
                Duration :
                <span class="">{{ dialog.data.durasi }} Minutes</span>
              </div>
              <div class="font-spartan text-subtitle-2">
                Price : <span class="">Rp.{{ dialog.data.harga }}</span>
              </div>
              <div class="font-spartan text-subtitle-2">
                Status : <span class="">{{ dialog.data.status }}</span>
              </div>
              <div class="font-spartan text-subtitle-2">
                Keyword : <span class="">#{{ dialog.data.keyword }}</span>
              </div>
              <div class="font-spartan text-subtitle-2">
                Links Room :
                <a
                  :href="dialog.data.url_meets"
                  target="__blank"
                >{{
                  dialog.data.url_meets ? dialog.data.url_meets : '-'
                }}</a>
              </div>
              <div class="font-spartan text-subtitle-2">
                Created_at :
                {{ dialog.data.created_at | moment('MMMM Do YYYY') }}
              </div>
              <div class="font-spartan text-subtitle-2">
                About <br>
                <span class="text-subtitle-1 font-spartan">
                  "{{ dialog.data.about }}"</span>
              </div>
            </v-col>
          </v-row>
          <div class="d-flex flex-row justify-center mt-2">
            <div class="d-flex-column">
              <v-btn
                width="200"
                text
                color="secondary"
                @click="dialog.open = false"
              >
                Back
              </v-btn>
            </div>
          </div>
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
      files: null,
      imageUrl: null,
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
      onPickFile () {
        this.$refs.fileInput.click()
      },
      onFilePicked (event) {
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
        console.log(this.files.size)
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
          this.$emit('change', {
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
.v-card--material__avatar__info
    margin-left: 209px !important
    margin-top: 20px
.v-btn__info
    margin-left: 170px !important
    margin-top: 10px
input[type="file"]
    display: none
.custom-file-upload
    width: 200px
    border: 1px solid #ccc
    display: inline-block
    padding: 6px 12px
    cursor: pointer
</style>
