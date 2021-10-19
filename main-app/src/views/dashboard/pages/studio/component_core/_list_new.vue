<template>
  <v-container>
    <v-row>
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
              style="background-color: grey"
            >
              <v-container>
                <v-row>
                  <v-col
                    class="d-flex flex-row-reverse"
                    cols="12"
                  >
                    <v-icon
                      v-if="!computedIsLikeYou[i]"
                      color="red"
                      @click="like(item)"
                    >
                      mdi-heart-outline
                    </v-icon>
                    <v-icon
                      v-else
                      color="red"
                      @click="unLike(item)"
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
                <v-row class="cols_list_studio">
                  <v-col cols="12">
                    <span class="font-spartan white--text">
                      {{ item.name }}
                    </span>
                    <br>
                    <span
                      v-if="item.author"
                      class="font-spartan white--text"
                    >
                      Studio
                    </span>

                    <v-rating
                      :value="computedList[i]"
                      readonly
                      background-color="grey"
                      color="orange"
                      size="20"
                    />

                    <v-btn
                      small
                      width="190"
                      outlined
                      color="primary"
                      class="btn-expolore-studio"
                      @click="clickPush(item.slug)"
                    >
                      Explore
                    </v-btn>
                    <v-btn
                      v-if="!computedIsFollowingYou[i]"
                      small
                      width="100"
                      outlined
                      color="primary"
                      class="btn-expolore-studio ml-1"
                      @click="follow(item)"
                    >
                      Follow
                    </v-btn>
                    <v-btn
                      v-else
                      width="100"
                      small
                      color="primary"
                      class="btn-expolore-studio ml-1"
                      @click="unFolow(item)"
                    >
                      <v-tooltip
                        color="primary"
                        bottom
                      >
                        <template #activator="{on, attrs}">
                          <v-icon
                            v-bind="attrs"
                            v-on="on"
                          >
                            mdi-account-check
                          </v-icon>
                        </template>
                        <span class="font-spartan-small">
                          Un Follow
                        </span>
                      </v-tooltip>
                    </v-btn>
                  </v-col>
                </v-row>
              </v-container>
            </v-img>
          </v-card>
        </v-hover>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
  export default {
    props: {
      data: {
        type: Array,
        default: () => [],
      },
      user: {
        type: Object,
        default: null,
      },
    },
    computed: {
      computedList () {
        const arrayReviews = []
        // eslint-disable-next-line no-unused-vars
        for (const item in this.data) {
          if (Object.hasOwnProperty.call(this.data, item)) {
            const studio = this.data[item]
            let newReviews = []
            newReviews = studio.reviews
            const count = newReviews.map(x => x.ratings)
            if (count.length !== 0) {
              const sum = count.filter(x => x > 0).reduce((x, y) => x + y)
              const avarage = sum / count.length

              arrayReviews.push(avarage)
            }
          }
        }
        return arrayReviews
      },
      computedIsFollowingYou () {
        let booleanArr = null
        const finalBool = []
        let boolFoll = false

        if (this.data.length > 0) {
          booleanArr = this.data.filter(x => x.followers)
          //   console.log(booleanArr)

          // eslint-disable-next-line no-unused-vars
          for (const item in booleanArr) {
            if (Object.hasOwnProperty.call(booleanArr, item)) {
              const list = booleanArr[item]
              const followers = list.followers

              if (followers !== undefined) {
                if (followers.length === 0) {
                  boolFoll = false
                }
                if (followers) {
                  // eslint-disable-next-line no-unused-vars
                  for (const item in followers) {
                    if (Object.hasOwnProperty.call(followers, item)) {
                      const x = followers[item]
                      boolFoll = x.id === this.user.id
                    }
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
        let dataStudioFilter = null
        const finalBool = []
        let boolFoll = false
        if (this.data.length > 0) {
          dataStudioFilter = this.data.filter(x => x.likes)

          // eslint-disable-next-line no-unused-vars
          for (const item in dataStudioFilter) {
            if (Object.hasOwnProperty.call(dataStudioFilter, item)) {
              const studio = dataStudioFilter[item]

              const likes = studio.likes
              if (likes.length === 0) {
                boolFoll = false
              }
              if (likes) {
                // eslint-disable-next-line no-unused-vars
                for (const item in likes) {
                  if (Object.hasOwnProperty.call(likes, item)) {
                    const x = likes[item]
                    boolFoll = x.id === this.user.id
                  }
                }
              }
              finalBool.push(boolFoll)
            }
          }
        }
        return finalBool
      },
    },
    mounted () {
    //   console.log(this.computedIsLikeYou)
    },
    methods: {
      like (item) {
        this.$emit("like", { item: item })
        const index = this.data.findIndex(x => x.id === item.id)
        if (index !== -1) {
          this.computedIsLikeYou.splice(index, 1, true)
        }
      },
      unLike (item) {
        this.$emit("unLike", { item: item })
        const index = this.data.findIndex(x => x.id === item.id)
        if (index !== -1) {
          this.computedIsLikeYou.splice(index, 1, false)
        }
      },
      clickPush (slug) {
        this.$router.push(`/${slug}/home`)
      },
      clickSHow (item) {
        item.show = !item.show
      },
      follow (item) {
        this.$emit("follow", { item: item })
        const indexStudio = this.data.findIndex(x => x.id === item.id)
        if (indexStudio !== -1) {
          this.computedIsFollowingYou.splice(indexStudio, 1, true)
        }
      },
      unFolow (item) {
        this.$emit("unFollow", { item: item })
        const indexStudio = this.data.findIndex(x => x.id === item.id)
        if (indexStudio !== -1) {
          this.computedIsFollowingYou.splice(indexStudio, 1, false)
        }
      },
    },
  }
</script>

<style lang="sass">
.cols_list_studio
    margin-top: 100px !important
.btn-expolore-studio
    margin-left: -2px
    // &:hover
    //     background-color: #9DC4D1
    //     color: white !important
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
