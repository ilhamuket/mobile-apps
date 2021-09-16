<template>
  <v-card class="bg-img">
    <v-img
      width="348"
      height="348"
      :src="data.url"
    />
  </v-card>
</template>

<script>
  export default {
    props: {
      data: {
        type: Object,
        default: null,
      },
    },
  }
</script>

<style lang="sass" scoped>
.bg-img::before
    content: ''
    display: block
    width: 100%
    height: 100%
    background-image: linear-gradient(to top, grey, grey)
    position: absolute
    bottom: 0
.bg-img
    background-color: #F0F2F5 !important
    position: relative
    z-index: 1
    overflow: hidden
</style>
