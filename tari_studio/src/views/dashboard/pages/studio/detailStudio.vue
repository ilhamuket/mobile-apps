<template>
  <v-app>
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
            :data="studio"
            class="d-none d-md-flex"
          />
        </v-col>
      </v-row>

      <v-tabs
        v-model="tabs"
        color="primary"
        class="font-title-rampart-one-small"
      >
        <v-tab>Home</v-tab>
        <v-tab>Class</v-tab>
        <v-tab>Review</v-tab>
      </v-tabs>
      <v-tabs-items v-model="tabs">
        <v-tab-item>
          <app-page-one
            :list="autoPlay"
            :list-vidios="listVidio"
            :tabs="tabs"
            @play="letsPlay"
          />
        </v-tab-item>
        <v-tab-item>
          <app-page-two
            :classes="classes"
            @open="fetchDataFromChild"
          />
        </v-tab-item>
      </v-tabs-items>
    </v-container>
    <app-dialog-page-two :dialog="dialogSeeMore" />
  </v-app>
</template>

<script>
  import topCardDetails from './_cardDetailStudio.vue'
  import pageOne from './childPages/pageOne.vue'
  import pageTwo from './childPages/pageTwo.vue'
  import dialogLearnMore from './childPages/__dialogLearnMore.vue'
  export default {
    components: {
      'app-studio-card-detail': topCardDetails,
      'app-page-one': pageOne,
      'app-page-two': pageTwo,
      'app-dialog-page-two': dialogLearnMore,
    },
    data: () => ({
      tabs: null,
      model: 0,
      colors: ['primary', 'secondary', 'yellow darken-2', 'red', 'orange'],
      id: null,
      folder: null,
      dialogSeeMore: {
        open: false,
        data: {},
        instructor: [],
      },
      studio: {},
      autoPlay: {},
      listVidio: [],
      classes: [],
      timelines: [],
      isLoad: true,
      attrs: {
        class: 'mb-6',
        boilerplate: true,
        elevation: 2,
      },
    }),
    computed: {},
    watch: {
      tabs () {
        if (this.tabs === 0) {
          this.folder = 'home'
          const params = (this.$route.params.folder = this.folder)
          this.$router.push(params).catch(() => {})
        } else if (this.tabs === 1) {
          this.folder = 'class'
          const params = (this.$route.params.folder = this.folder)
          this.$router.push(params).catch(() => {})
        } else if (this.tabs === 2) {
          this.folder = 'reviews'
          const params = (this.$route.params.folder = this.folder)
          this.$router.push(params).catch(() => {})
        }
      },
      '$route.params.folder': function (val) {
        return this.folder
      },
    },
    mounted () {
      this.getDataStudioBySlug()
      this.getDataAutoplay()
      this.getDataListVidio()
      this.getDataStudioClasses()
      this.getDataClassSchedules()
      this.firstLoad()
    },
    methods: {
      getDataStudioBySlug () {
        this.$store
          .dispatch('studio/getDataStudioBySlug', {
            slug: this.$route.params.slug,
            entities: 'img',
          })
          .then(({ data }) => {
            this.studio = data.data
            console.log(this.studio)
            this.isLoad = false
          })
      },
      getDataComments () {
        this.$store.dispatch('commentStudioVidio/getDataComments', {
          vidio_id: localStorage.getItem('vidio_id'),
        })
      },
      getDataAutoplay () {
        this.$store
          .dispatch('studioChild/getDataAutoplay', {
            vidio_id: this.id,
            studio_slug: this.$route.params.slug,
          })
          .then(res => {
            if (res.data.meta.status) {
              this.autoPlay = res.data.data
              localStorage.setItem('vidio_id', res.data.data.id)
              this.getDataComments()
            }
          })
      },
      getDataListVidio () {
        this.$store
          .dispatch('studioChild/getDataListVidio', {
            slug: this.$route.params.slug,
            search: this.search,
          })
          .then(({ data }) => {
            this.listVidio = data.data
          })
      },
      getDataStudioClasses () {
        this.$store
          .dispatch('studioClasses/getDataStudioClasses', {
            slug: this.$route.params.slug,
            entities: 'studio.img,author,instructor_v2,schedules',
          })
          .then(({ data }) => {
            this.classes = data.data
          })
      },
      firstLoad () {
        if (this.$route.params.folder === 'home') return (this.tabs = 0)
        else if (this.$route.params.folder === 'class') return (this.tabs = 1)
        else if (this.$route.params.folder === 'reviews') return (this.tabs = 2)
        else return (this.tabs = 0)
      },
      getDataClassSchedules (id) {
        this.$store
          .dispatch('schedulesStudioClass/getDataClassSchedules', {
            sort: 'start_at,time_start',
            class_id: id,
          })
          .then(({ data }) => {
            this.timelines = data.data
            console.log(this.timelines)
          // console.log(this.dialogSeeMore.id)
          })
      },
      // Emit
      letsPlay ({ item }) {
        this.id = item.id
        localStorage.setItem('vidio_id', this.id)
        this.getDataAutoplay()
      },
      fetchDataFromChild ({ item }) {
        this.dialogSeeMore.open = true
        this.dialogSeeMore.data = item
        this.getDataClassSchedules(this.dialogSeeMore.data.id)
      },
    // loadComments (id) {
    //   this.$store.dispatch('commentStudioVidio/getDataComments', {
    //     vidio_id: id,
    //   })
    // },
    },
  }
</script>

<style></style>
