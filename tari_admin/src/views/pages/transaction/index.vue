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
          title="Waiting Confirmation"
          :value="String(computedSummary.waiting_confirmation)"
          sub-icon="mdi-heart-outline"
          :class="`${
            $route.query.summary === 'waiting_confirmation' ? 'selected' : ''
          }`"
          sub-text="Ensiklotari"
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
          icon="mdi-twitter"
          title="Waiting Payment"
          :value="String(computedSummary.waiting_payment)"
          sub-icon="mdi-heart-outline"
          sub-text="Ensiklotari"
          :class="`${
            $route.query.summary === 'waiting_payment' ? 'selected' : ''
          }`"
          @click.native="setSummary('waiting_payment')"
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
          title="Waiting Proof"
          :value="String(computedSummary.waiting_proof)"
          sub-icon="mdi-heart-outline"
          sub-text="Ensiklotari"
          :class="`${
            $route.query.summary === 'waiting_proof' ? 'selected' : ''
          }`"
          @click.native="setSummary('waiting_proof')"
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
          sub-text="Ensiklotari"
          :class="`${$route.query.summary === 'cancelled' ? 'selected' : ''}`"
          @click.native="setSummary('cancelled')"
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
          title="Pending"
          :value="String(computedSummary.pending)"
          sub-icon="mdi-heart-outline"
          sub-text="Ensiklotari"
          :class="`${$route.query.summary === 'pending' ? 'selected' : ''}`"
          @click.native="setSummary('pending')"
        />
      </v-col>

      <v-col cols="12">
        <app-data-table
          :data="computedTrasaction"
          @confirmation="methodsOpenDialogConfirmation"
          @refresh="methodsRefresh"
          @reject="methodRejectLive"
        />
      </v-col>
    </v-row>
    <app-dialog-confirmation-id
      :dialog="dataDialogConfirmationlive"
      color-system-bar="info"
      :title-system-bar="`Confirmation Payment`"
      :icon-system-bar="`mdi-check`"
      :title="`Are you sure to confirm this payment?`"
      :text-btn="`Confirmation`"
      @input="confirmationCartEnsikloLive"
    />
    <app-dialog-rejected-id
      :dialog="dataDialogRejectLive"
      color-system-bar="red"
      :title-system-bar="`Rejected Payment`"
      :icon-system-bar="`mdi-close`"
      :text-btn="`Rejected`"
      :title="`Are you sure to reject this payment?`"
      @input="rejectedCartEnsikloLive"
    />
  </v-container>
</template>

<script>
  import dataTable from './_dataTable.vue'
  import dialogNotice from './_dialogNotice.vue'
  export default {
    components: {
      'app-data-table': dataTable,
      'app-dialog-confirmation-id': dialogNotice,
      'app-dialog-rejected-id': dialogNotice,
    },
    data: () => ({
      summary: '',
      dataDialogConfirmationlive: {
        open: false,
        data: {},
      },
      dataDialogRejectLive: {
        open: false,
        data: {},
      },
      search: '',
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
      methodsOpenDialogConfirmation ({ item }) {
        this.dataDialogConfirmationlive.data = item
        this.dataDialogConfirmationlive.open = true
      },
      methodRejectLive ({ item }) {
        this.dataDialogRejectLive.data = item
        this.dataDialogRejectLive.open = true
      },
      confirmationCartEnsikloLive ({ item }) {
        console.log('id: ', item.id)
        this.$store
          .dispatch('transaction/confirmationCartEnsikloLive', {
            id: item.id,
            class_id: item.class_id,
          })
          .then((res) => {
            console.log(res)
            if (res.data.meta.status) {
              this.dataDialogConfirmationlive.open = false
              const Toast = this.$swal.mixin({
                toast: true,
                position: 'bottom-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                  toast.addEventListener('mouseenter', this.$swal.stopTimer)
                  toast.addEventListener('mouseleave', this.$swal.resumeTimer)
                },
                popup: 'swal2-show',
                backdrop: 'swal2-backdrop-show',
                icon: 'swal2-icon-show',
              })
              Toast.fire({
                icon: 'success',
                title: 'Confirmation Payment Successfully',
              })
            } else {
              console.log(res)
            }
          })
      },
      methodsRefresh () {
        this.getDataTransactionEnsikloLive()
      },
      rejectedCartEnsikloLive ({ item }) {
        this.$store
          .dispatch('transaction/rejectedCartEnsikloLive', {
            id: item.id,
            class_id: item.class_id,
          })
          .then((res) => {
            this.getDataSummaryTransactionEnsikloLive()
            if (res.data.meta.status) {
              this.dataDialogRejectLive.open = false
              const Toast = this.$swal.mixin({
                toast: true,
                position: 'bottom-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                  toast.addEventListener('mouseenter', this.$swal.stopTimer)
                  toast.addEventListener('mouseleave', this.$swal.resumeTimer)
                },
                popup: 'swal2-show',
                backdrop: 'swal2-backdrop-show',
                icon: 'swal2-icon-show',
              })
              Toast.fire({
                icon: 'success',
                title: 'Rejected Payment Successfully',
              })
            } else {
              console.log(res)
            }
          })
      },
    },
  }
</script>

<style></style>
