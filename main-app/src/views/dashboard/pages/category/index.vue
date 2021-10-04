<template>
  <v-container>
    <v-row v-if="load_first">
      <loader
        object="#ff9633"
        color1="#ffffff"
        color2="#17fd3d"
        size="5"
        speed="2"
        bg="#343a40"
        objectbg="#999793"
        opacity="80"
        disable-scrolling="false"
        name="dots"
      />
    </v-row>
    <v-row v-else>
      <v-col cols="12">
        <app-page-list :data="category.data" />
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
  import listCategory from './components/__listCategory.vue'
  export default {
    components: {
      'app-page-list': listCategory,
    },
    data: () => ({
      category: {
        meta: {},
        links: {},
        data: [],
      },
      page: 1,
      state_load: false,
      load_first: true,
    }),
    computed: {
    //   category () {
    //     return this.$store.state.category.data
    //   },
    },
    mounted () {
      this.getDataCategory()
      this.scroll()
    },
    methods: {
      getDataCategory (page) {
        this.$store
          .dispatch('category/getDataCategory', {
            entities: 'studio.img',
            page: page,
            paginate: 6,
          })
          .then(res => {
            if (res.data.meta.status) {
              this.load_first = false
              this.category.meta = res.data.meta
              this.category.links = res.data.links
              if (page === 1) {
                this.category.data = res.data.data
                this.state_load = false
              } else {
                this.category.data.push(...res.data.data)
                this.state_load = false
              }
            }
          })
      },
      scroll () {
        window.onscroll = () => {
          const bottomOfWindow =
            document.documentElement.scrollTop + window.innerHeight >=
            document.documentElement.offsetHeight
          // console.log(bottomOfWindow)
          // console.log('heightOfsset : ', document.documentElement.offsetHeight)
          // console.log(
          //   'scroll : ',
          //   document.documentElement.scrollTop + window.innerHeight,
          // )

          // setTimeout(() => {
          if (bottomOfWindow) {
            // setTimeout(() => {
            this.moreCategory()
          // this.resize()
          // }, 3000)
          }
        // }, 3000)
        }
      },
      moreCategory () {
        if (this.category.links.next) {
          this.page++
          this.getDataCategory(this.page)
        }
      },
    },
  }
</script>

<style></style>
