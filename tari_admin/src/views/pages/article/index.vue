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
            sub-icon="mdi-tag"
            sub-text="Tracked from Google Analytics"
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
            sub-icon="mdi-tag"
            sub-text="Tracked from Google Analytics"
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
            sub-icon="mdi-tag"
            sub-text="Tracked from Google Analytics"
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
            sub-icon="mdi-tag"
            sub-text="Tracked from Google Analytics"
          />
        </v-col>
        <v-col cols="12">
          <app-data-table
            :data="article"
            @delete="popUpDeletes"
            @approve="popAppreves"
            @deleteById="popUpDeleteDataArticleById"
            @approveById="popApproveById"
          />
        </v-col>
      </v-row>
    </v-container>
    <app-data-dialog
      :dialog="dialogDelete"
      title="Delete"
      text="Are You Sure Want to Delete"
      text-button1="Delete"
      icon="mdi-delete"
      color-button1="red"
      color-button2="primary"
      @input="deletesData"
    />
    <app-data-dialog
      :dialog="dialogApproves"
      title="Approve"
      icon="mdi-check-decagram"
      text="Are You Sure Want To Approve"
      text-button1="Approve"
      @input="approveDatas"
    />
    <app-data-dialog
      :dialog="dialogDeleteById"
      :by-id="true"
      title="Delete"
      text="Are You Sure Want to Delete"
      text-button1="Delete"
      icon="mdi-delete "
      color-button1="red"
      color-button2="primary"
      @input="deletesArticleById"
    />
    <app-data-dialog
      :dialog="dialogApproveById"
      :by-id="true"
      title="Approve"
      text="Are You Sure Want To Approve"
      icon="mdi-check-decagram"
      text-button1="Approve"
      @input="approveDataArticleById"
    />
  </v-app>
</template>

<script>
  import dataTable from './_dataTable.vue'
  import dialog from './_dialog.vue'
  export default {
    components: {
      'app-data-table': dataTable,
      'app-data-dialog': dialog,
    },
    data: () => ({
      dialogDelete: {
        open: false,
        data: [],
      },
      dialogApproves: {
        open: false,
        data: [],
      },
      dialogDeleteById: {
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
      article () {
        return this.$store.state.article.data
      },
    },
    mounted () {
      this.getDataArticle()
    },
    methods: {
      getDataArticle () {
        this.$store.dispatch('article/getDataArticle')
      },
      popAppreves ({ item }) {
        this.dialogApproves.open = true
        this.dialogApproves.data = item
      },
      popUpDeletes ({ item }) {
        this.dialogDelete.open = true
        this.dialogDelete.data = item
      },
      deletesData ({ item }) {
        const id = item.map(x => x.id)
        this.$store
          .dispatch('article/deletesArticle', {
            id: id,
          })
          .then(res => {
            if (res.data.meta.status) {
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
                title: 'Data has been successfully Deleted',
              })
              this.dialogDelete.open = false
              this.getDataArticle()
            }
          })
      },
      approveDatas ({ item }) {
        const id = item.map(x => x.id)
        this.$store
          .dispatch('article/approveArticles', {
            id: id,
          })
          .then(res => {
            if (res.data.meta.status) {
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
                title: 'Data has been successfully Approved',
              })
              this.dialogApproves.open = false
              this.getDataArticle()
            }
          })
      },
      popUpDeleteDataArticleById ({ item }) {
        this.dialogDeleteById.open = true
        this.dialogDeleteById.id = item.id
        this.dialogDeleteById.title = item.title
      },
      deletesArticleById ({ item }) {
        this.$store
          .dispatch('article/deleteArticleById', {
            id: item.id,
          })
          .then(res => {
            if (res.data.meta.status) {
            }
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
              title: 'Data has been successfully Deleted',
            })
            this.dialogDeleteById.open = false
            this.getDataArticle()
          })
      },
      popApproveById ({ item }) {
        this.dialogApproveById.open = true
        this.dialogApproveById.id = item.id
        this.dialogApproveById.title = item.title
      },
      approveDataArticleById ({ item }) {
        this.$store
          .dispatch('article/approveArticle', {
            id: item.id,
          })
          .then(res => {
            if (res.data.meta.status) {
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
                title: 'Data has been successfully Approved',
              })
              this.dialogApproveById.open = false
              this.getDataArticle()
            }
          })
      },
    },
  }
</script>

<style></style>
