<template>
  <div>
    <!-- -----------------------------------------------
    Banner
    ----------------------------------------------- -->
    <Banner />

    <!-- -----------------------------------------------
    ./ Banner
    ----------------------------------------------- -->
    <!-- -----------------------------------------------
    All Components
    ----------------------------------------------- -->
    <AllCustomComponents />
    <!-- -----------------------------------------------
    ./ All Components
    ----------------------------------------------- -->
    <!-- -----------------------------------------------
    Coming Soon
    ----------------------------------------------- -->
    <!-- <ComingSoon /> -->
    <!-- -----------------------------------------------
    ./ Coming Soon
    ----------------------------------------------- -->
  </div>
</template>

<script>
// const URL = "https/api.ensiklotari.com/v1/";
export default {
  head() {
    return {
      title: "Halo",
      meta: [
        {
          hid: "description",
          name: "EnsikloTari",
          content: "EnsikloTari Menari Dimanapun Kapanpun",
        },
      ],
    };
  },

  data() {
    return {
      ip: null,
      data: {},
    };
  },
  components: {
    Banner: () => import("@/components/shared/lp-banner/Banner"),
    ComingSoon: () => import("@/components/shared/coming-soon/ComingSoon"),
    AllCustomComponents: () =>
      import("@/components/custom/AllCustomComponents"),
    // Setting: () => import('@/components/Setting')
  },
  
  methods: {},
};
</script>
