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
                cols="12"
                md="4"
              >
                <v-card
                  class="mx-auto"
                  max-width="400"
                >
                  <v-img
                    class="white--text align-end"
                    height="200px"
                    src="@/assets/img/1.png"
                  >
                    <v-card-title>Hurip Studio</v-card-title>
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
                          Hurip Studio
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
                          Studio
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
                          Bandung
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
                            :color="$vuetify.theme.dark ? 'white' : 'black'"
                            class="mr-1"
                          >
                            mdi-account-check
                          </v-icon>
                          9
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
                          10
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
                    >
                      Explore
                    </v-btn>
                  </v-card-actions>
                </v-card>
              </v-col>
              <v-col
                cols="12"
                md="4"
              >
                <v-card
                  class="mx-auto"
                  max-width="400"
                >
                  <v-img
                    class="white--text align-end"
                    height="200px"
                    src="@/assets/img/2.png"
                  >
                    <v-card-title>Rahsa</v-card-title>
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
                          Rahsa
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
                          Studio
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
                          Bandung
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
                            :color="$vuetify.theme.dark ? 'white' : 'black'"
                            class="mr-1"
                          >
                            mdi-account-check
                          </v-icon>
                          9
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
                          10
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
                    >
                      Explore
                    </v-btn>
                  </v-card-actions>
                </v-card>
              </v-col>
              <v-col
                cols="12"
                md="4"
              >
                <v-card
                  class="mx-auto"
                  max-width="400"
                >
                  <v-img
                    class="white--text align-end"
                    height="200px"
                    src="@/assets/img/3.png"
                  >
                    <v-card-title>Classic Studio</v-card-title>
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
                          Classic Studio
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
                          Studio
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
                          Bandung
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
                            :color="$vuetify.theme.dark ? 'white' : 'black'"
                            class="mr-1"
                          >
                            mdi-account-check
                          </v-icon>
                          9
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
                          10
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
