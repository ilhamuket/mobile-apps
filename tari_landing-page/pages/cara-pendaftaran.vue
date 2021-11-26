<template>
  <div>
    <app-cara></app-cara>
    <app-tutorial :data="data.data" :list="list"></app-tutorial>
  </div>
</template>

<script>
import axios from "axios";
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
  data: () => ({
    data: {
      data: {},
    },
    list: {
      data: [],
    },
  }),
  mounted() {
    this.getAutoPlay();
    this.listTutorial();
  },
  methods: {
    async getAutoPlay() {
      axios.defaults.headers.common.Authorization =
        "Bearer " + localStorage.getItem("access_token");
      axios.defaults.baseURL = process.env.VUE_APP_API_URL;

      const params = {
        entities: "",
      };
      const data = await this.$axios.get("/tutorial-free/video-auto", {
        params: params,
      });
      this.data = data.data;
    },
    async listTutorial() {
      axios.defaults.headers.common.Authorization =
        "Bearer " + localStorage.getItem("access_token");
      axios.defaults.baseURL = process.env.VUE_APP_API_URL;

      const params = {};
      const data = await this.$axios.get("/tutorial-free/list-video", {
        params: params,
      });
      this.list = data.data;
      console.log(this.list);
    },
  },
};
</script>

<style>
</style>