<template>
  <div>
    <banner />
    <app-studio :data="data" />
  </div>
</template>

<script>
import banner from "../components/shared/lp-banner/BannerStudio.vue";
import studio from "../components/Sanggar.vue";
export default {
  components: {
    banner,
    "app-studio": studio,
  },
  data: () => ({
    studio: {
      data: [],
      meta: {},
    },
    data: {},
  }),
  head() {
    return {
      title: "Pilihan Sanggar Ensiklotari",
      meta: [
        {
          hid: "Sanggar",
          name: "Pilihan Sanggar EnsikloTari",
          content: "Sanggar EnsikloTari",
        },
      ],
    };
  },
  computed: {},
  created() {
    this.getAllStudio();
    // console.log(this.studio);
  },
  methods: {
    async getAllStudio() {
      const params = {
        entities: "img",
      };

      const studio = await this.$axios.get("all/studio", { params: params });
      console.log(studio.data);
      this.data = studio.data;
    },
  },
};
</script>

<style>
</style>