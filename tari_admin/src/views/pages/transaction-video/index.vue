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
          sub-icon="mdi-clock"
          sub-text="Just Updated"
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
          sub-icon="mdi-clock"
          sub-text="Just Updated"
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
          sub-icon="mdi-clock"
          sub-text="Just Updated"
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
          sub-icon="mdi-clock"
          sub-text="Just Updated"
        />
      </v-col>
      <v-col cols="12">
        <app-data-table :data="computedTransaction" />
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
    computed: {
      computedTransaction () {
        return this.$store.state.transaction_video.data
      },
    },
    mounted () {
      this.getDataTransactionEnsikloVideo()
    },
    methods: {
      getDataTransactionEnsikloVideo () {
        this.$store.dispatch('transaction_video/getDataTransactionEnsikloVideo', {
          entities: 'bank,video,form.plan,subscription,user',
        })
      },
    },
  }
</script>

<style></style>
