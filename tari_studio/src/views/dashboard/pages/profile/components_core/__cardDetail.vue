<template>
  <v-card height="100">
    <v-row>
      <v-col
        cols="12"
        md="6"
        class="border-right"
      >
        <v-row>
          <v-col cols="3">
            <v-avatar
              v-if="studio.img"
              tile
              size="70"
              class="ml-2 rounded-xl mt-2"
            >
              <v-img :src="`${studio.img.url}`" />
            </v-avatar>
            <v-avatar
              v-else
              tile
              size="70"
              class="ml-2 rounded-xl mt-2"
            >
              <v-img
                src="https://ecs7.tokopedia.net/img/cache/300/default_picture_user/default_toped-22.jpg"
              />
            </v-avatar>
          </v-col>
          <v-col
            class="mt-4"
            cols="9"
          >
            <span class="font-spartan margin__title__user__detail">
              {{ studio.name }}
            </span>
            <br>
            <v-chip
              label
              small
              color="btn_primary"
              class="font-spartan-small text-capitalize margin__title__user__detail__type"
            >
              {{ studio.type }}
            </v-chip>
            <!-- <v-chip
              label
              class="font-spartan-small ml-2"
              color="transparent"
              text-color="btn_primary"
            >
              <v-icon class="mr-1">
                mdi-map-marker
              </v-icon>
              {{ studio.user.address }}
            </v-chip> -->
            <v-chip
              label
              class="font-spartan-small ml-2"
              color="transparent"
              text-color="btn_primary"
            >
              {{ studio.followers ? studio.followers.length : 0 }} followers
            </v-chip>
            <v-chip
              label
              class="font-spartan-small ml-2"
              color="transparent"
              text-color="btn_primary"
            >
              {{ studio.likes ? studio.likes.length : 0 }} Likes
            </v-chip>
          </v-col>
        </v-row>
      </v-col>
      <v-col
        class="mt-2"
        cols="6"
      >
        <div class="d-flex flex-row margin__headers__reviews">
          <div class="flex-column">
            <span class="font-spartan-small text-capitalize">
              studio rating
            </span>
          </div>
          <v-btn
            class="margin__icon__share"
            icon
            dark
          >
            <v-icon color="grey">
              mdi-share-variant
            </v-icon>
          </v-btn>
        </div>
        <div class="d-flex flex-row">
          <div class="d-flex flex-column margin__value">
            <span class="font-spartan-small "> ({{ computedRatings }}) </span>
          </div>
          <div class="d-flex flex-column">
            <v-rating
              v-model="computedRatings"
              readonly
              half-increments
              background-color="grey"
              color="green"
              class="margin__ratings__user"
            />
          </div>
          <div class="d-flex flex-column margin__value-people ml-2">
            <span class="font-spartan-small ">
              ({{ ratings.length }} Reviews)
            </span>
          </div>
        </div>
      </v-col>
    </v-row>
  </v-card>
</template>

<script>
  export default {
    props: {
      studio: {
        type: Object,
        default: null,
      },
      ratings: {
        type: Array,
        default: null,
      },
    },
    data: () => ({
      rating: 0,
    }),
    computed: {
      computedRatings () {
        let value = 0.0
        if (this.ratings) {
          const a = this.ratings.map(x => x.ratings)
          if (a.length > 0) {
            const sum = a.filter(x => x > 0).reduce((x, y) => x + y)
            value = sum / this.ratings.length
          }
        }
        const decimal = parseFloat(value.toFixed(2))
        // console.log(decimal)
        return decimal
      },
    },
  }
</script>

<style lang="sass">
.margin__title__user__detail
  margin-left: -47px
.margin__title__user__detail__type
  margin-left: -45px
  margin-right: 4px
.border-right
  border-right: 1px double #ECEFF5 !important
.margin__ratings__user
  margin-left: 10px
  margin-top: -19px
.margin__revews
  margin-left: 253px
.margin__value
  margin-top: -19px
  margin-left: 141px
.margin__headers__reviews
  margin-left: 228px !important
  margin-bottom: 10px
.margin__icon__share
  margin-left: 200px
.margin__value-people
  margin-top: -10px
</style>
