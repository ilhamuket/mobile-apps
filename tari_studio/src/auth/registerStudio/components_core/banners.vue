<template>
  <v-banner
    single-line
    color="red"
  >
    <v-img
      width="140"
      class="ml-6"
      src="@/assets/img/logo.svg"
    />

    <template v-slot:actions>
      <v-btn
        color="red"
        text
        class="btn__account"
        @click="toPush('/login')"
      >
        Sudah Punya Akun
      </v-btn>
    </template>
  </v-banner>
</template>

<script>
  export default {
    methods: {
      toPush (link) {
        this.$router.push(link)
      },
    },
  }
</script>

<style lang="sass">
// .theme--light.v-banner.v-sheet
//     background-color: #8f2929
//     width: 1300px
//     margin-left: -80px
//     border-radius: 10px
.btn__account
  .v-btn__content
    color: #9dc5d1
</style>
