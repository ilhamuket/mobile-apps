<template>
  <v-card class="rounded-xl">
    <v-img
      width="100%"
      height="348"
      :src="data.url_thumbnail"
      gradient="to top right, rgba(56,57,56,.33), rgba(56,57,56,.7)"
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

<style lang="sass">
.bg-img__class-vidio::before
    content: ''
    display: block
    width: 100%
    height: 100%
    background-image: linear-gradient(to top, grey, grey)
    position: absolute
    bottom: 0
.bg-img__class-vidio
    background-color: #F0F2F5 !important
    position: relative
    z-index: 1
    overflow: hidd
</style>
