<template>
  <v-app>
    <v-container>
      <v-row dense>
        <v-col
          cols="12"
          md="3"
        >
          <base-material-stats-card
            color="primary"
            icon="mdi-check-all"
            :title="$t('all')"
            :value="String(summary.total)"
            style="cursor:pointer"
            @click.native="sortByType('')"
          />
        </v-col>
        <v-col
          cols="12"
          md="3"
        >
          <base-material-stats-card
            color="info"
            icon="mdi-check-decagram-outline"
            :title="$t('verified')"
            :value="String(summary.verified)"
            style="cursor:pointer"
            @click.native="sortByType('verified')"
          />
        </v-col>
        <v-col
          cols="12"
          md="3"
        >
          <base-material-stats-card
            color="warning"
            icon="mdi-help-circle-outline"
            :title="$t('unverified')"
            :value="String(summary.not_verified)"
            style="cursor:pointer"
            @click.native="sortByType('not_verified')"
          />
        </v-col>
        <v-col
          cols="12"
          md="3"
        >
          <base-material-stats-card
            color="#F6114C"
            icon="mdi-delete-clock-outline"
            :title="$t('deleted')"
            :value="String(summary.deleted)"
            style="cursor:pointer"
            @click.native="sortByType('deleted')"
          />
        </v-col>
        <v-col
          cols="12"
          md="12"
        >
          <app-data-table
            :data="category"
            :title="type"
            @openDialog="openDialog"
            @edit="editDialog"
          />
        </v-col>
      </v-row>
    </v-container>
    <app-data-add-dialog
      :dialog="dialog"
      @input="insertData"
    />
    <app-data-edit-dialog
      :dialog="dialogEdit"
      @input="editDataCategory"
    />
  </v-app>
</template>

<script>
  import editDialog from './_editDialog.vue'
  import _addDialog from './_addDialog.vue'
  import dataTable from './_dataTable.vue'
  export default {
    components: {
      'app-data-table': dataTable,
      'app-data-add-dialog': _addDialog,
      'app-data-edit-dialog': editDialog,
    },
    data: () => ({
      dialog: {},
      dialogEdit: {},
      type: '',
    }),
    computed: {
      category () {
        return this.$store.state.category.list
      },
      summary () {
        return this.$store.state.category.summary
      },
    },
    watch: {
      type (newVal) {
        this.$router.push({ query: { ...this.$route.query, type: newVal } })
      },
      '$route.query.type': function (val) {
        this.type = val
      },
    },
    mounted () {
      this.getData()
      this.getDataSummary()
    },
    methods: {
      // List Category
      getData () {
        this.$store.dispatch('category/getData', {
          verified: this.type,
        })
      },
      //   Emit
      openDialog (event) {
        this.dialog = event.item
      },
      insertData (event) {
        this.$store
          .dispatch('category/insertData', {
            name: event.item.name,
            display_name: event.item.name.replace(/(?:^|\s)\S/g, function (a) {
              return a.toUpperCase()
            }),
            status: event.item.status,
          })
          .then(res => {
            if (res.data.meta.status) {
              event.item.name = ''
              event.item.status = ''
              this.dialog.open = false
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
                title: 'Data has been successfully created',
              })
            }
          })
      },
      editDialog (event) {
        this.dialogEdit = event.item
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
          icon: 'info',
          title: 'Dialog Di Buka',
        })
      },
      editDataCategory (event) {
        this.$store
          .dispatch('category/editData', {
            id: event.item.id,
            name: event.item.name,
            display_name: event.item.name.replace(/(?:^|\s)\S/g, function (a) {
              return a.toUpperCase()
            }),
            status: event.item.status,
          })
          .then(res => {
            if (res.data.meta.status) {
              this.dialogEdit.open = false
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
                title: 'Data Successfully Edited',
              })
            }
          })
      },
      deleteDialog (event) {},

      // Sumarry Category
      getDataSummary () {
        this.$store.dispatch('category/getDataSummary')
      },
      sortByType (val) {
        this.type = val
        this.getData()
      },
    },
  }
</script>

<style></style>
