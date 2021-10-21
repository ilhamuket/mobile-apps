<template>
  <v-container>
    <v-row>
      <v-col cols="12">
        <app-list-vidio :data="ensikloVidio" />
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

<style></style>
