<template>
  <v-container>
    <v-row>
      <v-col cols="12">
        <app-list-video :data="computedData" />
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
    computed: {
      computedData () {
        return this.$store.state.my_video.data
      },
    },
    mounted () {
      this.getDataMyVideo()
    },
    methods: {
      getDataMyVideo () {
        this.$store.dispatch("my_video/getDataMyVideo", {
          entities: "video",
        })
      },
    },
  }
</script>

<style></style>
