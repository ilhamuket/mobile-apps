<template>
  <v-container>
    <v-row>
      <v-col
        v-for="list in data"
        :key="list.id"
        cols="6"
      >
        <v-card class="rounded-xl">
          <v-img
            v-if="list.img"
            class="d-flex justify-center"
            :src="list.img.url"
            width="400"
            height="200"
            style="cursor:pointer"
            @click="clickPush(list.slug)"
          />

          <v-card-subtitle style="text-transform: capitalize">
            <div class="d-flex flex-row mb-2">
              <div class="d-flex flex-column">
                <h3>
                  {{ list.name }}
                </h3>
              </div>
            </div>
            <div class="d-flex flex-row">
              <div class="d-flex flex-column">
                <v-chip
                  outlined
                  label
                  small
                  color="primary"
                  class="text-capitalize"
                >
                  {{ list.type }}
                </v-chip>
              </div>

              <div class="d-flex flex-column flex-nowrap text-capitalize ml-2 ">
                <v-chip
                  color="primary"
                  small
                  label
                  outlined
                  class="font-size-ather-roboto-mono"
                >
                  <v-icon>
                    mdi-map-marker
                  </v-icon>
                  {{ list.address }}
                </v-chip>
              </div>

              <div
                v-if="list.followers"
                class="d-flex flex-column ml-2"
              >
                <v-chip
                  color="primary"
                  small
                  label
                  outlined
                >
                  <v-icon
                    :color="$vuetify.theme.dark ? 'white' : 'black'"
                    class="mr-1"
                  >
                    mdi-account-check
                  </v-icon>
                  {{ list.followers.length }}
                </v-chip>
              </div>

              <div
                v-if="list.likes"
                class="d-flex flex-column ml-2"
              >
                <v-chip
                  color="primary"
                  small
                  label
                  outlined
                >
                  <v-icon
                    color="red"
                    class="mr-1"
                  >
                    mdi-heart
                  </v-icon>
                  {{ list.likes.length }}
                </v-chip>
              </div>
            </div>
            <div class="d-flex flex-row mt-2">
              <div class="d-flex flex-column">
                <v-rating
                  :value="4.5"
                  color="amber"
                  dense
                  half-increments
                  readonly
                  size="20"
                />
              </div>
              <div class="d-flex flex-column font-size-small mr-4">
                <v-chip
                  color="amber"
                  small
                  label
                  outlined
                >
                  (200 Review)
                </v-chip>
              </div>
            </div>

            <!-- <div class="grey--text ms-4">
                  4.5 (413)
                </div> -->
          </v-card-subtitle>

          <div class="d-flex justify-content-center">
            <v-btn
              class="d-flex justify-center"
              color="pallet1"
              outlined
              @click="clickPush(list.slug)"
            >
              Explore
            </v-btn>

            <v-spacer />

            <v-icon @click="clickSHow(list)">
              {{ list.show === 1 ? 'mdi-chevron-up' : 'mdi-chevron-down' }}
            </v-icon>
          </div>

          <v-expand-transition>
            <div v-show="list.show">
              <v-divider />

              <v-card-text class="text-h5 font-size-ather-roboto-mono">
                "{{ list.about }}"
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
      data: {
        type: Array,
        default: () => [
          {
            img: {
              url: '',
            },
          },
        ],
      },
    },
    data: () => ({
      show: false,
    }),
    methods: {
      clickPush (slug) {
        this.$router.push(`/${slug}/home`)
      },
      clickSHow (item) {
        item.show = !item.show
      },
    },
  }
</script>

<style lang="sass" scoped>
.font-size-small
  font-size: 11px !important
.col-12
  padding: 1px !important
.v-card
  margin-top: 0px
  margin-bottom: 0px
</style>
