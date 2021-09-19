<template>
  <v-card>
    <v-chip
      :color="setColorLabel(data.status_kelas)"
      text-color="white"
      label
      class="bg--title text-center"
    >
      <span
        class="text-center text-capitalize"
      ><v-icon class="mr-2">mdi-label-multiple</v-icon>{{ data.status_kelas }}</span>
    </v-chip>
    <v-card-title class="text-subtitle-2 font-spartan font__customize__title">
      {{ data.name }}
    </v-card-title>
    <v-card-subtitle class="text-subtitle font-spartan size--customize mt-1">
      {{ data.views }} People View This Class
    </v-card-subtitle>
    <v-card-text>
      <span class="text-subtitle-2 font-spartan font__customize__price">
        Rp{{ data.harga }}
      </span>
      <v-divider class="mt-2 mb-2" />
      <v-tabs
        v-model="tab"
        color="primary"
        align-with-title
        class="bg--white"
      >
        <v-tabs-slider color="primary" />

        <v-tab
          v-for="item in items"
          :key="item"
          class="font-spartan-small btn_primary--text"
        >
          {{ item }}
        </v-tab>
      </v-tabs>
      <v-tabs-items v-model="tab">
        <v-tab-item class="font-spartan font__customize mt-4 ml-2">
          <app-data-tabs-one :data="data" />
        </v-tab-item>
        <v-tab-item class="font-spartan font__customize mt-4 ml-2">
          <app-data-tabs-one :data="data" />
        </v-tab-item>
      </v-tabs-items>
    </v-card-text>
    <v-divider />
    <v-card-text class="">
      <v-avatar
        size="48"
        color="btn_primary"
      >
        <span>SJ</span>
      </v-avatar>
      <p
        v-if="data.studio"
        class="ml-2 font-spartan font__studio__title"
        style="cursor:pointer"
        @click="toPush(data.studio)"
      >
        {{ data.studio.name }}
      </p>
      <v-card-actions>
        <v-rating
          v-model="rating"
          class="font__studio__start"
          length="1"
          small
          readonly
        >
          <template v-slot:item="props">
            <v-icon
              :color="props.isFilled ? genColor(props.index) : 'grey lighten-1'"
              medium
              @click="props.click"
            >
              {{
                props.isFilled ? 'mdi-star-circle' : 'mdi-star-circle-outline'
              }}
            </v-icon>
          </template>
        </v-rating>
        <span class="font__studio__ratings orange--text">
          ({{ rating }} ,200 Reviews)
        </span>
      </v-card-actions>
      <v-btn
        v-if="isFollowYou"
        class="btn__studio"
        small
        color="btn_primary"
        outlined
      >
        Following
      </v-btn>
      <v-btn
        v-else
        class="btn__studio"
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
  import tabsOne from '../components/__tabsOne.vue'
  export default {
    components: {
      'app-data-tabs-one': tabsOne,
    },
    props: {
      data: {
        type: Object,
        default: null,
      },
      me: {
        type: Object,
        default: null,
      },
    },
    data: () => ({
      tab: null,
      items: ['Detail', 'Info'],

      colors: ['orange'],
      rating: 4.5,
    }),

    computed: {
      isFollowYou () {
        let boolean = false
        if (this.data.studio.followers !== undefined) {
          boolean = this.data.studio.followers.some(x => x.id === this.me.id)
        }

        return boolean
      },
      isLikesYou () {
        let boolean = false
        if (this.data.likes !== undefined) {
          boolean = this.data.studio.likes.some(x => x.id === this.me.id)
        }

        return boolean
      },
    },

    watch: {},
    mounted () {
    // console.log(this.data.studio.followers.some(x => x.id === this.me.id))
    // this.breadcumbsPush()
    //   console.log(this.$route)
    },
    methods: {
      folow (item) {
        this.$emit('inputFollow', { item: item })
      },
      unfoll (item) {
        this.$emit('inputUnfoll', { item: item })
      },
      setColorLabel (item) {
        if (item === 'ongoing') return 'btn_primary'
        if (item === 'upcoming') return 'primary'
        else return 'red'
      },
      genColor (i) {
        return this.colors[i]
      },
      toPush (data) {
        this.$router.push(`/${data.slug}/home`)
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
    font-weight: 800 !important
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
.bg--title
    margin-top: 20px !important
    margin-left: 640px
.font__studio__title
    font-size: 13px !important
    margin-top: -41px
    margin-left: 69px !important
    font-weight: 900
.font__studio__start
    font-size: 7px !important
    margin-top: -37px
    margin-left: 48px !important
    font-weight: 900
.font__studio__ratings
    font-size: 12px !important
    margin-top: -36px !important
    margin-left: -1px !important
    font-weight: 900
.btn__studio
    margin-top: -90px !important
    margin-left: 605px !important
    font-weight: 900
// .theme--light
//     .v-tabs
</style>
