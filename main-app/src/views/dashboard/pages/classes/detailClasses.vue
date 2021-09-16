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
          <app-card-detail :data="classes" />
        </v-col>
      </v-row>
    </v-card>
  </v-container>
</template>

<script>
  import cardImg from './components_core/_img.vue'
  import detail from './components_core/_cardDetail.vue'
  import list from './components/__listImg.vue'
  import buying from './components/__buying.vue'
  export default {
    components: {
      'app-card-img': cardImg,
      'app-card-detail': detail,
      'app-list-img': list,
      'app-buying': buying,
    },
    data: () => ({
      breadcumbs: {
        text: 'Mahardika',
        disabled: true,
        to: '/',
      },
    }),
    computed: {
      classes () {
        return this.$store.state.classes.dataBySlug
      },
    },
    watch: {
      breadcumbs (newVal) {
        this.$router.history.current.meta.breadcumbs.push(newVal)
      },
      $route: function () {
        console.log('as')
      },
    },
    mounted () {
      this.getDataClassesBySlug()
      console.log(this.classes)
    },
    methods: {
      getBreadcumbs () {
        this.$router.history.current.meta.breadcumbs.push({
          text: 'Mahardika',
          disabled: true,
          to: '/',
        })
      // this.breadcumbs =
      },
      getDataClassesBySlug () {
        this.$store.dispatch('classes/getDataClassesBySlug', {
          entities: 'listImg,img,studio,category, listImg',
          slug: this.$route.params.slug,
          studio_slug: this.$route.params.studio_slug,
        })
      },
    },
  }
</script>

<style lang="sass">
.bg-img::before
    content: ''
    display: block
    width: 100%
    height: 100%
    background-image: linear-gradient(to top, grey, grey)
    position: absolute
    bottom: 0
.bg-img
    background-color: #F0F2F5 !important
    position: relative
    z-index: 1
    overflow: hidden
</style>
