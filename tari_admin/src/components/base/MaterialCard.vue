<template>
  <v-card
    v-bind="$attrs"
    :class="classes"
    class="v-card--material pa-3"
  >
    <div class="d-flex grow flex-wrap">
      <div
        v-if="avatar"
        class="mx-auto v-card--material__avatar elevation-6"
      >
        <v-avatar
          size="130"
          color="grey"
          tile
        >
          <v-img :src="avatar" />
        </v-avatar>

        <div class="d-flex flex-nowrap mt-2">
          <v-icon
            class="d-flex align-end justify-center mx-auto"
            dark
            color="primary"
            @click="changePict"
          >
            mdi-pencil
          </v-icon>
          <v-icon
            class="d-flex align-end justify-center mx-auto"
            dark
            color="primary"
            @click="push"
          >
            mdi-camera-enhance-outline
          </v-icon>
        </div>
      </div>

      <v-sheet
        v-else
        :class="{
          'pa-7': !$slots.image,
        }"
        :color="color"
        :max-height="icon ? 90 : undefined"
        :width="icon ? 'auto' : '100%'"
        elevation="6"
        class="text-start v-card--material__heading mb-n6"
        dark
      >
        <slot
          v-if="$slots.heading"
          name="heading"
        />

        <slot
          v-else-if="$slots.image"
          name="image"
        />

        <div
          v-else-if="title && !icon"
          class="font-weight-light"
          v-text="title"
        />

        <v-icon
          v-else-if="icon"
          size="32"
          v-text="icon"
        />

        <div
          v-if="text"
          class="font-weight-thin"
          v-text="text"
        />
      </v-sheet>

      <div
        v-if="$slots['after-heading']"
        class="ml-6"
      >
        <slot name="after-heading" />
      </div>

      <div
        v-else-if="icon && title"
        class="ml-4"
      >
        <div
          class="card-title font-weight-light"
          v-text="title"
        />
      </div>
    </div>

    <slot />

    <template v-if="$slots.actions">
      <v-divider class="mt-2" />

      <v-card-actions class="pb-0">
        <slot name="actions" />
      </v-card-actions>
    </template>
  </v-card>
</template>

<script>
  export default {
    name: 'MaterialCard',

    props: {
      avatar: {
        type: String,
        default: '',
      },
      color: {
        type: String,
        default: 'btn_primary',
      },
      icon: {
        type: String,
        default: undefined,
      },
      image: {
        type: Boolean,
        default: false,
      },
      text: {
        type: String,
        default: '',
      },
      title: {
        type: String,
        default: '',
      },
      link: {
        type: String,
        default: '',
      },
    },

    computed: {
      classes () {
        return {
          'v-card--material--has-heading': this.hasHeading,
        }
      },

      hasHeading () {
        return Boolean(this.$slots.heading || this.title || this.icon)
      },
      hasAltHeading () {
        return Boolean(this.$slots.heading || (this.title && this.icon))
      },
    },
    methods: {
      changePict () {
        this.$emit('input')
      },
      push () {
        this.$emit('push')
      },
    },
  }
</script>

<style lang="sass">
.v-card--material
  &__avatar
    position: relative
    top: -64px
    margin-bottom: -40px
    background-color: #272F45 !important

  &__heading
    position: relative
    top: -40px
    transition: .3s ease
    z-index: 1
</style>
