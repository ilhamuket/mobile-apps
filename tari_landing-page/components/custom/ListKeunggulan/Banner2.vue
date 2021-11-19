<template>
  <div>
    <div class="banner2-component">
      <v-container>
        <!-- -----------------------------------------------
            Start Banner2
        ----------------------------------------------- -->
        <v-row justify="center">
          <v-col cols="12" md="8" class="d-flex align-center">
            <div class="text-center">
              <span class="banner2-title font-weight-light font-weight-bold text--h4 text-nowrap primary--text1">
                Belajar Tari  Di mana pun dan Kapan pun
              </span>

              <!-- <p class="font-spartan-text text-h4 grey--text fonts">
                Belajar Di mana pun dan Kapan pun, di EnsikloTari anda bisa belajar tari dimana pun dengan sangat mudah
              </p> -->

              <div class="mt-16 pt-2">
                <v-btn
                  nuxt
                  large
                  href="https://app.ensiklotari.com/classes"
                  target="__blank"
                  class="btn-custom-lg btn-arrow white--text"
                  depressed
                  color="#9DC4D1"
                  elevation="0"
                >
                  <span>Pilih Kelas Tari</span>
                  <i class="mdi mdi-arrow-right"></i>
                </v-btn>
              </div>
            </div>
          </v-col>
        </v-row>

        <!-- -----------------------------------------------
            End Banner2
        ----------------------------------------------- -->
      </v-container>
    </div>
  </div>
</template>
<script>
export default {
  name: "Banner2",
  data() {
    return {};
  },
  methods: {},
};
</script>
<style lang="sass">
.fonts
  line-height: 20px !important
.text-nowrap
  white-space: nowrap
</style>
