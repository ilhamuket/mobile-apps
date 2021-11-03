<template>
  <div>
    <div class="feature1-component mini-spacer">
      <v-container>
        <!-- -----------------------------------------------
            Start Feature 1 Text
        ----------------------------------------------- -->
        <v-row justify="center">
          <v-col cols="12" md="10" lg="7">
            <div class="text-center">
              <v-chip small color="error" text-color="white">
                Feature 1
              </v-chip>
              <h2 class="section-title font-weight-medium">2 Type Kelas</h2>
              <p>
                EnsikloTari Memiliki 2 Type Kelas Yaitu EnsikloLive Dan
                EnsikloVidio
              </p>
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
            <v-card elevation="0">
              <v-card-text>
                <div class="icon-round bg-light-info">
                  <i class="mdi mdi-star"></i>
                </div>
                <h5 class="font-weight-medium font-18">EnsikloLive</h5>
                <p class="mt-10 mb-8">
                  EnsikloLive Adalah salah satu type kelas di
                  EnsikloTari.EnsikloLive yaitu pengajaran tari dengan cara live
                  Melalui Zoom Aplikasi
                </p>
                <a
                  href="#live"
                  class="
                    text-themecolor
                    linking
                    text-decoration-none
                    d-flex
                    align-center
                  "
                >
                  Lihat Selengkapnya <i class="mdi mdi-arrow-right"></i>
                </a>
              </v-card-text>
            </v-card>
          </v-col>
          <v-col cols="12" md="6">
            <v-card elevation="0">
              <v-card-text>
                <div class="icon-round bg-light-info">
                  <i class="mdi mdi-check-circle"></i>
                </div>
                <h5 class="font-weight-medium font-18">EnsikloVidio</h5>
                <p class="mt-10 mb-8">
                  EnsikloVidio Adalah salah satu type kelas di ensiklotari,
                  EnsikloVidio yaitu pengajaran tari berupa vidio atau kelas
                  streaming
                </p>
                <a
                  href="#vidio"
                  class="
                    text-themecolor
                    linking
                    text-decoration-none
                    d-flex
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
