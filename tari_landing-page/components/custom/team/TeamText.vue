<template>
  <div class="bg--fitur1">
    <div class="mini-spacer bg--fitur1">
      <v-container>
        <!-- -----------------------------------------------
            Start Team
        ----------------------------------------------- -->
        <v-row justify="center">
          <v-col cols="12" sm="10" md="9" lg="7">
            <div class="text-center">
              <h2 class="ui-title font-weight-bold">Pembayaran</h2>
              <p>EnsikloTari Mendukung Metode Pembayaran Instans</p>
            </div>
          </v-col>
        </v-row>

        <!-- -----------------------------------------------
            End Team
        ----------------------------------------------- -->
      </v-container>
      <v-container class="margin--container__payment">
        <v-row>
          <v-col cols="12" md="2" sm="2">
            <v-img
            class="mobile__visa"
              src="https://orderonline.id/wp-content/uploads/2020/10/Visa_Logo.png"
            />
          </v-col>
          <v-col class="" cols="12" md="2" sm="2">
            <v-img
              class="mastercard--img mobile__mastercard"
              src="https://orderonline.id/wp-content/uploads/2020/10/200px-mastercard-logo.svg_.png"
            />
          </v-col>
          <v-col class="margin--bri" cols="12" md="2" sm="2">
            <v-img
              class="mobile__bca"
              src="https://orderonline.id/wp-content/uploads/2020/10/bca-bank-central-asia-logo-png-transparent-1024x321.png"
            />
          </v-col>
        </v-row>
      </v-container>
    </div>
  </div>
</template>
<script>
export default {
  name: "TeamText",
  data() {
    return {};
  },
  methods: {},
};
</script>
<style lang="sass">
.margin--bri
  margin-left: -55px
@media screen and (min-width: 883px)
  .margin--container__payment
    margin-top: 3% !important
    margin-left: 33%
    .mastercard--img
      width: 56%
      margin-left: 7%

@media screen and (max-width: 882px)
  .margin--container
    &__payment
      .mobile
        &__visa
          margin-top: 5%
          margin-bottom: 5%
      .mobile
        &__mastercard
          margin-top: 5%
          margin-bottom: 5%
      .mobile
        &__bca
          margin-left: 22%
          margin-top: 5%
          margin-bottom: 5%
          width: 88%
</style>