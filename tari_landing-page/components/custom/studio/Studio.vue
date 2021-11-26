<template>
  <div>
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
                  <h2
                    v-if="text"
                    class="section-title font-weight-m{edium font-weight-bold"
                  >
                    {{ text }}
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
              <v-col cols="12" md="6" lg="4">
                <v-card class="portfolio-card overflow-hidden">
                  <div class="portfolio-img">
                    <img
                      src="https://api.ensiklotari.com/images/ensiklo-live/RRpyhiCQCO7aSOgsJL5DvgZmr3JBcnRmj990BkbC.jpg"
                      class="img-fluid"
                      alt="portfolio"
                      width="520"
                      height="200"
                    />
                  </div>
                  <v-card-text>
                    <h5 class="font-weight-medium font-18">asdas</h5>
                    <p class="font-14 mb-0">sada</p>
                    <br />
                    <P> Level : asdsad </P>
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
    item_array: {
      type: Array,
      default: null,
    },
    text: {
      type: String,
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
    console.log(this.item_array);
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
  </div>
</template>

<script>
export default {};
</script>

<style>
</style>