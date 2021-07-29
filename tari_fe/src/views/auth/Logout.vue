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
            this.$router.push('/login')
          })
          .catch(e => {
            this.$router.push('/login')
          })
      },
    },
  }
</script>

<style></style>
