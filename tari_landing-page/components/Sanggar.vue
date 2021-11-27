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
                    <v-rating
                      small
                      readonly
                      :value="computedList[i]"
                    ></v-rating>
                  </p>
                  <br />
                  <v-row>
                    <v-col
                      cols="12"
                      class="d-flex justify-center icon--sanggar"
                    >
                      <v-tooltip bottom color="primary">
                        <template #activator="{ on, attrs }">
                          <v-icon
                            v-on="on"
                            v-bind="attrs"
                            v-for="(item, i) in itemIcon"
                            :key="i"
                            class="ml-2 primary--text"
                            >{{ item.text }}</v-icon
                          >
                        </template>
                        <span class="font-spartan font-9">
                          facebook
                        </span>
                      </v-tooltip>
                    </v-col>
                  </v-row>
                </v-card-text>
                <!-- <v-card-actions>
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
                </v-card-actions> -->
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
import Team from "./custom/team/Team.vue";
// import axios from "@nuxtjs/axios";
export default {
  components: { Team },
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
  data: () => ({
    itemIcon: [
      { text: "mdi-facebook", color: "blue" },
      { text: "mdi-whatsapp", color: "blue" },
      { text: "mdi-twitter", color: "blue" },
      { text: "mdi-instagram", color: "blue" },
    ],
  }),
  computed: {
    computedList() {
      const arrayReviews = [];
      // eslint-disable-next-line no-unused-vars
      for (const item in this.data.data) {
        if (Object.hasOwnProperty.call(this.data.data, item)) {
          const studio = this.data.data[item];
          let newReviews = [];
          newReviews = studio.reviews;
          const count = newReviews.map((x) => x.ratings);
          if (count.length !== 0) {
            const sum = count.filter((x) => x > 0).reduce((x, y) => x + y);
            const avarage = sum / count.length;

            arrayReviews.push(avarage);
          }
        }
      }
      return arrayReviews;
    },
  },
  mounted() {
    // console.log(this.data.data);
    // console.log(this.computedList);
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
.icon--sanggar
  .v-icon
    transition: 0.1s ease-in
    cursor: pointer
  &:hover
    .v-icon
      transform: scale(1.5)
      margin-left: 6% !important
</style>