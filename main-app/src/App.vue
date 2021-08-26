<template>
  <router-view />
</template>

<script>
  export default {
    name: 'App',
    mounted () {
      if (localStorage.getItem('dark_theme') === 'true') {
        this.$vuetify.theme.dark = true
      } else {
        this.$vuetify.theme.light = true
      }
    },
  }
</script>
