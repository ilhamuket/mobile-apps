<template>
  <v-container>
    <v-row>
      <v-col
        v-if="!isLoad"
        cols="12"
      >
        <app-list-card
          :data="data"
          :is-load="is_load"
        />
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
  import listCard from "./component_core/_list_card.vue"
  export default {
    components: {
      "app-list-card": listCard,
    },
    data: () => ({
      data: {
        meta: {},
        data: [],
        links: {},
      },
      page: 1,
      isLoad: true,
      is_load: false,
    }),
    computed: {
      computedData () {
        return this.$store.state.my_class.data
      },
    },
    mounted () {
      this.getDataMyClass()
      this.scroll()
    },
    methods: {
      getDataMyClass (page = 1) {
        this.$store
          .dispatch("my_class/getDataMyClass", {
            entities: "student,classes.img,classes.studio",
            page: page,
          })
          .then((res) => {
            this.isLoad = true
            if (res.data.meta.status) {
              this.data.links = res.data.links
              this.is_load = true
              this.isLoad = false
              this.data.meta = res.data.meta
              if (page === 1) {
                this.data.data = res.data.data
                this.is_load = false
              } else {
                this.data.data.push(...res.data.data)
                this.isLoad = false
                this.is_load = false
              }
            }
          })
      },
      scroll () {
        window.onscroll = () => {
          const bottomOfWindow =
            document.documentElement.scrollTop + window.innerHeight >=
            document.documentElement.offsetHeight - 150
          // console.log(bottomOfWindow)

          // setTimeout(() => {
          if (bottomOfWindow) {
            // setTimeout(() => {
            this.moreClass()

          // this.resize()
          // }, 3000)
          }
        // }, 3000)
        }
      },
      moreClass () {
        if (this.data.links.next) {
          this.page++
          // console.log(this.page)
          // this.is_load = true
          this.getDataMyClass(this.page)
        }
      },
    },
  }
</script>

<style></style>
