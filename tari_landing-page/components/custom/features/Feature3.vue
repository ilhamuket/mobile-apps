<template>
  <div>
    <div class="feature3-component mini-spacer">
      <v-container class="position-relative">
        <!-- -----------------------------------------------
            Start Feature 3 Text
        ----------------------------------------------- -->
        <v-row>
          <v-col cols="12" lg="10">
            <v-img
              :src="require('@/assets/images/features/3/feature-img.jpg')"
              alt="feature"
              class="rounded"
            />
          </v-col>
          <v-col cols="12" md="7" lg="5" class="feature3-card">
            <v-card class="card-shadow">
              <v-card-text>
                <div class="pa-10 text-center">
                  <v-chip small color="#4CAF50" text-color="white">
                    Daftar
                  </v-chip>
                  <h3 class="feature3-title font-weight-bold primary--text1">
                    Masih Ragu ?
                  </h3>
                  <p>Daftar yuk, bergabung bersama kami di EnsikloTari</p>
                  <v-btn
                    color="#9DC4D1"
                    class="btn-custom-lg white--text linking mt-10 btn-arrow"
                    nuxt
                    large
                    href="https://app.ensiklotari.com/classes/register"
                    target="__blank"
                    elevation="0"
                  >
                    <span>Buat Akun !!</span>
                    <i class="mdi mdi-arrow-right"></i>
                  </v-btn>
                </div>
              </v-card-text>
            </v-card>
          </v-col>
        </v-row>

        <!-- -----------------------------------------------
            End Feature 3 Text
        ----------------------------------------------- -->
      </v-container>
    </div>
  </div>
</template>
<script>
export default {
  name: "Feature3",
  data() {
    return {};
  },
  methods: {},
};
</script>
