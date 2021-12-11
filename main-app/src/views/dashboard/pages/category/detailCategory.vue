<template>
  <v-container>
    <v-row>
      <v-col cols="12">
        <app-card-detail
          :category="category"
          :me="me"
          :ratings="ratings"
        />
      </v-col>
    </v-row>
    <v-row>
      <v-col cols="12">
        <v-tabs
          v-model="tabs"
          class="tabs__category font-spartan"
          center-active
        >
          <v-tab>EnsikloLive</v-tab>
          <v-tab>EnsikloVideo</v-tab>
        </v-tabs>
        <v-tabs-items v-model="tabs">
          <v-tab-item>
            <app-page-all :classes="classes.data" />
          </v-tab-item>
          <v-tab-item>
            <app-page-vidio :data="ensikloVidio.data" />
          </v-tab-item>
        </v-tabs-items>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
  import cardDetail from "./components/__cardDetail.vue"
  import pageAllCategory from "./component_core/_pageLive.vue"
  import pageVidio from "./component_core/_pageVidio.vue"
  export default {
    components: {
      "app-card-detail": cardDetail,
      "app-page-all": pageAllCategory,
      "app-page-vidio": pageVidio,
    },
    data: () => ({
      tabs: null,
      classes: {
        meta: {},
        links: {
          next: null,
        },
        data: [],
      },
      ensikloVidio: {
        meta: {},
        links: {
          next: null,
        },
        data: [],
      },
      page: 1,
      folder: "",
    }),
    computed: {
      category () {
        return this.$store.state.category.category
      },
      me () {
        const Me = localStorage.getItem("ME")
        const users = JSON.parse(Me)
        return users
      },
      ratings () {
        return this.$store.state.category.ratings
      },
    },
    watch: {
      tabs () {
        if (this.tabs === 0) {
          this.folder = "ensiklo-live"
          const params = (this.$route.params.folder = this.folder)
          this.$router.push(params).catch(() => {})
        } else if (this.tabs === 1) {
          this.folder = "ensiklo-video"
          const params = (this.$route.params.folder = this.folder)
          this.$router.push(params).catch(() => {})
        }
      },
    },
    mounted () {
      this.ratingCategory()
      this.studioClassByCategory()
      this.getDataCategoryShow()
      this.getDataEnsikloVidio()
      this.scroll()
    // console.log(this.$route.params)
    },
    methods: {
      getDataCategoryShow () {
        this.$store.dispatch("category/getDataCategoryShow", {
          entities: "studio.img,img,follow,class",
          name: this.$route.params.name,
        })
      },
      getDataEnsikloVidio (page) {
        this.$store
          .dispatch("ensikloVidio/getDataEnsikloVidio", {
            entities: "",
            studio_slug: this.$route.params.studio_slug,
            category: this.$route.params.name,
          })
          .then((res) => {
            if (res.data.meta.status) {
              this.ensikloVidio.meta = res.data.meta
              // this.ensikloVidio.links.next = res.data.links.next
              if (page == 1) {
                this.ensikloVidio.data = res.data.data
              } else {
                this.ensikloVidio.data.push(...res.data.data)
              }
            }
          })
      },
      studioClassByCategory (page) {
        this.$store
          .dispatch("classes/getDataClasses", {
            paginate: 6,
            page: page,
            entities: "studio.img,img",
            category_name: this.$route.params.name,
            studio_slug: this.$route.params.studio_slug,
            status: "publish",
          })
          .then((res) => {
            if (res.data.meta.status) {
              this.classes.meta = res.data.meta
              this.classes.links.next = res.data.links.next
              if (page === 1) {
                this.classes.data = res.data.data
              } else {
                this.classes.data.push(...res.data.data)
              }
            }
          })
      },
      moreClass () {
        if (this.classes.links.next) {
          this.page++
          this.studioClassByCategory(this.page)
        }
      },
      scroll () {
        window.onscroll = () => {
          const bottomOfWindow =
            document.documentElement.scrollTop + window.innerHeight >=
            document.documentElement.offsetHeight - 150

          if (bottomOfWindow) {
            if (this.$route.params.folder === "ensiklo-live") {
              this.moreClass()
            } else if (this.$route.params.folder === "ensiklo-video") {
            // this.moreEnsikloVideo()
            }
          }
        }
      },
      moreEnsikloVideo () {
        if (this.ensikloVidio.links.next) {
          this.page++
          this.getDataEnsikloVidio(this.page)
        }
      },
      ratingCategory () {
        this.$store
          .dispatch("category/ratingCategory", {
            studio_slug: this.$route.params.studio_slug,
          })
          .then((res) => {
            if (res.data.meta.status) {
              console.log(res.data.data)
            }
          })
      },
    },
  }
</script>
<style lang="sass">
.tabs__category > .v-tabs-bar
  background-color: #F0F2F5 !important
  margin-bottom: 2px
  border-bottom: 1px double #9DC4D1 !important
  .v-tab
    text-transform: capitalize !important
</style>
