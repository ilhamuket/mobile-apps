<template>
  <v-app>
    <!--  -->
  </v-app>
</template>

<script>
  export default {
    created () {
      this.logout()
      this.$vuetify.theme.dark = false
    },
    methods: {
      logout () {
        this.$store
          .dispatch('auth/logout')
          .then(() => {
            localStorage.setItem('dark_theme', 'false')
            this.$router.push('/login')
            localStorage.removeItem('acces_token')
          })
          .catch(e => {
            this.$router.push('/login')
          })
      },
    },
  }
</script>

<style></style>
