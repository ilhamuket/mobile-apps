<template>
  <div>
    <v-container>
      <v-row>
        <v-col
          class=""
          cols="12"
        >
          <v-carousel
            v-if="classes.list_img"
            class="rounded-sm width--carousel ml-5"
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
            class="rounded-sm width--carousel ml-5"
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
    <v-container class="container--row justify-center">
      <v-row class="row__card">
        <v-col
          cols="12"
          class=""
        >
          <v-card>
            <v-card-title
              class="d-flex flex-row justify-center mobile__classname"
            >
              {{ classes.name ? classes.name : "Classes Name" }}
            </v-card-title>
            <v-card-text class="mt-2 d-flex justify-center mobile__cardtext">
              <span
                v-if="classes.studio"
                class="font-spartan mt-2 mobile__studioname"
              >
                {{ classes.studio.name }}
              </span>
              <v-chip
                color="transparent"
                class="mobile__ratings"
              >
                ({{ computedRatings }})
                <v-rating
                  :value="computedRatings"
                  color="orange"
                  background-color="grey"
                  half-increments
                  readonly
                />
                ({{ classes.studio ? classes.studio.reviews.length : 0 }}
                Reviews)
              </v-chip>
            </v-card-text>
            <!-- <v-card-text v-if="isMobile">

            </v-card-text> -->
            <v-card-text class="d-flex justify-center mobile__icon">
              <v-tooltip
                bottom
                color="blue"
              >
                <template #activator="{ on, attrs }">
                  <v-icon
                    v-bind="attrs"
                    class="icon__share hover__icon"
                    color="blue"
                    v-on="on"
                  >
                    mdi-facebook
                  </v-icon>
                </template>
                <span
                  v-if="classes.studio"
                  class="font-spartan-small"
                >
                  {{
                    classes.studio.username_fb
                      ? classes.studio.username_fb
                      : "Facebook"
                  }}
                </span>
              </v-tooltip>

              <v-tooltip
                bottom
                color="blue"
              >
                <template #activator="{ on, attrs }">
                  <v-icon
                    v-bind="attrs"
                    class="icon__share hover__icon"
                    color="red"
                    v-on="on"
                  >
                    mdi-instagram
                  </v-icon>
                </template>
                <span
                  v-if="classes.studio"
                  class="font-spartan-small"
                >
                  {{
                    classes.studio.username_ig
                      ? classes.studio.username_ig
                      : "Instagram"
                  }}
                </span>
              </v-tooltip>

              <v-tooltip
                bottom
                color="blue"
              >
                <template #activator="{ on, attrs }">
                  <v-icon
                    v-bind="attrs"
                    class="icon__share hover__icon"
                    color="blue"
                    v-on="on"
                  >
                    mdi-twitter
                  </v-icon>
                </template>
                <span
                  v-if="classes.studio"
                  class="font-spartan-small"
                >
                  {{
                    classes.studio.username_tw
                      ? classes.studio.username_tw
                      : "Twitter"
                  }}
                </span>
              </v-tooltip>
            </v-card-text>
            <v-card-actions class="d-flex justify-center mobile__actions">
              <v-btn
                color="btn_primary"
                class="mr-12"
                @click="openDialogRegister"
              >
                Register Class
              </v-btn>
            </v-card-actions>
            <v-card-actions class="d-flex justify-center mr-12 mobile__etc">
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
                v-if="yourWishlist === false"
                bottom
                color="btn_primary"
              >
                <template #activator="{ on, attrs }">
                  <v-btn
                    v-bind="attrs"
                    class="size__icon"
                    color="btn_primary"
                    icon
                    dark
                    v-on="on"
                    @click="pushWishlist(classes)"
                  >
                    <v-icon color="">
                      mdi-heart-outline
                    </v-icon>
                  </v-btn>
                </template>
                <span>WishList</span>
              </v-tooltip>
              <v-tooltip
                v-else
                bottom
                color="btn_primary"
              >
                <template #activator="{ on, attrs }">
                  <v-btn
                    v-bind="attrs"
                    class="size__icon"
                    color="btn_primary"
                    icon
                    dark
                    @click="deleteFromWishlist(classes)"
                    v-on="on"
                  >
                    <v-icon color="">
                      mdi-heart
                    </v-icon>
                  </v-btn>
                </template>
                <span class="font-spartan-small">Cancel on wish list</span>
              </v-tooltip>
              <v-tooltip
                bottom
                color="btn_primary"
              >
                <template #activator="{ on, attrs }">
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
                    {{ $t("ensiklolive.ppp") }}
                  </span>
                </div>
              </div>
              <div class="d-flex flex-row">
                <div class="d-flex flex-column">
                  <span class="font-spartan-price mt-2">
                    {{ $t("ensiklolive.slot") }} :
                    {{ computedClassUser.length }} / {{ classes.kapasitas }}
                  </span>
                </div>
              </div>
              <div class="d-flex flex-ro">
                <div class="d-flex flex-column">
                  <span class="font-spartan-price mt-2">
                    Started Class :
                    {{ classes.start_at | moment("MMMM Do YYYY") }}
                  </span>
                </div>
              </div>
              <div class="d-flex flex-row">
                <div class="d-flex flex-column">
                  <span
                    v-if="classes.time_start"
                    class="font-spartan-price mt-2"
                  >
                    {{ time(classes.time_start) }} ({{
                      classes.durasi ? classes.durasi : "-"
                    }}
                    {{ $t("minutes") }})
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
                icon="mdi-access-point-network"
                prominent
                class="mt-4"
              >
                <span class="font-weight-bold">
                  {{ $t("ensiklolive.title_desc") }}</span>
                <br>
                {{ $t("ensiklolive.desc") }}
              </v-alert>

              <div class="d-flex flex-row mt-12">
                <div class="d-flex flex-column">
                  <span class="font-spartan-about font-weight-bold">
                    {{ $t("ensiklolive.about") }}
                  </span>
                  <span class="font-spartan-about-text mt-2">
                    "{{ classes.about }}"
                  </span>
                </div>
              </div>

              <div class="d-flex flex-row mt-12">
                <div class="d-flex flex-column">
                  <span class="font-spartan-about font-weight-bold">
                    {{ $t("ensiklolive.note") }}
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
      :state-load="state_load"
      @send="replyDataDiscusses"
      @sendReply="replyDataDiscussesParent"
      @replyNesting="replyDataNestingDiscustion"
    />
    <app-dialog-form
      :dialog="register"
      :user="users"
      @input="submit"
    />
  </div>
