<template>
  <base-material-card
    icon="mdi-eye"
    color="#6B75AA"
  >
    <template v-slot:heading>
      <v-chip color="transparent">
        <h1>
          For You
        </h1>
      </v-chip>
    </template>

    <v-container>
      <v-row>
        <v-col
          cols="12"
          md="8"
        >
          <v-card v-if="vidios.length !== 0">
            <iframe
              class="iframe"
              width="100%"
              height="400"
              :src="
                `${vidios.url}?autoplay=1&mute=1&rel=0&modestbranding=1&fs=1&loop=0&autopause=0`
              "
              allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture;"
              sandbox="allow-scripts allow-same-origin"
              allowfullscreen
              frameborder="0"
            />
            <v-container>
              <div class="d-flex flex-row justify-start">
                <div class="d-flex flex-column">
                  <v-chip
                    outlined
                    color="pallet1"
                    text-color=""
                    label
                  >
                    <v-icon left>
                      mdi-account-circle-outline
                    </v-icon>
                    <v-list-item-title>
                      <h4 class="text-center text-capitalize">
                        {{
                          vidios.author_first_name +
                            ' ' +
                            vidios.author_last_name
                        }}
                        || {{ vidios.class_type }}
                      </h4>
                    </v-list-item-title>
                  </v-chip>
                </div>
              </div>
              <div class="d-flex flex-row justify-start">
                <div class="d-flex flex-column">
                  <v-chip color="transparent">
                    <h1>
                      {{ vidios.title_yt }}
                    </h1>
                  </v-chip>
                </div>
              </div>
            </v-container>
          </v-card>
          <v-card v-else>
            <v-alert
              dense
              outlined
              type="error"
            >
              You dont have a Schedules
            </v-alert>
          </v-card>
          <div class="d-flex flex-row justify-center align-center">
            <div class="d-flex flex-column">
              <v-btn
                large
                outlined
                color="pallet1"
                width="300"
                @click="addDialog"
              >
                Add Class
              </v-btn>
            </div>
          </div>
        </v-col>
        <v-col
          cols="12"
          md="4"
        >
          <v-card color="transparent">
            <v-app-bar
              absolute
              color="pallet1"
              dark
              src="https://picsum.photos/1920/1080?random"
              scroll-target="#scrolling-techniques-3"
            >
              <template v-slot:img="{ props }">
                <v-img
                  v-bind="props"
                  gradient="to top right, rgba(100,115,201,.7), rgba(25,32,72,.7)"
                />
              </template>

              <v-app-bar-title v-if="is_field === false">
                <h3>
                  Today's Schedule
                </h3>
              </v-app-bar-title>

              <v-spacer />

              <v-btn
                v-if="is_field === false"
                icon
              >
                <v-icon @click="is_field = true">
                  mdi-magnify
                </v-icon>
              </v-btn>
              <div
                v-else
                class="d-flex flex-row mt-5 align-center"
              >
                <div class="d-flex flex-column">
                  <v-text-field
                    append-icon="mdi-magnify"
                    class="mt-5 ml-9"
                    outlined
                    rounded
                    width="100%"
                    dense
                    @click:append="is_field = false"
                  />
                </div>
              </div>
            </v-app-bar>

            <v-list
              v-scroll.self="onScroll"
              max-height="600"
              class="overflow-y-auto"
            >
              <v-list-item
                v-for="(list, i) in schedule"
                :key="i"
              >
                <v-list-item-content
                  v-if="list.length !== 0"
                  class="mt-7"
                >
                  <v-card>
                    <v-img
                      :class="
                        list.title_yt === vidios.title_yt ? 'border-mark' : ''
                      "
                      style="cursor:pointer"
                      width="100%"
                      height="100%"
                      :src="`${list.thumbnail_url}`"
                      @click="play(list)"
                    >
                      <v-row class="fill-height text-right ma-0">
                        <v-col cols="12">
                          <v-chip
                            label
                            class="mx-0 ml-2 mb-2 text-uppercase"
                            color="pallet1"
                            text-color="white"
                            small
                            @click.stop=""
                          >
                            {{
                              list.author_first_name +
                                ' ' +
                                list.author_last_name
                            }}
                            || {{ list.class_type }}
                          </v-chip>
                        </v-col>

                        <v-col align-self="end">
                          <v-chip
                            class="text-uppercase ma-0"
                            color="primary"
                            label
                            small
                          >
                            {{ list.status }}
                          </v-chip>
                        </v-col>
                      </v-row>
                    </v-img>

                    <div class="d-flex flex-row justify-start mt-4">
                      <div class="d-flex flex-column">
                        <p>
                          {{ list.title_yt }}
                        </p>
                      </div>
                    </div>
                  </v-card>
                </v-list-item-content>
                <v-card
                  v-else
                  class="mt-12 mx-auto"
                >
                  <v-alert
                    class="mt-12 mx-auto"
                    dense
                    outlined
                    type="error"
                  >
                    You dont have a Vidio Class
                  </v-alert>
                </v-card>
              </v-list-item>
            </v-list>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
  </base-material-card>
</template>

<script>
  export default {
    props: {
      vidios: {
        type: Object,
        default: null,
      },
      schedule: {
        type: Array,
        default: null,
      },
    },
    data: () => ({
      is_img: false,
      is_field: false,
      scrollInvoked: 0,
      dialog: {
        open: false,
      },
    }),
    mounted () {},
    methods: {
      onScroll () {
        this.scrollInvoked++
      },
      play (item) {
        this.$emit('input', { item: item })
      },
      addDialog () {
        this.dialog.open = !this.dialog.open
        this.$emit('dialog', { item: this.dialog })

        const Toast = this.$swal.mixin({
          toast: true,
          position: 'top-end',
          icon: 'success',
          title: 'Your work has been saved',
          showConfirmButton: false,
          timer: 1500,
          didOpen: toast => {
            toast.addEventListener('mouseenter', this.$swal.stopTimer)
            toast.addEventListener('mouseleave', this.$swal.resumeTimer)
          },
          popup: 'swal2-show',
          backdrop: 'swal2-backdrop-show',
        // icon: 'swal2-icon-show',
        })

        Toast.fire({
          icon: 'success',
          title: 'Dialog Di Buka',
        })
      },
      closeDialog () {
        this.dialog.open = false
        this.$emit('close', { item: this.dialog })
      },
    },
  }
</script>

<style lang="sass" scoped>
.img-shadow
    // box-shadow: 6px 8px 4px 2px #6B75AA !important
.custumize-round
  border-top-left-radius: 20px !important
  border-top-right-radius: 20px
  border-bottom-left-radius: 20px !important
  border-bottom-right-radius: 20px !important
.overflow
  overflow: auto !important
.font
  font-size: large
.width-chips
  width: 110px !important
.text-center
  text-align: center !important
.overflow-x
  overflow-x: auto !important
.border-mark
  border: 10px double blue !important
</style>
