<template>
  <v-system-bar
    :color="$vuetify.theme.dark ? '#141C31' : '#F0F8FF'"
    window
  >
    <v-toolbar-title
      :class="$vuetify.theme.dark ? 'white--text' : ' black--text'"
    >
      <v-icon :color="color">
        {{ icon }}
      </v-icon>
      <span class="font-spartan-small">
        {{ $t(title) }}
      </span>
    </v-toolbar-title>

    <v-spacer />

    <v-icon @click="close">
      mdi-close
    </v-icon>
  </v-system-bar>
</template>

<script>
  export default {
    props: {
      icon: {
        type: String,
        default: "",
      },
      title: {
        type: String,
        default: "",
      },
      color: {
        type: String,
        default: "",
      },
    },
    methods: {
      close () {
        this.$emit("close")
      },
    },
  }
</script>

<style></style>
