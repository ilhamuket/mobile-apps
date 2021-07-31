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
          <v-card>
            <iframe
              width="100%"
              height="400"
              src="https://www.youtube.com/embed/liuSjQERYMk?autoplay=1&mute=1&rel=0&modestbranding=1&fs=1"
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
                    label
                  >
                    <v-icon left>
                      mdi-account-circle-outline
                    </v-icon>
                    <v-list-item-title>
                      <h4 class="text-center">
                        Mahardika Kessuma Denie || Beginner
                      </h4>
                    </v-list-item-title>
                  </v-chip>
                </div>
              </div>
              <div class="d-flex flex-row justify-start">
                <div class="d-flex flex-column">
                  <v-chip color="transparent">
                    <h1>
                      Tips Menjadi PROGRAMMER ZAMAN NOW Feat. Eko Kurniawan
                      Khannedy
                    </h1>
                  </v-chip>
                </div>
              </div>
            </v-container>
          </v-card>
          <div class="d-flex flex-row justify-center align-center">
            <div class="d-flex flex-column">
              <v-btn
                large
                outlined
                color="pallet1"
                width="300"
              >
                Tambah Kelas
              </v-btn>
            </div>
          </div>
        </v-col>
        <v-col
          cols="12"
          md="4"
        >
          <v-card
            overflow-hidden
            color="transparent"
          >
            <v-card-title>
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
                    Kelas Hari Ini
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
            </v-card-title>
            <v-list
              v-scroll.self="onScroll"
              max-height="600"
              class="overflow-y-auto"
            >
              <v-list-item>
                <v-list-item-content>
                  <v-img
                    class="mt-12 img-shadow"
                    width="100%"
                    height="200"
                    src="https://i.ytimg.com/vi/liuSjQERYMk/hqdefault.jpg"
                  >
                    <div class="d-flex item-center align-center">
                      <v-icon>
                        mdi-eye
                      </v-icon>
                    </div>
                  </v-img>
                </v-list-item-content>
              </v-list-item>
              <v-list-item>
                <v-list-item-content>
                  <v-img
                    class="mt-12 img-shadow"
                    width="100%"
                    height="200"
                    src="https://i.ytimg.com/vi/2xhdt43QDCo/hqdefault.jpg"
                  />
                </v-list-item-content>
              </v-list-item>
              <v-list-item>
                <v-list-item-content>
                  <v-img
                    class="mt-12 img-shadow"
                    width="100%"
                    height="200"
                    src="https://i.ytimg.com/vi/J1E5kG6369c/hqdefault.jpg"
                  />
                </v-list-item-content>
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
    data: () => ({
      is_img: false,
      is_field: false,
      scrollInvoked: 0,
    }),
    methods: {
      onScroll () {
        this.scrollInvoked++
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
    overflow: auto
.font
  font-size: large
.width-chips
  width: 110px !important
.text-center
  text-align: center !important
</style>
