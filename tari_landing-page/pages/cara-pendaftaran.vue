<template>
  <div>
    <app-cara></app-cara>
    <app-tutorial></app-tutorial>
  </div>
</template>

<script>
import cara from "../components/shared/lp-banner/BannerCara.vue";
import tutorial from "../components/Tutorial.vue";
export default {
  components: {
    "app-cara": cara,
    "app-tutorial": tutorial,
  },
  head() {
    return {
      title: "Cara Pendaftaran Dan Pembelian",
      meta: [
        {
          hid: "description",
          name: "Next Ui Kit",
          content: "Next Ui Kit is the best way",
        },
      ],
    };
  },
  mounted() {},
};
</script>

<style>
</style>