</template>

<script>
  import discuss from "./components_core/_discuss.vue"
  import dialogForm from "./components/__dialogForm.vue"
  export default {
    components: {
      "app-discuss": discuss,
      "app-dialog-form": dialogForm,
    },
    data () {
      return {
        discuss: {
          meta: null,
          data: [],
          links: {},
        },
        register: {
          open: false,
        },
        page: 1,
        picker: new Date(Date.now() - new Date().getTimezoneOffset() * 60000)
          .toISOString()
          .substr(0, 10),
        state_load: false,
        user: {},
        class_id: 0,
        isMobile: false,
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
        const Me = localStorage.getItem("ME")
        const users = JSON.parse(Me)
        return users
      },
      yourWishlist () {
        let bool = false
        if (this.classes) {
          if (this.classes.wishlist) {
            bool = this.classes.wishlist.some((x) => x.id === this.user.id)
            console.log("bool : ", bool)
          }
        }
        return bool
      },
      computedRatings () {
        let value = 0
        if (this.classes.studio) {
          const ratings = this.classes.studio.reviews.map((x) => x.ratings)
          if (ratings.length > 0) {
            const sum = ratings.filter((x) => x > 0).reduce((x, y) => x + y, 0)
            value = sum / this.classes.studio.reviews.length
          }
        }
        return value
      },
      computedClassUser () {
        return this.$store.state.classes.class_user
      },
    },
    created () {
      this.getDataClassesBySlug()
      this.getDataDiscuss()
      this.scroll()
      this.getMe()
      this.getDataClassHasUser()
      this.onResize()
    },
    methods: {
      // get Dom

      time (val) {
        if (val !== null) {
          const nameArray = val.split(":")
          nameArray.splice(2, 1)
          const newName = nameArray.join(":")
          return newName
        }
      },

      openDialogRegister () {
        this.register.open = true
      },

      submit ({ item }) {
        console.log(item)
        this.$store
          .dispatch("my_class/formRegister", {
            name: item.fullname,
            contact: item.contact,
            email: item.email,
            ttl: item.ttl,
            address: item.address,
            class_id: this.class_id,
          })
          .then((res) => {
            if (res.data.meta.status) {
              this.$router.push("/cart")
              this.register.open = false
              const Toast = this.$swal.mixin({
                toast: true,
                position: "bottom-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                  toast.addEventListener("mouseenter", this.$swal.stopTimer)
                  toast.addEventListener("mouseleave", this.$swal.resumeTimer)
                },
                popup: "swal2-show",
                backdrop: "swal2-backdrop-show",
                icon: "swal2-icon-show",
              })
              Toast.fire({
                icon: "success",
                title: "Process",
              })
            }
          })
      },

      scroll () {
        window.onscroll = () => {
          const bottomOfWindow =
            document.documentElement.scrollTop + window.innerHeight >=
            document.documentElement.offsetHeight - 150
          // console.log(bottomOfWindow)
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

      getMe () {
        this.$store
          .dispatch("user/me", {
            entities: "wishlist",
          })
          .then((res) => {
            if (res.data.meta.status) {
              this.user = res.data.data
            // console.log(this.user)
            }
          })
      },

      moreDiscuss () {
        if (this.discuss.links.next) {
          this.page++
          this.getDataDiscuss(this.page)
        }
      },

      getDataClassesBySlug () {
        this.$store
          .dispatch("classes/getDataClassesBySlug", {
            entities:
              "listImg,img,studio.followers,category,wishlist,studio.reviews",
            slug: this.$route.params.class_slug,
            studio_slug: this.$route.params.studio_slug,
            keyword: this.$route.params.keyword,
          })
          .then((res) => {
            this.class_id = res.data.data.id
          })
      },

      getDataClassHasUser () {
        this.$store
          .dispatch("classes/getDataClassHasUser", {
            slug: this.$route.params.keyword,
          })
          .then((res) => {
            console.log(res.data.data.length)
          })
      },

      getDataDiscuss (page) {
        this.$store
          .dispatch("studioDiscuses/getDataDiscusses", {
            class_slug: this.$route.params.class_slug,
            entities:
              "class,user.img,child.user.img, child.class,child.user.studio.img",
            page: page,
            parent: "null",
          })
          .then((res) => {
            if (res.data.meta.status) {
              this.state_load = true
              this.discuss.meta = res.data.meta
              this.discuss.links = res.data.links
              if (
                page === 1 &&
                this.computedDiscuss.id !== this.discuss.data.id
              ) {
                this.discuss.data = res.data.data
                this.state_load = false
              } else {
                this.discuss.data.push(...res.data.data)
                this.state_load = false
              }
            }
          })
      },
      replyDataDiscusses ({ item }) {
        this.$store
          .dispatch("studioDiscuses/replyDataDiscusses", {
            body: item,
            slug: this.$route.params.class_slug,
          })
          .then((res) => {
            if (res.data.meta.status) {
              this.discuss.data.unshift(res.data.data)
            }
            item = ""
          })
      },
      replyDataDiscussesParent ({ item }) {
        this.$store
          .dispatch("studioDiscuses/replyDataDiscusses", {
            body: item.content,
            slug: this.$route.params.class_slug,
            parent_id: item.data.id,
          })
          .then((res) => {
            if (res.data.meta.status) {
              const index = this.discuss.data.findIndex(
                (x) => x.id === item.data.id,
              )
              // console.log(index)
              if (index !== -1) {
                this.discuss.data[index].child.unshift(res.data.data)
              // this.getDataDiscuss()
              }
              item.content = ""
            }
          })
      },

      replyDataNestingDiscustion ({ item }) {
        // console.log(item)
        // console.log(`@${item.data.user.nickName} ${item.content}`)
        this.$store
          .dispatch("studioDiscuses/replyDataDiscusses", {
            body: `@${item.data.user.nickName} ${item.content}`,
            slug: this.$route.params.class_slug,
            parent_id: item.parent_id,
          })
          .then((res) => {
            if (res.data.meta.status) {
              const index = this.discuss.data.findIndex(
                (x) => x.id === item.parent_id,
              )
              // console.log(index)
              if (index !== -1) {
                this.discuss.data[index].child.push(res.data.data)
              }
              item.content = ""
            }
          })
      },
      pushWishlist (item) {
        this.$store
          .dispatch("etc/pushWishlist", {
            id: item.id,
          })
          .then((res) => {
            if (res.data.meta.status) {
              const Toast = this.$swal.mixin({
                toast: true,
                position: "bottom-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                  toast.addEventListener("mouseenter", this.$swal.stopTimer)
                  toast.addEventListener("mouseleave", this.$swal.resumeTimer)
                },
                popup: "swal2-show",
                backdrop: "swal2-backdrop-show",
                icon: "swal2-icon-show",
              })
              Toast.fire({
                icon: "success",
                title: "Add Wishlist Successfully",
              })
              this.getDataClassesBySlug()
            }
          })
      },
      deleteFromWishlist (item) {
        console.log("tai")
        this.$store
          .dispatch("etc/deleteFromWishlist", {
            id: item.id,
          })
          .then((res) => {
            if (res.data.meta.status) {
              const Toast = this.$swal.mixin({
                toast: true,
                position: "bottom-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                  toast.addEventListener("mouseenter", this.$swal.stopTimer)
                  toast.addEventListener("mouseleave", this.$swal.resumeTimer)
                },
                popup: "swal2-show",
                backdrop: "swal2-backdrop-show",
                icon: "swal2-icon-show",
              })
              Toast.fire({
                icon: "success",
                title: "Delete Item Successfully",
              })
              this.getDataClassesBySlug()
            }
          })
      },
      onResize () {
        if (window.innerWidth < 883) this.isMobile = true
        else this.isMobile = false
      },
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
    // margin-right: 200px !important
    // width: 1163px
.row__card
    // width: 1270px
    margin-left: 32px
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
.hover__icon
  &:hover
    transform: scale(1.1)
    cursor: pointer
@media screen and (max-width: 500px)
  .row__card
    // width: 100% !important
    // margin-left: 32px
    .v-card
      .mobile
        &__studioname
          margin-left: 33%
          margin-top: 10%
          margin-bottom: 10%
        &__ratings
          margin-left: 12% !important
          margin-top: 4%
          margin-bottom: 4%
        &__icon
          padding-left: 16%
        &__actions
          padding-left: 16%
        &__etc
          padding-left: 16%
</style>
