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
          icon="mdi-twitter"
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
          icon="mdi-twitter"
          title="Waiting Transfer"
          :value="String(computedSummary.waiting_transfer)"
          sub-icon="mdi-heart"
          sub-text="EnsikloTari"
          @click.native="setSummary('waiting_transfer')"
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
          title="Rejected"
          :value="String(computedSummary.rejected)"
          sub-icon="mdi-heart"
          sub-text="EnsikloTari"
          @click.native="setSummary('rejected')"
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
          sub-icon="mdi-heart"
          sub-text="EnsikloTari"
          @click.native="setSummary('new')"
        />
      </v-col>
      <v-col cols="12">
        <app-data-table
          :data="computedPayment"
          @transfer="methodDialogPayment"
          @refresh="refresh"
          @listBank="methodDialogListBank"
          @delete="methodsDialogDeletePayment"
          @removeBank="deleteBankChoice"
        />
      </v-col>
    </v-row>
    <app-dialog-transfer
      :is-transfer="true"
      :dialog="dialogPayment"
      :icon-system-bar="`mdi-cart`"
      :title-system-bar="`Transfer`"
      color-system-bar="success"
      @upload="uploadProof"
    />
    <app-dialog-list-bank
      :is-data-list-bank="true"
      :is-data-array="true"
      :dialog="dialogListBank"
      :icon-system-bar="`mdi-cart`"
      :title-system-bar="`Transfer`"
      color-system-bar="success"
      :title="`Choose a Bank Account`"
      @input="chooseAccountBank"
    />
    <app-dialog-delete
      :is-data-array="false"
      :is-transfer="false"
      :dialog="dialogDeleteById"
      :icon-system-bar="`mdi-delete`"
      :color-system-bar="`red`"
      :title-system-bar="`Delete`"
      :title="`Are you sure want to delete this payment with studio`"
      :text-btn1="`Cancel`"
      :text-btn2="`Delete`"
      :text-btn-color1="`btn_primary`"
      :text-btn-color2="`red`"
      :is-text-btn2="true"
      @actionBtn1="dialogDeleteById.open = false"
      @actionBtn2="deleteDataPayment"
    />
  </v-container>
</template>

<script>
  import dataTable from './_dataTable.vue'
  import dialogNotice from './_dialogNotice.vue'
  export default {
    components: {
      'app-data-table': dataTable,
      'app-dialog-transfer': dialogNotice,
      'app-dialog-list-bank': dialogNotice,
      'app-dialog-delete': dialogNotice,
    },
    data: () => ({
      summary: '',
      dialogPayment: {
        open: false,
        data: {},
      },
      dialogDeleteById: {
        open: false,
        data: {},
      },
      dialogListBank: {
        open: false,
        data: [],
      },
    }),
    computed: {
      computedPayment () {
        return this.$store.state.payment.data
      },
      computedSummary () {
        return this.$store.state.payment.summary
      },
    },
    watch: {
      summary (val) {
        this.$router.push({ query: { ...this.$route.query, summary: val } })
      },
      '$route.query.summary' (val) {
        this.summary = val
        this.getDataPayment()
      },
    },
    mounted () {
      this.getDataPayment()
      this.getSummaryPayment()
    },
    methods: {
      getDataPayment () {
        this.$store.dispatch('payment/getDataPayment', {
          entities:
            'user,class.studio.bank,video.studio.bank,cart.form,cartVideo',
          summary: this.summary || this.$route.query.summary,
        })
      },
      getSummaryPayment () {
        this.$store.dispatch('payment/getSummaryPayment')
      },
      setSummary (val) {
        this.summary = val
      },
      methodDialogPayment ({ item }) {
        this.dialogPayment.open = true
        this.dialogPayment.data = item
      },
      methodsDialogDeletePayment ({ item }) {
        this.dialogDeleteById.open = true
        this.dialogDeleteById.data = item
      },
      methodDialogListBank ({ item }) {
        this.dialogListBank.open = true
        this.dialogListBank.data = item
        console.log(item)
      },
      deleteDataPayment ({ item }) {
        this.$store
          .dispatch('payment/deleteDataPayment', {
            id: item.id,
          })
          .then((res) => {
            console.log(res)
            if (res.data.meta.status) {
              this.dialogDeleteById.open = false
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
                title: 'Data Payment has been deleted',
              })
            }
          })
          .catch((e) => {
            console.log('error : ', e)
          })
      },
      refresh () {
        this.getDataPayment()
        this.getSummaryPayment()
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
      chooseAccountBank ({ item, id }) {
        this.$store
          .dispatch('payment/filledBank', {
            check: 'fill_bank',
            id: id,
            to: `${item.bank_name} - ${item.no_rek} - ${item.name}`,
          })
          .then((res) => {
            if (res.data.meta.status) {
              this.dialogListBank.open = false
              // this.dialogListBank.data = []
              this.getDataPayment()
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
                title: 'Data Payment has been filled',
              })
            }
          })
          .catch((e) => {
            console.log(e)
          })
      },
      deleteBankChoice ({ item }) {
        this.$store
          .dispatch('payment/filledBank', {
            check: 'fill_bank',
            id: item.id,
            to: null,
          })
          .then((res) => {
            // console.log(res)
            if (res.data.meta.status) item.to = null
          })
      },
      uploadProof ({ event, item }) {
        const files = event.target.files
        const fileName = files[0].name
        console.log('Name : ', fileName)
        const fileReader = new FileReader()
        fileReader.readAsDataURL(files[0])
        if (files[0].size > 2000000) {
          console.log('too big')
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
            icon: 'error',
            title: 'file too big',
          })
        } else {
          this.$store
            .dispatch('payments/sendTransfer', {
              id: item.id,
              img: files[0],
            })
            .then((res) => {
              if (res.data.meta.status) {
                this.dialogPayment.open = false
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
                  title: 'Transfer has been sent',
                })
              }
            })
        }
      },
    },
  }
</script>

<style></style>
