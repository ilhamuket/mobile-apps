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
          icon="mdi-book-plus-multiple-outline"
          title="All"
          :value="String(computedSummary.all)"
          :class="`${$route.query.summary === 'all' ? 'selected' : ''}`"
          sub-icon="mdi-heart-outline"
          sub-text="EnsikloTari"
          @click.native="setSummary('all')"
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
          title="Publish"
          :value="String(computedSummary.publish)"
          :class="`${$route.query.summary === 'publish' ? 'selected' : ''}`"
          sub-icon="mdi-heart-outline"
          sub-text="EnsikloTari"
          @click.native="setSummary('publish')"
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
          title="Draft"
          :value="String(computedSummary.draft)"
          :class="`${$route.query.summary === 'draft' ? 'selected' : ''}`"
          sub-icon="mdi-heart-outline"
          sub-text="EnsikloTari"
          @click.native="setSummary('draft')"
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
          :value="String(computedSummary.new)"
          :class="`${$route.query.summary === 'new' ? 'selected' : ''}`"
          sub-icon="mdi-heart-outline"
          sub-text="EnsikloTari"
          @click.native="setSummary('new')"
        />
      </v-col>
      <v-col cols="12">
        <app-data-table
          :data="computedArticle"
          @deletes="methodsPopUpDialogDeletes"
          @refresh="refresh"
          @approves="methodPopUpDialogApproves"
          @updateDialog="methodPopUpDialogEditForm"
          @delete="methodPopUpDialogDeleteArticle"
          @hide="methodsPopUpDialogHide"
        />
      </v-col>
    </v-row>
    <app-dialog-deletes
      :dialog="dataDialogDeletes"
      title="Do you Want to deletes Article"
      title-system-bar="Deletes"
      color-system-bar="red"
      icon-system-bar="mdi-delete"
      name-button="Deletes"
      @input="deleteDataArticles"
    />
    <app-dialog-approves
      :dialog="dataDialogPublish"
      title="do you want to Approves Article"
      title-system-bar="Approves"
      icon-system-bar="mdi-check-decagram"
      color-system-bar="mdi-check-decagram"
      name-button="Publish"
      @input="publishDataArticles"
    />
    <app-dialog-edit-article
      :dialog="dataDialogEditForm"
      icon-system-bar="mdi-pencil"
      title-system-bar="Edit"
      color-system-bar="blue"
      @input="updateDataArticle"
    />
    <app-dialog-delete
      :is-data-array="false"
      :dialog="dataDialogDelete"
      title="Do you Want to deletes Article"
      title-system-bar="Deletes"
      color-system-bar="red"
      icon-system-bar="mdi-delete"
      name-button="Deletes"
      @input="deleteDataArticle"
    />
    <app-dialog-hide
      :is-data-array="false"
      :dialog="dataDialogHide"
      title="Do You Want to Hide Article"
      title-system-bar="Hide"
      color-system-bar="red"
      icon-system-bar="mdi-eye-off"
      name-button="Hide"
      @input="hideDataArticle"
    />
  </v-container>
</template>

