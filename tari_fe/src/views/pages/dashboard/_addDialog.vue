<template>
  <v-dialog
    v-model="dialog.open"
    transition="dialog-bottom-transition"
    width="50%"
  >
    <base-material-card
      class="mt-6"
      icon="mdi-eye"
      color="#6B75AA"
    >
      <template v-slot:heading>
        <v-chip color="transparent">
          <h1>
            Add Class
          </h1>
        </v-chip>
      </template>
      <!-- <v-card-title>
        <span class="text-h5">User Profile</span>
      </v-card-title> -->
      <v-card-text>
        <v-container>
          <v-row>
            <v-col cols="6">
              <v-date-picker
                v-model="picker"
                color="pallet1"
              />
            </v-col>
            <v-col cols="6">
              <div class="d-flex flex-row-reverse">
                <div class="d-flex flex-column">
                  <v-text-field
                    outlined
                    placeholder="Search"
                    label="Search"
                    rounded
                    dense
                    append-icon="mdi-magnify"
                  />
                </div>
              </div>
              <div class="d-flex flex-row mb-2">
                <div class="d-flex flex-column">
                  <v-chip
                    color="pallet1"
                    outlined
                    label
                  >
                    <h2>
                      Kelas Rekomendasi
                    </h2>
                  </v-chip>
                </div>
              </div>
              <v-list
                max-height="300"
                class="overflow-y-auto"
              >
                <v-list-item
                  v-for="list in classes"
                  :key="list.id"
                  class="mb-2"
                >
                  <v-card>
                    <div
                      v-if="list.posts"
                      class="d-flex flex-row flex-nowrap"
                    >
                      <div class="d-flex flex-column">
                        <v-img
                          :src="`${list.posts.thumbnail_url}`"
                          width="242"
                          height="100"
                        />
                      </div>
                    </div>
                    <div
                      v-if="list.posts && list.teacher"
                      class="d-flex flex-column ml-2"
                    >
                      <h6 class="text-nowrap">
                        {{ list.posts.title_yt }} -
                        {{
                          list.teacher.firstName + ' ' + list.teacher.lastName
                        }}
                      </h6>
                    </div>
                    <div class="d-flex flex-row-reverse justify-center mb-2">
                      <div class="d-flex flex-column">
                        <v-btn
                          outlined
                          color="pallet1"
                        >
                          adden
                        </v-btn>
                      </div>
                    </div>
                  </v-card>
                </v-list-item>
                <!-- <v-list-item class="mb-2">
                  <v-card>
                    <div class="d-flex flex-row flex-nowrap">
                      <div class="d-flex flex-column">
                        <v-img
                          src="https://i.ytimg.com/vi/eA0TxhOv2FI/hqdefault.jpg"
                          width="242"
                          height="100"
                        />
                      </div>
                    </div>
                    <div class="d-flex flex-column ml-2">
                      <h6 class="text-nowrap">
                        [ 1 Hour ] Camilo , Pedro Capó -- Tutu - Alma Zarza
                        Cover ( Tiktok Song ) - Mahardika
                      </h6>
                    </div>
                    <div class="d-flex flex-row-reverse justify-center mb-2">
                      <div class="d-flex flex-column">
                        <v-btn
                          outlined
                          color="pallet1"
                        >
                          adden
                        </v-btn>
                      </div>
                    </div>
                  </v-card>
                </v-list-item>
                <v-list-item class="mb-2">
                  <v-card>
                    <div class="d-flex flex-row flex-nowrap">
                      <div class="d-flex flex-column">
                        <v-img
                          src="https://i.ytimg.com/vi/1NRJf8OAdc8/hqdefault.jpg"
                          width="242"
                          height="100"
                        />
                      </div>
                    </div>
                    <div class="d-flex flex-column ml-2">
                      <h6 class="text-nowrap">
                        20191228 KULIAH Teknik Hacking
                      </h6>
                    </div>
                    <div class="d-flex flex-row-reverse justify-center mb-2">
                      <div class="d-flex flex-column">
                        <v-btn
                          outlined
                          color="pallet1"
                        >
                          adden
                        </v-btn>
                      </div>
                    </div>
                  </v-card>
                </v-list-item> -->
              </v-list>
            </v-col>
          </v-row>
        </v-container>
      </v-card-text>

      <div class="d-flex flex-row-reverse">
        <div class="d-flex flex-column">
          <v-btn
            color="blue darken-1"
            outlined
            @click="close"
          >
            Close
          </v-btn>
        </div>
        <div class="d-flex flex-column mr-2">
          <v-btn
            color="blue darken-1"
            outlined
            @click="log"
          >
            Save
          </v-btn>
        </div>
      </div>
    </base-material-card>
  </v-dialog>
</template>

<script>
  export default {
    props: {
      dialog: {
        type: Object,
        default: null,
      },
      classes: {
        type: Array,
        default: null,
      },
    },
    data () {
      return {
        picker: null,
      }
    },
    mounted () {},
    methods: {
      log () {
        console.log(this.picker)
      },
      close () {
        this.dialog.open = false
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
          title: 'Password atau Email Anda salah',
        })

        if (this.dialog.open === false) {
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
            title: 'Dialog Di tutup',
          })
        }
      },
    },
  }
</script>

<style lang="sass" scoped>
.border
    border: 10px double grey !important
</style>
