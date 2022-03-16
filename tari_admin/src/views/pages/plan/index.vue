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
          title="Active"
          :value="String(computedSummary.active)"
          sub-icon="mdi-heart-outline"
          sub-text="EnsikloTari"
          :class="$route.query.summary === 'active' ? 'selected' : ''"
          @click.native="setSummary('active')"
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
          title="Inactive"
          :value="String(computedSummary.inactive)"
          sub-icon="mdi-heart-outline"
          sub-text="EnsikloTari"
          :class="$route.query.summary === 'inactive' ? 'selected' : ''"
          @click.native="setSummary('inactive')"
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
          :items="computedPlan"
          @open="methodOpenDialogFormCreate"
        />
      </v-col>
    </v-row>
    <app-dialog-form-create
      :dialog="dialogFormCreate"
      :icon-system-bar="`mdi-folder-plus-outline`"
      :title-system-bar="`Create Plan`"
      :color-system-bar="`btn_primary`"
      @input="storePlanSummary"
    />
  </v-container>
</template>

<script>
  import dataTable from './_dataTable.vue'
  import dialogNotice from './_dialogNotice.vue'
  export default {
    components: {
      'app-data-table': dataTable,
      'app-dialog-form-create': dialogNotice,
    },
    data: () => ({
      summary: '',
      dialogFormCreate: {
        open: false,
      },
    }),
    computed: {
      computedPlan () {
        return this.$store.state.plan.data
      },
      computedSummary () {
        return this.$store.state.plan.summary
      },
    },
    watch: {
      summary (val) {
        this.$router.push({ query: { ...this.$route.query, summary: val } })
      },
      '$route.query.summary': function (val) {
        this.summary = val
        this.getDataPlan()
      },
    },
    mounted () {
      this.getDataPlan()
      this.getDataSummary()
    },
    methods: {
      getDataPlan () {
        this.$store.dispatch('plan/getDataPlan', {
          summary: this.summary || this.$route.query.summary,
        })
      },
      getDataSummary () {
        this.$store.dispatch('plan/getDataSummary', {})
      },
      setSummary (summary) {
        this.summary = summary
      },
      methodOpenDialogFormCreate () {
        this.dialogFormCreate.open = true
      },
      storePlanSummary ({ item }) {
        console.log(item)
        this.$store
          .dispatch('plan/storePlanSummary', {
            name: item.name,
            type: item.type,
            duration: item.duration,
            about: item.about,
          })
          .then((res) => {
            if (res.data.meta.status) {
              this.dialogFormCreate.open = false
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
                title: 'Create Plan Has Been Created',
              })
            }
          })
      },
    },
  }
</script>

<style></style>
