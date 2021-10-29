<template>
  <v-container>
    <v-row>
      <v-col cols="12">
        <app-card />
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
  import listCard from "./component_core/_listCard.vue"
  export default {
    components: {
      "app-card": listCard,
    },
  }
</script>

<style></style>
