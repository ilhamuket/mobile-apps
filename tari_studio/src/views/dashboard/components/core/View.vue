<template>
  <v-main>
    <div
      v-if="!is_screen"
      class="d-flex flex-row flex-nowrap mt-6"
      :class="!drawer ? 'ml-4' : 'mr-2'"
    >
      <div class="d-flex flex-column mt">
        <span
          class="ml-7 font-spartan text-h3"
        >{{ $t($route.name) }} <v-icon>mdi-chevron-right</v-icon></span>
      </div>

      <div class="d-flex flex-column">
        <v-breadcrumbs
          class="mr-2"
          :items="$route.meta.breadcumbs"
          divider="/"
        >
          <template v-slot:divider>
            <v-icon>mdi-chevron-right</v-icon>
          </template>
        </v-breadcrumbs>
      </div>
    </div>
    <div
      v-else
      class="mt-6"
    >
      <span class="ml-7 font-spartan">
        {{ $t($route.name) }}
      </span>
    </div>
    <router-view />

    <!-- <dashboard-core-footer /> -->
  </v-main>
</template>

<script>
  import { mapState, mapMutations } from "vuex"
  export default {
    name: "DashboardCoreView",

    // components: {
    //   DashboardCoreFooter: () => import('./Footer'),
    // },
    data: () => ({
      is_screen: false,
    }),
    computed: {
      ...mapState(["drawer"]),
      cumputedStore () {
        return this.$store.state.auth.token
      },
    },
    mounted () {
      // console.log(this.cumputedStore)
      console.log("screen : ", screen.width)
      if (screen.width < 400) {
        this.is_screen = true
      } else return (this.is_screen = false)
    },
    methods: {
      ...mapMutations({
        setDrawer: "SET_DRAWER",
      }),
    },
  }
</script>
<style lang="sass" scoped>
.mt
  margin-top: 15px !important
  margin-left: 22px
.v-application ul, .v-application ol
    padding-left: 4px
    margin-top: 2px
</style>
