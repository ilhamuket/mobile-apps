<template>
  <v-container>
    <v-row>
      <v-col
        cols="12"
        md="4"
        class="d-flex justify-start"
      >
        <h2 :class="$vuetify.theme.dark ? 'font-spartan' : 'font-spartan'">
          Describe Class
        </h2>
      </v-col>
    </v-row>

    <v-row>
      <v-col
        cols="12"
        md="12"
      >
        <v-row>
          <v-col
            cols="12"
            md="4"
            sm="12"
          >
            <v-text-field
              :label="`${$t('search')}`"
              dense
              outlined
              append-icon="mdi-magnify"
            />
          </v-col>
        </v-row>
      </v-col>
      <v-col
        v-for="(item, i) in classes"
        :key="i"
        cols="12"
        md="4"
      >
        <v-card
          class="mx-auto"
          max-height="500"
        >
          <v-img
            v-if="item.img"
            :src="item.img.url"
            width="400"
            height="200"
          />
          <v-img
            v-else
            height="200px"
            src="https://cdn.vuetifyjs.com/images/cards/sunshine.jpg"
          />
          <v-card-text>
            <div class="text-h6">
              <v-chip
                :color="setColorStatus(item.status)"
                small
                label
              >
                {{ item.status }}
              </v-chip>
            </div>
            <div class="d-flex flex-row mt-1">
              <div class="d-flex flex-column font-size-ather-roboto-mono">
                Name :
              </div>
              <div class="d-flex flex-column float-right">
                <v-chip
                  color="pallet1"
                  label
                  outlined
                  small
                  class="text-h4 ml-1"
                >
                  {{ item.name }}
                </v-chip>
              </div>
            </div>
            <div class="d-flex flex-row mt-1">
              <div class="d-flex flex-column font-size-ather-roboto-mono">
                <p>
                  Level :
                </p>
              </div>
              <div class="d-flex flex-column ml-2">
                <v-chip
                  color="red"
                  small
                  label
                  outlined
                  class="mb-2 text-capitalize"
                >
                  {{ item.levels }}
                </v-chip>
              </div>
            </div>
            <div class="d-flex flex-row mt-1">
              <div class="d-flex flex-column font-size-ather-roboto-mono">
                Price :
              </div>
              <div class="d-flex flex-column float-right">
                <v-chip
                  color="transparent"
                  label
                  small
                  class="text-h4 ml-1"
                >
                  {{ item.harga === null ? '-' : item.harga }}
                </v-chip>
              </div>
            </div>
            <div class="d-flex flex-row mt-1">
              <div class="d-flex flex-column font-size-ather-roboto-mono">
                Duration :
              </div>
              <div class="d-flex flex-column float-right">
                <v-chip
                  color="transparent"
                  label
                  small
                  class="text-h4 ml-1"
                >
                  {{ item.durasi === null ? '-' : item.durasi }}
                </v-chip>
              </div>
            </div>
            <div class="d-flex flex-row mt-1">
              <div class="d-flex flex-column font-size-ather-roboto-mono">
                Capacity :
              </div>
              <div class="d-flex flex-column float-right">
                <v-chip
                  color="transparent"
                  label
                  small
                  class="text-h4 ml-1"
                >
                  0 / {{ item.kapasitas === null ? '-' : item.kapasitas }}
                </v-chip>
              </div>
            </div>

            <!-- <div class="text--primary font-size-ather-roboto-mono">
              {{ item.about }}
            </div> -->
          </v-card-text>
          <!-- <v-card-actions class="d-flex justify-center mb-2">
            <v-btn
              class=""
              outlined
              color="primary"
              width="200"
              small
              @click="clickSeeMore(item)"
            >
              See More
            </v-btn>
          </v-card-actions> -->
          <v-card-actions>
            <v-btn
              class=""
              text
              color="primary"
              width="200"
              small
              @click="clickSeeMore(item)"
            >
              See More
            </v-btn>

            <v-spacer />

            <v-btn
              icon
              dark
              @click="show = !show"
            >
              <v-icon color="primary">
                {{ show ? 'mdi-chevron-up' : 'mdi-chevron-down' }}
              </v-icon>
            </v-btn>
          </v-card-actions>

          <v-expand-transition>
            <div v-show="show">
              <v-divider />

              <v-card-text>
                <div class="text--primary font-size-ather-roboto-mono">
                  {{ item.about }}
                </div>
              </v-card-text>
            </div>
          </v-expand-transition>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
  export default {
    props: {
      classes: {
        type: Array,
        default: null,
      },
    },
    data: () => ({
      items: ['tahu', 'ayam'],
      show: false,
    }),
    methods: {
      setColorStatus (status) {
        if (status === 1) return 'primary'
        else return 'red'
      },
      clickSeeMore (item) {
        this.$emit('open', { item: item })
      },
    },
  }
</script>

<style lang="sass" scoped>
// @import url('https://fonts.googleapis.com/css2?family=Rampart+One&display=swap')
// @import url('https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&family=Shadows+Into+Light&display=swap')
// @import url('https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&family=Roboto+Mono:ital,wght@1,100&family=Shadows+Into+Light&display=swap')
// .font-title
//   font-family: 'Rampart One', cursive !important
//   color: #6B75AA !important
// .font-about
//   // font-family: 'Dancing Script', cursive !important
//   font-family: 'Shadows Into Light', cursive !important
// .font-size-ather
//   font-size: 14px !important
//   font-family: 'Roboto Mono', monospace
//   font-weight: bold
</style>
