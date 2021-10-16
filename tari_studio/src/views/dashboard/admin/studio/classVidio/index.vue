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
          title="Followers"
          value="+245"
          sub-icon="mdi-clock"
          sub-text="Just Updated"
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
          title="Followers"
          value="+245"
          sub-icon="mdi-clock"
          sub-text="Just Updated"
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
          title="Followers"
          value="+245"
          sub-icon="mdi-clock"
          sub-text="Just Updated"
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
          title="Followers"
          value="+245"
          sub-icon="mdi-clock"
          sub-text="Just Updated"
        />
      </v-col>
      <v-col cols="12">
        <app-data-table
          :data="computedClassVidio"
          @refresh="refresh"
          @publish="upPublishClassVidio"
          @hide="upHideDataClassVidio"
          @edit="upDialogUpdate"
          @deletes="upDeleteClassVidioSelected"
          @deletesById="upDeleteClassVidioById"
        />
      </v-col>
    </v-row>
    <app-dialog-notice
      :dialog="publish"
      :is-publish="true"
      @input="publishDataClassVidio"
    />
    <app-dialog-notice
      :dialog="hide"
      :is-hide="true"
      title="hide_class"
      color="red"
      icon="mdi-bag-suitcase-off"
      @input="hideDataClassVidio"
    />
    <app-dialog-notice
      :dialog="deleteSelected"
      :is-delete="true"
      title="Delete"
      color="red"
      icon="mdi-bag-suitcase-off"
      @input="deleteDataClassVidioSelected"
    />
    <app-dialog-notice
      :dialog="deleteById"
      :is-delete-by-id="true"
      title="Delete"
      color="red"
      icon="mdi-bag-suitcase-off"
      @input="deleteDataClassVidioById"
    />
    <app-dialog-edit
      :dialog="update"
      :category="computedCategories"
      title="update_class"
      icon="mdi-pencil"
      @input="updateDataClassVidio"
    />
  </v-container>
</template>

