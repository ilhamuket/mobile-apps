<template>
  <v-container>
    <v-row>
      <v-col
        v-if="ensikloVidio.length !== 0"
        cols="12"
      >
        <app-list-vidio :data="ensikloVidio" />
      </v-col>
      <v-col
        v-else
        cols="12"
        class="img--empety"
      >
        <v-img
          width="900"
          height="400"
          src="@/assets/img/noclass.svg"
        />
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
  import listVidio from "./component_core/_list_vidio.vue"
  export default {
    components: {
      "app-list-vidio": listVidio,
    },
    computed: {
      ensikloVidio () {
        return this.$store.state.ensikloVidio.data
      },
    },
    mounted () {
      this.getDataEnsikloVidio()
    },
    methods: {
      getDataEnsikloVidio () {
        this.$store.dispatch("ensikloVidio/getDataEnsikloVidio", {
          entities: "category,studio",
          status: "publish",
        })
      },
    },
  }
</script>

<style lang="sass" scoped>
.img--empety
  margin-left: 220px
</style>
