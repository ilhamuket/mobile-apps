<template>
  <v-container>
    <v-row>
      <app-video :item="computedClass" />
    </v-row>
    <v-row>
      <app-text :item="computedClass" />
    </v-row>
  </v-container>
</template>

<script>
  import textVue from "./components/text.vue"
  import videoVue from "./components/video.vue"
  export default {
    components: {
      "app-video": videoVue,
      "app-text": textVue,
    },
    data: () => ({}),
    computed: {
      computedClass () {
        return this.$store.state.ensikloVidio.show
      },
    },
    mounted () {
      this.showDataEnsikloVidio()
    },
    methods: {
      showDataEnsikloVidio () {
        this.$store
          .dispatch("ensikloVidio/showDataEnsikloVidio", {
            slug: this.$route.params.slug,
            entities: "category,studio.img,studio.reviews,studio.followers",
          })
          .then((res) => {
            console.log(res)
          })
      },
    },
  }
</script>
