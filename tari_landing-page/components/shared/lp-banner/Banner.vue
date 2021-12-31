<template>
  <div class="banner-wrapper">
    <v-container>
      <!-- -----------------------------------------------
            Start Banner
        ----------------------------------------------- -->
      <v-row>
        <v-col cols="12" md="6" class="d-flex align-center mobile__cols">
          <div class="text-start">
            <h1 class="banner-title font-spartan font-weight-bold primary--text1">
              Selamat datang <br> di EnsikloTari
            </h1>
            <!-- <h4 class="banner-subtitle white--text font-weight-regular">
              Free Vuetify UI Kit with Lots of Ready to Use Sections
            </h4> -->
            <div class="mt-12 pt-2">
              <v-btn
                color="#4CAF50"
                class="mr-0 mr-md-8 mb-5 btn-masuk mobile__btn mb-md-0 btn-custom-md white--text font-weight-bold"
                nuxt
                large
                target="_blank"
                href="https://app.ensiklotari.com"
                elevation="0"
              >
                Masuk Murid
              </v-btn>
              <v-btn
                nuxt
                large
                target="__blank"
                href="https://studio.ensiklotari.com"
                class="btn-custom-md font-weight-bold mobile__btn"
                outlined
                color="#9DC4D1"
                elevation="0"
              >
                Masuk Sanggar
              </v-btn>
            </div>
          </div>
        </v-col>
        <v-col cols="12" md="6" class="">
          <v-img
          class="mt-8 ml-7"
            :src="require('@/assets/images/ensiklo/icon_ensiklo.svg')"
            alt="banner"
          />
        </v-col>
      </v-row>

      <!-- -----------------------------------------------
            End Banner
        ----------------------------------------------- -->
    </v-container>
  </div>
</template>
<script>
export default {
  name: "Banner",
  data() {
    return {};
  },
};
</script>
<style lang="sass">
@media screen and (max-width: 883px)
  .banner-wrapper
    .mobile
      &__cols
        .banner-title
          padding-top: 3%
          padding-left: 14% 
      &__btn
        margin-left: 5% !important
        width: 89%
        margin-bottom: 6% !important
</style>