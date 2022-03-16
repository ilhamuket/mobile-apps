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
          sub-text="EnsikloTari"
          :class="$route.query.summary === '' ? 'selected' : ''"
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
          sub-text="EnsikloTari"
          :class="$route.query.summary === 'paid' ? 'selected' : ''"
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
          sub-text="EnsikloTari"
          :class="
            $route.query.summary === 'waiting_confirmation' ? 'selected' : ''
          "
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
          sub-text="EnsikloTari"
          :class="$route.query.summary === 'waiting_payment' ? 'selected' : ''"
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
          title="Pending"
          :value="String(computedSummary.pending)"
          sub-icon="mdi-heart-outline"
          sub-text="EnsikloTari"
          :class="$route.query.summary === 'pending' ? 'selected' : ''"
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
          icon="mdi-twitter"
          title="New"
          :value="String(computedSummary.new)"
          sub-icon="mdi-heart-outline"
          sub-text="EnsikloTari"
          :class="$route.query.summary === 'new' ? 'selected' : ''"
          @click.native="setSummary('new')"
        />
      </v-col>
      <v-col cols="12">
        <app-data-table
          :data="computedTransaction"
          @confirmation="methodDialogConfirmation"
          @reject="methodDialogReject"
          @refresh="refresh"
        />
      </v-col>
    </v-row>
    <app-dialog-confirmation
      :dialog="dialogConfirmation"
      :title="dialogConfirmation.text"
      :color-system-bar="dialogConfirmation.color"
      :icon-system-bar="dialogConfirmation.icon"
      :title-system-bar="dialogConfirmation.title"
      :is-array="false"
      :is-text-btn1="true"
      :color-btn1="`error`"
      :text-btn1="`Cancel`"
      :text-btn2="`Confirm`"
      :color-btn2="`btn_primary`"
      @input1="dialogConfirmation.open = false"
      @input2="confirmationData"
    />
    <app-dialog-reject
      :dialog="dialogReject"
      :title="dialogReject.text"
      :color-system-bar="dialogReject.color"
      :title-system-bar="dialogReject.title"
      :icon-system-bar="dialogReject.icon"
      :is-array="false"
      :is-text-btn1="false"
      :color-btn1="`btn_primary`"
      :text-btn1="`Cancel`"
      :is-text-btn2="true"
      :color-btn2="`error`"
      :text-btn2="`Reject`"
      @input1="dialogReject.open = false"
      @input2="rejectData"
    />
  </v-container>
</template>

<script>
  import dataTable from './_dataTable.vue'
  import dialogNotice from './_dialogNotice.vue'
  export default {
    components: {
      'app-data-table': dataTable,
      'app-dialog-confirmation': dialogNotice,
      'app-dialog-reject': dialogNotice,
    },
    data: () => ({
      dialogConfirmation: {
        open: false,
        title: 'Confirmation',
        text: 'Are you sure you want to delete this item?',
        color: 'warning',
        icon: 'mdi-check-decagram',
        data: {},
      },
      dialogReject: {
        open: false,
        title: 'Rejected',
        text: 'Are you sure you want to reject this item?',
        color: 'error',
        icon: 'mdi-close-circle',
        data: {},
      },
      summary: '',
    }),
    computed: {
      computedTransaction () {
        return this.$store.state.transaction_video.data
      },
      computedSummary () {
        return this.$store.state.transaction_video.summary
      },
    },
    watch: {
      summary (val) {
        this.$router.push({ query: { ...this.$route.query, summary: val } })
      },
      '$route.query.summary': function (newVal) {
        this.summary = newVal
        this.getDataSummaryTransactionEnsikloVideo()
      },
    },
    mounted () {
      this.getDataTransactionEnsikloVideo()
      this.getDataSummaryTransactionEnsikloVideo()
    },
    methods: {
      getDataTransactionEnsikloVideo () {
        this.$store.dispatch('transaction_video/getDataTransactionEnsikloVideo', {
          entities: 'bank,video,form.plan,subscription,user',
          sort: '-id',
          summary: this.summary || this.$route.query.summary,
        })
      },
      getDataSummaryTransactionEnsikloVideo () {
        this.$store.dispatch(
          'transaction_video/getDataSummaryTransactionEnsikloVideo',
        )
      },
      setSummary (val) {
        this.summary = val
      },
      confirmationData ({ item }) {
        this.$store
          .dispatch('transaction_video/confirmationData', {
            id: item.id,
          })
          .then((res) => {
            if (res.data.meta.status) {
              this.dialogConfirmation.open = false
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
                title: 'Confirmation Data Successfully',
              })
            }
          })
          .catch((e) => {
            console.log('something error ' + e)
          })
      },
      rejectData ({ item }) {
        this.$store
          .dispatch('transaction_video/rejectData', {
            cart_id: item.id,
          })
          .then((res) => {
            if (res.data.meta.status) {
              this.dialogReject.open = false
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
                title: 'Reject Data Successfully',
              })
            }
          })
          .catch((e) => {
            console.log('something error ' + e)
          })
      },
      methodDialogConfirmation ({ item }) {
        this.dialogConfirmation.data = item
        this.dialogConfirmation.open = true
      },
      methodDialogReject ({ item }) {
        this.dialogReject.data = item
        this.dialogReject.open = true
      },
      refresh () {
        this.getDataTransactionEnsikloVideo()
        this.getDataSummaryTransactionEnsikloVideo()
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
          title: 'Fetch Data',
        })
      },
    },
  }
</script>

<style></style>
