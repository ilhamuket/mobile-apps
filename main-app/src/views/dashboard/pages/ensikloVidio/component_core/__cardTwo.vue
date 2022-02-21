<template>
  <v-card>
    <div class="d-flex flex-row justify-end pr-2 pt-2">
      <div class="d-flex flex-column">
        <v-chip
          color="btn_primary"
          text-color="white"
          label
          class="text-center d-flex justify-end"
        >
          <span
            class="text-capitalize"
          ><v-icon class="mr-2">mdi-label-multiple</v-icon>Video</span>
        </v-chip>
      </div>
    </div>
    <v-card-title>
      <span class="font-spartan-text font-weight-bold primary--text">
        {{ data.name }}
      </span>
    </v-card-title>
    <v-card-subtitle
      v-if="data.studio"
      class="text-subtitle font-spartan size--customize mt-1"
    >
      {{ data.studio.name }}
    </v-card-subtitle>
    <v-card-text>
      <span class="font-spartan-small font__customize__price btn_primary--text">
        Rp{{ data.price }}
      </span>
      <v-divider class="mt-2 mb-2" />
      <v-tabs v-model="tabs">
        <v-tab> Detail </v-tab>
        <v-tab> Info </v-tab>
      </v-tabs>
      <v-tabs-items v-model="tabs">
        <v-tab-item class="font-spartan font__customize mt-4 ml-2">
          <app-tabs-one :data="data" />
        </v-tab-item>
        <v-tab-item class="font-spartan font__customize mt-4 ml-2">
          <app-tabs-one :data="data" />
        </v-tab-item>
      </v-tabs-items>
    </v-card-text>
    <v-divider class="mb-2 mt-2" />
    <v-card-text
      v-if="data.studio"
      class="mt-6"
    >
      <v-avatar v-if="data.studio.img">
        <v-img :src="data.studio.img.url" />
      </v-avatar>
      <v-avatar
        v-else
        size="48"
        color="btn_primary"
      >
        <span>{{ data.studio.name.charAt(0) }}</span>
      </v-avatar>
      <p
        v-if="data.studio"
        class="ml-2 font-spartan font__studio__title"
        style="cursor: pointer"
        @click="toPush(data.studio)"
      >
        {{ data.studio.name }}
      </p>
      <v-card-actions>
        <v-rating
          v-model="count"
          class="font__studio__start"
          small
          :length="count"
          readonly
        >
          <template v-slot:item="props">
            <v-icon
              :color="'orange'"
              small
              @click="props.click"
            >
              mdi-star-circle
            </v-icon>
          </template>
        </v-rating>
        <span class="font__studio__ratings orange--text"> ({{ count }}) </span>
      </v-card-actions>
      <v-btn
        v-if="computedIsFollowing"
        :class="'btn__studio'"
        small
        color="btn_primary"
      >
        Following
      </v-btn>
      <v-btn
        v-else
        :class="'btn__studio'"
        small
        color="btn_primary"
        outlined
      >
        Follow
      </v-btn>
    </v-card-text>
  </v-card>
</template>

<script>
  import tabsOne from "../components/__tabsOne.vue"
  export default {
    components: {
      "app-tabs-one": tabsOne,
    },
    props: {
      data: {
        type: Object,
        default: null,
      },
      user: {
        type: Object,
        default: null,
      },
    },
    data: () => ({
      tabs: null,
      rating: 4,
      isFollowYou: true,
      isMobile: false,
    }),
    computed: {
      count () {
        let value = 0
        if (this.data.studio) {
          if (this.data.studio.reviews) {
            const a = this.data.studio.reviews.map((x) => x.ratings)

            if (a.length > 0) {
              const sum = a.filter((x) => x > 0).reduce((x, y) => x + y)
              value = sum / this.data.studio.reviews.length
            }
          }
        }
        const x = parseFloat(value.toFixed(2))

        return x
      },
      computedIsFollowing () {
        let bool = false
        if (this.data.studio) {
          if (this.data.studio.followers) {
            bool = this.data.studio.followers.some((x) => x.id === this.user.id)
          }
        }
        return bool
      },
    },
    mounted () {
      this.onResize()
    },
    methods: {
      toPush (data) {
        this.$router.push(`/${data.slug}/home`)
      },
      onResize () {
        if (window.innerWidth < 883) this.isMobile = true
        else this.isMobile = false
      },
    },
  }
</script>

<style lang="sass" scoped>
.font__customize__title
    font-size: 1.28571rem !important
    font-weight: 900 !important
.size--customize
    font-size: 1rem !important
    line-height: 20px !important
.font__customize__price
    font-size: 2rem !important
    line-height: 34px !important
    font-weight: 650 !important
    margin-bottom: 4px !important
.v-bar__modified
    height: 40px !important
    font-family: 'Spartan', sans-serif !important
    // background-color: #ffff !important
.font-cutomize
    font-size: 15px !important
    font-family: 'Spartan', sans-serif !important
    margin-top: 20px !important
.font__customize
    font-size: 14px !important
.font__studio__start
  margin-left: 49px
  margin-top: -33px
.bg--title
    padding-top: 20px !important
    padding-left : 640px
.font__studio__title
    font-size: 13px !important
    margin-top: -41px
    margin-left: 69px !important
    font-weight: 900
.margin-studio-ratings
    font-size: 7px !important
    margin-top: -37px !important
    margin-left: 48px !important
    font-weight: 900
.font__studio__ratings
    font-size: 12px !important
    margin-top: -32px !important
    margin-left: -1px !important
    font-weight: 900
.btn__studio
    &__resize
      margin-left: 74%
      margin-top: -41%
    margin-top: -90px !important
    margin-left: 605px !important
    font-weight: 900
@media screen and (max-width: 887px)
  .btn__studio
    margin-top: -90px !important
    margin-left: 219px !important
    font-weight: 900
</style>
