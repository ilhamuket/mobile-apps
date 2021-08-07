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
            localStorage.setItem('dark_theme', 'false')
            this.$router.push('/landingpage')
          })
          .catch(e => {
            this.$router.push('/landingpage')
          })
      },
    },
  }
</script>

<style></style>
