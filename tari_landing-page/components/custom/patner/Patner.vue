<template>
  <div class="bg--fitur1">
    <v-container>
      <v-row>
        <v-col cols="12" class="d-flex justify-center">
          <span class="font-spartan text-h2 black--text"> Patner Kami </span>
        </v-col>
        <v-col cols="12" md="6" class="d-flex justify-center">
          <v-img
            :src="require('@/assets/images/ensiklo/favicon.png')"
            class="img--ars"
            width="40"
          ></v-img>
        </v-col>
        <v-col cols="12" md="6">
          <v-img
            src="https://dokumentari.org/wp-content/uploads/2020/12/Asset-1-300x230.png"
          ></v-img>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<script>
export default {};
</script>

<style lang="sass">
.img--ars
    background-color: red !important
</style>