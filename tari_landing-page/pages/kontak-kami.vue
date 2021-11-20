<template>
  <div>
    <kontak />
    <contact />
  </div>
</template>

<script>
import kontak from "../components/shared/lp-banner/BannerContact.vue";
import contact from "../components/custom/contact/Contact.vue";
export default {
  components: {
    kontak,
    contact,
  },
  head() {
    return {
      title: "Kontak Kami",
      meta: [
        {
          hid: "description",
          name: "Next Ui Kit",
          content: "Next Ui Kit is the best way",
        },
      ],
    };
  },
};
</script>

<style>
</style>