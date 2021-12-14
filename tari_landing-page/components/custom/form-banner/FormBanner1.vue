<template>
  <div>
    <div class="formbanner1-component mini-spacer bg-extra-light">
      <v-container>
        <!-- -----------------------------------------------
            Start Form Banner1
        ----------------------------------------------- -->
        <v-row justify="center">
          <v-col cols="12" md="7" lg="5" class="d-flex align-center">
            <div class="text-center text-md-left">
              <h2 class="formbanner1-title font-weight-bold text-h1">
                EnsikloTari & Sanggar
              </h2>
              <p class="mt-16 pt-4 black--text text-justify">
                Platform EnsikloTari memungkinkan para pemilik sanggar untuk
                memperluas jaringan kelasnya, berkolaborasi, dan berbagi dengan
                siapa pun, di mana pun. Tidak Sekedar meningkatkan pendapatan
                mereka, tetapi mengharumkan nama bangsa
              </p>
              <div class="mt-16 pt-2">
                <v-btn
                  nuxt
                  width="300"
                  class="btn-custom-lg white--text"
                  href="https://app.ensiklotari.com/studio"
                  target="__blank" 
                  depressed
                  color="#4CAF50"
                  elevation="0"
                >
                  <span>Lihat sanggar yang tersedia</span>
                  <i class="mdi mdi-arrow-right ml-2"></i>
                </v-btn>
              </div>
            </div>
          </v-col>
          <v-col cols="12" md="5" lg="6" class="ml-auto">
            <v-img
              :src="require('@/assets/images/form-banner/form-banner1.png')"
              alt="banner"
            />
          </v-col>
        </v-row>

        <!-- -----------------------------------------------
            End Form Banner1
        ----------------------------------------------- -->
      </v-container>
    </div>
  </div>
</template>
<script>
export default {
  name: "FormBanner1",
  data() {
    return {};
  },
  methods: {},
};
</script>
<style lang="sass">
.text-justify
  text-align: justify
</style>