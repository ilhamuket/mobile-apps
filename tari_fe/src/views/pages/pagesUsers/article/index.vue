<template>
  <v-app>
    <v-container>
      <v-row dense>
        <v-col
          cols="4"
          class="mt-7"
        >
          <v-card>
            <v-card-title>
              <h4>
                {{ $t('search') }}
              </h4>
            </v-card-title>
            <v-card-text>
              <v-text-field
                :label="$t('search')"
                outlined
                dense
              />
              <v-select
                :label="$t('search')"
                outlined
                dense
              />
            </v-card-text>
          </v-card>
        </v-col>
        <v-col cols="8">
          <v-container>
            <v-row>
              <v-col
                cols="6"
                class="ml-3"
              >
                <v-card
                  :loading="loading"
                  class="mx-auto my-12"
                  max-width="374"
                >
                  <template slot="progress">
                    <v-progress-linear
                      color="deep-purple"
                      height="10"
                      indeterminate
                    />
                  </template>

                  <v-img
                    height="250"
                    src="https://cdn.vuetifyjs.com/images/cards/cooking.png"
                  />

                  <v-card-title>
                    <p class="text-subtitle-1">
                      Pengertian, Unsur-unsur, Fungsi, Jenis-jenis, serta Contoh
                      Seni Tari Tradisional di Indonesia
                    </p>
                  </v-card-title>

                  <v-card-text>
                    <v-row
                      align="center"
                      class="mx-0"
                    >
                      <v-rating
                        :value="4.5"
                        color="amber"
                        dense
                        half-increments
                        readonly
                        size="14"
                      />
                    </v-row>

                    <div class="my-4 text-subtitle-1">
                      $ • Mahardika - Hurip Studio
                    </div>

                    <div>
                      Small plates, salads & sandwiches - an intimate setting
                      with 12 indoor seats plus patio seating.
                    </div>
                  </v-card-text>
                </v-card>
              </v-col>
            </v-row>
          </v-container>
        </v-col>
      </v-row>
    </v-container>
  </v-app>
</template>

<script>
  export default {
    data: () => ({
      loading: false,
      selection: 1,
    }),

    methods: {
      reserve () {
        this.loading = true

        setTimeout(() => (this.loading = false), 2000)
      },
    },
  }
</script>
<style lang="sass" scoped>
.text-size
    font-size: 20px !important
</style>
