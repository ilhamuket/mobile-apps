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
              <h2 class="formbanner1-title font-weight-bold">
                Belajar Tari Dimanapun & kapanpun
              </h2>
              <p class="mt-16 pt-4">
                To accomplish great things, we must not only act, but also
                dream; not only plan, but also believe.
              </p>
              <div class="mt-16 pt-2">
                <v-btn
                  nuxt
                  width="300"
                  href="https://app.ensiklotari.com/class-vidio"
                  target="__blank"
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
