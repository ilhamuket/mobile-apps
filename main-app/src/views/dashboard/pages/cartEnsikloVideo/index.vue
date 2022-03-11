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
          title="Total"
          :value="String(computedSummary.all)"
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
          title="Paid"
          :value="String(computedSummary.paid)"
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
          title="Waiting Confirmation"
          :value="String(computedSummary.waiting_confirmation)"
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
          title="Waiting Payment"
          :value="String(computedSummary.waiting_payment)"
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
          title="Cancelled"
          :value="String(computedSummary.cancelled)"
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
      computedSummary () {
        return this.$store.state.cart.summary_video
      },
    },
    watch: {},
    mounted () {
      this.getDataEnsikloVideoCart()
      this.getSummaryDataEnsikloVideoCart()
    },
    methods: {
      getDataEnsikloVideoCart () {
        this.$store.dispatch("cart/getDataEnsikloVideoCart", {
          entities: "video",
        })
      },
      getSummaryDataEnsikloVideoCart () {
        this.$store.dispatch("cart/getSummaryDataEnsikloVideoCart")
      },
    },
  }
</script>

<style></style>
