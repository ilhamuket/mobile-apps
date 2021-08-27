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
                      <p class="text-nowrap font-title-rampart-one text-colour">
                        {{ data.name }}
                      </p>
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
                        {{ data.type }}
                      </v-chip>
                    </div>
                    <div class="d-flex flex-column flex-nowrap">
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
                    <div
                      v-if="data.followers"
                      class="d-flex flex-column ml-2"
                    >
                      {{ data.followers.length }}
                      {{ $t('studioPage.card_detail.folowers') }}
                    </div>
                    <div class="d-flex flex-column ml-2">
                      |
                    </div>
                    <div class="d-flex flex-column ml-2">
                      20 {{ $t('studioPage.card_detail.likes') }}
                    </div>
                  </div>
                </v-col>
                <div class="d-flex flex-row mt-1">
                  <div class="d-flex flex-column">
                    <v-btn
                      v-if="!isFollowYou"
                      outlined
                      width="170"
                      small
                      class="mb-2"
                      @click="folow(data)"
                    >
                      {{ $t('studioPage.card_detail.btn.folow') }}
                    </v-btn>
                    <v-btn
                      v-else
                      width="170"
                      small
                      color="primary"
                      class="mb-2"
                      @click="unfoll(data)"
                    >
                      Following
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
        default: () => ({
          img: {
            url: '',
          },
          followers: [],
        }),
      },
      me: {
        type: Object,
        default: null,
      },
      isFollow: {
        type: Boolean,
        default: false,
      },
    },
    computed: {
      isFollowYou () {
        let data = false
        if (this.data.followers !== undefined) {
          data = this.data.followers.some(x => x.id === this.me.id)
          console.log(data, 'hai')
        }

        return data
      },
    },
    mounted () {},
    methods: {
      folow (item) {
        this.$emit('inputFollow', { item: item })
      },
      unfoll (item) {
        this.$emit('inputUnfoll', { item: item })
      },
    },
  }
</script>

<style lang="sass" scoped>
.border-right
    border-right: 1px double #ECEFF5 !important
.theme--light
  .text-colour
    color: #6B75AA
.theme--dark
  .text-colour
    color: #FFFF !important
</style>
