<template>
  <v-card class="rounded-sm">
    <v-container>
      <v-row>
        <v-col
          class="border-right"
          cols="12"
          md="6"
        >
          <v-row>
            <v-col cols="3">
              <v-img
                v-if="data.img"
                class="rounded-sm"
                :src="data.img.url"
                width="120"
                height="120"
              />
              <v-img
                v-else
                class="rounded-sm"
                src="https://ecs7.tokopedia.net/img/cache/300/default_picture_user/default_toped-22.jpg"
              />
            </v-col>
            <v-col
              cols="12"
              md="9"
            >
              <v-row>
                <v-col class="mt-1">
                  <div class="d-flex flex-row justify-start mr-12">
                    <div class="d-flex flex-column mr-12">
                      <p class="text-nowrap font-roboto-mono-small text-colour">
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
                        text-color="primary"
                        class="text-capitalize chip-color"
                      >
                        {{ data.type }}
                      </v-chip>
                    </div>
                    <div class="d-flex flex-column flex-nowrap">
                      <v-icon color="blue">
                        mdi-map-marker
                      </v-icon>
                    </div>
                    <!-- <div
                      class="d-flex flex-column flex-nowrap text-capitalize font-roboto-mono-small"
                    >
                      {{ data.address }}
                    </div> -->

                    <div
                      v-if="data.followers"
                      class="d-flex flex-column ml-2"
                    >
                      |
                    </div>
                    <div
                      v-if="data.followers"
                      class="d-flex flex-column ml-2 font-roboto-mono-small"
                    >
                      {{ data.followers.length }}
                      {{ $t("studioPage.card_detail.folowers") }}
                    </div>
                    <div
                      v-if="data.likes"
                      class="d-flex flex-column ml-2"
                    >
                      |
                    </div>
                    <div
                      v-if="data.likes"
                      class="d-flex flex-column ml-2 font-roboto-mono-small"
                    >
                      {{ data.likes.length }}
                      {{ $t("studioPage.card_detail.likes") }}
                    </div>
                  </div>
                </v-col>
                <div class="d-flex flex-row mt-1 justify-between">
                  <div class="d-flex flex-column">
                    <v-btn
                      v-if="!isFollowYou"
                      color="btn_primary"
                      outlined
                      width="170"
                      small
                      class="mb-2"
                      @click="folow(data)"
                    >
                      {{ $t("studioPage.card_detail.btn.folow") }}
                    </v-btn>
                    <v-btn
                      v-else
                      width="170"
                      small
                      outlined
                      color="btn_primary"
                      class="mb-2"
                      @click="unfoll(data)"
                    >
                      <v-tooltip
                        color="primary"
                        bottom
                      >
                        <template #activator="{ on, attrs }">
                          <v-icon
                            color="btn_primary"
                            v-bind="attrs"
                            v-on="on"
                          >
                            mdi-account-check
                          </v-icon>
                        </template>
                        <span class="font-spartan-small white--text">
                          Unfollow
                        </span>
                      </v-tooltip>
                    </v-btn>
                  </div>

                  <div class="d-flex flex-column ml-2">
                    <v-btn
                      v-if="!isLikesYou"
                      outlined
                      width="120"
                      small
                      color="red"
                      class="mb-2"
                      @click="likes(data)"
                    >
                      <v-tooltip
                        color="red"
                        bottom
                      >
                        <template #activator="{ on, attrs }">
                          <v-icon
                            v-bind="attrs"
                            v-on="on"
                          >
                            mdi-heart-outline
                          </v-icon>
                        </template>
                        <span class="font-spartan-small white--text">
                          like
                        </span>
                      </v-tooltip>
                    </v-btn>
                    <v-btn
                      v-else
                      width="120"
                      small
                      outlined
                      color="red"
                      class="mb-2"
                      @click="unLike(data)"
                    >
                      <v-tooltip
                        color="red"
                        bottom
                      >
                        <template #activator="{ on, attrs }">
                          <v-icon
                            v-bind="attrs"
                            color="red"
                            v-on="on"
                          >
                            mdi-heart
                          </v-icon>
                        </template>
                        <span class="font-spartan-small white--text">
                          Unlike
                        </span>
                      </v-tooltip>
                    </v-btn>
                  </div>
                  <div class="d-flex flex-column ml-3">
                    <v-btn
                      color="primary"
                      rounded
                      width="120"
                      outlined
                      small
                    >
                      <v-icon> mdi-information-variant </v-icon>
                    </v-btn>
                  </div>
                </div>
              </v-row>
            </v-col>
          </v-row>
        </v-col>
        <v-col
          cols="12"
          md="6"
        >
          <v-row class="ml-12">
            <!-- <v-col cols="12">
              <span class="font-spartan">
                Ratings
              </span>
            </v-col> -->
            <v-col
              cols="12"
              class="mr-6 d-flex align-center justify-center m-21"
            >
              <div class="d-flex flex-row-reverse">
                <div class="d-flex flex-column mt-2 mr-2">
                  <span class="font-spartan text-h3 font-weight-bold">
                    ({{ count }})
                  </span>
                </div>
              </div>

              <v-rating
                :value="count"
                color="btn_primary"
                dense
                half-increments
                background-color="primary"
                readonly
                class="mt-3 mr-2"
                size="35"
              />
              <div class="d-flex flex-column mt-1 text-align-center mr-2">
                <P class="mt-1 font-roboto-mono-small">
                  ({{ dataReviews.length }}
                  {{ $t("studioPage.card_detail.review") }})
                </P>
              </div>
            </v-col>
          </v-row>
          <v-row>
            <!-- <v-col class="">
              <div class="d-flex flex-row"> -->
            <!-- <div class="d-flex flex-column"> -->
            <!-- <v-btn
                    color="primary"
                    rounded
                    width="100%"
                    outlined
                  >
                    See Statictic
                  </v-btn> -->
            <!-- </div> -->
            <!-- <div
                  class="d-flex flex-column justify-center text-center m-l-201 mt-2"
                > -->
            <!-- <v-btn
                    outlined
                    width="280"
                    small
                    rounded
                    color="primary"
                    class="mb-2 font-roboto-mono-small"
                  >
                    <v-icon>
                      mdi-information-variant
                    </v-icon>
                  </v-btn> -->
            <!-- </div> -->
            <!-- </div>
            </v-col> -->
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
            url: "",
          },
          followers: [],
        }),
      },
      ratings: {
        type: Object,
        default: null,
      },
      dataReviews: {
        type: Array,
        default: null,
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
        let boolean = false
        if (this.data.followers !== undefined) {
          boolean = this.data.followers.some((x) => x.id === this.me.id)
        }

        return boolean
      },
      isLikesYou () {
        let boolean = false
        if (this.data.likes !== undefined) {
          boolean = this.data.likes.some((x) => x.id === this.me.id)
        }

        return boolean
      },
      count () {
        let value = 0
        if (this.dataReviews) {
          const a = this.dataReviews.map((x) => x.ratings)

          if (a.length > 0) {
            const sum = a.filter((x) => x > 0).reduce((x, y) => x + y)
            value = sum / this.dataReviews.length
          }
        }
        const x = parseFloat(value.toFixed(2))
        console.log(x)

        return x
      },
    },
    mounted () {
      console.log(this.count)
    },
    methods: {
      folow (item) {
        this.$emit("inputFollow", { item: item })
      },
      unfoll (item) {
        this.$emit("inputUnfoll", { item: item })
      },
      likes (item) {
        this.$emit("inputLike", { item: item })
      },
      unLike (item) {
        this.$emit("inputUnLike", { item: item })
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
    font-size: 20px
.theme--dark
  .text-colour
    color: #FFFF !important
    font-size: 20px
.m-l-201
  margin-left: 91px
.m-21
  margin-top: 30px
</style>
