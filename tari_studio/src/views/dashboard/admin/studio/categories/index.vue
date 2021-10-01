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
          title="All"
          :value="String(summary.all)"
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
          title="Publish"
          :value="String(summary.publish)"
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
          title="Concept"
          :value="String(summary.concept)"
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
          title="draft"
          :value="String(summary.draft)"
          sub-icon="mdi-clock"
          sub-text="Just Updated"
        />
      </v-col>
      <v-col cols="12">
        <app-data-category
          :data="categories"
          @create="popUpDialogCreate"
          @deleteById="popDialogDeleteById"
        />
      </v-col>
    </v-row>
    <app-data-create
      :dialog="dialogCreate"
      @input="createDataCategory"
    />
    <app-data-notice
      :dialog="deleteById"
      @input="deleteCategoryById"
    />
  </v-container>
</template>

<script>
  import componentsCategory from './components_core/_dataTable.vue'
  import dialogForm from './components/__dialogForm.vue'
  import dialogNotice from './components/__dialogNotice.vue'
  export default {
    components: {
      'app-data-category': componentsCategory,
      'app-data-create': dialogForm,
      'app-data-notice': dialogNotice,
    },
    data: () => ({
      dialogCreate: {
        open: false,
      },
      deleteById: {
        open: false,
        data: {},
      },
    }),
    computed: {
      categories () {
        return this.$store.state.studioCategories.data
      },
      summary () {
        return this.$store.state.categorySummary.data
      },
    },
    mounted () {
      this.getDataStudioCategories()
    },
    methods: {
      getDataStudioCategories () {
        this.$store.dispatch('studioCategories/getDataStudioCategories', {
          entities: 'class',
        })
      },
      createDataCategory ({ item }) {
        this.$store
          .dispatch('studioCategories/insertDataCategory', {
            name: item.name,
            display_name: item.display_name,
            status: item.status,
          })
          .then(res => {
            if (res.data.meta.status) {
              item = null
              this.dialogCreate.open = false
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
                title: 'Class Created Successfully',
              })
            }
          })
      },
      getDataCategorySummary () {
        this.$store.dispatch('categorySummary/getDataCategorySummary')
      },
      popUpDialogCreate () {
        this.dialogCreate.open = true
      },
      popDialogDeleteById ({ item }) {
        this.deleteById.open = true
        this.deleteById.data = item
      },
      deleteCategoryById ({ item }) {
        console.log(item)
      },
    },
  }
</script>

<style></style>
