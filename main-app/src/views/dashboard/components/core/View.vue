<template>
  <v-main>
    <div
      class="d-flex flex-row flex-nowrap mt-6"
      :class="!drawer ? 'ml-4' : 'mr-2'"
    >
      <div class="d-flex flex-column mt">
        <span class="ml-7 font-spartan text-h3">{{ $t($route.name) }} |</span>
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

    <router-view />

    <!-- <dashboard-core-footer /> -->
  </v-main>
</template>

<script>
  import { mapState } from 'vuex'
  export default {
    name: 'DashboardCoreView',
    components: {},
    data: () => ({
      items: [
        {
          text: 'Dashboard',
          disabled: false,
          href: 'breadcrumbs_dashboard',
        },
        {
          text: 'Link 1',
          disabled: false,
          href: 'breadcrumbs_link_1',
        },
        {
          text: 'Link 2',
          disabled: true,
          href: 'breadcrumbs_link_2',
        },
      ],
    }),
    computed: {
      ...mapState(['drawer']),
    },
    mounted () {
      console.log(this.$route.meta.breadcumbs)
    },
  // components: {
  //   DashboardCoreFooter: () => import('./Footer'),
  // },
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
