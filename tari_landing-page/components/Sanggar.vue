<template>
  <div>
    <div id="ensiklolive" class="bg--fitur1" ref="live">
      <div class="portfolio-component mini-spacer">
        <v-container>
          <!-- -----------------------------------------------
            Start Portfolio Text
        ----------------------------------------------- -->
          <v-row justify="center">
            <v-col cols="12" sm="10" md="9" lg="7">
              <div class="text-center">
                <h2 class="section-title font-weight-medium font-weight-bold">
                  Studio
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
          <v-row v-if="data" class="mt-13">
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
                  <img
                    v-else
                    src="https://api.ensiklotari.com/images/ensiklo-live/RRpyhiCQCO7aSOgsJL5DvgZmr3JBcnRmj990BkbC.jpg"
                    class="img-fluid"
                    alt="portfolio"
                    width="520"
                    height="200"
                  />
                </div>
                <v-card-text>
                  <h5 class="font-weight-medium font-18 text-capitalize">
                    {{ item.name }}
                  </h5>
                  <p class="font-14 mb-0">
                    <v-rating small :value="2"></v-rating>
                  </p>
                  <br />
                  <P v-if="item.img"> Level : {{ item.img.url }} </P>
                  <p>Durasi : sdsa Menit</p>
                  <p class="font-rp font-weight-bold">Rp sada</p>
                </v-card-text>
                <v-card-actions>
                  <v-btn
                    color="#4CAF50"
                    class="
                      btn-custom-lg
                      linking
                      btn--margin btn-arrow
                      white--text
                    "
                    nuxt
                    small
                    target="__blank"
                    elevation="0"
                  >
                    <span>Lihat Studio</span>
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
  </div>
</template>
<script>
// import axios from "@nuxtjs/axios";
export default {
  props: {
    data: {
      type: Object,
      default: null,
    },
    list: {
      type: Object,
      default: null,
    },
  },
  computed: {
    // getData() {
    //   return localStorage.getItem("studio");
    // },
  },
  mounted() {
    // this.getData();
    // console.log(this.item_array);
  },
  methods: {
    // async getData() {
    //   this.studio = await this.$axios.get("all/studio");
    //   console.log(this.studio.data.data);
    // },
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