<script>
  import dataTable from "./components_core/_dataTable.vue"
  import dialogNotice from "./components/__dialogNotice.vue"
  import dialogEdit from "./components/__dialogEdit.vue"
  export default {
    components: {
      "app-data-table": dataTable,
      "app-dialog-notice": dialogNotice,
      "app-dialog-edit": dialogEdit,
    },
    data: () => ({
      publish: {
        open: false,
        data: [],
      },
      hide: {
        open: false,
        data: {},
      },
      update: {
        open: false,
        data: {},
      },
      deleteSelected: {
        open: false,
        data: [],
      },
      deleteById: {
        open: false,
        data: {},
      },
    }),
    computed: {
      computedClassVidio () {
        return this.$store.state.classVidio.data
      },
      computedCategories () {
        return this.$store.state.studioCategories.data
      },
    },
    mounted () {
      this.getDataClassVidio()
      this.getDataStudioCategories()
    },
    methods: {
      getDataClassVidio () {
        this.$store.dispatch("classVidio/getDataClassVidio", {
          entities: "category",
        })
      },
      getDataStudioCategories () {
        this.$store.dispatch("studioCategories/getDataStudioCategories", {})
      },
      refresh () {
        this.getDataClassVidio()
        const Toast = this.$swal.mixin({
          toast: true,
          position: "top-end",
          showConfirmButton: false,
          timer: 3000,
          timerProgressBar: true,
          didOpen: toast => {
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
      upPublishClassVidio ({ item }) {
        this.publish.open = true
        this.publish.data = item
      },
      publishDataClassVidio ({ item }) {
        this.$store
          .dispatch("classVidio/publishDataClassVidio", item)
          .then(res => {
            if (res.data.meta.status) {
              this.publish.open = false
              const Toast = this.$swal.mixin({
                toast: true,
                position: "bottom-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: toast => {
                  toast.addEventListener("mouseenter", this.$swal.stopTimer)
                  toast.addEventListener("mouseleave", this.$swal.resumeTimer)
                },
                popup: "swal2-show",
                backdrop: "swal2-backdrop-show",
                icon: "swal2-icon-show",
              })
              Toast.fire({
                icon: "success",
                title: "Publish Class Vidio Sucessfully",
              })
            }
          })
      },
      upHideDataClassVidio ({ item }) {
        this.hide.open = true
        this.hide.data = item
      },
      hideDataClassVidio ({ item }) {
        this.$store
          .dispatch("classVidio/hideDataClassVidio", {
            status: "hide",
            id: item.id,
          })
          .then(res => {
            if (res.data.meta.status) {
              this.hide.open = false
              const Toast = this.$swal.mixin({
                toast: true,
                position: "bottom-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: toast => {
                  toast.addEventListener("mouseenter", this.$swal.stopTimer)
                  toast.addEventListener("mouseleave", this.$swal.resumeTimer)
                },
                popup: "swal2-show",
                backdrop: "swal2-backdrop-show",
                icon: "swal2-icon-show",
              })
              Toast.fire({
                icon: "success",
                title: "Hide Class Vidio Sucessfully",
              })
            }
          })
      },
      upDialogUpdate ({ item }) {
        this.update.open = true
        this.update.data = item
      },
      updateDataClassVidio ({ item }) {
        this.$store
          .dispatch("classVidio/updateDataClassVidio", {
            id: item.id,
            name: item.name,
            levels: item.levels,
            duration: item.duration,
            about: item.about,
            price: item.price,
            status: item.status,
            note: item.note,
            category_id: item.category_id,
          })
          .then(res => {
            if (res.data.meta.status) {
              this.update.open = false
              const Toast = this.$swal.mixin({
                toast: true,
                position: "bottom-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: toast => {
                  toast.addEventListener("mouseenter", this.$swal.stopTimer)
                  toast.addEventListener("mouseleave", this.$swal.resumeTimer)
                },
                popup: "swal2-show",
                backdrop: "swal2-backdrop-show",
                icon: "swal2-icon-show",
              })
              Toast.fire({
                icon: "success",
                title: "Update Class Vidio Sucessfully",
              })
            }
          })
      },
      upDeleteClassVidioSelected ({ item }) {
        this.deleteSelected.open = true
        this.deleteSelected.data = item
      },
      upDeleteClassVidioById ({ item }) {
        this.deleteById.open = true
        this.deleteById.data = item
      },
      deleteDataClassVidioSelected ({ item }) {
        this.$store
          .dispatch("classVidio/deleteDataClassVidioSelected", item)
          .then(res => {
            if (res.data.meta.status) {
              this.deleteSelected.open = false
              const Toast = this.$swal.mixin({
                toast: true,
                position: "bottom-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: toast => {
                  toast.addEventListener("mouseenter", this.$swal.stopTimer)
                  toast.addEventListener("mouseleave", this.$swal.resumeTimer)
                },
                popup: "swal2-show",
                backdrop: "swal2-backdrop-show",
                icon: "swal2-icon-show",
              })
              Toast.fire({
                icon: "success",
                title: "Delete Class Vidio Sucessfully",
              })
            }
          })
      },
      deleteDataClassVidioById ({ item }) {
        this.$store
          .dispatch("classVidio/deleteDataClassVidioById", {
            id: item.id,
          })
          .then(res => {
            if (res.data.meta.status) {
              this.deleteById.open = false
              const Toast = this.$swal.mixin({
                toast: true,
                position: "bottom-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: toast => {
                  toast.addEventListener("mouseenter", this.$swal.stopTimer)
                  toast.addEventListener("mouseleave", this.$swal.resumeTimer)
                },
                popup: "swal2-show",
                backdrop: "swal2-backdrop-show",
                icon: "swal2-icon-show",
              })
              Toast.fire({
                icon: "success",
                title: "Delete Class Vidio Sucessfully",
              })
            }
          })
      },
    },
  }
</script>

<style lang="sass">
.sweet2-title
  font-family: 'Spartan', sans-serif !important
</style>
