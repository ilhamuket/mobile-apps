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
              {{ category.display_name ? category.display_name : "Category I" }}
            </v-chip>
            -
            <v-chip
              class="chip__category"
              color="transparent"
              text-color="btn_primary"
              outlined
            >
              {{ category.studio ? category.studio.name : "Studio Name" }}
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
              @click="followCategory(category)"
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
              @click="unFollowCategory(category)"
            >
              Following
            </v-btn>
            <v-btn
              v-if="!isLikesCategory"
              small
              color="btn_primary"
              class="mt-2 ml-1"
              width="200"
              outlined
              rounded
              @click="likes(category)"
            >
              <v-tooltip
                bottom
                color="btn_primary"
              >
                <template #activator="{ on, attrs }">
                  <v-icon
                    v-bind="attrs"
                    v-on="on"
                  >
                    mdi-heart-outline
                  </v-icon>
                </template>
                <span class="font-spartan-small"> Like Category </span>
              </v-tooltip>
            </v-btn>
            <v-btn
              v-else
              small
              color="btn_primary"
              class="mt-2 ml-1"
              width="200"
              rounded
              @click="unLikes(category)"
            >
              <v-tooltip
                bottom
                color="btn_primary"
              >
                <template #activator="{ on, attrs }">
                  <v-icon
                    v-bind="attrs"
                    v-on="on"
                  >
                    mdi-heart
                  </v-icon>
                </template>
                <span class="font-spartan-small"> Un-like Category </span>
              </v-tooltip>
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
              class="chip__category__class mt-6"
            >
              {{ category.class.length }} EnsikloLive -
              {{ category.video.length }} EnsikloVideo -
              {{ category.follow.length }} Followers
            </v-chip>
            <v-chip
              v-else
              color="transparent"
              text-color="btn_primary"
              class="chip__category__class mt-6"
            >
              0 EnsikloLive - 0 EnsikloVideo - 0 Followers
            </v-chip>
            <!-- <br> -->
            <!-- <span class="font-spartan-small value__ratings">
              ({{ ratings.float }})
            </span> -->
            <!-- <v-rating
              class="chip__category__ratings"
              :value="ratings.avarage"
              readonly
              background-color="grey"
              color="orange"
              size="20"
            /> -->
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
          boolean = this.category.follow.some((x) => x.id === this.me.id)
        }
        return boolean
      },
      isLikesCategory () {
        let boolean = false
        if (this.category.likes !== undefined) {
          boolean = this.category.likes.some((x) => x.id === this.me.id)
        }
        return boolean
      },
    },

    methods: {
      onResize () {
        if (window.innerWidth < 769) this.isMobile = true
        else this.isMobile = false
      },
      followCategory (category) {
        this.$emit("follow", { item: category })
      },
      unFollowCategory (category) {
        this.$emit("un-follow", { item: category })
      },
      likes (category) {
        this.$emit("likes", { item: category })
      },
      unLikes (category) {
        this.$emit("unLikes", { item: category })
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
