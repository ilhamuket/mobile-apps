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
              <h2 class="banner2-title font-weight-light">
                Belajar Tari
                <span class="font-weight-bold">
                  Dimanapun & Kapanpun
                </span>
              </h2>

              <p class="font-spartan-text text-h4 grey--text fonts">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea cumque aperiam, 
                beatae error mollitia vero, esse ipsa facere explicabo ex odit delectus excepturi? Vel maxime repudiandae, 
                facere nobis aliquid illum.
              </p>

              <div class="mt-16 pt-2">
                <v-btn
                  nuxt
                  large
                  to="/"
                  class="btn-custom-lg btn-arrow"
                  depressed
                  color="error"
                  elevation="0"
                >
                  <span>Lihat Kelas Tari</span>
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
</style>
