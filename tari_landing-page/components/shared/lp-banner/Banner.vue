<template>
  <div class="banner-wrapper">
    <v-container>
      <!-- -----------------------------------------------
            Start Banner
        ----------------------------------------------- -->
      <v-row justify="center">
        <v-col cols="12" md="7" lg="6" class="d-flex align-center">
          <div class="text-center text-md-left">
            <h1 class="banner-title font-spartan font-weight-bold primary--text1">
              Selamat datang <br> di EnsikloTari
            </h1>
            <!-- <h4 class="banner-subtitle white--text font-weight-regular">
              Free Vuetify UI Kit with Lots of Ready to Use Sections
            </h4> -->
            <div class="mt-16 pt-2">
              <v-btn
                color="#9DC4D1"
                class="mr-0 mr-md-8 mb-5 mb-md-0 btn-custom-md white--text font-weight-bold"
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
                class="btn-custom-md font-weight-bold"
                outlined
                color="#9DC4D1"
                elevation="0"
              >
                Masuk Sanggar
              </v-btn>
            </div>
          </div>
        </v-col>
        <v-col cols="12" md="5" lg="6" class="">
          <v-img
            :src="require('@/assets/images/dance.svg')"
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
