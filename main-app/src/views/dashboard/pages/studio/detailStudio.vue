<template>
  <div>
    <v-container v-if="isLoad">
      <loader
        object="#ff9633"
        color1="#ffffff"
        color2="#24e544"
        size="5"
        speed="2"
        bg="#343a40"
        objectbg="#e79b04"
        opacity="52"
        disable-scrolling="false"
        name="dots"
      />
      <v-row>
        <v-col
          cols="12"
          md="12"
        >
          <v-skeleton-loader
            v-bind="attrs"
            type="date-picker"
          />
        </v-col>

        <v-col cols="12">
          <v-skeleton-loader
            v-bind="attrs"
            type="list-item-avatar, divider, list-item-three-line, card-heading, image, actions"
          />

          <v-skeleton-loader
            v-bind="attrs"
            type="list-item-avatar-three-line, image, article"
          />
        </v-col>
      </v-row>
    </v-container>
    <v-container v-else>
      <v-row class="d-flex justify-center">
        <v-col cols="12">
          <app-studio-card-detail
            :data="computedStudio"
            :is-follow="isFollow"
            :me="computedMe"
            :ratings="ratings"
            :data-reviews="computedRatings"
            class="d-none d-md-flex"
            @inputFollow="followStudio"
            @inputUnfoll="popUpUnfollowNotice"
            @inputLike="likeStudio"
            @inputUnLike="unLikeStudio"
          />
          <app-studio-card-detail-mobile class="d-md-none" />
        </v-col>
      </v-row>
      <!-- <v-row>
        <v-col cols="12">
        </v-col>
      </v-row> -->

      <v-tabs
        v-model="tabs"
        color="btn_primary"
        class="font-spartan customize--tabs"
        show-arrows
      >
        <v-tab class="">
          Home
        </v-tab>
        <v-tab class="">
          {{ $t("studioPage.class") }}
        </v-tab>
        <v-tab> ensikloVidio </v-tab>
        <v-tab class="">
          {{ $t("instructor") }}
        </v-tab>
        <v-tab class="">
          {{ $t("studioPage.review") }}
        </v-tab>
      </v-tabs>
      <v-tabs-items v-model="tabs">
        <v-tab-item>
          <app-page-home
            :list="autoPlay"
            :list-vidios="listVidio"
            :tabs="tabs"
            @play="letsPlay"
          />
        </v-tab-item>
        <v-tab-item>
          <app-page-classes
            :classes="classes.data"
            :state-load="state_load"
            :studio-dates="studioDates"
            @fetchDate="fetchDate"
          />
        </v-tab-item>
        <v-tab-item>
          <app-page-ensiklovideo :data="dataEnsikloVidio.data" />
        </v-tab-item>
        <v-tab-item>
          <app-page-instructor :item="computedHasInstructor" />
        </v-tab-item>
        <v-tab-item>
          <app-page-reviews
            :reviews="computedReviews"
            :value="valueReviews"
            :meta="meta"
            :review="computedRatings"
            @paginate="nextPagination"
          />
        </v-tab-item>
      </v-tabs-items>
    </v-container>
    <app-dialog-page-two :dialog="dialogSeeMore" />
    <app-dialog-notice
      :dialog="dialogUnFollow"
      @input="executeUnfollowStudio"
    />
  </div>
</template>

