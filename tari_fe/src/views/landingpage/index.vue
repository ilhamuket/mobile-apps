<template>
  <v-app>
    <router-view />
  </v-app>
</template>

<script>
  export default {
    created () {
      this.light()
    },
    methods: {
      light () {
        return this.$vuetify.theme.light
      },
    },
  }
</script>

<style></style>
