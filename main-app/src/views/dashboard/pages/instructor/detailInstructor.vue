<template>
  <div>
    <v-container fluid>
      <app-row-detail-img />
    </v-container>
    <app-card-detail-profile :data="computedDetail" />
    <v-container>
      <v-row>
        <v-col cols="12">
          <v-row>
            <v-col cols="12">
              <v-tabs
                v-model="tabs"
                class="customize--tabs font-spartan"
              >
                <v-tab> Profile </v-tab>
                <v-tab> Class </v-tab>
              </v-tabs>
              <v-tabs-items v-model="tabs">
                <v-tab-item>
                  <app-page-profile
                    :data="computedDetail"
                    :list="computedVidioProfile"
                    :auto-play="computedAutoPlay"
                    @choose="chooseVidio"
                  />
                </v-tab-item>
                <v-tab-item>
                  <app-page-class :classes="classes.data" />
                </v-tab-item>
              </v-tabs-items>
            </v-col>
          </v-row>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<script>
  import rowDetail from "./component_core/_rowDetail.vue"
  import cardDetail from "./component_core/_cardDetail.vue"
  import pageProfile from "./component/__pageProfile.vue"
  // import fix from "./component_core/_class.vue"
  import pageCLasses from "./component/__pageEnsikloLive.vue"
  export default {
    components: {
      "app-row-detail-img": rowDetail,
      "app-card-detail-profile": cardDetail,
      "app-page-profile": pageProfile,
      // "app-page-fix": fix,
      "app-page-class": pageCLasses,
    },
    data: () => ({
      tabs: null,
      list: [],
      classes: {
        meta: {},
        links: {
          next: null,
        },
        data: [],
      },
      page: 1,
    }),
    computed: {
      computedDetail () {
        return this.$store.state.instructor.detail
      },
      computedVidioProfile () {
        return this.$store.state.instructorVidio.data
      },
      computedAutoPlay () {
        return this.$store.state.instructorVidio.auto_play
      },
    },
    mounted () {
      this.fetchDataDetailInstructor()
      this.getDataVidioProfile()
      this.getDataAutoPlay()
      this.classByInstructor()
      this.scroll()
    },
    methods: {
      fetchDataDetailInstructor () {
        this.$store.dispatch("instructor/fetchDataDetailInstructor", {
          entities: "studio,img",
          slug: this.$route.params.slug,
        })
      },
      getDataVidioProfile () {
        this.$store
          .dispatch("instructorVidio/getDataVidioProfile", {
            slug: this.$route.params.slug,
            entities: "instructor.studio",
          })
          .then((res) => {})
      },
      getDataAutoPlay (id) {
        this.$store.dispatch("instructorVidio/getDataAutoPlay", {
          slug: this.$route.params.slug,
          entities: "instructor.studio,instructor.img",
          vidio_id: id,
        })
      },
      classByInstructor (page) {
        this.$store
          .dispatch("classes/getDataClasses", {
            paginate: 6,
            page: page,
            entities: "studio.img,img",
            instructor_slug: this.$route.params.slug,
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
          this.classByInstructor(this.page)
        }
      },
      scroll () {
        window.onscroll = () => {
          const bottomOfWindow =
            document.documentElement.scrollTop + window.innerHeight >=
            document.documentElement.offsetHeight - 150

          if (bottomOfWindow) {
            // if (this.$route.params.folder === "ensiklo-live") {
            this.moreClass()
          // } else if (this.$route.params.folder === "ensiklo-video") {
          // // this.moreEnsikloVideo()
          // }
          }
        }
      },
      // Emit
      chooseVidio ({ item }) {
        this.getDataAutoPlay(item.id)
        console.log(item.id)
      },
    },
  }
</script>

<style lang="sass">
.customize--tabs
  .v-tab
    text-transform: capitalize !important
    font-style: none !important
</style>
