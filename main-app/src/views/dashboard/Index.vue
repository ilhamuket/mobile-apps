<template>
  <v-app>
    <dashboard-core-drawer-break-point v-if="$vuetify.breakpoint.mdAndDown" />
    <dashboard-core-drawer v-else />
    <dashboard-core-view />
    <settings v-if="$vuetify.breakpoint.mdAndDown" />
    <app-bar-break-point v-if="$vuetify.breakpoint.mdAndDown" />
    <dashboard-core-app-bar v-else />
  </v-app>
</template>

<script>
  export default {
    name: "DashboardIndex",

    components: {
      DashboardCoreAppBar: () => import("./components/core/AppBar"),
      DashboardCoreDrawer: () => import("./components/core/Drawer"),
      DashboardCoreDrawerBreakPoint: () =>
      import("./components/core/DrawerBreakPoint.vue"),
      settings: () => import("./components/core/Settings.vue"),
      AppBarBreakPoint: () => import("./components/core/AppBarBreakpoint_.vue"),

      DashboardCoreView: () => import("./components/core/View"),
    },

    data: () => ({
      expandOnHover: false,
    }),
    mounted () {
      this.$store.dispatch("user/me", {
        entities: "followingStudio.img,followingStudio.reviews,cart",
      })
    },
  }
</script>
