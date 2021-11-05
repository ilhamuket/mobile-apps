<template>
  <div>
    <v-container fluid>
      <app-row-detail-img />
    </v-container>
    <v-container class="d-flex justify-center container--profile">
      <v-row>
        <v-col>
          <v-card
            height="120"
            hidden
            color="transparent"
          >
            <v-avatar
              v-if="computedDetail.img"
              size="120"
            >
              <v-img :src="computedDetail.img.url" />
            </v-avatar>
            <v-avatar
              v-else
              size="120"
            >
              <v-img
                src="https://steezy.imgix.net/choreographers/abey-cabrera.png?auto=compress"
              />
            </v-avatar>
            <div class="margin--span_name">
              <span class="font-spartan font-weight-bold grey --text">
                {{ computedDetail.name }}
              </span>
            </div>
            <div class="margin--span__atribute">
              <v-tooltip
                color="red"
                bottom
              >
                <template #activator="{ on, attrs }">
                  <v-icon
                    v-bind="attrs"
                    color="red"
                    style="cursor: pointer"
                    v-on="on"
                  >
                    mdi-instagram
                  </v-icon>
                </template>
                <span
                  v-if="computedDetail.username_ig"
                  class="font-spartan-small white--text text-capitalize"
                >
                  {{ computedDetail.username_ig }}
                </span>
                <span
                  v-else
                  class="font-spartan-small white--text"
                >instagram</span>
              </v-tooltip>
              <v-tooltip
                color="blue"
                bottom
              >
                <template #activator="{ on, attrs }">
                  <v-icon
                    v-bind="attrs"
                    class="ml-1"
                    color="blue"
                    style="cursor: pointer"
                    v-on="on"
                  >
                    mdi-facebook
                  </v-icon>
                </template>
                <span
                  v-if="computedDetail.username_fb"
                  class="font-spartan-small white--text"
                >
                  {{ computedDetail.username_fb }}
                </span>
                <span
                  v-else
                  class="font-spartan-small white--text"
                >
                  facebook
                </span>
              </v-tooltip>
              <v-tooltip
                color="blue"
                bottom
              >
                <template #activator="{ on, attrs }">
                  <v-icon
                    v-bind="attrs"
                    class="ml-1"
                    color="blue"
                    style="cursor: pointer"
                    v-on="on"
                  >
                    mdi-twitter
                  </v-icon>
                </template>
                <span
                  v-if="computedDetail.username_tw"
                  class="font-spartan-small white--text"
                >
                  {{ computedDetail.username_tw }}
                </span>
                <span
                  v-else
                  class="font-spartan-small white--text"
                >
                  Twitter
                </span>
              </v-tooltip>
              <v-icon
                class="ml-1"
                color="blue"
              >
                mdi-map-marker
              </v-icon>
              <span class="font-spartan-small">
                {{ computedDetail.region }}
              </span>
            </div>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
    <v-container>
      <v-row>
        <v-col cols="12">
          <v-row>
            <v-col cols="12">
              <v-tabs v-model="tabs">
                <v-tab> Profile </v-tab>
                <v-tab> Class </v-tab>
              </v-tabs>
              <v-tabs-items v-model="tabs">
                <v-tab-item>
                  <app-page-profile
                    :data="computedDetail"
                    :list="computedVidioProfile"
                    :auto-play="computedAutoPlay"
                    @choose="chooseVidio"
                  />
                </v-tab-item>
                <v-tab-item>
                  <!--  -->
                </v-tab-item>
              </v-tabs-items>
            </v-col>
          </v-row>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<script>
  import rowDetail from "./component_core/_rowDetail.vue"
  // import cardDetail from "./component_core/_cardDetail.vue"
  import pageProfile from "./component/__pageProfile.vue"
  export default {
    components: {
      "app-row-detail-img": rowDetail,
      // "app-card-detail-profile": cardDetail,
      "app-page-profile": pageProfile,
    },
    data: () => ({
      tabs: null,
      list: [],
    }),
    computed: {
      computedDetail () {
        return this.$store.state.instructor.detail
      },
      computedVidioProfile () {
        return this.$store.state.instructorVidio.data
      },
      computedAutoPlay () {
        return this.$store.state.instructorVidio.auto_play
      },
    },
    mounted () {
      this.fetchDataDetailInstructor()
      this.getDataVidioProfile()
      this.getDataAutoPlay()
    },
    methods: {
      fetchDataDetailInstructor () {
        this.$store.dispatch("instructor/fetchDataDetailInstructor", {
          entities: "studio,img",
          slug: this.$route.params.slug,
        })
      },
      getDataVidioProfile () {
        this.$store
          .dispatch("instructorVidio/getDataVidioProfile", {
            slug: this.$route.params.slug,
            entities: "instructor.studio",
          })
          .then((res) => {
            console.log(res.data.data)
          })
      },
      getDataAutoPlay (id) {
        this.$store.dispatch("instructorVidio/getDataAutoPlay", {
          slug: this.$route.params.slug,
          entities: "instructor.studio,instructor.img",
          vidio_id: id,
        })
      },
      chooseVidio ({ item }) {
        this.getDataAutoPlay(item.id)
        console.log(item.id)
      },
    },
  }
</script>

<style lang="sass">
.container--profile
    width: 70%
    margin-top: -9%
    .margin--span_name
        margin-top: -10%
        margin-left: 14%
    .margin--span__atribute
        margin-left: 14%
        margin-top: 1%
</style>
