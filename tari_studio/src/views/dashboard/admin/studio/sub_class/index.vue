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
            color="primary"
            icon="mdi-poll"
            title="All"
            :value="String(cumputedSummary.all)"
            sub-icon="mdi-tag"
            sub-text="Tracked from Google Analytics"
            style="cursor:pointer"
            @click.native="orderBySummary('all')"
          />
        </v-col>
        <v-col
          cols="12"
          sm="6"
          lg="3"
        >
          <base-material-stats-card
            color="primary"
            icon="mdi-poll"
            title="Approved"
            :value="String(cumputedSummary.approved)"
            sub-icon="mdi-tag"
            sub-text="Tracked from Google Analytics"
            style="cursor:pointer"
            @click.native="orderBySummary('approved')"
          />
        </v-col>
        <v-col
          cols="12"
          sm="6"
          lg="3"
        >
          <base-material-stats-card
            color="primary"
            icon="mdi-poll"
            title="Non Approved"
            :value="String(cumputedSummary.non_approved)"
            sub-icon="mdi-tag"
            sub-text="Tracked from Google Analytics"
            style="cursor:pointer"
            @click.native="orderBySummary('non_approved')"
          />
        </v-col>
        <v-col
          cols="12"
          sm="6"
          lg="3"
        >
          <base-material-stats-card
            color="primary"
            icon="mdi-poll"
            title="New"
            :value="String(cumputedSummary.new)"
            sub-icon="mdi-tag"
            sub-text="Tracked from Google Analytics"
            style="cursor:pointer"
            @click.native="orderBySummary('new')"
          />
        </v-col>
        <v-col>
          <app-data-table
            :items="cumputedSubClass"
            @appPopUp="popUpDialogApproves"
            @delPopUp="popUpDialogDeletes"
            @edit="popDialogEdit"
            @delById="popUpDialogEditById"
          />
        </v-col>
      </v-row>
    </v-container>

    <app-dialog-form
      :dialog="form"
      @input="editDataSubClass"
    />
    <app-dialog-notice
      :dialog="approves"
      icon="mdi-check-decagram"
      title="Approve"
      text-button1="Approve"
      text="card_notice.approved"
      @input="approvesDataSubclass"
    />
    <app-dialog-notice
      title="Delete"
      text="card_notice.text"
      text-button1="Delete"
      icon="mdi-delete "
      color-button1="red"
      color-button2="primary"
      :dialog="deletes"
      @input="deletesDataSubclass"
    />
    <app-dialog-notice
      :dialog="dialogDeleteById"
      :by-id="true"
      title="Delete"
      text="card_notice.textById"
      text-button1="Delete"
      icon="mdi-delete "
      color-button1="red"
      color-button2="primary"
      @input="deletesDialogById"
    />
  </v-app>
</template>

