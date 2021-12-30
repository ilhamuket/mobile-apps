<template>
  <v-container>
    <v-row>
      <v-col cols="12">
        <iframe
          width="100%"
          height="400"
          :src="`${item.url}?autoplay=1&mute=1&rel=0&modestbranding=1&fs=1&loop=0&autopause=0`"
          allowfullscreen
          allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture;"
          sandbox="allow-scripts allow-same-origin"
          class="mobile__iframe"
        />
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
  export default {
    props: {
      item: {
        type: Object,
        default: null,
      },
    },
  }
</script>
<style lang="sass">
.mobile
    &__iframe
        border-radius: 2%
// @media screen and (max-width: 883px)
//     .mobile
//        &__iframe
//            width: 100%
//            height: 164%
//            border-radius: 2%
// @media screen and (min-width: 884px)
//     .mobile
//        &__iframe
//            width: 100%
//            height: 300% !important
//            border-radius: 2%
</style>
