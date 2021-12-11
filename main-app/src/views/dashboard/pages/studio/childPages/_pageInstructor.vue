<template>
  <v-container>
    <v-row v-if="item.length === 0">
      <v-col
        class="d-flex justify-center"
        cols="12"
      >
        <!-- <v-img
          :src="require('@/assets/img/perbaikan.png')"
          width="200"
        /> -->
        <v-progress-circular
          indeterminate
          color="primary"
        />
      </v-col>
    </v-row>
    <v-row v-else>
      <v-col
        v-for="(data, i) in item"
        :key="i"
        cols="12"
        md="4"
      >
        <v-hover v-slot="{ hover }">
          <v-card
            :elevation="hover ? 12 : 2"
            :class="{ hover: 'on-hover' }"
          >
            <v-img
              v-if="data.img"
              :src="data.img.url"
              style="cursor: pointer"
            >
              <v-container>
                <v-row class="row--instructor">
                  <v-col cols="12">
                    <span class="font-spartan font-weight-bold white--text">
                      {{ data.name }}
                    </span>
                  </v-col>
                </v-row>
              </v-container>
            </v-img>
            <v-container>
              <v-row>
                <v-col
                  cols="12"
                  class="d-flex flex-row-reverse margin-callbacks"
                >
                  <div class="d-flex flex-row margin--icon">
                    <div class="d-flex flex-column">
                      <v-tooltip
                        bottom
                        color="btn_primary"
                      >
                        <template #activator="{ on, attrs }">
                          <v-icon
                            v-bind="attrs"
                            color="red"
                            class="mr-2"
                            v-on="on"
                          >
                            mdi-instagram
                          </v-icon>
                        </template>
                        <span
                          v-if="data.username_ig"
                          class="font-spartan-small"
                        >
                          {{ data.username_ig }}
                        </span>
                        <span
                          v-else
                          class="font-spartan-small"
                        >
                          Instagram
                        </span>
                      </v-tooltip>
                    </div>
                    <div class="d-flex flex-column">
                      <v-tooltip
                        bottom
                        color="btn_primary"
                      >
                        <template #activator="{ on, attrs }">
                          <v-icon
                            v-bind="attrs"
                            color="blue"
                            class="mr-2"
                            v-on="on"
                          >
                            mdi-facebook
                          </v-icon>
                        </template>
                        <span
                          v-if="data.username_fb"
                          class="font-spartan-small"
                        >
                          {{ data.username_fb }}
                        </span>
                        <span
                          v-else
                          class="font-spartan-small"
                        >
                          Facebook
                        </span>
                      </v-tooltip>
                    </div>
                    <div class="d-flex flex-column">
                      <v-tooltip
                        bottom
                        color="btn_primary"
                      >
                        <template #activator="{ on, attrs }">
                          <v-icon
                            v-bind="attrs"
                            color="blue"
                            v-on="on"
                          >
                            mdi-twitter
                          </v-icon>
                        </template>
                        <span
                          v-if="data.username_tw"
                          class="font-spartan-small"
                        >
                          {{ data.username_tw }}
                        </span>
                        <span
                          v-else
                          class="font-spartan-small"
                        > Twitter </span>
                      </v-tooltip>
                    </div>
                  </div>
                </v-col>
              </v-row>
            </v-container>
          </v-card>
        </v-hover>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
  export default {
    props: {
      item: {
        type: Array,
        default: null,
      },
    },
    data: () => ({}),
    computed: {},

    methods: {},
  }
</script>

<style lang="sass">
.row--instructor
  margin-top: 85% !important
</style>
