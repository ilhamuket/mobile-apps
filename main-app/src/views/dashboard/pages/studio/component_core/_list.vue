<template>
  <v-container>
    <v-row>
      <v-col
        v-for="list in data"
        :key="list.id"
        cols="12"
        md="4"
      >
        <v-card>
          <v-img
            v-if="list.img"
            class="d-flex justify-center"
            :src="list.img.url"
            width="400"
            height="200"
            style="cursor:pointer"
            @click="clickPush(list.slug)"
          />
          <v-list-item-avatar
            v-else
            tile
            width="360"
            height="200"
            style="cursor:pointer"
            @click="clickPush(list.slug)"
          >
            <!-- <span
              class="text-h1 font-title-rampart-one custome-brad custumize-class"
            >ET</span> -->
            <v-img src="@/assets/img/et.png" />
          </v-list-item-avatar>

          <v-card-subtitle style="text-transform: capitalize">
            <div class="d-flex flex-row mb-2">
              <div
                v-if="list.name.length > 26"
                class="d-flex flex-column"
              >
                <v-tooltip
                  bottom
                  color="primary"
                >
                  <template #activator="{on,attrs}">
                    <h3
                      v-bind="attrs"
                      style="cursor:pointer"
                      v-on="on"
                      @click="clickPush(list.slug)"
                    >
                      {{ list.name.substr(0, 26) + ' .. ' }}
                    </h3>
                  </template>
                  <span>{{ list.name }}</span>
                </v-tooltip>
              </div>
              <div
                v-else
                class="d-flex flex-column"
              >
                <h3
                  style="cursor:pointer"
                  @click="clickPush(list.slug)"
                >
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

          <v-card-actions class="d-flex justify-center">
            <v-btn
              color="orange"
              class="d-flex justify-end"
              text
              @click="clickPush(list.slug)"
            >
              Explore
            </v-btn>

            <v-spacer />

            <v-icon @click="clickSHow(list)">
              {{ list.show === 1 ? 'mdi-chevron-up' : 'mdi-chevron-down' }}
            </v-icon>
          </v-card-actions>

          <v-expand-transition>
            <div v-show="list.show">
              <v-divider />

              <v-card-text class="text-h5 font-spartan">
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
    computed: {
      initials () {
        let result = ''
        for (const name in this.data) {
          if (Object.hasOwnProperty.call(this.data, name)) {
            const initials = this.data[name]
            const fullName = initials.name.split(' ')
            const initial = fullName.shift().chart(0) + fullName.pop().chart(0)
            result = initial.toUpperCase()
          }
        }

        return result
      },
    },
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
.v-card
  margin-top: 0px
  margin-bottom: 0px
  border-radius: 10px !important
.custumize-class
  color: white !important
.btn-12
  margin-left: 100px
</style>
