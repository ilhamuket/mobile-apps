<template>
  <v-row>
    <v-col cols="6">
      <v-btn
        width="185"
        color="btn_primary"
      >
        <v-icon class="mr-1">
          mdi-cart
        </v-icon>
        Cart
      </v-btn>
    </v-col>
    <v-col cols="6">
      <v-btn
        width="185"
        outlined
        color="btn_primary"
      >
        <v-icon>mdi-cart-check</v-icon>
        Buy Now
      </v-btn>
    </v-col>
    <v-col
      class="col__buying__modified"
      cols="12"
    >
      <v-row>
        <v-col cols="6">
          <v-btn
            width="183"
            small
            outlined
            color="btn_primary"
          >
            <v-icon class="mr-2">
              mdi-heart
            </v-icon>
            WishList
          </v-btn>
        </v-col>
        <v-col cols="6">
          <v-btn
            width="183"
            small
            color="btn_primary"
          >
            <v-icon class="mr-2">
              mdi-share-variant
            </v-icon>
            Share
          </v-btn>
        </v-col>
      </v-row>
    </v-col>
  </v-row>
</template>

<script>
  export default {}
</script>

<style lang="sass" scoped>
.col__buying__modified
    margin-top: -20px !important
    margin-left: -1px !important
</style>
