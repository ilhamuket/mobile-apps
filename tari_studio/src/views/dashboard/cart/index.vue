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
          sub-icon="mdi-heart-outline"
          sub-text="EnsikloTari"
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
          icon="mdi-poll"
          title="Paid"
          :value="String(computedSummary.paid)"
          sub-icon="mdi-heart-outline"
          sub-text="EnsikloTari"
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
          icon="mdi-poll"
          title="Waiting Confirmation"
          :value="String(computedSummary.waiting_confirmation)"
          sub-icon="mdi-heart-outline"
          sub-text="EnsikloTari"
          :class="`${
            $route.query.summary === 'waiting_confirmation' ? 'selected' : ''
          }`"
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
          sub-icon="mdi-heart-outline"
          sub-text="EnsikloTari"
          :class="`${
            $route.query.summary === 'waiting_payment' ? 'selected' : ''
          }`"
          @click.native="setSummary('waiting_payment')"
        />
      </v-col>
      <v-col cols="12">
        <app-data-table
          :data="computedData"
          @refresh="refresh"
          @waAdmin="sendWhatsapp"
        />
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
  import dataTableVue from "./components/_dataTable.vue"

  export default {
    components: {
      "app-data-table": dataTableVue,
    },
    data: () => ({
      summary: "",
      textToAdmin: ` `,
    }),
    computed: {
      computedData () {
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
      "$route.query.summary" (value) {
        this.summary = value
        this.getDataCart()
      },
    },
    mounted () {
      this.getDataCart()
      this.getSummary()
    },
    methods: {
      getDataCart () {
        this.$store.dispatch("cart/getDataCart", {
          entities: "user,class.img,class.studio,form",
          summary: this.summary || this.$route.query.summary,
        })
      },
      getSummary () {
        this.$store.dispatch("cart/getSummary")
      },
      setSummary (value) {
        this.summary = value
        this.getDataCart()
      },
      sendWhatsapp ({ item }) {
        // console.log(item)
        window.open(
          `https://api.whatsapp.com/send?phone=089621174934&text=halo Admin EnsikloTariiii <3, saya dari ${item.class.studio.name} ingin mengirim pesanan ${item.class.name} ke ${item.user.name} dengan nomor ${item.user.phone}`,
        )
      },
      refresh () {
        this.getDataCart()
        this.getSummary()
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

<style></style>
