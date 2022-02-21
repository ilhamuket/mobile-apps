<template>
  <v-app>
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
            :value="String(computedStudioSummary.all)"
            sub-icon="mdi-heart-outline"
            sub-text="EnsikloTari"
            :class="`${$route.query.summary === '' ? 'selected' : ''}`"
            @click.native="seeSummary('')"
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
            title="Approved"
            :value="String(computedStudioSummary.approved)"
            sub-icon="mdi-heart-outline"
            sub-text="EnsikloTari"
            :class="`${$route.query.summary === 'approved' ? 'selected' : ''}`"
            @click.native="seeSummary('approved')"
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
            title="Non Approved"
            :value="String(computedStudioSummary.non_approved)"
            sub-icon="mdi-heart-outline"
            sub-text="EnsikloTari"
            :class="`${
              $route.query.summary === 'non_approved' ? 'selected' : ''
            }`"
            @click.native="seeSummary('non_approved')"
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
            title="New"
            :value="String(computedStudioSummary.new)"
            sub-icon="mdi-heart-outline"
            sub-text="EnsikloTari"
            :class="`${$route.query.summary === 'new' ? 'selected' : ''}`"
            @click.native="seeSummary('new')"
          />
        </v-col>

        <v-col
          cols="12"
          md="12"
        >
          <app-data-table
            :data="studio"
            @refresh="refresh"
            @verificationOwners="popUpDialogVerifications"
            @verificationOwner="popDialogVerification"
          />
        </v-col>
      </v-row>
    </v-container>
    <app-dialog-verifications
      :dialog="dataDialogVerifications"
      color-system-bar="info"
      title-system-bar="Verification"
      icon-system-bar="mdi-check-decagram"
      title="Are you sure want to Verification Studio"
      @input="verificationDataStudios"
    />
    <app-dialog-verification
      :is-data-array="false"
      :dialog="dataDialogVerification"
      color-system-bar="info"
      title-system-bar="Verification"
      icon-system-bar="mdi-check-decagram"
      title="Are you sure want to Verification Studio"
      @input="verificationDataStudio"
    />
  </v-app>
</template>

<script>
  import dataTable from './_dataTable.vue'
  import dataNotice from './_dataNotice.vue'
  export default {
    components: {
      'app-data-table': dataTable,
      'app-dialog-verifications': dataNotice,
      'app-dialog-verification': dataNotice,
    },
    data: () => ({
      dialog: {
        open: false,
        data: [],
      },

      dataDialogVerifications: {
        open: false,
        data: [],
      },
      dataDialogVerification: {
        open: false,
        data: {},
      },
      summary: '',
    }),
    computed: {
      studio () {
        return this.$store.state.studio.data
      },
      computedStudioSummary () {
        return this.$store.state.studio.summary
      },
    },
    watch: {
      summary (val) {
        this.$router.push({ query: { ...this.route, summary: val } })
      },
      '$route.query.summary': function (newVal) {
        this.summary = newVal
        this.getDataStudio()
      },
    },
    mounted () {
      this.getDataStudioSummary()
      this.getDataStudio()
    },
    methods: {
      getDataStudio () {
        this.$store.dispatch('studio/getData', {
          entities: 'author,img',
          summary: this.summary,
        })
      },
      getDataStudioSummary () {
        this.$store.dispatch('studio/getDataStudioSummary')
      },
      seeSummary (val) {
        this.summary = val
      },
      refresh () {
        this.getDataStudio()
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
      popUpDialogVerifications ({ item }) {
        this.dataDialogVerifications.open = true
        this.dataDialogVerifications.data = item
      },
      popDialogVerification ({ item }) {
        this.dataDialogVerification.open = true
        this.dataDialogVerification.data = item
      },
      verificationDataStudios ({ item }) {
        this.$store
          .dispatch('studio/verificationDataStudios', item)
          .then((res) => {
            if (res.data.meta.status) {
              this.dataDialogVerifications.open = false
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
                title: 'Approves Data Successfully',
              })
            }
          })
      },
      verificationDataStudio ({ item }) {
        this.$store
          .dispatch('studio/verificationDataStudio', {
            id: item.author_id,
          })
          .then((res) => {
            if (res.data.meta.status) {
              this.dataDialogVerification.open = false
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
                title: 'Verification Studio Successfully',
              })
            } else {
              console.log('error')
              console.log(res)
            }
          })
      },
    },
  }
</script>

<style></style>