<script>
  import topCardDetails from "./component_core/_cardDetailStudio.vue"
  import pageHome from "./childPages/_pageHome.vue"
  import pageClasses from "./childPages/_pageClasses.vue"
  import pageReviews from "./childPages/_pageReviews.vue"
  import dialogLearnMore from "./childPages/component/__dialogLearnMore.vue"
  import dialogNotice from "./childPages/component/__dialogNotice.vue"
  import pageInstructor from "./childPages/_pageInstructor.vue"
  import pageEnsikloVideo from "./childPages/_pageEnsikloVideo.vue"
  // import cardDetail from './component_core/_detailCardStudio.vue'
  export default {
    components: {
      "app-studio-card-detail": topCardDetails,
      "app-studio-card-detail-mobile": () =>
      import("./component_core/_cardDetailStudioMobile.vue"),
      "app-page-home": pageHome,
      "app-page-classes": pageClasses,
      "app-page-reviews": pageReviews,
      "app-dialog-page-two": dialogLearnMore,
      "app-dialog-notice": dialogNotice,
      "app-page-instructor": pageInstructor,
      "app-page-ensiklovideo": pageEnsikloVideo,
    // "app-card-detail"
    },
    data: () => ({
      tabs: null,
      model: 0,
      colors: ["primary", "secondary", "yellow darken-2", "red", "orange"],
      id: null,
      folder: null,
      currentDate: new Date(Date.now() - new Date().getTimezoneOffset() * 60000)
        .toISOString()
        .substr(0, 10),
      dialogSeeMore: {
        open: false,
        data: {},
      },
      dialogUnFollow: {
        open: false,
        slug: "",
        img: "",
        name: "",
      },
      studio_id: localStorage.getItem("studio_id") || 0,
      studio: {},
      autoPlay: {},
      listVidio: [],
      reviews: [],
      classes: {
        meta: null,
        data: [],
        links: {
          next: null,
        },
      },
      state_load: false,
      timelines: [],
      isFollow: false,
      search: "",
      isLoad: true,
      date: "",
      attrs: {
        class: "mb-6",
        boilerplate: true,
        elevation: 2,
      },
      sum: 0,
      ratings: {
        value: 0,
        people: 0,
      },
      dataEnsikloVidio: {
        meta: {},
        links: {},
        data: [],
      },
      meta: {},
      mean: 0,
      page: 1,
    }),
    computed: {
      computedStudio () {
        return this.$store.state.studio.dataBySlug
      },
      computedMe () {
        return this.$store.state.user.me
      },
      computedReviews () {
        return this.$store.state.studioReviews.data
      },
      studioDates () {
        return this.$store.state.studioClasses.date
      },
      valueReviews () {
        return this.$store.state.studioReviews.value
      },
      computedRatings () {
        return this.$store.state.studioReviews.ratings
      },
      computedHasInstructor () {
        return this.$store.state.studioHasInstructor.data
      },
    },
    watch: {
      tabs () {
        if (this.tabs === 0) {
          this.folder = "home"
          const params = (this.$route.params.folder = this.folder)
          this.$router.push(params).catch(() => {})
        } else if (this.tabs === 1) {
          this.folder = "class"
          const params = (this.$route.params.folder = this.folder)
          this.$router.push(params).catch(() => {})
        } else if (this.tabs === 2) {
          this.folder = "ensiklo-video"
          const params = (this.$route.params.folder = this.folder)
          this.$router.push(params).catch(() => {})
        } else if (this.tabs === 3) {
          this.folder = "instructor"
          const params = (this.$route.params.folder = this.folder)
          this.$router.push(params).catch(() => {})
        } else if (this.tabs === 4) {
          this.folder = "reviews"
          const params = (this.$route.params.folder = this.folder)
          this.$router.push(params).catch(() => {})
        }
      },
      "$route.params.folder": function (val) {
        return this.folder
      },
    },
    mounted () {
      this.getDataStudioBySlug()
      this.getDataAutoplay()
      this.getDataListVidio()
      this.getDataStudioClasses()
      this.getDataClassSchedules()
      this.getDataMe()
      this.firstLoad()
      this.getDataReviewsStudio()
      this.getDataValueReviewsStudio()
      this.ratingsStudio()
      this.scroll()
      this.getDataStudioDate()
      this.getValueReviewsEnsiloVidio()
      this.getDataReviewForRating()
      this.studioHasInstructor()
      this.firstInstructor()
      this.getDataStudioHasEnsikloVideo()
    },
    methods: {
      ratingsStudio () {
        if (this.computedReviews) {
          const ratings = this.computedReviews.map((x) => x.ratings)
          if (ratings.length > 0) {
            this.sum = ratings.filter((x) => x > 0).reduce((x, y) => x + y)
            this.mean = this.sum / this.computedReviews.length
            this.ratings.value = this.mean
            this.ratings.people = this.computedReviews.length
          }
        }
      },

      getDataReviewsStudio (page) {
        this.$store
          .dispatch("studioReviews/getDataReviewsStudio", {
            slug: this.$route.params.slug,
            page: page,
            entities: "user.img,studio,class,likes,report,response",
          })
          .then((res) => {
            if (res.data.meta.status) {
              this.meta = res.data.meta
            }
          })
      },

      getDataValueReviewsStudio () {
        this.$store
          .dispatch("studioReviews/getDataValueReviewsStudio", {
            id: this.$route.params.slug,
          })
          .then((res) => {
          // console.log(res.data.data)
          })
      },
      getDataReviewForRating () {
        this.$store.dispatch("studioReviews/getDataReviewForRating", {
          studio_slug: this.$route.params.slug,
          entities: "user.img,studio,class,likes,report,response",
        })
      },
      studioHasInstructor (studioId) {
        this.$store.dispatch("studioHasInstructor/getDataInstructor", {
          studio_id: this.$route.params.id,
          entities: "img",
        })
      },
      firstInstructor () {
        this.studioHasInstructor(localStorage.getItem("studio_id"))
      },
      getDataStudioBySlug () {
        this.$store
          .dispatch("studio/getDataStudioBySlug", {
            slug: this.$route.params.slug,
            entities: "author,img,followers,likes",
          })
          .then(({ data }) => {
            this.studio = data.data
            localStorage.setItem("studio_id", data.data.id)
            this.isLoad = false
          })
      },
      getValueReviewsEnsiloVidio () {
        this.$store.dispatch("ensikloVidio/getValueReviewsEnsiloVidio", {
          class_id: this.$route.params.slug,
        })
      },
      getDataStudioDate () {
        this.$store.dispatch("studioClasses/getDataStudioDate", {
          slug: this.$route.params.slug,
        })
      },
      getDataComments () {
        this.$store.dispatch("commentStudioVidio/getDataComments", {
          vidio_id: localStorage.getItem("vidio_id"),
        })
      },
      getDataAutoplay () {
        this.$store
          .dispatch("studioChild/getDataAutoplay", {
            vidio_id: this.id,
            studio_slug: this.$route.params.slug,
          })
          .then((res) => {
            this.autoPlay = res.data.data
            localStorage.setItem("vidio_id", res.data.data.id)
            this.getDataComments()
          })
      },
      getDataListVidio () {
        this.$store
          .dispatch("studioChild/getDataListVidio", {
            slug: this.$route.params.slug,
            search: this.search,
            status: "publish",
          })
          .then(({ data }) => {
            this.listVidio = data.data
          })
      },
      getDataStudioClasses (date, page) {
        this.$store
          .dispatch("studioClasses/getDataStudioClasses", {
            slug: this.$route.params.slug,
            entities: "studio.img,author,schedules,instructor_v2,img,category",
            filter: "Publish",
            date: date || this.currentDate,
            page: page,
          })
          .then((res) => {
            if (res.data.meta.status) {
              this.state_load = true
              this.classes.meta = res.data.meta
              this.classes.links = res.data.links
              if (page === 1) {
                this.classes.data = res.data.data
                this.state_load = false
              } else {
                this.classes.data.push(...res.data.data)
                this.state_load = false
              }
            }
          })
      },
      getDataStudioHasEnsikloVideo (page = 1) {
        this.$store
          .dispatch("studioHasEnsikloVideo/getDataStudioHasEnsikloVideo", {
            studio_id: this.$route.params.id,
            page: page,
            paginate: 6,
          })
          .then((res) => {
            if (res.data.meta.status) {
              this.dataEnsikloVidio.meta = res.data.meta
              this.dataEnsikloVidio.links = res.data.links
              if (page === 1) {
                this.dataEnsikloVidio.data = res.data.data
              } else {
                this.dataEnsikloVidio.data.push(...res.data.data)
              }
            }
          })
      },
      firstLoad () {
        if (this.$route.params.folder === "home") return (this.tabs = 0)
        else if (this.$route.params.folder === "class") return (this.tabs = 1)
        else if (this.$route.params.folder === "ensiklo-video")
          return (this.tabs = 2)
        else if (this.$route.params.folder === "instructor")
          return (this.tabs = 3)
        else if (this.$route.params.folder === "reviews") return (this.tabs = 4)
        else return (this.tabs = 0)
      },
      getDataClassSchedules (id) {
        this.$store
          .dispatch("schedulesStudioClass/getDataClassSchedules", {
            sort: "start_at,time_start",
            class_id: id,
          })
          .then(({ data }) => {
            this.timelines = data.data
          })
      },
      getDataMe () {
        this.$store.dispatch("user/me")
      },
      scroll () {
        window.onscroll = () => {
          const bottomOfWindow =
            document.documentElement.scrollTop + window.innerHeight >=
            document.documentElement.offsetHeight - 150

          if (bottomOfWindow) {
            if (this.$route.params.folder === "class") {
              this.moreClass()
            } else if (this.$route.params.folder === "ensiklo-video") {
              this.moreEnsikloVideo()
              const Toast = this.$.mixin({
                toast: true,
                position: "bottom-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                  toast.addEventListener("mouseenter", this.$.stopTimer)
                  toast.addEventListener("mouseleave", this.$.resumeTimer)
                },
                popup: "swal2-show",
                backdrop: "swal2-backdrop-show",
                icon: "swal2-icon-show",
              })
              Toast.fire({
                icon: "success",
                title: "Fetch Data",
              })
            }
          }
        }
      },
      // Emit
      letsPlay ({ item }) {
        this.id = item.id
        localStorage.setItem("vidio_id", this.id)
        this.getDataAutoplay()
      },
      fetchDate ({ item }) {
        this.date = item
        this.page = 1
        this.getDataStudioClasses(this.date, this.page)
      },
      moreClass () {
        if (this.classes.links.next) {
          this.page++
          this.getDataStudioClasses(this.date, this.page)
        }
      },
      moreEnsikloVideo () {
        if (this.dataEnsikloVidio.links.next) {
          this.page++
          this.getDataStudioHasEnsikloVideo(this.page)
        }
      },
      fetchDataFromChild ({ item }) {
        this.dialogSeeMore.open = true
        this.dialogSeeMore.data = item
        this.getDataClassSchedules(this.dialogSeeMore.data.id)
      },
      followStudio ({ item }) {
        this.$store
          .dispatch("studio/followStudio", {
            slug: item.slug,
          })
          .then((res) => {
            if (res.data.meta.status) {
              this.isFollow = true
              this.getDataStudioBySlug()
              this.$swal.fire({
                customClass: {},
                title: "You have Followed this studio.",
                width: 600,
                padding: "3em",
                background:
                  "#fff url(https://sweetalert2.github.io/images/trees.png)",
                backdrop: `
  rgba(0,0,123,0.4)
  url("https://sweetalert2.github.io/images/nyan-cat.gif")
  left top
  no-repeat
`,
              })
            }
          })
      },
      popUpUnfollowNotice ({ item }) {
        this.dialogUnFollow.open = true
        this.dialogUnFollow.name = item.name
        this.dialogUnFollow.slug = item.slug
        this.dialogUnFollow.img = item.img.url
      },
      executeUnfollowStudio ({ item }) {
        this.$store
          .dispatch("studio/unfollStudio", {
            slug: item.slug,
          })
          .then(({ data }) => {
            if (data.meta.status) {
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
                title: "You Unfollow this Studio",
              })
              this.getDataStudioBySlug()
              this.dialogUnFollow.open = false
            }
          })
      },
      unfollStudio_old ({ item }) {
        // Version Old
        this.$swal
          .fire({
            title: `${item.name} !`,
            text: "Modal with a custom image.",
            imageUrl: item.img.url,
            imageWidth: 400,
            imageHeight: 200,
            imageAlt: "Custom image",
            showCancelButton: true,
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel!",
          })
          .then((res) => {
            if (res.isConfirmed) {
              this.$store
                .dispatch("studio/unfollStudio", {
                  slug: item.slug,
                })
                .then(({ data }) => {
                  if (data.meta.status) {
                    const Toast = this.$swal.mixin({
                      toast: true,
                      position: "bottom-end",
                      showConfirmButton: false,
                      timer: 3000,
                      timerProgressBar: true,
                      didOpen: (toast) => {
                        toast.addEventListener("mouseenter", this.$swal.stopTimer)
                        toast.addEventListener(
                          "mouseleave",
                          this.$swal.resumeTimer,
                        )
                      },
                      popup: "swal2-show",
                      backdrop: "swal2-backdrop-show",
                      icon: "swal2-icon-show",
                    })
                    Toast.fire({
                      icon: "success",
                      title: "You Unfollow this Studio",
                    })
                    this.getDataStudioBySlug()
                  }
                })
            } else if (
              /* Read more about handling dismissals below */
              res.dismiss === this.$swal.DismissReason.cancel
            ) {
              this.$swal.fire(
                "You Still Followed",
                "Enjoy With My Content :)",
                "error",
              )
            }
          })
      },
      nextPagination ({ page }) {
        this.getDataReviewsStudio(page)
      },
      likeStudio ({ item }) {
        this.$store
          .dispatch("studio/likeStudio", {
            slug: item.slug,
          })
          .then(({ data }) => {
            if (data.meta.status) {
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
                title: "You like this Studio",
              })
              this.getDataStudioBySlug()
            }
          })
      },
      unLikeStudio ({ item }) {
        this.$store
          .dispatch("studio/unLikeStudio", {
            slug: item.slug,
          })
          .then(({ data }) => {
            if (data.meta.status) {
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
                title: "You Unlike this Studio",
              })
              this.getDataStudioBySlug()
            }
          })
      },
    // loadComments (id) {
    //   this.$store.dispatch('commentStudioVidio/getDataComments', {
    //     vidio_id: id,
    //   })
    // },
    },
  }
