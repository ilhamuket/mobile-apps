<template>
  <div>
    <div class="portfolio-component bg--fitur1 mini-spacer">
      <v-container>
        <!-- -----------------------------------------------
            Start Portfolio Text
        ----------------------------------------------- -->
        <v-row justify="center">
          <v-col cols="12" sm="10" md="9" lg="7">
            <div class="text-center">
              <h2
                class="
                  section-title
                  font-weight-medium
                  font-weight-bold
                "
              >
                EnsikloVideo
              </h2>
              <!-- <p>
                You can relay on our amazing features list and also our customer
                services will be great experience for you without doubt and in
                no-time
              </p> -->
            </div>
          </v-col>
        </v-row>

        <!-- -----------------------------------------------
            End Portfolio Text
        ----------------------------------------------- -->
        <!-- -----------------------------------------------
            Start Portfolio
        ----------------------------------------------- -->
        <v-row class="mt-13">
          <v-col
            v-for="(item, i) in data.data"
            :key="i"
            cols="12"
            md="6"
            lg="4"
          >
            <v-card class="portfolio-card overflow-hidden">
              <div class="portfolio-img">
                <img
                  :src="item.url_thumbnail"
                  class="img-fluid"
                  alt="portfolio"
                  width="520"
                  height="200"
                />
              </div>
              <v-card-text>
                <h5 class="font-weight-medium font-18">
                  {{ item.name.substr(0, 20) + ".." }}
                </h5>
                <p class="font-14 mb-0" v-if="item.studio">{{item.studio.name}}</p>
                <br>
                <p class="">Level : {{item.levels}}</p>
                <p>Durasi : {{ item.duration }} Menit</p>
                <p class="font-rp font-weight-bold">
                  Rp {{item.price}}
                </p>
              </v-card-text>
              <v-card-actions>
                <v-btn
                  color="#4CAF50"
                  class="btn-custom-lg btn--margin linking btn-arrow white--text"
                  nuxt
                  small
                  :href="`https://app.ensiklotari.com/class-vidio/detail/${item.slug}`"
                  target="__blank"
                  elevation="0"
                >
                  <span>Lihat Kelas</span>
                  <i class="mdi mdi-arrow-right"></i>
                </v-btn>
              </v-card-actions>
            </v-card>
          </v-col>
          <!-- <v-col cols="12" md="6" lg="4">
            <v-card class="portfolio-card overflow-hidden">
              <div class="portfolio-img">
                <img
                  src="@/assets/images/portfolio/img2.jpg"
                  class="img-fluid"
                  alt="portfolio"
                />
              </div>
              <v-card-text>
                <h5 class="font-weight-medium font-18">Button Designs Free</h5>
                <p class="font-14 mb-0">Search Engine</p>
              </v-card-text>
            </v-card>
          </v-col>
          <v-col cols="12" md="6" lg="4">
            <v-card class="portfolio-card overflow-hidden">
              <div class="portfolio-img">
                <img
                  src="@/assets/images/portfolio/img3.jpg"
                  class="img-fluid"
                  alt="portfolio"
                />
              </div>
              <v-card-text>
                <h5 class="font-weight-medium font-18">Branding & Co Agency</h5>
                <p class="font-14 mb-0">Admin templates</p>
              </v-card-text>
            </v-card>
          </v-col>
          <v-col cols="12" md="6" lg="4">
            <v-card class="portfolio-card overflow-hidden">
              <div class="portfolio-img">
                <img
                  src="@/assets/images/portfolio/img4.jpg"
                  class="img-fluid"
                  alt="portfolio"
                />
              </div>
              <v-card-text>
                <h5 class="font-weight-medium font-18">Zukandre Phoniex</h5>
                <p class="font-14 mb-0">Branding</p>
              </v-card-text>
            </v-card>
          </v-col>
          <v-col cols="12" md="6" lg="4">
            <v-card class="portfolio-card overflow-hidden">
              <div class="portfolio-img">
                <img
                  src="@/assets/images/portfolio/img5.jpg"
                  class="img-fluid"
                  alt="portfolio"
                />
              </div>
              <v-card-text>
                <h5 class="font-weight-medium font-18">Sionage Mokcup</h5>
                <p class="font-14 mb-0">Wll Mockup</p>
              </v-card-text>
            </v-card>
          </v-col>
          <v-col cols="12" md="6" lg="4">
            <v-card class="portfolio-card overflow-hidden">
              <div class="portfolio-img">
                <img
                  src="@/assets/images/portfolio/img6.jpg"
                  class="img-fluid"
                  alt="portfolio"
                />
              </div>
              <v-card-text>
                <h5 class="font-weight-medium font-18">Hard Cover Book Mock</h5>
                <p class="font-14 mb-0">Book Covers</p>
              </v-card-text>
            </v-card>
          </v-col> -->
        </v-row>

        <!-- -----------------------------------------------
            End Portfolio
        ----------------------------------------------- -->
      </v-container>
    </div>
  </div>
</template>
<script>
export default {
  name: "Portfolio",
  data() {
    return {
      data: {
        meta: {},
        data: [],
      },
    };
  },
  mounted() {
    this.getDataClassVidio();
  },
  methods: {
    async getDataClassVidio() {
      const params = {
        entities: "studio.reviews,category",
      };

      this.data = await this.$axios.$get("all/ensiklo-vidio", {params:params});
      console.log(this.data);
      localStorage.setItem("class-vidio", JSON.stringify(this.data));
    },
  },
};
</script>
