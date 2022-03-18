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
          @actived="methodOpenDialogActivedId"
          @edit="methodsOpenDIalogEdit"
          @refresh="refresh"
          @activate="methodDialogOpenInactiveId"
        />
      </v-col>
    </v-row>
    <app-dialog-form-create
      :is-form="true"
      :dialog="dialogFormCreate"
      :icon-system-bar="`mdi-folder-plus-outline`"
      :title-system-bar="`Create Plan`"
      :color-system-bar="`btn_primary`"
      @save="storePlanSummary"
    />
    <app-dialog-notice-edit-id
      :is-form="true"
      :is-edit="true"
      :dialog="dialogEditPlan"
      :icon-system-bar="`mdi-pencil`"
      :title-system-bar="`Edit Plan`"
      :color-system-bar="`info`"
      @edit="editPlan"
    />
    <app-dialog-notice-active-id
      :dialog="dialogActived"
      :title-system-bar="dialogActived.titleSystem"
      :icon-system-bar="dialogActived.iconSystem"
      :color-system-bar="dialogActived.colorSystem"
      :color-btn1="dialogActived.colorBtnCancel"
      :color-btn2="dialogActived.colorBtnConfirm"
      :title="`Are you sure want to actived this plan ${dialogActived.data.name} ? `"
      :is-text-btn1="dialogActived.isTextBtnCancel"
      :class-btn2="dialogActived.classBtnConfirm"
      :is-notice="true"
      :text-btn1="dialogActived.textBtnCancel"
      :text-btn2="dialogActived.textBtnConfirm"
      @actionBtnOne="dialogActived.open = false"
      @actionBtnTwo="activatedPlan"
    />
    <app-dialog-notice-incative-id
      :is-notice="true"
      :dialog="dialogInactive"
      :title-system-bar="dialogInactive.titleSystem"
      :icon-system-bar="dialogInactive.iconSystem"
      :color-system-bar="dialogInactive.colorSystem"
      :color-btn1="dialogInactive.colorBtnCancel"
      :color-btn2="dialogInactive.colorBtnConfirm"
      :title="`are you sure want to inactive this plan ? ${dialogInactive.data.name}`"
      :is-text-btn1="dialogInactive.isTextBtnCancel"
      :is-text-btn2="dialogInactive.isTextBtnConfirm"
      :class-btn2="dialogInactive.classBtnConfirm"
      :text-btn1="dialogInactive.textBtnCancel"
      :text-btn2="dialogInactive.textBtnConfirm"
      @actionBtnOne="dialogInactive.open = false"
      @actionBtnTwo="inactivatePlan"
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
      'app-dialog-notice-active-id': dialogNotice,
      'app-dialog-notice-incative-id': dialogNotice,
      'app-dialog-notice-edit-id': dialogNotice,
    },
    data: () => ({
      summary: '',
      dialogFormCreate: {
        open: false,
      },
      dialogActived: {
        title: 'are you sure want to actived this plan ? ',
        iconSystem: 'mdi-check-decagram',
        colorSystem: 'info',
        titleSystem: 'Active Plan',
        colorBtnCancel: 'error',
        textBtnCancel: 'Cancel',
        isTextBtnCancel: true,
        colorBtnConfirm: 'btn_primary',
        textBtnConfirm: 'Actived',
        classBtnConfirm: 'ml-2',
        open: false,
        data: {},
      },
      dialogInactive: {
        title: 'are you sure want to inactive this plan ? ',
        iconSystem: 'mdi-check-decagram',
        colorSystem: 'info',
        titleSystem: 'Inactive Plan',
        colorBtnCancel: 'btn_primary',
        textBtnCancel: 'Cancel',
        isTextBtnCancel: false,
        isTextBtnConfirm: true,
        colorBtnConfirm: 'error',
        textBtnConfirm: 'Inactive',
        classBtnConfirm: 'ml-2',
        open: false,
        data: {},
      },
      dialogEditPlan: {
        open: false,
        form: {
          id: 0,
          name: '',
          type: '',
          duration: 0,
          about: '',
        },
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
      methodOpenDialogActivedId ({ item }) {
        this.dialogActived.data = item
        this.dialogActived.open = true
      },
      methodsOpenDIalogEdit ({ item }) {
        this.dialogEditPlan.open = true
        this.dialogEditPlan.form.id = item.id
        this.dialogEditPlan.form.name = item.name
        this.dialogEditPlan.form.type = item.type
        this.dialogEditPlan.form.duration = item.date_count
        this.dialogEditPlan.form.about = item.about
      // console.log(item)
      },
      methodDialogOpenInactiveId ({ item }) {
        this.dialogInactive.data = item
        this.dialogInactive.open = true
      },
      storePlanSummary ({ item }) {
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
      editPlan ({ item }) {
        this.$store
          .dispatch('plan/editPlan', {
            id: item.id,
            name: item.name,
            type: item.type,
            duration: item.duration,
            about: item.about,
          })
          .then((res) => {
            // console.log(res)
            if (res.data.meta.status) {
              this.dialogEditPlan.open = false
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
                title: 'Edit Plan Has Been Successfuly',
              })
            }
          })
      },
      activatedPlan ({ item }) {
        this.$store
          .dispatch('plan/activatedPlan', {
            id: item.id,
          })
          .then((res) => {
            if (res.data.meta.status) {
              this.dialogActived.open = false
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
                title: 'Plan Has Been Activated',
              })
            }
          })
      },
      refresh () {
        this.getDataSummary()
        this.getDataSummary()
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
      inactivatePlan ({ item }) {
        this.$store
          .dispatch('plan/inactivatePlan', {
            id: item.id,
          })
          .then((res) => {
            if (res.data.meta.status) {
              this.dialogInactive.open = false
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
                title: 'Incativate Plan Has Been Successfuly',
              })
            } else {
              this.dialogInactive.open = false
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
                title: `${res.data.meta.message}`,
              })
            }
          })
      },
    },
  }
</script>

<style></style>
