<template>
  <v-content>
    <v-row>
      <v-col cols="12">
        <app-banners />
      </v-col>
    </v-row>
    <v-row>
      <v-col cols="6">
        <app-stepper />
      </v-col>
    </v-row>
  </v-content>
</template>

<script>
  import banners from './components_core/banners.vue'
  import stepper from './components_core/steeper.vue'
  export default {
    components: {
      'app-banners': banners,
      'app-stepper': stepper,
    },
  }
</script>

<style></style>
