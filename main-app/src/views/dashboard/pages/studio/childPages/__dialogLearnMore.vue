<template>
  <v-dialog
    v-model="dialog.open"
    width="60%"
  >
    <v-card
      class="overflow-x-hidden"
      :color="$vuetify.theme.dark ? '#141C31' : '#F0F2F5'"
    >
      <app-card :data="dialog.data" />
      <app-instructor
        v-if="dialog.data.instructor"
        :data="dialog.data.instructor"
      />
      <app-time-lines
        v-if="dialog.data.schedules"
        :data="dialog.data.schedules"
      />
    </v-card>
  </v-dialog>
</template>

<script>
  import card from './___card.vue'
  import instructor from './___instructor.vue'
  import timelines from './___timelines.vue'
  export default {
    components: {
      'app-card': card,
      'app-instructor': instructor,
      'app-time-lines': timelines,
    },
    props: {
      dialog: {
        type: Object,
        default: () => ({
          open: false,
        }),
      },
    },
  }
</script>

<style lang="sass" scoped>
.v-card--material
  &__avatar
    position: relative
    top: -64px
    margin-bottom: -32px

  &__heading
    position: relative
    top: -40px
    transition: .3s ease
    z-index: 1
.overflow-x-hidden
    overflow-x: hidden !important
</style>
