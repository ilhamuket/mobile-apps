<template>
  <v-container>
    <v-card>
      <v-row class="ml-2">
        <v-col
          cols="12"
          md="4"
          sm="12"
        >
          <app-card-one :data="computedClass" />
          <app-btn-buy />
        </v-col>
        <v-col
          cols="12"
          md="8"
        >
          <app-card-two
            :data="computedClass"
            :user="computedMe"
          />
        </v-col>
      </v-row>
    </v-card>
    <v-card class="card--reviews">
      <v-row>
        <v-col cols="12">
          <app-card-reviews />
        </v-col>
      </v-row>
    </v-card>
  </v-container>
</template>

<script>
  import cardOne from "./component_core/__cardOne.vue"
  import cardTwo from "./component_core/__cardTwo.vue"
  import cardReviews from "./component_core/__cardReviews.vue"
  import btn from "./components/__btn.vue"
  export default {
    components: {
      "app-card-one": cardOne,
      "app-card-two": cardTwo,
      "app-card-reviews": cardReviews,
      "app-btn-buy": btn,
    },
    data: () => ({}),
    computed: {
      computedClass () {
        return this.$store.state.ensikloVidio.show
      },
      computedMe () {
        return this.$store.state.user.me
      },
    },
    mounted () {
      this.showDataEnsikloVidio()
    },
    methods: {
      showDataEnsikloVidio () {
        this.$store.dispatch("ensikloVidio/showDataEnsikloVidio", {
          slug: this.$route.params.slug,
          entities: "category,studio.img,studio.reviews,studio.followers",
        })
      },
    },
  }
</script>

<style lang="sass">
.card--reviews
    margin-top: -10px
</style>
