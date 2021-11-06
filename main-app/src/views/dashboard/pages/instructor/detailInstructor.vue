<template>
  <div>
    <v-container fluid>
      <app-row-detail-img />
    </v-container>
    <app-card-detail-profile :data="computedDetail" />
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
  import cardDetail from "./component_core/_cardDetail.vue"
  import pageProfile from "./component/__pageProfile.vue"
  export default {
    components: {
      "app-row-detail-img": rowDetail,
      "app-card-detail-profile": cardDetail,
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

<style lang="sass"></style>
