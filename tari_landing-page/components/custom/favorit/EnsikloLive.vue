<template>
  <div id="ensiklolive" class="bg--fitur1" ref="live">
    <div class="portfolio-component mini-spacer">
      <v-container>
        <!-- -----------------------------------------------
            Start Portfolio Text
        ----------------------------------------------- -->
        <v-row justify="center">
          <v-col cols="12" sm="10" md="9" lg="7">
            <div class="text-center">
              <h2 class="section-title font-weight-medium font-weight-bold">EnsikloLive</h2>
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
                  v-if="item.img"
                  :src="item.img.url"
                  class="img-fluid"
                  alt="portfolio"
                  width="520"
                  height="200"
                />
              </div>
              <v-card-text>
                <h5 class="font-weight-medium font-18">
                  {{ item.name }}
                </h5>
                <p v-if="item.studio" class="font-14 mb-0">
                  {{ item.studio.name }}
                </p>
                <br>
                <P v-if="item.category">
                  Level : {{ item.levels }}
                </P>
                <p>
                  Durasi : {{ item.durasi }} Menit
                </p>
                <p class="font-rp font-weight-bold">
                  Rp {{item.harga}}
                </p>
                <!-- <p v-if="item.studio" class="font-spartan-small">
                  {{ item.studio.reviews ? item.studio.reviews.length : 0 }}
                  ulasan
                </p>
                <v-rating
                  class="ratings--ensikloive"
                  :value="computedValue[i]"
                  readonly
                  small
                  background-color="red"
                  color="green"
                /> -->
              </v-card-text>
              <v-card-actions>
                <v-btn
                  color="#4CAF50"
                  class="btn-custom-lg linking btn--margin btn-arrow white--text"
                  nuxt
                  small
                  :href="`https://app.ensiklotari.com/detail/class/live/ensiklo-studio/${item.slug}`"
                  target="__blank"
                  elevation="0"
                >
                  <span>Lihat Kelas</span>
                  <i class="mdi mdi-arrow-right"></i>
                </v-btn>
              </v-card-actions>
            </v-card>
          </v-col>
        </v-row>

        <!-- -----------------------------------------------
            End Portfolio
        ----------------------------------------------- -->
      </v-container>
    </div>
  </div>
</template>
<script>
import axios from "@nuxtjs/axios";
export default {
  name: "Portfolio",
  data() {
    return {
      data: {},
      data2: {
        studio: {},
      },
    };
  },
  mounted() {
    this.getDataClassAll();
  },
  computed: {
    computedValue() {
      let ratings = [];
      const data = localStorage.getItem("data_live");
      const data_parse = JSON.parse(data);

      if (data_parse.data) {
        for (const item in data_parse.data) {
          if (Object.hasOwnProperty.call(data_parse.data, item)) {
            const newReviews = data_parse.data[item];
            const studio = newReviews.studio;
            let newArr = [];
            newArr = studio.reviews;
            const count = newArr.map((x) => x.ratings);
            const sum = count.filter((x) => x > 0).reduce((x, y) => x + y);
            const avarage = sum / count.length;

            ratings.push(avarage);
          }
        }
      }
      return ratings;
    },
  },
  methods: {
    async getDataClassAll() {
      const params = {
        entities: "img,studio.reviews,category",
      };
      const data = await this.$axios.$get("all/live", { params: params });
      this.data = data;
      localStorage.setItem("data_live", JSON.stringify(this.data));
    },
  },
};
</script>
<style lang="sass">
.font-spartan-small
  font-family: "Spartan"
  font-size: 13px
  margin-left: 162px
  margin-bottom: -27px !important
.font-rp
  font-size: 21px
  color: #4CAF50
  margin-top: 20px
.btn--margin
  margin-top: -6%
</style>