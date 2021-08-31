<template>
  <v-card>
    <v-container>
      <v-row>
        <v-col
          class="border-right"
          cols="6"
        >
          <v-row>
            <v-col cols="3">
              <v-img
                v-if="data.img"
                :src="data.img.url"
                width="120"
                height="120"
              />
            </v-col>
            <v-col cols="9">
              <v-row>
                <v-col class="mt-1">
                  <div class="d-flex flex-row justify-start mr-12">
                    <div class="d-flex flex-column mr-12">
                      <p class="text-nowrap">
                        {{ data.name }}
                      </p>
                    </div>
                  </div>
                  <div class="d-flex flex-row mt-6">
                    <div class="d-flex flex-column">
                      <v-chip
                        outlined
                        label
                        small
                        color="primary"
                        class="text-capitalize"
                      >
                        {{ data.type }}
                      </v-chip>
                    </div>
                    <div class="d-flex flex-column flex-nowrap ml-2">
                      <v-icon>
                        mdi-map-marker
                      </v-icon>
                    </div>
                    <div class="d-flex flex-column flex-nowrap text-capitalize">
                      {{ data.region }}
                    </div>

                    <div class="d-flex flex-column ml-2">
                      |
                    </div>
                    <div class="d-flex flex-column ml-2">
                      20 {{ $t('studioPage.card_detail.folowers') }}
                    </div>
                    <div class="d-flex flex-column ml-2">
                      |
                    </div>
                    <div class="d-flex flex-column ml-2">
                      20 {{ $t('studioPage.card_detail.folowers') }}
                    </div>
                  </div>
                </v-col>
                <div class="d-flex flex-row ml-2">
                  <div class="d-flex flex-column">
                    <v-btn
                      outlined
                      width="170"
                      small
                      class="mb-2"
                    >
                      {{ $t('studioPage.card_detail.btn.folow') }}
                    </v-btn>
                  </div>
                  <div class="d-flex flex-column ml-2">
                    <v-btn
                      outlined
                      width="120"
                      small
                      class="mb-2"
                    >
                      <v-icon>
                        mdi-thumb-up-outline
                      </v-icon>
                    </v-btn>
                  </div>

                  <div class="d-flex flex-column ml-2">
                    <v-btn
                      outlined
                      width="80"
                      small
                      class="mb-2"
                    >
                      Info Studio
                    </v-btn>
                  </div>
                </div>
              </v-row>
            </v-col>
          </v-row>
        </v-col>
        <v-col cols="4">
          <v-row>
            <v-col class="mr-6 d-flex justify-center">
              <div class="d-flex flex-row-reverse">
                <div class="d-flex flex-column mt-2 mr-2">
                  <h2 class="mt-1">
                    4.5
                  </h2>
                </div>
              </div>

              <v-rating
                :value="4.5"
                color="amber"
                dense
                half-increments
                readonly
                class="mt-3 mr-2"
                size="35"
              />
              <div class="d-flex flex-column mt-1 text-align-center mr-2">
                <P class="mt-1">
                  (200 Review)
                </P>
              </div>
            </v-col>
          </v-row>
          <v-row>
            <v-col class="">
              <div class="d-flex flex-row">
                <div class="d-flex flex-column">
                  <v-btn
                    color="primary"
                    rounded
                    width="150"
                    outlined
                  >
                    See Statictic
                  </v-btn>
                </div>
                <div class="d-flex flex-column ml-2 mb-2">
                  <v-btn
                    color="pallet1"
                    rounded
                    width="300"
                  >
                    Subcribe
                  </v-btn>
                </div>
              </div>
            </v-col>
          </v-row>
        </v-col>
      </v-row>
    </v-container>
  </v-card>
</template>

<script>
  export default {
    props: {
      data: {
        type: Object,
        default: null,
      },
    },
  }
</script>

<style lang="sass" scoped>
.border-right
    border-right: 1px double #ECEFF5 !important
</style>
