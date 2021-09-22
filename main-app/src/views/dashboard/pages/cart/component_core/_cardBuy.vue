<template>
  <v-card
    width="450"
    color="#F0F2F5"
  >
    <v-row>
      <v-col
        class="ml-12"
        cols="12"
      >
        <v-card-title>
          <v-icon
            class=""
            color="primary"
          >
            mdi-cart
          </v-icon>Shopping Summary
        </v-card-title>
        <v-divider class="margin--divider" />
        <v-card-text>
          <span class="font-spartan-small">
            Ballet
          </span>
          <span class="font-spartan-small margin__box_price_item">
            Rp2000
          </span>
          <br>
          <span class="font-spartan-small">
            Price Total (1)
          </span>
          <span class="font-spartan-small margin__box_price">
            Rp2000
          </span>
        </v-card-text>
        <v-divider class="margin--divider" />
        <v-card-actions>
          <v-btn
            width="200"
            class="d-flex justify-center ml-12"
            color="btn_primary"
          >
            Beli (1)
          </v-btn>
        </v-card-actions>
      </v-col>
    </v-row>
  </v-card>
</template>

<script>
  export default {}
</script>

<style lang="sass">
.theme--dark
    .margin--divider
        margin-left: -47px
        opacity: .2
.theme--light
    .margin--divider
        margin-left: -47px
.margin__box_price
    margin-left: 180px
.margin__box_price_item
    margin-left: 220px
</style>
