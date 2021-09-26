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
              tile
              size="70"
              class="ml-2 rounded-xl mt-2"
            >
              <v-img src="http://127.0.0.1:8000/images/776290.jpg" />
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
            <v-chip
              label
              class="font-spartan-small ml-2"
              color="transparent"
              text-color="btn_primary"
            >
              <v-icon class="mr-1">
                mdi-map-marker
              </v-icon>
              {{ studio.address }}
            </v-chip>
            <v-chip
              v-if="studio.followers"
              label
              class="font-spartan-small ml-2"
              color="transparent"
              text-color="btn_primary"
            >
              {{ studio.followers.length }} followers
            </v-chip>
            <v-chip
              v-if="studio.likes"
              label
              class="font-spartan-small ml-2"
              color="transparent"
              text-color="btn_primary"
            >
              {{ studio.likes.length }} Likes
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
          <v-icon class="margin__icon__share">
            mdi-share-variant
          </v-icon>
        </div>
        <div class="d-flex flex-row">
          <div class="d-flex flex-column margin__value">
            <span class="font-spartan-small ">
              (0)
            </span>
          </div>
          <div class="d-flex flex-column">
            <v-rating
              v-model="rating"
              background-color="purple lighten-3"
              color="purple"
              class="margin__ratings__user"
            />
          </div>
          <div class="d-flex flex-column mt-2 ml-2">
            <span class="font-spartan-small ">
              (0 Reviews)
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
    },
    data: () => ({
      rating: 0,
    }),
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
    margin-left: 20px
.margin__revews
    margin-left: 253px
.margin__value
    margin-top: 2px
    margin-left: 140px
.margin__headers__reviews
    margin-left: 228px !important
    margin-bottom: 10px
.margin__icon__share
    margin-left: 200px
</style>
