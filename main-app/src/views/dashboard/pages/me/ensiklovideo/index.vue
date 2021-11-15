<template>
  <v-container>
    <v-row>
      <v-col cols="12">
        <app-list-video :data="data" />
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
  import listVideo from "./component_core/_listVideo.vue"
  export default {
    components: {
      "app-list-video": listVideo,
    },
    data: () => ({
      data: [],
    }),
    methods: {},
  }
</script>

<style></style>