</script>

<style lang="sass">
.theme--dark.v-skeleton-loader .v-skeleton-loader__actions, .theme--dark.v-skeleton-loader .v-skeleton-loader__article, .theme--dark.v-skeleton-loader .v-skeleton-loader__card-heading, .theme--dark.v-skeleton-loader .v-skeleton-loader__card-text, .theme--dark.v-skeleton-loader .v-skeleton-loader__date-picker, .theme--dark.v-skeleton-loader .v-skeleton-loader__list-item, .theme--dark.v-skeleton-loader .v-skeleton-loader__list-item-avatar, .theme--dark.v-skeleton-loader .v-skeleton-loader__list-item-text, .theme--dark.v-skeleton-loader .v-skeleton-loader__list-item-two-line, .theme--dark.v-skeleton-loader .v-skeleton-loader__list-item-avatar-two-line, .theme--dark.v-skeleton-loader .v-skeleton-loader__list-item-three-line, .theme--dark.v-skeleton-loader .v-skeleton-loader__list-item-avatar-three-line, .theme--dark.v-skeleton-loader .v-skeleton-loader__table-heading, .theme--dark.v-skeleton-loader .v-skeleton-loader__table-thead, .theme--dark.v-skeleton-loader .v-skeleton-loader__table-tbody, .theme--dark.v-skeleton-loader .v-skeleton-loader__table-tfoot
    background: #283046 !important
    background-image: initial
    background-position-x: initial
    background-position-y: initial
    background-size: initial
    background-repeat-x: initial
    background-repeat-y: initial
    background-attachment: initial
    background-origin: initial
    background-clip: initial
    background-color: rgb(87, 38, 38)
.theme--dark
  .font-cutomize
    color: white !important
.font-cutomize
  color: black !important
  .v-tab
    text-transform: capitalize !important
.customize--tabs
  .v-tab
    text-transform: capitalize !important
    font-style: none !important
// .d-mobile
//   @media screen and (min-width: 490px) and (max-width: 1900px) {
//     display: none !important
//   }
//   @media screen and (max-width: 400px) {
//     display: block !important
//   }
</style>