<script>
  import dataTable from './component_core/_dataTable.vue'
  import dialogForm from './component/__dialogForm.vue'
  import dialogNotice from './component/__dialogNotice.vue'
  export default {
    components: {
      'app-data-table': dataTable,
      'app-dialog-form': dialogForm,
      'app-dialog-notice': dialogNotice,
    },
    data: () => ({
      form: {
        open: false,
        id: 0,
        title: null,
        class_id: 0,
        status: 0,
        about: null,
        time_start: null,
        time_end: null,
        icon: null,
        color: {
          hex: null,
        },
      },
      approves: {
        open: false,
        id: 0,
        data: [],
      },
      deletes: {
        open: false,
        id: 0,
        data: [],
      },
      dialogDeleteById: {
        id: 0,
        open: false,
        title: '',
      },
      summary: '',
    }),
    computed: {
      cumputedSubClass () {
        return this.$store.state.subClassStudio.data
      },
      cumputedSummary () {
        return this.$store.state.subClassStudioSummary.data
      },
    },
    watch: {
      summary (val) {
        this.$router.push({ query: { ...this.$route.query, summary: val } })
      },
      '$route.query.summary': function (val) {
        this.summary = val
        this.getDataSubClass()
      },
    },
    mounted () {
      this.getDataSubClass()
      this.getDataSummarySubClass()
    },
    methods: {
      getDataSubClass () {
        this.$store.dispatch('subClassStudio/getDataSubClass', {
          entities: 'classes',
          summary: this.summary,
        })
      },
      popUpDialog () {
        this.form.open = true
      },
      getDataSummarySubClass () {
        this.$store.dispatch('subClassStudioSummary/getDataSummarySubClass')
      },
      orderBySummary (val) {
        this.summary = val
        this.getDataSubClass()
      },
      // Emit
      popUpDialogApproves ({ item }) {
        this.approves.open = true
        this.approves.id = item.id
        this.approves.data = item
      },
      popUpDialogDeletes ({ item }) {
        this.deletes.open = true
        this.deletes.id = item.id
        this.deletes.data = item
      },
      popDialogEdit ({ item }) {
        this.form.open = true
        this.form.id = item.id
        this.form.title = item.title
        this.form.class_id = item.class_id
        this.form.status = item.status
        this.form.about = item.about
        this.form.time_start = item.time_start
        this.form.time_end = item.time_end
        this.form.icon = item.icon
        this.form.color.hex = item.color
      },
      popUpDialogEditById ({ item }) {
        this.dialogDeleteById.open = true
        this.dialogDeleteById.id = item.id
        this.dialogDeleteById.title = item.title
      },
      deletesDataSubclass ({ item }) {
        this.$store
          .dispatch('subClassStudio/deletesDataSubclass', item)
          .then(res => {
            if (res.data.meta.status) {
              this.deletes.open = false
              const Toast = this.$swal.mixin({
                toast: true,
                position: 'bottom-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: toast => {
                  toast.addEventListener('mouseenter', this.$swal.stopTimer)
                  toast.addEventListener('mouseleave', this.$swal.resumeTimer)
                },
                popup: 'swal2-show',
                backdrop: 'swal2-backdrop-show',
                icon: 'swal2-icon-show',
              })
              Toast.fire({
                icon: 'success',
                title: 'Class Deleted Successfully',
              })
            }
          })
      },
      approvesDataSubclass ({ item }) {
        this.approves.open = false
        this.$store
          .dispatch('subClassStudio/approvesDataSubclass', item)
          .then(res => {
            if (res.data.meta.status) {
              this.approves.open = false
              const Toast = this.$swal.mixin({
                toast: true,
                position: 'bottom-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: toast => {
                  toast.addEventListener('mouseenter', this.$swal.stopTimer)
                  toast.addEventListener('mouseleave', this.$swal.resumeTimer)
                },
                popup: 'swal2-show',
                backdrop: 'swal2-backdrop-show',
                icon: 'swal2-icon-show',
              })
              Toast.fire({
                icon: 'success',
                title: 'Class Deleted Successfully',
              })
            }
          })
      },
      editDataSubClass ({ item }) {
        this.$store
          .dispatch('subClassStudio/editDataSubClass', {
            id: item.id,
            title: item.title,
            status: item.status,
            about: item.about,
            time_start: item.time_start,
            time_end: item.time_end,
            color: item.color.hex,
          })
          .then(res => {
            if (res.data.meta.status) {
              this.form.open = false
              const Toast = this.$swal.mixin({
                toast: true,
                position: 'bottom-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: toast => {
                  toast.addEventListener('mouseenter', this.$swal.stopTimer)
                  toast.addEventListener('mouseleave', this.$swal.resumeTimer)
                },
                popup: 'swal2-show',
                backdrop: 'swal2-backdrop-show',
                icon: 'swal2-icon-show',
              })
              Toast.fire({
                icon: 'success',
                title: 'Sub-Class Edited Successfully',
              })
            }
          })
      },
      deletesDialogById ({ item }) {
        this.$store
          .dispatch('subClassStudio/deletesDataSubclassbyId', {
            id: item.id,
          })
          .then(res => {
            if (res.data.meta.status) {
              this.dialogDeleteById.open = false
              const Toast = this.$swal.mixin({
                toast: true,
                position: 'bottom-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: toast => {
                  toast.addEventListener('mouseenter', this.$swal.stopTimer)
                  toast.addEventListener('mouseleave', this.$swal.resumeTimer)
                },
                popup: 'swal2-show',
                backdrop: 'swal2-backdrop-show',
                icon: 'swal2-icon-show',
              })
              Toast.fire({
                icon: 'success',
                title: 'SubClass Deleted Successfully',
              })
            }
          })
      },
    },
  }
</script>

<style></style>
