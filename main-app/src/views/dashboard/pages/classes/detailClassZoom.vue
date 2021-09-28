<template>
  <div>
    <v-container fluid>
      <v-row>
        <v-col
          class=""
          cols="12"
        >
          <v-carousel
            v-if="classes.list_img"
            class="rounded-xl width--carousel ml-5"
          >
            <v-carousel-item
              v-for="(item, i) in classes.list_img"
              :key="i"
              :src="item.url"
              :continuous="true"
              :show-arrows="true"
              hide-delimiter-background
              show-arrows-on-hover
              delimiter-icon="mdi-minus"
            />
          </v-carousel>
          <v-carousel
            v-else
            class="rounded-xl width--carousel ml-5"
          >
            <!-- <v-carousel-item
              v-for="(item, i) in items"
              :key="i"
              :src="item.src"
              :continuous="true"
              :show-arrows="true"
              hide-delimiter-background
              delimiter-icon="mdi-minus"
            /> -->
          </v-carousel>
        </v-col>
      </v-row>
    </v-container>
    <v-container class="container--row">
      <v-row class="row__card">
        <v-col cols="12">
          <v-card>
            <v-card-title class="d-flex justify-center">
              {{ classes.name }} -
              <v-chip
                class="ml-2"
                outlined
                color="btn_primary"
              >
                EnsikloLive
              </v-chip>
            </v-card-title>
            <v-card-text class="mt-2 d-flex justify-center">
              <span
                v-if="classes.studio"
                class="font-spartan mt-2"
              >
                {{ classes.studio.name }}
              </span>
              <v-chip
                color="transparent"
                class="ml-2"
              >
                (4)
                <v-rating
                  :value="4"
                  color="orange"
                  background-color="grey"
                  half-increments
                  readonly
                />
                (200 Reviews)
              </v-chip>
            </v-card-text>
            <v-card-text class="d-flex justify-center">
              <v-icon
                class="icon__share"
                color="red"
              >
                mdi-instagram
              </v-icon>
              <v-icon
                class="icon__share"
                color="blue"
              >
                mdi-facebook
              </v-icon>
              <v-icon
                class="icon__share"
                color="blue"
              >
                mdi-twitter
              </v-icon>
            </v-card-text>
            <v-card-actions class="d-flex justify-center">
              <v-btn
                color="btn_primary"
                class="mr-12"
              >
                Register Class
              </v-btn>
            </v-card-actions>
            <v-card-actions class="d-flex justify-center mr-12">
              <v-btn
                class="size__icon"
                color="btn_primary"
                icon
                dark
              >
                <v-icon color="">
                  mdi-share-variant-outline
                </v-icon>
              </v-btn>
              <v-tooltip
                bottom
                color="btn_primary"
              >
                <template #activator="{on, attrs}">
                  <v-btn
                    v-bind="attrs"
                    class="size__icon"
                    color="btn_primary"
                    icon
                    dark
                    v-on="on"
                  >
                    <v-icon color="">
                      mdi-heart-outline
                    </v-icon>
                  </v-btn>
                </template>
                <span>WishList</span>
              </v-tooltip>
              <v-tooltip
                bottom
                color="btn_primary"
              >
                <template #activator="{on, attrs}">
                  <v-btn
                    v-bind="attrs"
                    color="btn_primary"
                    icon
                    dark
                    v-on="on"
                  >
                    <v-icon color="">
                      mdi-cart-outline
                    </v-icon>
                  </v-btn>
                </template>
                <span>cart</span>
              </v-tooltip>
            </v-card-actions>
          </v-card>
          <v-divider />
          <v-card class="card__detail">
            <v-card-text class="">
              <div class="d-flex flex-row mt-2">
                <div class="d-flex flex-column">
                  <span class="font-spartan">
                    Price Per Person
                  </span>
                </div>
              </div>
              <div class="d-flex flex-row">
                <div class="d-flex flex-column">
                  <span class="font-spartan-price mt-2">
                    Slot : 0 / {{ classes.kapasitas }}
                  </span>
                </div>
              </div>
              <div class="d-flex flex-row">
                <div class="d-flex flex-column">
                  <span
                    v-if="classes.time_start"
                    class="font-spartan-price mt-2"
                  >
                    {{ time(classes.time_start) }} (60 Minutes)
                  </span>
                </div>
              </div>
              <div class="d-flex flex-row">
                <div class="d-flex flex-column">
                  <span class="font-spartan-price btn_primary--text mt-2">
                    Rp {{ classes.harga }}
                  </span>
                </div>
              </div>

              <v-alert
                type="info"
                text
                dense
                icon="mdi-signal-variant"
                prominent
                class="mt-4"
              >
                <span class="font-weight-bold"> This is a Zoom Live Class</span>
                <br>
                To enjoy the class, make sure you have internet service
              </v-alert>

              <div class="d-flex flex-row mt-12">
                <div class="d-flex flex-column">
                  <span class="font-spartan-about font-weight-bold ">
                    About This Class
                  </span>
                  <span class="font-spartan-about-text mt-2">
                    "{{ classes.about }}"
                  </span>
                </div>
              </div>

              <div class="d-flex flex-row mt-12">
                <div class="d-flex flex-column">
                  <span class="font-spartan-about font-weight-bold ">
                    Notes
                  </span>
                  <span class="font-spartan-about-text mt-2">
                    "{{ classes.about }}"
                  </span>
                </div>
              </div>
            </v-card-text>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
    <v-divider class="mt-2 mb-2" />
    <app-discuss
      :data="discuss.data"
      :me="users"
      @send="replyDataDiscusses"
    />
  </div>
