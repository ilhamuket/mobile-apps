<template>
  <div>
    <div class="banner1-component">
      <v-container>
        <!-- -----------------------------------------------
            Start Banner1
        ----------------------------------------------- -->
        <v-row justify="center">
          <v-col cols="12" md="7" lg="6" class="d-flex align-center">
            <div class="text-center text-md-left">
              <v-chip  class="" color="#4CAF50" text-color="white">
                Daftar Sanggar
              </v-chip>
              <h2
                class="
                  banner1-title
                  font-weight-bold
                  text-uppercase
                  white--text
                "
              >
                Bergabung Bersama EnsikloTari
              </h2>
              <p class="white--text op-8 font-weight-regular">
                Mengangkat budaya seni tari Indonesia melalui platform pembelajaran digital              
              </p>
              <div class="mt-16 pt-2">
                <v-btn
                  nuxt
                  large
                  rounded
                  href="https://studio.ensiklotari.com/register"
                  target="__blank"
                  class="btn-custom-md"
                  depressed
                  color="white"
                  elevation="0"
                >
                  Daftar sanggar tari Anda disin
                </v-btn>
              </div>
            </div>
          </v-col>
          <v-col cols="12" md="5" lg="5">
            <v-img
            class="bg--img"
              :src="require('@/assets/images/banner/banner1.jpg')"
              alt="banner"
            />
          </v-col>
        </v-row>

        <!-- -----------------------------------------------
            End Banner1
        ----------------------------------------------- -->
      </v-container>
    </div>
  </div>
</template>
<script>
export default {
  name: "Banner1",
  data() {
    return {};
  },
  methods: {},
};
</script>
<style lang="sass">
.bg--img
  background-image: red !important
</style>