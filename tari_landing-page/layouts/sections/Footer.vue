<template>
  <!-- -----------------------------------------------
        Start Footer
  ----------------------------------------------- -->
  <v-footer class="footer">
    <v-container>
      <v-row class="py-0 py-md-15">
        <!-- -----------------------------------------------
        First Column
      ----------------------------------------------- -->
        <v-col cols="12" sm="12" md="12" lg="3" class="px-xs-0">
          <h4 class="font-weight-regular font-18">Alamat</h4>
          <p class="mt-10">Antapani, Jl. Terusan Sekolah No.1-2, Cicaheum, Kec. Kiaracondong, Kota Bandung, Jawa Barat 40282</p>
        </v-col>
        <!-- -----------------------------------------------
        Second Column
      ----------------------------------------------- -->
        <v-col cols="12" sm="12" md="12" lg="3" class="px-xs-0">
          <h4 class="font-weight-regular font-18">Kontak</h4>
          <p class="mt-10 mb-0">Reception : +205 123 4567</p>
          <p>Office : +207 235 7890</p>
        </v-col>
        <!-- -----------------------------------------------
        Third Column
      ----------------------------------------------- -->
        <v-col cols="12" sm="12" md="12" lg="3" class="px-xs-0">
          <h4 class="font-weight-regular font-18">E-mail</h4>
          <p class="mt-10 mb-0 text-nowrap">
            Office : <span class="font-weight-bold dark-link">
              ensiklotari01@gmail.com
            </span>
          </p>
          <p>
            Site :
            <a class="dark-link" href="https://ensiklotari.com"
              >ensiklotari.com</a
            >
          </p>
        </v-col>
        <!-- -----------------------------------------------
        Fourth Column
      ----------------------------------------------- -->
        <v-col cols="12" sm="12" md="12" lg="3" class="px-xs-0">
          <h4 class="font-weight-regular font-18">Social</h4>

          <div class="social-icons mt-10">
            <a href="#">
              <i class="mdi mdi-facebook"></i>
            </a>
            <a href="#">
              <i class="mdi mdi-twitter"></i>
            </a>
            <a href="#">
              <i class="mdi mdi-google-plus"></i>
            </a>
            <a href="#">
              <i class="mdi mdi-youtube"></i>
            </a>
            <a href="#">
              <i class="mdi mdi-instagram"></i>
            </a>
          </div>
        </v-col>
      </v-row>
      <div class="footer-bottom-bar font-14">
        <div class="d-block d-md-flex align-center">
          <p>
            All Rights Reserved by
            <a href="https://www.wrappixel.com/" class="link">EnsikloTari</a>
          </p>
          <div class="ml-auto">
            <div class="d-flex align-center">
              <a href="/" class="link px-4">Terms of Use</a>
              <a href="/" class="link px-4">Legal Disclaimer</a>
              <a href="/" class="link px-4">Privacy Policy</a>
            </div>
          </div>
        </div>
      </div>
    </v-container>
  </v-footer>
  <!-- -----------------------------------------------
        End Footer
  ----------------------------------------------- -->
</template>

<script>
export default {
  name: "Footer",
  data() {
    return {
      data: [],
    };
  },
  components: {},
};
</script>
 