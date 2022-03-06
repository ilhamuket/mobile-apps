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
          :value="String(computedSummary.all)"
          style="cursor: pointer"
          @click.native="toNavigate('')"
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
          title="Paid"
          :value="String(computedSummary.paid)"
          style="cursor: pointer"
          @click.native="toNavigate('paid')"
        />
      </v-col>
      <v-col
        cols="12"
        lg="3"
      >
        <base-material-stats-card
          color="orange"
          icon="mdi-sofa"
          title="Pending"
          :value="String(computedSummary.pending)"
          style="cursor: pointer"
          @click.native="toNavigate('pending')"
        />
      </v-col>
      <v-col
        cols="12"
        lg="3"
      >
        <base-material-stats-card
          color="orange"
          icon="mdi-sofa"
          title="Waiting Proof Of Transfer"
          :value="String(computedSummary.waiting_proof)"
          style="cursor: pointer"
          @click.native="toNavigate('waiting_proof')"
        />
      </v-col>
      <v-col
        cols="12"
        lg="3"
      >
        <base-material-stats-card
          color="orange"
          icon="mdi-sofa"
          title="Waiting Payment"
          :value="String(computedSummary.waiting_payment)"
          style="cursor: pointer"
          @click.native="toNavigate('waiting_payment')"
        />
      </v-col>
      <v-col
        cols="12"
        lg="3"
      >
        <base-material-stats-card
          color="orange"
          icon="mdi-sofa"
          title="Waiting Confirmation"
          :value="String(computedSummary.waiting_confirmation)"
          style="cursor: pointer"
          @click.native="toNavigate('waiting_confirmation')"
        />
      </v-col>
      <v-col
        cols="12"
        lg="3"
      >
        <base-material-stats-card
          color="orange"
          icon="mdi-sofa"
          title="Cancelled"
          :value="String(computedSummary.cancelled)"
          style="cursor: pointer"
          @click.native="toNavigate('cancelled')"
        />
      </v-col>
      <v-col cols="12">
        <app-data-table
          :data="cart"
          @refresh="refresh"
        />
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
      cart: [],
      summary: "",
    }),
    computed: {
      computedCart () {
        return this.$store.state.cart.data
      },
      computedSummary () {
        return this.$store.state.cart.summary
      },
    },
    watch: {
      summary (value) {
        this.$router.push({ query: { ...this.$route.query, summary: value } })
      },
      "$route.query.summary": function (value) {
        this.summary = value
        this.getDataCart()
      },
    },
    mounted () {
      this.getDataCart()
      this.getDataCartSummary()
    },
    methods: {
      getDataCart () {
        this.$store
          .dispatch("cart/getDataCart", {
            entities: "user,class.studio, class.category, class.img,form",
            summary: this.$route.query.summary,
          })
          .then((res) => {
            this.cart = res.data.data
          })
      },
      getDataCartSummary () {
        this.$store.dispatch("cart/getDataCartSummary")
      },
      toNavigate (link) {
        this.summary = link
        this.getDataCart()
      },
      refresh () {
        this.getDataCart()
        const Toast = this.$swal.mixin({
          toast: true,
          position: "bottom-end",
          showConfirmButton: false,
          timer: 3000,
          timerProgressBar: true,
          didOpen: (toast) => {
            toast.addEventListener("mouseenter", this.$swal.stopTimer)
            toast.addEventListener("mouseleave", this.$swal.resumeTimer)
          },
          popup: "swal2-show",
          backdrop: "swal2-backdrop-show",
          icon: "swal2-icon-show",
        })
        Toast.fire({
          icon: "success",
          title: "Fetch Data",
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
