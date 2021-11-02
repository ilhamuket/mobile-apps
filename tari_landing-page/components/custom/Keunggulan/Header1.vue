<template>
  <div>
    <!-- -----------------------------------------------
          Start Header
    ----------------------------------------------- -->
  
      <!-- <v-container class="py-0 fill-height">
        <v-row>
          <v-col cols="12" md="6">
            <v-img src="https://www.ensiklotari.com/img/communities.svg" width="250" />
          </v-col>
          <v-col cols="12" md="6">
            <span class="font-spartan-text text-h2 margin--text">
              Didukung Oleh Sanggar Sanggar
            </span>
          </v-col>
        </v-row>
      </v-container> -->
   
    <!-- -----------------------------------------------
          End Header
    ----------------------------------------------- -->
  </div>
</template>

<script>
export default {
  name: "Header1",
  data() {
    return {
      isActive: false,
    };
  },
  methods: {
    toggleClass: function (event) {
      this.isActive = !this.isActive;
    },
  },
};
</script>
<style lang="sass">
.margin--text
  margin-left: -160px
  margin-top: 20px !important 
</style>
