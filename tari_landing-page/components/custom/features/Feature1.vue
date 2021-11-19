<template>
  <div class="bg--fitur1">
    <div class="feature1-component mini-spacer">
      <v-container>
        <!-- -----------------------------------------------
            Start Feature 1 Text
        ----------------------------------------------- -->
        <v-row justify="center">
          <v-col cols="12" md="10" lg="7">
            <div class="text-center">
              <!-- <v-chip small color="#4CAF50" text-color="white">
                Fitur A
              </v-chip> -->
              <h2 class="section-title font-weight-bold primary--text1 text-h1">
                Tipe Kelas
              </h2>
              <p>EnsikloLive & EnsikloVideo</p>
            </div>
          </v-col>
        </v-row>

        <!-- -----------------------------------------------
            End Feature 1 Text
        ----------------------------------------------- -->
        <!-- -----------------------------------------------
            Start Feature 1
        ----------------------------------------------- -->

        <v-row justify="center" class="mt-13">
          <v-col cols="12" md="6">
            <v-card color="#E9F3F8" elevation="0">
              <v-card-text>
                <div class="icon-round bg-light-info">
                  <i class="mdi mdi-youtube"></i>
                </div>
                <h5 class="font-weight-bold font-18 primary--text1">
                  EnsikloLive
                </h5>
                <p class="mt-10 mb-8">
                  EnsikloLive yaitu
                  pengajaran tari dengan cara live melalui Zoom Aplikasi
                </p>
                <a
                  href="#live"
                  class="
                    text-themecolor
                    linking
                    text-decoration-none
                    d-flex
                    primary--text1
                    align-center
                  "
                >
                  Lihat Selengkapnya <i class="mdi mdi-arrow-right"></i>
                </a>
              </v-card-text>
            </v-card>
          </v-col>
          <v-col cols="12" md="6">
            <v-card color="#E9F3F8" elevation="0">
              <v-card-text>
                <div class="icon-round bg-light-info">
                  <i class="mdi mdi-check-circle"></i>
                </div>
                <h5 class="font-weight-bold font-18 primary--text1">
                  EnsikloVideo
                </h5>
                <p class="mt-10 mb-8">
                  EnsikloVideo yaitu
                  pengajaran tari melalui sebuah video atau kelas streaming
                </p>
                <a
                  href="#vidio"
                  class="
                    text-themecolor
                    linking
                    text-decoration-none
                    d-flex
                    primary--text1
                    align-center
                  "
                >
                  Lihat Selengkapnya <i class="mdi mdi-arrow-right"></i>
                </a>
              </v-card-text>
            </v-card>
          </v-col>
        </v-row>

        <!-- -----------------------------------------------
            End Feature 1
        ----------------------------------------------- -->
      </v-container>
    </div>
  </div>
</template>
<script>
export default {
  name: "Feature1",
  data() {
    return {};
  },
  methods: {},
};
</script>
<style lang="sass">
.bg--fitur1
  background-color: #E9F3F8 !important
</style>