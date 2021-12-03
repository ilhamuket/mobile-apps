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
          icon="mdi-account-outline"
          title="All"
          :value="String(computedSummary.all)"
          sub-icon="mdi-heart-outline"
          sub-text="EnsikloTari"
          style="cursor: pointer"
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
          icon="mdi-account-check-outline"
          title="Paid"
          :value="String(computedSummary.paid)"
          sub-icon="mdi-heart-outline"
          sub-text="EnsikloTari"
          style="cursor: pointer"
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
          icon="mdi-account-clock-outline"
          title="Pending"
          :value="String(computedSummary.pending)"
          sub-icon="mdi-heart-outline"
          sub-text="EnsikloTari"
          style="cursor: pointer"
          @click.native="setSummary('pending')"
        />
      </v-col>
      <v-col
        cols="12"
        sm="6"
        lg="3"
      >
        <base-material-stats-card
          color="info"
          icon="mdi-account-convert"
          title="New"
          :value="String(computedSummary.new)"
          sub-icon="mdi-heart-outline"
          sub-text="EnsikloTari"
          style="cursor: pointer"
          @click.native="setSummary('new')"
        />
      </v-col>
      <v-col cols="12">
        <app-data-table :data="computedData" />
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
    data: () => ({
      summary: "",
    }),
    computed: {
      computedData () {
        return this.$store.state.studioHasStudio.data
      },
      computedSummary () {
        return this.$store.state.studioHasStudio.summary
      },
    },
    watch: {
      summary (val) {
        this.$router.push({ query: { ...this.$route.query, summary: val } })
      },
      "$route.query.summary": function (val) {
        this.summary = val
      },
    },
    mounted () {
      this.getDataUserHasStudio()
      this.getDataSummaryStudioHasUser()
    },
    methods: {
      getDataUserHasStudio (summary) {
        this.$store.dispatch("studioHasStudio/getDataUserHasStudio", {
          id: localStorage.getItem("studio_id"),
          summary: summary,
          entities: "form.cart,student.img,classes",
        })
      },
      getDataSummaryStudioHasUser () {
        this.$store.dispatch("studioHasStudio/getDataSummaryStudioHasUser", {
          id: localStorage.getItem("studio_id"),
        })
      },
      setSummary (item) {
        this.summary = item
        this.getDataUserHasStudio(this.summary)
      },
    },
  }
</script>

<style></style>
