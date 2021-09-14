<template>
  <v-img
    class="img__content"
    src="@/assets/img/asset-web-errorpage.png"
  >
    <v-container>
      <v-row class="row-modified">
        <v-col>
          <v-btn
            color="pallet1"
            class="mr-2"
            width="200"
            @click="toPush('/')"
          >
            Back
          </v-btn>
        </v-col>
      </v-row>
    </v-container>
  </v-img>
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

<style lang="sass" scoped>
.row-modified
  margin-left: 450px !important
  margin-top: 420px !important
.img__content
  margin-top: -60px !important
</style>
