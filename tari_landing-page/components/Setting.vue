<template>
  <div id="settings-wrapper">
    <v-card
      to="#u"
      id="settings"
      class="py-2 px-4"
      color="rgba(0, 0, 0, .3)"
      dark
      flat
      link
      min-width="100"
      style="position: fixed; top: 115px; right: -35px; border-radius: 8px"
    >
      <v-icon large> mdi-account</v-icon>
    </v-card>
  </div>
</template>

<script>
// Mixins
import Proxyable from "vuetify/lib/mixins/proxyable";
import { mapMutations, mapState } from "vuex";

export default {
  name: "DashboardCoreSettings",

  mixins: [Proxyable],

  data: () => ({
    color: "#E91E63",
    colors: ["#9C27b0", "#00CAE3", "#4CAF50", "#ff9800", "#E91E63", "#FF5252"],
    image:
      "https://demos.creative-tim.com/material-dashboard/assets/img/sidebar-1.jpg",
    images: [
      "https://demos.creative-tim.com/material-dashboard/assets/img/sidebar-1.jpg",
      "https://demos.creative-tim.com/material-dashboard/assets/img/sidebar-2.jpg",
      "https://demos.creative-tim.com/material-dashboard/assets/img/sidebar-3.jpg",
      "https://demos.creative-tim.com/material-dashboard/assets/img/sidebar-4.jpg",
    ],
    menu: false,
    saveImage: "",
    showImg: true,
    lenguage: [
      {
        name: "en",
        img: "https://media.istockphoto.com/vectors/flag-of-great-britain-vector-id497118178?s=612x612",
      },
      {
        name: "id",
        img: "https://upload.wikimedia.org/wikipedia/commons/9/9f/Flag_of_Indonesia.svg",
      },
    ],
  }),

  computed: {
    ...mapState(["barImage"]),
  },

  watch: {
    color(val) {
      this.$vuetify.theme.themes[this.isDark ? "dark" : "light"].primary = val;
    },
    showImg(val) {
      if (!val) {
        this.saveImage = this.barImage;
        this.setBarImage("");
      } else if (this.saveImage) {
        this.setBarImage(this.saveImage);
        this.saveImage = "";
      } else {
        this.setBarImage(val);
      }
    },
    image(val) {
      this.setBarImage(val);
    },
  },

  methods: {
    ...mapMutations({
      setBarImage: "SET_BAR_IMAGE",
    }),
  },
};
</script>

<style lang="sass">

</style>
