<template>
  <v-container>
    <v-row>
      <v-col
        v-for="(item, i) in studio"
        :key="i"
        cols="12"
        md="4"
      >
        <v-card class="mx-auto card__poluler--studio">
          <v-img
            v-if="item.img"
            class="white--text layout__fhd align-end"
            width="400"
            height="400"
            :src="item.img.url"
            style="cursor: pointer"
            gradient="to top right, rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.05)"
            @click="toPush(item)"
          >
            <v-container>
              <v-row class="row__headers">
                <v-col
                  cols="12"
                  class="d-flex flex-row-reverse"
                >
                  <v-chip
                    label
                    class="font-spartan mr-1 text-uppercase"
                    color="btn_primary"
                    text-color="white"
                    small
                    @click.stop=""
                  >
                    {{ item.views ? item.views : "0" }} Visited
                  </v-chip>
                </v-col>
              </v-row>
              <v-row class="row__populer">
                <v-card-subtitle style="text-transform: capitalize">
                  <div class="d-flex flex-row mb-2">
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

                    <div class="d-flex flex-column ml-2">
                      <v-chip
                        color="primary"
                        small
                        label
                        outlined
                      >
                        <v-tooltip
                          bottom
                          color="primary"
                        >
                          <template #activator="{ on, attrs }">
                            <v-icon
                              v-bind="attrs"
                              :color="$vuetify.theme.dark ? 'white' : 'orange'"
                              class="mr-1"
                              v-on="on"
                            >
                              mdi-account-check
                            </v-icon>
                          </template>
                          <span class="font-spartan-small"> Following </span>
                        </v-tooltip>

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
                        :value="computedList[i]"
                        color="amber"
                        dense
                        background-color="primary"
                        half-increments
                        readonly
                        size="20"
                      />
                    </div>
                    <div class="d-flex flex-column font-size-small mr-4">
                      <v-chip
                        :color="item.reviews.length > 0 ? 'amber' : 'primary'"
                        small
                        label
                        outlined
                      >
                        ({{ item.reviews.length }} Review)
                      </v-chip>
                    </div>
                  </div>
                </v-card-subtitle>
              </v-row>
            </v-container>
          </v-img>
          <v-img
            v-else
            class="white--text layout__fhd align-end"
            width="400"
            height="400"
            src="https://ecs7.tokopedia.net/img/cache/300/default_picture_user/default_toped-22.jpg"
            style="cursor: pointer"
            gradient="to top right, rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.05)"
            @click="toPush(item)"
          >
            <v-container>
              <v-row class="row__headers">
                <v-col
                  cols="12"
                  class="d-flex flex-row-reverse"
                >
                  <v-chip
                    label
                    class="font-spartan mr-1 text-uppercase"
                    color="btn_primary"
                    text-color="white"
                    small
                    @click.stop=""
                  >
                    {{ item.views ? item.views : "0" }} Visited
                  </v-chip>
                </v-col>
              </v-row>
              <v-row class="row__populer">
                <v-card-subtitle style="text-transform: capitalize">
                  <div class="d-flex flex-row mb-2">
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

                    <div class="d-flex flex-column ml-2">
                      <v-chip
                        color="primary"
                        small
                        label
                        outlined
                      >
                        <v-tooltip
                          bottom
                          color="primary"
                        >
                          <template #activator="{ on, attrs }">
                            <v-icon
                              v-bind="attrs"
                              :color="$vuetify.theme.dark ? 'white' : 'orange'"
                              class="mr-1"
                              v-on="on"
                            >
                              mdi-account-check
                            </v-icon>
                          </template>
                          <span class="font-spartan-small"> Following </span>
                        </v-tooltip>

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
                        :value="computedList[i]"
                        color="amber"
                        dense
                        background-color="primary"
                        half-increments
                        readonly
                        size="20"
                      />
                    </div>
                    <div class="d-flex flex-column font-size-small mr-4">
                      <v-chip
                        :color="item.reviews.length > 0 ? 'amber' : 'primary'"
                        small
                        label
                        outlined
                      >
                        ({{ item.reviews.length }} Review)
                      </v-chip>
                    </div>
                  </div>
                </v-card-subtitle>
              </v-row>
            </v-container>
          </v-img>

          <!-- <v-card-actions>
          <v-btn
            color="orange"
            text
            @click="toPush(`${item.slug}/home`)"
          >
            {{ $t("dahsboard.sxp") }}
          </v-btn>
        </v-card-actions> -->
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
  export default {
    props: {
      studio: {
        type: Array,
        default: null,
      },
    },
    computed: {
      computedList () {
        const arrayReviews = []
        // eslint-disable-next-line no-unused-vars
        for (const item in this.studio) {
          if (Object.hasOwnProperty.call(this.studio, item)) {
            const studio = this.studio[item]
            let newReviews = []
            newReviews = studio.reviews
            let count = [2]
            count = newReviews.map((x) => x.ratings)
            if (count.length > 0) {
              const sum = count.filter((x) => x > 0).reduce((x, y) => x + y, 0)
              const avarage = sum / count.length

              arrayReviews.push(avarage)
            }
          }
        }
        return arrayReviews
      },
    },
    methods: {
      toPush (link) {
        this.$router.push(`/studio/${link.id}/${link.slug}/home`)
      },
    },
  }
</script>

<style lang="sass">
.row__populer
    margin-top: 77% !important
.card
  &__poluler--studio
    &:hover
      transform: scale(.9)
      border: 2px double #9DC4D1
// @media screen and (min-width: 1600px)
//   .layout
//     &__fhd
//       width: 100% !important
</style>
