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
          icon="mdi-all-inclusive"
          title="All"
          :value="String(summary.all)"
          sub-icon="mdi-heart-outline"
          sub-text="EnsikloTari"
          style="cursor: pointer"
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
          icon="mdi-publish"
          title="Publish"
          :value="String(summary.publish)"
          sub-icon="mdi-heart-outline"
          sub-text="EnsikloTari"
          style="cursor: pointer"
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
          icon="mdi-publish-off"
          title="Concept"
          :value="String(summary.concept)"
          sub-icon="mdi-heart-outline"
          sub-text="EnsikloTari"
          style="cursor: pointer"
          @click.native="setSummary('concept')"
        />
      </v-col>
      <v-col
        cols="12"
        sm="6"
        lg="3"
      >
        <base-material-stats-card
          color="info"
          icon="mdi-file"
          title="draft"
          :value="String(summary.draft)"
          sub-icon="mdi-heart-outline"
          sub-text="EnsikloTari"
          style="cursor: pointer"
          @click.native="setSummary('draft')"
        />
      </v-col>
      <v-col cols="12">
        <app-data-category
          :data="categories"
          @create="popUpDialogCreate"
          @deleteById="popDialogDeleteById"
          @deleteSelected="popDialogCategorySelected"
          @approveSelected="popDialogApproveSelected"
          @update="upUpdateCategory"
          @input="postPicture"
          @change="onChangePicture"
          @refresh="refreshCategory"
        />
      </v-col>
    </v-row>
    <app-data-create
      :dialog="dialogCreate"
      @input="createDataCategory"
    />
    <app-data-notice
      :dialog="deleteById"
      :by-id="true"
      @input="deleteCategoryById"
    />
    <app-data-notice
      :dialog="dialogDeleteSelected"
      @input="deleteDataCategorySelected"
    />
    <app-data-notice
      :dialog="dialogApproveSelected"
      text-body="Are you sure want to publish category with name"
      text-btn="Approve"
      color-btn1="btn_primary"
      color-btn2="red"
      icon-btn="mdi-check-decagram"
      icon="mdi-check-decagram"
      title="Approve"
      text-btn-selected="Approve"
      @input="approveCategorySelected"
    />
    <app-data-update
      :dialog="update"
      @input="updateDataCategory"
    />
  </v-container>
</template>

<script>
  import componentsCategory from "./components_core/_dataTable.vue"
  import dialogForm from "./components/__dialogForm.vue"
  import dialogNotice from "./components/__dialogNotice.vue"
  import dialogUpdate from "./components/__dialogEdit.vue"
  export default {
    components: {
      "app-data-category": componentsCategory,
      "app-data-create": dialogForm,
      "app-data-notice": dialogNotice,
      "app-data-update": dialogUpdate,
    },
    data: () => ({
      dialogCreate: {
        open: false,
      },
      deleteById: {
        open: false,
        data: {},
      },
      dialogDeleteSelected: {
        open: false,
        data: [],
      },
      dialogApproveSelected: {
        open: false,
        data: [],
      },
      update: {
        open: false,
        data: {},
      },
      itemSummary: "",
    }),
    computed: {
      categories () {
        return this.$store.state.studioCategories.data
      },
      summary () {
        return this.$store.state.categorySummary.data
      },
    },
    watch: {
      itemSummary (val) {
        this.$router.push({ query: { ...this.$route.query, summary: val } })
      },
      "$route.query.summary": function (val) {
        this.itemSummary = val
        this.getDataStudioCategories()
      },
    },
    mounted () {
      this.getDataStudioCategories()
      this.getDataCategorySummary()
      this.firstLoad()
    },
    methods: {
      firstLoad () {
        if (this.$route.query.summary === "publish") {
          this.itemSummary = "publish"
        } else if (this.$route.query.summary === "concept") {
          this.itemSummary = "concept"
        } else if (this.$route.query.summary === "draft") {
          this.itemSummary = "draft"
        } else {
          this.itemSummary = ""
        }
        this.getDataStudioCategories()
      },
      getDataStudioCategories () {
        this.$store.dispatch("studioCategories/getDataStudioCategories", {
          entities: "class.img, img,likes,follow,classVidio",
          summary: this.itemSummary,
        })
      },

      createDataCategory ({ item }) {
        this.$store
          .dispatch("studioCategories/insertDataCategory", {
            name: item.name,
            display_name: item.display_name,
            status: item.status,
          })
          .then((res) => {
            if (res.data.meta.status) {
              item = null
              this.dialogCreate.open = false
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
                title: "Class Created Successfully",
              })
            }
          })
      },
      getDataCategorySummary () {
        this.$store.dispatch("categorySummary/getDataCategorySummary")
      },
      popUpDialogCreate () {
        this.dialogCreate.open = true
      },
      popDialogDeleteById ({ item }) {
        this.deleteById.open = true
        this.deleteById.data = item
      },
      popDialogCategorySelected ({ item }) {
        this.dialogDeleteSelected.open = true
        this.dialogDeleteSelected.data = item
      },

      deleteCategoryById ({ item }) {
        this.$store
          .dispatch("studioCategories/deleteDataCategory", item)
          .then((res) => {
            this.deleteById.open = false
            if (res.data.meta.status) {
              this.deleteById.open = false
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
                title: "Category Deleted Successfully",
              })
            }
          })
      },
      popDialogApproveSelected ({ item }) {
        this.dialogApproveSelected.open = true
        this.dialogApproveSelected.data = item
      },
      deleteDataCategorySelected ({ item }) {
        this.$store
          .dispatch("studioCategories/deleteDataCategorySelected", item)
          .then((res) => {
            this.dialogDeleteSelected.open = false
            if (res.data.meta.status) {
              this.dialogDeleteSelected.open = false
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
                title: "Category Deleted Successfully",
              })
            }
          })
      },
      approveCategorySelected ({ item }) {
        this.$store
          .dispatch("studioCategories/approveCategorySelected", item)
          .then((res) => {
            if (res.data.meta.status) {
              this.dialogApproveSelected.open = false
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
                title: "Category Approved Successfully",
              })
            }
          })
      },
      updateDataCategory ({ item }) {
        this.$store
          .dispatch("studioCategories/updateDataCategory", {
            id: item.id,
            name: item.name,
            display_name: item.display_name,
          })
          .then((res) => {
            if (res.data.meta.status) {
              this.update.open = false
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
                title: "Category Edited Successfully",
              })
            }
          })
      },
      setSummary (val) {
        this.itemSummary = val
        this.getDataStudioCategories()
      },
      upUpdateCategory ({ item }) {
        this.update.open = true
        this.update.data = item
      },
      postPicture ({ item }) {
        this.$store
          .dispatch("studioCategories/onPostPicture", {
            files: item.files,
            category_id: item.category_id,
          })
          .then((res) => {
            if (res.data.meta.status) {
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
                title: "Upload Category Profile Successfully",
              })
              this.getDataStudioCategories()
            }
          })
      },
      onChangePicture ({ item }) {
        console.log(item)
        this.$store
          .dispatch("studioCategories/onChangePicture", {
            files: item.files,
            category_id: item.category_id,
          })
          .then((res) => {
            if (res.data.meta.status) {
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
                title: "Edited Category Profile Successfully",
              })
              this.getDataStudioCategories()
            }
          })
      },
      refreshCategory () {
        this.getDataStudioCategories()
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
          title: "Refresh Data Category",
        })
      },
    },
  }
</script>
<style></style>
