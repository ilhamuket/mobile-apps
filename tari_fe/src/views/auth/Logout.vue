<template>
  <v-app>
    <!--  -->
  </v-app>
</template>

<script>
  export default {
    created () {
      this.logout()
    },
    methods: {
      logout () {
        this.$store
          .dispatch('auth/logout')
          .then(() => {
            this.$store.state.auth.token = null
            this.vuetify.theme.dark = false
            localStorage.setItem('dark_theme', 'false')
            this.$router.push('/login')
          })
          .catch(e => {
            this.$router.push('/login')
            this.vuetify.theme.dark = false
            localStorage.setItem('dark_theme', 'false')
          })
      },
    },
  }
</script>

<style></style>
