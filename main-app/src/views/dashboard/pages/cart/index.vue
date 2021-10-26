<template>
  <v-container>
    <v-row>
      <v-col
        cols="12"
        sm="6"
        lg="3"
      >
        <base-material-stats-card
          color="orange"
          icon="mdi-sofa"
          title="All"
          value="184"
        />
      </v-col>
      <v-col
        cols="12"
        sm="6"
        lg="3"
      >
        <base-material-stats-card
          color="orange"
          icon="mdi-sofa"
          title="Bookings"
          value="184"
        />
      </v-col>
      <v-col
        cols="12"
        sm="6"
        lg="3"
      >
        <base-material-stats-card
          color="orange"
          icon="mdi-sofa"
          title="Bookings"
          value="184"
        />
      </v-col>
      <v-col cols="12">
        <app-data-table />
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
      cart () {
        return this.$store.state.cart.data
      },
    },
    mounted () {
      this.getDataCart()
    },
    methods: {
      getDataCart () {
        this.$store.dispatch("cart/getDataCart", {
          entities: "user,class.studio, class.category, class.img",
          type: "cart",
        })
      },
    },
  }
</script>

<style lang="sass">
.posistion
    position: fixed
    margin-left: 771px
</style>
