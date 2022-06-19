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
          icon="mdi-poll"
          title="All"
          :value="String(computedSummary.all)"
          sub-icon="mdi-heart"
          sub-text="EnsikloTari"
          @click.native="setSummary('')"
        />
      </v-col>
      <v-col
        cols="12"
        sm="6"
        lg="3"
      >
        <base-material-stats-card
          color="info"
          icon="mdi-poll"
          title="Paid"
          :value="String(computedSummary.paid)"
          sub-icon="mdi-heart"
          sub-text="EnsikloTari"
          @click.native="setSummary('paid')"
        />
      </v-col>
      <v-col
        cols="12"
        sm="6"
        lg="3"
      >
        <base-material-stats-card
          color="info"
          icon="mdi-poll"
          title="Waiting Confirmation"
          :value="String(computedSummary.waiting_confirmation)"
          sub-icon="mdi-heart"
          sub-text="EnsikloTari"
          @click.native="setSummary('waiting_confirmation')"
        />
      </v-col>
      <v-col
        cols="12"
        sm="6"
        lg="3"
      >
        <base-material-stats-card
          color="info"
          icon="mdi-poll"
          title="Waiting Payment"
          :value="String(computedSummary.waiting_payment)"
          sub-icon="mdi-heart"
          sub-text="EnsikloTari"
          @click.native="setSummary('waiiitng_payment')"
        />
      </v-col>
      <v-col cols="12">
        <app-data-table :data="computedData" />
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
  import dataTable from "./components/_dataTable.vue"
  export default {
    components: {
      "app-data-table": dataTable,
    },
    data: () => ({
      summary: "",
    }),
    computed: {
      computedData () {
        return this.$store.state.cart_video.data
      },
      computedSummary () {
        return this.$store.state.cart_video.summary
      },
    },
    watch: {
      summary (value) {
        this.$router.push({ query: { ...this.$route.query, summary: value } })
      },
      "$route.query.summary" (value) {
        this.summary = value
        this.getData()
      },
    },
    mounted () {
      this.getData()
      this.getSummary()
    },
    methods: {
      getData () {
        this.$store
          .dispatch("cart_video/getData", {
            entities: "video,subscription.plan,user",
            summary: this.summary || this.$route.query.summary,
          })
          .then((res) => {
            console.log(res.data.data)
          })
      },
      getSummary () {
        this.$store.dispatch("cart_video/getSummary")
      },
      setSummary (value) {
        this.summary = value
      },
    },
  }
</script>

<style></style>
