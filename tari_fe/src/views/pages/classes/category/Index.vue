<template>
  <v-app>
    <v-container>
      <v-row dense>
        <v-col
          cols="12"
          md="4"
        >
          <base-material-stats-card
            color="info"
            icon="mdi-twitter"
            title="Followers"
            value="+245"
            sub-icon="mdi-clock"
            sub-text="Just Updated"
          />
        </v-col>
        <v-col
          cols="12"
          md="4"
        >
          <base-material-stats-card
            color="info"
            icon="mdi-twitter"
            title="Followers"
            value="+245"
            sub-icon="mdi-clock"
            sub-text="Just Updated"
          />
        </v-col>
        <v-col
          cols="12"
          md="4"
        >
          <base-material-stats-card
            color="info"
            icon="mdi-twitter"
            title="Followers"
            value="+245"
            sub-icon="mdi-clock"
            sub-text="Just Updated"
          />
        </v-col>
        <v-col
          cols="12"
          md="12"
        >
          <app-data-table
            :data="category"
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
    }),
    computed: {
      category () {
        return this.$store.state.category.list
      },
    },
    mounted () {
      this.getData()
    },
    methods: {
      // List Category
      getData () {
        this.$store.dispatch('category/getData')
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
                title: 'Data Sudah Berhasil DiBuat',
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
                title: 'Data Berhasil Di Edit',
              })
            }
          })
      },
      deleteDialog (event) {},
    },
  }
</script>

<style></style>
