<template>
  <v-container>
    <v-row>
      <v-col
        cols="12"
        md="8"
        class="mx-auto"
      >
        <v-card>
          <v-card-text class="text-center text-capitalize">
            Hi, {{ users.nickName }}
          </v-card-text>
        </v-card>
      </v-col>
      <v-col cols="12">
        <v-card>
          <v-card-title class="">
            <span class="text-capitalize text-center mx-auto">
              {{ $t('dahsboard.cds') }}
            </span>
          </v-card-title>
          <v-divider class="divider--opacity" />
          <v-card-text>
            <v-row>
              <v-col
                v-for="(item, i) in studio"
                :key="i"
                cols="12"
                md="4"
              >
                <v-card
                  class="mx-auto"
                  max-width="400"
                >
                  <v-img
                    v-if="item.img"
                    class="white--text align-end"
                    height="200px"
                    :src="item.img.url"
                  >
                    <v-card-title>{{ item.name }}</v-card-title>
                  </v-img>

                  <v-card-subtitle style="text-transform: capitalize">
                    <div class="d-flex flex-row mb-2">
                      <!-- <div
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
                              v-on="on"
                            >
                              {{ list.name.substr(0, 26) + ' .. ' }}
                            </h3>
                          </template>
                          <span>{{ list.name }}</span>
                        </v-tooltip>
                      </div> -->
                      <div class="d-flex flex-column">
                        <h3>
                          {{ item.name }}
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
                          {{ item.type }}
                        </v-chip>
                      </div>

                      <div
                        class="d-flex flex-column flex-nowrap text-capitalize ml-2 "
                      >
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
                          {{ item.address }}
                        </v-chip>
                      </div>

                      <div class="d-flex flex-column ml-2">
                        <v-chip
                          color="primary"
                          small
                          label
                          outlined
                        >
                          <v-icon
                            :color="$vuetify.theme.dark ? 'white' : 'orange'"
                            class="mr-1"
                          >
                            mdi-account-check
                          </v-icon>
                          {{ item.followers.length }}
                        </v-chip>
                      </div>

                      <div class="d-flex flex-column ml-2">
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
                          {{ item.likes.length }}
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

                  <v-card-actions>
                    <v-btn
                      color="orange"
                      text
                      @click="toPush(`${item.slug}/home`)"
                    >
                      Explore
                    </v-btn>
                  </v-card-actions>
                </v-card>
              </v-col>
            </v-row>
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
  export default {
    computed: {
      users () {
        const Me = localStorage.getItem('ME')
        const users = JSON.parse(Me)

        return users
      },
      studio () {
        return this.$store.state.studioPopuler.data
      },
    },
    mounted () {
      this.getDataMostPopuler()
    },
    methods: {
      getDataMostPopuler () {
        this.$store.dispatch('studioPopuler/getDataMostPopuler', {
          entities: 'img, followers, likes',
        })
      },
      toPush (link) {
        this.$router.push(link)
      },
    },
  }
</script>

<style lang="sass" scoped>
a
  text-decoration: underline
.theme--dark
  .divider--opacity
    opacity: .2
</style>
