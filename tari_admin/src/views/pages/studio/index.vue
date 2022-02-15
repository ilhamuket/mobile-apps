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
            title="Website Visits"
            value="75.521"
            sub-icon="mdi-heart-outline"
            sub-text="EnsikloTari"
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
            title="Website Visits"
            value="75.521"
            sub-icon="mdi-heart-outline"
            sub-text="EnsikloTari"
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
            title="Website Visits"
            value="75.521"
            sub-icon="mdi-heart-outline"
            sub-text="EnsikloTari"
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
            title="Website Visits"
            value="75.521"
            sub-icon="mdi-heart-outline"
            sub-text="EnsikloTari"
          />
        </v-col>

        <v-col
          cols="12"
          md="12"
        >
          <app-data-table
            :data="studio"
            @delete="deletedDataStudio"
            @approve="approvedDataStudio"
            @add="addDialog"
            @remove="removeStudioById"
            @aproveById="popUpApprovedDataStudioById"
          />
        </v-col>
      </v-row>
    </v-container>
    <app-data-dialog
      :dialog="dialog"
      icon="mdi-check-decagram"
      title="Approve"
      text-button1="Approve"
      text="Are You Sure Want to Approve"
      @input="approveData"
    />
    <app-data-dialog
      :dialog="dialogDelete"
      title="Delete"
      text="Are You Sure Want to Delete"
      text-button1="Delete"
      icon="mdi-delete "
      color-button1="red"
      color-button2="primary"
      @input="deletesData"
    />
    <app-data-dialog-add
      :dialog="dialogAdd"
      @input="saveStudio"
    />
    <app-data-dialog
      :dialog="dialogEditById"
      :by-id="true"
      title="Delete"
      text="Are You Sure Want to Delete"
      text-button1="Delete"
      icon="mdi-delete "
      color-button1="red"
      color-button2="primary"
      @input="deleteStudio"
    />
    <app-data-dialog
      :dialog="dialogApproveById"
      :by-id="true"
      icon="mdi-check-decagram"
      title="Approve"
      text-button1="Approve"
      text="Are You Sure Want to Approve"
      @input="approveDataStudioById"
    />
  </v-app>
</template>

<script>
  import dialogApproved from './_dialogApproved.vue'
  import dataTable from './_dataTable.vue'
  import dialogAddStudio from './_dialogAddStudio.vue'
  export default {
    components: {
      'app-data-table': dataTable,
      'app-data-dialog': dialogApproved,
      'app-data-dialog-add': dialogAddStudio,
    },
    data: () => ({
      dialog: {
        open: false,
        data: [],
      },
      dialogDelete: {
        open: false,
        data: [],
      },
      dialogAdd: {
        open: false,
      },
      dialogEditById: {
        id: 0,
        open: false,
        title: '',
      },
      dialogApproveById: {
        id: 0,
        open: false,
        title: '',
      },
    }),
    computed: {
      studio () {
        return this.$store.state.studio.data
      },
    },
    mounted () {
      this.getDataStudio()
    },
    methods: {
      getDataStudio () {
        this.$store.dispatch('studio/getData')
      },
      approvedDataStudio ({ item }) {
        this.dialog.open = true
        this.dialog.data = item
      },
      approveData ({ item }) {
        const id = item.map((x) => x.id)
        this.$store
          .dispatch('studio/approvedData', {
            id: id,
          })
          .then((res) => {
            if (res.data.meta.status) {
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
                title: 'Data has been successfully Approved',
              })
              this.dialog.open = false
              this.getDataStudio()
            }
          })
      },
      deletedDataStudio ({ item }) {
        this.dialogDelete.open = true
        this.dialogDelete.data = item
      },
      deletesData ({ item }) {
        const id = item.map((x) => x.id)
        // console.log(id)
        this.$store
          .dispatch('studio/DeleteDataStudios', {
            id: id,
          })
          .then((res) => {
            if (res.data.meta.status) {
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
                title: 'Data has been successfully Deleted',
              })
              this.dialogDelete.open = false
              this.getDataStudio()
            }
          })
      },
      addDialog () {
        this.dialogAdd.open = true
      },
      saveStudio ({ item }) {
        this.$store
          .dispatch('studio/insertData', {
            name: item.name,
            prefix: item.prefix,
            about: item.about,
            contact: item.contact,
            region: item.region,
            email: item.email,
            username: item.username,
          })
          .then((res) => {
            if (res.data.meta.status) {
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
                title: 'Data has been successfully Created',
              })
              this.dialogAdd.open = false
            }
          })
      },
      removeStudioById ({ item }) {
        this.dialogEditById.open = true
        this.dialogEditById.title = item.name
        this.dialogEditById.id = item.id
      },
      deleteStudio ({ item }) {
        // console.log(item)
        this.$store
          .dispatch('studio/deleteStudio', {
            id: item.id,
          })
          .then((res) => {
            if (res.data.meta.status) {
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
                title: 'Data has been successfully Deleted',
              })
              this.dialogEditById.open = false
            }
          })
      },
      popUpApprovedDataStudioById ({ item }) {
        this.dialogApproveById.open = true
        this.dialogApproveById.id = item.id
        this.dialogApproveById.title = item.name
      },
      approveDataStudioById ({ item }) {
        this.$store
          .dispatch('studio/approvedDataById', {
            id: item.id,
          })
          .then((res) => {
            if (res.data.meta.status) {
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
                title: 'Data has been successfully Created',
              })
              this.dialogApproveById.open = false
              this.getDataStudio()
            }
          })
      },
    },
  }
</script>

<style></style>