</template>

<script>
  import discuss from './components_core/_discuss.vue'
  export default {
    components: {
      'app-discuss': discuss,
    },
    data () {
      return {
        discuss: {
          meta: null,
          data: [],
          links: {},
        },
        page: 1,
        picker: new Date(Date.now() - new Date().getTimezoneOffset() * 60000)
          .toISOString()
          .substr(0, 10),
      }
    },
    computed: {
      classes () {
        return this.$store.state.classes.dataBySlug
      },
      computedDiscuss () {
        return this.$store.state.studioDiscuses.data
      },
      users () {
        const Me = localStorage.getItem('ME')
        const users = JSON.parse(Me)
        return users
      },
    },
    mounted () {
      this.getDataClassesBySlug()
      this.getDataDiscuss()
      this.scroll()
    // this.getMe()
    // console.log(this.classes.list_img)
    },
    methods: {
      time (val) {
        if (val !== null) {
          const nameArray = val.split(':')
          nameArray.splice(2, 1)
          const newName = nameArray.join(':')
          return newName
        }
      },
      scroll () {
        window.onscroll = () => {
          const bottomOfWindow =
            document.documentElement.scrollTop + window.innerHeight >=
            document.documentElement.offsetHeight
          console.log(bottomOfWindow)
          // console.log('heightOfsset : ', document.documentElement.offsetHeight)
          // console.log(
          //   'scroll : ',
          //   document.documentElement.scrollTop + window.innerHeight,
          // )

          // setTimeout(() => {
          if (bottomOfWindow) {
            // setTimeout(() => {
            this.moreDiscuss()
          // this.resize()
          // }, 3000)
          }
        // }, 3000)
        }
      },

      moreDiscuss () {
        if (this.discuss.links.next) {
          this.page++
          this.getDataDiscuss(this.page)
        }
      },

      getDataClassesBySlug () {
        this.$store.dispatch('classes/getDataClassesBySlug', {
          entities: 'listImg,img,studio.followers,category',
          slug: this.$route.params.class_slug,
          studio_slug: this.$route.params.studio_slug,
        })
      },
      getDataDiscuss (page) {
        this.$store
          .dispatch('studioDiscuses/getDataDiscusses', {
            class_slug: this.$route.params.class_slug,
            entities: 'class,user.img,child.user.img, child.class',
            page: page,
          })
          .then(res => {
            if (res.data.meta.status) {
              this.discuss.meta = res.data.meta
              this.discuss.links = res.data.links
              if (
                page === 1 &&
                this.computedDiscuss.id !== this.discuss.data.id
              ) {
                this.discuss.data = res.data.data
              } else {
                this.discuss.data.push(...res.data.data)
              // this.is_load = false
              }
            }
          })
      },
      replyDataDiscusses ({ item }) {
        this.$store
          .dispatch('studioDiscuses/replyDataDiscusses', {
            body: item,
            slug: this.$route.params.class_slug,
          })
          .then(res => {
            if (res.data.meta.status) {
              item = ''
              this.discuss.data.unshift(res.data.data)
            // this.getDataDiscuss()
            }
          })
      },
    // getMe () {
    //   this.$store.dispatch('user/me')
    // },
    },
  }
</script>

<style lang="sass">
.container--row
    margin-top: -100px
.width--carousel
    .v-carousel__controls
        background-color: transparent !important
        height: 142px
        margin-right: 200px !important
        // width: 1163px
.row__card
    width: 1270px
    margin-left: -32px
    .v-card
        // height: 100px
    .ratings__users
        margin-left: 138px
        margin-top: -27px
    .icon__share
        margin-top: -10px
        margin-right: 52px
        font-size: 30px
        margin-bottom: 10px
    .card__detail
        margin-top: -6px
    .ensiklo_chips
        width: 90px
        .v-chip__content
            margin-left: 16px
            font-size: 12px
    .font-spartan-price
        font-size: 16px
        font-weight: bold
    .alert-font
        font-size: 16px !important
    .font-spartan-about
        font-size: 15px
    .font-spartan-about-text
        font-size: 14px
    .size__icon
        font-size: 31px !important
.list__item
    .v-chip
        &:hover
            background-color: red
</style>
