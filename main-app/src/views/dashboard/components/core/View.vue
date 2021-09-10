<template>
  <v-main>
    <v-breadcrumbs
      class="ml-12"
      :items="items"
      divider="."
    />
    <router-view />

    <!-- <dashboard-core-footer /> -->
  </v-main>
</template>

<script>
  export default {
    name: 'DashboardCoreView',
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
  // components: {
  //   DashboardCoreFooter: () => import('./Footer'),
  // },
  }
</script>
