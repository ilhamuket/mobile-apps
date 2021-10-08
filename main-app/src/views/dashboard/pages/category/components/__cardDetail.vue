<template>
  <v-card>
    <v-row>
      <v-col
        cols="12"
        md="6"
        sm="6"
      >
        <v-row>
          <v-col
            v-resize="onResize"
            cols="12"
            md="2"
            sm="2"
            class="title_category"
            :class="isMobile ? 'title_category__mobile' : ''"
          >
            <v-avatar
              size="80"
              tile
              class="ml-2 rounded-xl"
            >
              <v-img src="http://127.0.0.1:8000/images/776290.jpg" />
            </v-avatar>
          </v-col>
          <v-col
            cols="12"
            md="9"
            sm="9"
            class="title__category"
          >
            <v-chip
              class="chip__category"
              color="transparent"
              text-color="btn_primary"
              outlined
            >
              {{ category.display_name }}
            </v-chip>
            -
            <v-chip
              v-if="category.studio"
              class="chip__category"
              color="transparent"
              text-color="btn_primary"
              outlined
            >
              {{ category.studio.name }}
            </v-chip>
            <br>
            <v-btn
              v-if="!isFollowYoU"
              small
              color="btn_primary"
              class="mt-2"
              width="200"
              outlined
              rounded
            >
              Follow
            </v-btn>
            <v-btn
              v-else
              small
              color="btn_primary"
              class="mt-2"
              width="198"
              rounded
            >
              Following
            </v-btn>
            <v-btn
              small
              color="btn_primary"
              class="mt-2 ml-1"
              width="200"
              outlined
              rounded
            >
              <v-icon>
                mdi-heart-outline
              </v-icon>
            </v-btn>
          </v-col>
        </v-row>
      </v-col>
      <v-col
        cols="12"
        md="6"
        sm="6"
      >
        <v-row>
          <v-col cols="12">
            <v-chip
              v-if="category.class"
              color="transparent"
              text-color="btn_primary"
              class="chip__category__class mt-2"
            >
              {{ category.class.length }} Class -
              {{ category.follow.length }} Followers
            </v-chip>
            <br>
            <span class="font-spartan-small value__ratings">
              ({{ ratings.float }})
            </span>
            <v-rating
              class="chip__category__ratings"
              :value="ratings.avarage"
              readonly
              background-color="grey"
              color="orange"
              size="20"
            />
          </v-col>

          <!-- <span class="chip__category__ratings__reviews">
            (2 Reviews)
          </span> -->
        </v-row>
      </v-col>
    </v-row>
  </v-card>
</template>

<script>
  export default {
    props: {
      category: {
        type: Object,
        default: null,
      },
      me: {
        type: Object,
        default: null,
      },
      ratings: {
        type: Object,
        default: null,
      },
    },
    data: () => ({
      isMobile: false,
    }),
    computed: {
      isFollowYoU () {
        let boolean = false
        if (this.category.follow !== undefined) {
          boolean = this.category.follow.some(x => x.id === this.me.id)
        }
        return boolean
      },
    },

    methods: {
      onResize () {
        if (window.innerWidth < 769) this.isMobile = true
        else this.isMobile = false
      },
    },
  }
</script>

<style lang="sass">
.title__category
  margin-left: 20px !important
  margin-top: 10px !important
  border-right: 1px double #ECEFF5 !important
.chip__category
  .v-chip__content
    font-size: 14px !important
.chip__category__class
  margin-left: 103px
  .v-chip__content
    font-size: 16px !important
.chip__category__ratings
  margin-left: 146px
  margin-top: -24px
.title_category__mobile
  margin-left: 170px
.value__ratings
  margin-left: 108px
  margin-top: 20px !important
.chip__category__ratings__reviews
  margin-left: 345px
  margin-top: -38px
</style>
