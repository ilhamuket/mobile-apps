<template>
  <v-dialog
    v-model="dialog.open"
    :width="$vuetify.breakpoint.mdAndDown ? '100%' : '60%'"
  >
    <v-card
      class="overflow-x-hidden"
      :color="$vuetify.theme.dark ? '#141C31' : '#F0F2F5'"
    >
      <v-card-title class="text-h2 pallet1--text font-title-rampart-one">
        <v-spacer />

        <v-icon
          aria-label="Close"
          @click="dialog.open = false"
        >
          mdi-close
        </v-icon>
      </v-card-title>
      <app-card :data="dialog.data" />
      <app-instructor
        v-if="dialog.data.instructor_v2"
        :data="dialog.data.instructor_v2"
      />
      <app-time-lines
        v-if="dialog.data.schedules"
        :data="dialog.data.schedules"
      />

      <div class="d-flex flex-row-reverse mb-2">
        <div class="d-flex flex-column">
          <v-btn
            color="primary"
            @click="dialog.open = false"
          >
            Close
          </v-btn>
        </div>
      </div>
    </v-card>
  </v-dialog>
</template>

<script>
  import card from './child/___card.vue'
  import instructor from './child/___instructor.vue'
  import timelines from './child/___timelines.vue'
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
    mounted () {
      console.log(this.dialog)
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
