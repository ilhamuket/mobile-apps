<template>
  <v-container>
    <v-row>
      <v-col
        v-resize="onResize"
        cols="12"
      >
        <app-card
          v-if="!isMobile"
          :studio="computedStudio"
        />
      </v-col>
      <v-col cols="12">
        <v-tabs
          v-model="tabs"
          background-color="btn_primary"
          color="btn_primary"
          class="tabs-profile"
        >
          <v-tab class="font-spartan-small">
            Home
          </v-tab>
          <v-tab class="font-spartan-small">
            Profile
          </v-tab>
          <v-tab class="font-spartan-small">
            Social Media
          </v-tab>
          <v-tab class="font-spartan-small">
            Discusses
          </v-tab>
          <v-tab class="font-spartan-small">
            Reviews
          </v-tab>
        </v-tabs>
        <v-tabs-items v-model="tabs">
          <v-tab-item>
            <app-page-summarry :summary="cumputedSummary" />
          </v-tab-item>
          <v-tab-item>
            <app-page-one />
          </v-tab-item>
          <v-tab-item>
            <app-page-medsos />
          </v-tab-item>
        </v-tabs-items>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
  import card from './components_core/__cardDetail.vue'
  import pageOne from './components_core/_pageProfile.vue'
  import summary from './components_core/_pageSummary.vue'
  import medsos from './components_core/_pageSocilaMedia.vue'
  export default {
    components: {
      'app-card': card,
      'app-page-one': pageOne,
      'app-page-summarry': summary,
      'app-page-medsos': medsos,
    },
    data: () => ({
      tabs: null,
      isMobile: false,
    }),
    computed: {
      computedMe () {
        return this.$store.$state.user.me
      },
      cumputedSummary () {
        return this.$store.state.dashboardSummary.data
      },
      computedStudio () {
        return this.$store.state.studio.me
      },
    },
    mounted () {
      this.me()
      this.getDataSummary()
      this.getStudioMe()
    },
    methods: {
      me () {
        this.$store
          .dispatch('user/me', {
            entities: 'studio',
          })
          .then(res => {
            this.users = res.data.data
            this.is_load = false
          })
      },
      onResize () {
        if (window.innerWidth < 769) this.isMobile = true
        else this.isMobile = false
      },
      getStudioMe () {
        this.$store.dispatch('studio/getDataMeStudio', {
          entities: 'likes,followers',
        })
      },
      complete (index) {
        this.list[index] = !this.list[index]
      },
      toClass () {
        this.$router.push('/class')
      },
      getDataSummary () {
        this.$store.dispatch('dashboardSummary/getDataSummary')
      },
      toNavigate (link) {
        this.$router.push(link)
      },
    // covid () {
    //   const data = this.database
    //   data.forEach(d => {
    //     const date = moment(d.date, 'YYYYMMDD').format('MM/DD')
    //     const {
    //       positive,
    //       hospiitalizedCurrently,
    //       inIcuCurrently,
    //       onVentilatorCurrently,
    //       recovered,
    //       death,
    //     } = d

    //     this.arrPositive.push({ date, total: positive })
    //     this.arrHospitalize.push({ date, total: hospiitalizedCurrently })
    //     this.arrInIcu.push({ date, total: inIcuCurrently })
    //     this.arrOnVentilators.push({ date, total: onVentilatorCurrently })
    //     this.arrRecorvered.push({ date, total: recovered })
    //     this.arrDeaths.push({ date, total: death })
    //   })
    // },
    },
  }
</script>

<style lang="sass">
.theme--light
    .tabs-profile > .v-tabs-bar
        background-color: #F0F2F5 !important
        margin-bottom: 2px
        border-bottom: 1px double #9DC4D1 !important
</style>
