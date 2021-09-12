<template>
  <v-container>
    <v-row v-if="is_load">
      <loader
        object="#ff9633"
        color1="#ffffff"
        color2="#17fd3d"
        size="5"
        speed="2"
        bg="#343a40"
        objectbg="#999793"
        opacity="80"
        disable-scrolling="false"
        name="dots"
      />
      <v-col>
        <v-skeleton-loader type="card-avatar, article, actions" />
      </v-col>
    </v-row>
    <v-row v-else>
      <v-col
        cols="12"
        md="8"
        class="mx-auto"
      >
        <v-card>
          <v-card-text
            class="text-center text-capitalize font-spartan font-italic"
          >
            Hi, {{ users.nickName }}
          </v-card-text>
        </v-card>
      </v-col>
      <v-col cols="12">
        <v-card>
          <v-card-title class="">
            <span
              class="text-capitalize text-center mx-auto font-spartan font-italic"
            >
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
                    style="cursor:pointer"
                    @click="toPush(`${item.slug}/home`)"
                  >
                    <v-row class="fill-height mt-g text-right">
                      <v-col cols="12">
                        <v-chip
                          label
                          class="font-spartan mr-1 text-uppercase"
                          color="primary"
                          text-color="white"
                          small
                          @click.stop=""
                        >
                          {{ item.views ? item.views : '0' }} Visited
                        </v-chip>
                      </v-col>
                    </v-row>
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
    data: () => ({
      is_load: true,
    }),
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
        this.$store
          .dispatch('studioPopuler/getDataMostPopuler', {
            entities: 'img, followers, likes',
          })
          .then(res => {
            if (res.data.meta.status) {
              this.is_load = false
            }
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
.mt-g
  margin-top: -200px
</style>
