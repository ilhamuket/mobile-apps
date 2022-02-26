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
          :value="String(computedSummary.total)"
          sub-icon="mdi-heart-outline"
          sub-text="Ensiklotari"
          :class="`${$route.query.summary === '' ? 'selected' : ''}`"
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
          icon="mdi-twitter"
          title="Paid"
          :value="String(computedSummary.paid)"
          sub-icon="mdi-heart-outline"
          sub-text="Ensiklotari"
          :class="`${$route.query.summary === 'paid' ? 'selected' : ''}`"
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
          icon="mdi-twitter"
          title="Waiting"
          :value="String(computedSummary.waiting)"
          sub-icon="mdi-heart-outline"
          :class="`${$route.query.summary === 'waiting' ? 'selected' : ''}`"
          sub-text="Ensiklotari"
          @click.native="setSummary('waiting')"
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
          title="New"
          :value="String(computedSummary.new)"
          sub-icon="mdi-heart-outline"
          sub-text="Ensiklotari"
          :class="`${$route.query.summary === 'new' ? 'selected' : ''}`"
          @click.native="setSummary('new')"
        />
      </v-col>
      <v-col>
        <app-data-table :data="computedTrasaction" />
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
  import dataTable from './_dataTable.vue'
  export default {
    components: {
      'app-data-table': dataTable,
    },
    data: () => ({
      summary: '',
    }),
    computed: {
      computedTrasaction () {
        return this.$store.state.transaction.data
      },
      computedSummary () {
        return this.$store.state.transaction.summary
      },
    },
    watch: {
      summary (val) {
        this.$router.push({ query: { ...this.$route.query, summary: val } })
      },
      '$route.query.summary': function (val) {
        this.summary = val
        this.getDataTransactionEnsikloLive()
      },
    },
    mounted () {
      this.getDataTransactionEnsikloLive()
      this.getDataSummaryTransactionEnsikloLive()
    },
    methods: {
      getDataTransactionEnsikloLive () {
        this.$store.dispatch('transaction/getDataTransactionEnsikloLive', {
          entities: 'class,user,form,bank',
          summary: this.summary || this.$route.query.summary,
        })
      },
      getDataSummaryTransactionEnsikloLive () {
        this.$store.dispatch(
          'transaction/getDataSummaryTransactionEnsikloLive',
          {},
        )
      },
      setSummary (val) {
        this.summary = val
      },
    },
  }
</script>

<style></style>