<script>
  import dataTable from "./componets_core/_dataTable.vue"
  import dialogNotice from "./components/__dialogNotice.vue"
  import __dialogEditVue from "./components/__dialogEditForm.vue"
  export default {
    components: {
      "app-data-table": dataTable,
      "app-dialog-deletes": dialogNotice,
      "app-dialog-approves": dialogNotice,
      "app-dialog-delete": dialogNotice,
      "app-dialog-hide": dialogNotice,
      "app-dialog-edit-article": __dialogEditVue,
    },
    data: () => ({
      dataArticle: [],
      dataDialogDeletes: {
        open: false,
        data: [],
      },
      dataDialogPublish: {
        open: false,
        data: [],
      },
      dataDialogEditForm: {
        open: false,
        data: {},
      },
      dataDialogDelete: {
        open: false,
        data: {},
      },
      dataDialogHide: {
        open: false,
        data: {},
      },
      summary: "",
    }),
    computed: {
      computedArticle () {
        return this.$store.state.article.data
      },
      computedSummary () {
        return this.$store.state.article.summary
      },
    },
    watch: {
      summary (value) {
        this.$router.push({ query: { ...this.$route.query, summary: value } })
      },
      "$route.query.summary": function (value) {
        this.summary = value
      },
    },
    mounted () {
      this.getDataArticle()
      this.getDataSummary()
    },
    methods: {
      getDataArticle () {
        this.$store.dispatch("article/getDataArticle", {
          summary: this.summary,
        })
      },
      getDataSummary () {
        this.$store.dispatch("article/getArticleSummary")
      },
      setSummary (value) {
        this.summary = value
        this.getDataArticle()
      },
      deleteDataArticles ({ item }) {
        this.$store.dispatch("article/deleteDataArticles", item).then((res) => {
          if (res.data.meta.status) {
            this.dataDialogDeletes.open = false
            const Toast = this.$swal.mixin({
              toast: true,
              position: "bottom-end",
              showConfirmButton: false,
              timer: 3000,
              timerProgressBar: true,
              didOpen: (toast) => {
                toast.addEventListener("mouseenter", this.$swal.stopTimer)
                toast.addEventListener("mouseleave", this.$swal.resumeTimer)
              },
              popup: "swal2-show",
              backdrop: "swal2-backdrop-show",
              icon: "swal2-icon-show",
            })
            Toast.fire({
              icon: "success",
              title: "Deletes Data Successfully",
            })
          }
        })
      },
      publishDataArticles ({ item }) {
        this.$store.dispatch("article/publishDataArticles", item).then((res) => {
          if (res.data.meta.status) {
            this.dataDialogPublish.open = false
            const Toast = this.$swal.mixin({
              toast: true,
              position: "bottom-end",
              showConfirmButton: false,
              timer: 3000,
              timerProgressBar: true,
              didOpen: (toast) => {
                toast.addEventListener("mouseenter", this.$swal.stopTimer)
                toast.addEventListener("mouseleave", this.$swal.resumeTimer)
              },
              popup: "swal2-show",
              backdrop: "swal2-backdrop-show",
              icon: "swal2-icon-show",
            })
            Toast.fire({
              icon: "success",
              title: "Data Article Publish Successfully",
            })
          }
        })
      },
      methodsPopUpDialogDeletes ({ item }) {
        this.dataDialogDeletes.open = true
        this.dataDialogDeletes.data = item
      },
      methodPopUpDialogApproves ({ item }) {
        this.dataDialogPublish.open = true
        this.dataDialogPublish.data = item
      },
      methodPopUpDialogEditForm ({ item }) {
        this.dataDialogEditForm.open = true
        this.dataDialogEditForm.data = item
      },
      methodPopUpDialogDeleteArticle ({ item }) {
        this.dataDialogDelete.open = true
        this.dataDialogDelete.data = item
      },
      methodsPopUpDialogHide ({ item }) {
        this.dataDialogHide.open = true
        this.dataDialogHide.data = item
      },
      refresh () {
        this.getDataArticle()
        const Toast = this.$swal.mixin({
          toast: true,
          position: "bottom-end",
          showConfirmButton: false,
          timer: 3000,
          timerProgressBar: true,
          didOpen: (toast) => {
            toast.addEventListener("mouseenter", this.$swal.stopTimer)
            toast.addEventListener("mouseleave", this.$swal.resumeTimer)
          },
          popup: "swal2-show",
          backdrop: "swal2-backdrop-show",
          icon: "swal2-icon-show",
        })
        Toast.fire({
          icon: "success",
          title: "Fetch Data",
        })
      },
      updateDataArticle ({ item }) {
        this.$store
          .dispatch("article/updateDataArticle", {
            id: item.id,
            title: item.title,
            content: item.content,
          })
          .then((res) => {
            if (res.data.meta.status) {
              this.dataDialogEditForm.open = false
              const Toast = this.$swal.mixin({
                toast: true,
                position: "bottom-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                  toast.addEventListener("mouseenter", this.$swal.stopTimer)
                  toast.addEventListener("mouseleave", this.$swal.resumeTimer)
                },
                popup: "swal2-show",
                backdrop: "swal2-backdrop-show",
                icon: "swal2-icon-show",
              })
              Toast.fire({
                icon: "success",
                title: "Update Data Article Sucessfully",
              })
            }
          })
      },
      deleteDataArticle ({ item }) {
        this.$store
          .dispatch("article/deleteDataArticle", { id: item.id })
          .then((res) => {
            if (res.data.meta.status) {
              this.dataDialogDelete.open = false
              const Toast = this.$swal.mixin({
                toast: true,
                position: "bottom-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                  toast.addEventListener("mouseenter", this.$swal.stopTimer)
                  toast.addEventListener("mouseleave", this.$swal.resumeTimer)
                },
                popup: "swal2-show",
                backdrop: "swal2-backdrop-show",
                icon: "swal2-icon-show",
              })
              Toast.fire({
                icon: "success",
                title: "Deletes Article Successfully",
              })
            }
          })
      },
      hideDataArticle ({ item }) {
        this.$store
          .dispatch("article/hideDataArticle", {
            id: item.id,
            status: "hide",
          })
          .then((res) => {
            if (res.data.meta.status) {
              this.dataDialogHide.open = false
              const Toast = this.$swal.mixin({
                toast: true,
                position: "bottom-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                  toast.addEventListener("mouseenter", this.$swal.stopTimer)
                  toast.addEventListener("mouseleave", this.$swal.resumeTimer)
                },
                popup: "swal2-show",
                backdrop: "swal2-backdrop-show",
                icon: "swal2-icon-show",
              })
              Toast.fire({
                icon: "success",
                title: "Fetch Data",
              })
            }
          })
      },
    },
  }
</script>

<style></style>
