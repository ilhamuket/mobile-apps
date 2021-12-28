<template>
  <v-container>
    <v-row>
      <v-col
        cols="12"
        sm="6"
        lg="3"
      >
        <base-material-stats-card
          color="info"
          icon="mdi-twitter"
          title="Followers"
          value="+245"
          sub-icon="mdi-heart-outline"
          sub-text="EnsikloTari"
        />
      </v-col>
      <v-col
        cols="12"
        sm="6"
        lg="3"
      >
        <base-material-stats-card
          color="info"
          icon="mdi-twitter"
          title="Followers"
          value="+245"
          sub-icon="mdi-heart-outline"
          sub-text="EnsikloTari"
        />
      </v-col>
      <v-col
        cols="12"
        sm="6"
        lg="3"
      >
        <base-material-stats-card
          color="info"
          icon="mdi-twitter"
          title="Followers"
          value="+245"
          sub-icon="mdi-heart-outline"
          sub-text="EnsikloTari"
        />
      </v-col>
      <v-col cols="12">
        <app-data-table :data="computedDataCart" />
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
  import dataTable from "./component_core/_dataTable.vue"
  export default {
    components: {
      "app-data-table": dataTable,
    },
    data: () => ({}),
    computed: {
      computedDataCart () {
        return this.$store.state.cart.cart_video
      },
    },
    watch: {},
    mounted () {
      this.getDataEnsikloVideoCart()
    },
    methods: {
      getDataEnsikloVideoCart () {
        this.$store.dispatch("cart/getDataEnsikloVideoCart", {
          entities: "video",
        })
      },
    },
  }
</script>

<style></style>
