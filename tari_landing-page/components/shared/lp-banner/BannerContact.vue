<template>
  <div class="banner-wrapper" style="background-color:#753437">
    <v-container>
      <!-- -----------------------------------------------
            Start Banner
        ----------------------------------------------- -->
      <v-row justify="center">
        <v-col
          cols="12"
          sm="10"
          md="6"
          lg="4"
          class="d-flex align-center justify-center"
        >
          <div class="text-center">
            <h1 class="banner-title font-weight-bold white--text text-nowrap">
              Kontak Kami
            </h1>
            <h4 class="banner-subtitle mr-0 white--text font-weight-regular">
                EnsikloTari
            </h4>
            <!-- <div class="mt-16 pt-2">
              <v-btn nuxt large to="/coming-soon" color="success" elevation="0">
                Upgrade to Pro
              </v-btn>
            </div> -->
          </div>
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
  name: "BannerTwo",
  data() {
    return {};
  },
  methods: {}
};
</script>
