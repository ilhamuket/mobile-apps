<template>
  <v-container>
    <v-card>
      <v-row class="ml-2">
        <v-col
          cols="12"
          md="4"
          sm="6"
        >
          <app-card-img
            v-if="classes.img"
            :data="classes.img"
          />
          <app-list-img
            v-if="classes.list_img"
            :data="classes.list_img"
          />
          <app-buying />
        </v-col>
        <v-col
          cols="12"
          md="8"
          sm="6"
        >
          <app-card-detail
            :data="classes"
            :me="me"
          />
        </v-col>
      </v-row>
    </v-card>
    <v-card>
      <v-row>
        <v-col>
          <app-card-reviews :reviews="reviews" />
        </v-col>
      </v-row>
    </v-card>
  </v-container>
</template>

<script>
  import cardImg from "./components_core/_img.vue"
  import detail from "./components_core/_cardDetail.vue"
  import list from "./components/__listImg.vue"
  import buying from "./components/__buying.vue"
  import cardReviews from "./components_core/_cardReviews.vue"
  export default {
    components: {
      "app-card-img": cardImg,
      "app-card-detail": detail,
      "app-list-img": list,
      "app-buying": buying,
      "app-card-reviews": cardReviews,
    },
    data: () => ({
      breadcumbs: {
        text: "Mahardika",
        disabled: true,
        to: "/",
      },
    }),
    computed: {
      classes () {
        return this.$store.state.classes.dataBySlug
      },
      reviews () {
        return this.$store.state.classesReviews.data
      },
      me () {
        return this.$store.state.user.me
      },
    },
    watch: {
      breadcumbs (newVal) {
        this.$router.history.current.meta.breadcumbs.push(newVal)
      },
      $route: function () {
        console.log("as")
      },
    },
    mounted () {
      this.getDataClassesBySlug()
      this.getDataReviews()
      this.getMe()

    // console.log(this.$route.params)
    },
    methods: {
      getBreadcumbs () {
        this.$router.history.current.meta.breadcumbs.push({
          text: "Mahardika",
          disabled: true,
          to: "/",
        })
      // this.breadcumbs =
      },
      getMe () {
        this.$store.dispatch("user/me")
      },
      getDataClassesBySlug () {
        this.$store.dispatch("classes/getDataClassesBySlug", {
          entities: "listImg,img,studio.followers,category, listImg",
          slug: this.$route.params.slug,
          studio_slug: this.$route.params.studio_slug,
        })
      },
      getDataReviews () {
        this.$store.dispatch("classesReviews/getDataReviews", {
          class_slug: this.$route.params.slug,
          entities: "user.img,studio,class,likes,report",
        })
      },
    },
  }
</script>
