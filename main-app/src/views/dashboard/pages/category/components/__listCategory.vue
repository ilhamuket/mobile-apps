<template>
  <v-container>
    <v-row v-if="data.length !== 0">
      <v-col
        v-for="(item, i) in data"
        :key="i"
        cols="12"
        md="4"
      >
        <v-hover v-slot="{ hover }">
          <v-card
            :elevation="hover ? 12 : 2"
            :class="{ 'on-hover': hover }"
          >
            <v-img
              v-if="item.img"
              :src="item.img.url"
              width="400"
              height="276"
              gradient="to top right, rgba(0,0,0,.33), rgba(0,0,0,.7)"
            >
              <v-container>
                <v-row>
                  <v-col
                    class="d-flex flex-row-reverse cols__icon"
                    cols="12"
                  >
                    <v-icon
                      v-if="!computedIsLikeYou[i]"
                      color="primary"
                      class="hover__icon"
                      @click="likeCategory(item)"
                    >
                      mdi-heart-outline
                    </v-icon>
                    <v-icon
                      v-if="computedIsLikeYou[i]"
                      color="red"
                      class="hover__icon"
                      @click="unLikeCategory(item)"
                    >
                      mdi-heart
                    </v-icon>
                    <v-icon
                      class="mr-2"
                      color="primary"
                    >
                      mdi-share-variant
                    </v-icon>
                  </v-col>
                </v-row>
                <v-row class="cols__list_category">
                  <v-col cols="12">
                    <span class="font-spartan white--text">
                      {{ item.display_name }}
                    </span>
                    <br>
                    <span
                      v-if="item.studio"
                      class="font-spartan white--text"
                    >
                      {{ item.studio.name }}
                    </span>
                    <br>
                    <!-- <v-rating
                      class="chip__category__ratings"
                      :value="2"
                      background-color="grey"
                      color="primary"
                      size="20"
                    /> -->

                    <v-btn
                      small
                      outlined
                      width="200"
                      color="primary"
                      class=""
                      @click="
                        toPush(
                          `/category/detail/${item.studio.slug}/${item.slug}/ensiklo-live`
                        )
                      "
                    >
                      Explore
                    </v-btn>
                    <v-btn
                      v-if="!isFollowYouComputed[i]"
                      small
                      outlined
                      color="primary"
                      class="ml-1"
                      @click="followCategory(item)"
                    >
                      Follow
                    </v-btn>
                    <v-btn
                      v-else
                      small
                      color="btn_primary"
                      class="ml-1"
                      @click="unFollowCategory(item)"
                    >
                      Following
                    </v-btn>
                  </v-col>
                </v-row>
              </v-container>
            </v-img>
            <v-img
              v-else-if="item.studio"
              src="http://localhost:8081/img/ensiklotariLogo.bf423a85.svg"
              gradient="to top right, rgba(0,0,0,.7), rgba(0,0,0,.7)"
              width="400"
              height="276"
            >
              <v-container>
                <v-row>
                  <v-col
                    class="d-flex flex-row-reverse cols__icon"
                    cols="12"
                  >
                    <v-icon
                      v-if="!computedIsLikeYou[i]"
                      color="primary"
                      class="hover__icon"
                      @click="likeCategory(item)"
                    >
                      mdi-heart-outline
                    </v-icon>
                    <v-icon
                      v-if="computedIsLikeYou[i]"
                      color="red"
                      class="hover__icon"
                      @click="unLikeCategory(item)"
                    >
                      mdi-heart
                    </v-icon>
                    <v-icon
                      class="mr-2"
                      color="primary"
                    >
                      mdi-share-variant
                    </v-icon>
                  </v-col>
                </v-row>
                <v-row class="cols__list_category">
                  <v-col cols="12">
                    <span class="font-spartan white--text">
                      {{ item.display_name }}
                    </span>
                    <br>
                    <span
                      v-if="item.studio"
                      class="font-spartan white--text"
                    >
                      {{ item.studio.name }}
                    </span>
                    <br>
                    <!-- <v-rating
                      class="chip__category__ratings"
                      :value="2"
                      background-color="grey"
                      color="primary"
                      size="20"
                    /> -->
                    <v-btn
                      small
                      outlined
                      color="primary"
                      width="200"
                      class="btn_explore"
                    >
                      Explore
                    </v-btn>
                    <v-btn
                      v-if="!isFollowYouComputed[i]"
                      small
                      outlined
                      color="primary"
                      class="ml-1 btn_explore"
                      @click="followCategory(item)"
                    >
                      Follow
                    </v-btn>
                    <v-btn
                      v-else
                      small
                      color="btn_primary"
                      class="ml-1 btn_explore"
                      @click="unFollowCategory(item)"
                    >
                      Following
                    </v-btn>
                  </v-col>
                </v-row>
              </v-container>
            </v-img>
          </v-card>
        </v-hover>
      </v-col>
    </v-row>
    <v-row v-else>
      <v-col
        cols="12"
        class="d-flex justify-center"
      >
        <span class="font-spartan font-capitalize"> data not available </span>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
  export default {
    props: {
      data: {
        type: Array,
        default: null,
      },
      me: {
        type: Object,
        default: null,
      },
    },
    data: () => ({
      isTrue: false,
    }),
    computed: {
      isFollowYouComputed () {
        let booleanArr = null
        const finalBool = []
        let boolFoll = false
        if (this.data.length > 0) {
          booleanArr = this.data.filter((x) => x.follow)
          /* eslint-disable no-unused-vars */
          for (const item in booleanArr) {
            if (Object.hasOwnProperty.call(booleanArr, item)) {
              const isFollow = booleanArr[item]
              const contain = isFollow.follow
              if (contain.length === 0) {
                boolFoll = false
              }
              if (contain) {
                for (const item in contain) {
                  if (Object.hasOwnProperty.call(contain, item)) {
                    const x = contain[item]
                    boolFoll = x.id === this.me.id
                  }
                }
              }
              finalBool.push(boolFoll)
            }
          }
        }

        return finalBool
      },
      computedIsLikeYou () {
        const arr = []
        let boolLikes = false
        if (this.data.length > 0) {
          const booleanArr = this.data.filter((x) => x.likes)
          for (const item in booleanArr) {
            if (Object.hasOwnProperty.call(booleanArr, item)) {
              const likes = booleanArr[item]
              const itemLikes = likes.likes
              // console.log(itemLikes.length)
              if (itemLikes.length === 0) {
                boolLikes = false
              } else {
                for (const item in itemLikes) {
                  if (Object.hasOwnProperty.call(itemLikes, item)) {
                    const x = itemLikes[item]
                    boolLikes = x.id === this.me.id
                  }
                }
              }
              arr.push(boolLikes)
            }
          }
        }
        return arr
      },
    },
    mounted () {
      console.log(this.computedIsLikeYou)
    },
    methods: {
      isFollowingYou (item) {
        let boolean = false

        if (item.follow !== undefined) {
          boolean = item.follow.some((x) => x.id === this.me.id)
        }

        return boolean
      },
      toPush (link) {
        this.$router.push(link)
      },
      followCategory (item) {
        this.$emit("follow", { item: item })
        const indexCategory = this.data.findIndex((x) => x.id === item.id)
        // console.log(indexCategory)
        if (indexCategory !== -1) {
          this.isFollowYouComputed.splice(indexCategory, 1, true)
        }
      },
      unFollowCategory (item) {
        this.$emit("unfollow", { item: item })
        const indexCategory = this.data.findIndex((x) => x.id === item.id)
        // console.log(indexCategory)
        if (indexCategory !== -1) {
          this.isFollowYouComputed.splice(indexCategory, 1, false)
        }
      },
      likeCategory (item) {
        this.$emit("like", { item: item })
        const indexCategory = this.data.findIndex((x) => x.id === item.id)
        if (indexCategory !== -1) {
          this.computedIsLikeYou.splice(indexCategory, 1, true)
        }
      },
      unLikeCategory (item) {
        this.$emit("unLike", { item: item })
        const indexCategory = this.data.findIndex((x) => x.id === item.id)
        if (indexCategory !== -1) {
          this.computedIsLikeYou.splice(indexCategory, 1, false)
        }
      },
    },
  }
</script>

<style lang="sass">
.cols__list_category
    margin-top: 120px !important
.btn_explore
    margin-top: 15px
.hover__icon
  &:hover
    transform: scale(1.5)
</style>
<style scoped>
.v-card {
  transition: opacity 0.7s ease-in-out;
}

.v-card:not(.on-hover) {
  opacity: 1;
}
.v-card:hover {
  opacity: 0.9;
  cursor: pointer;
}

.show-btns {
  color: rgba(255, 255, 255, 1) !important;
}
</style>
