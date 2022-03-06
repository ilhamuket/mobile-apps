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
        <app-data-table :data="computedPayment" />
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
      computedPayment () {
        return this.$store.state.payment.data
      },
    },
    mounted () {
      this.getDataPayment()
    },
    methods: {
      getDataPayment () {
        this.$store.dispatch('payment/getDataPayment', {
          entities: 'user,class,video,cart.form,cartVideo',
        })
      },
    },
  }
</script>

<style></style>
