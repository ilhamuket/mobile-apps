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
        <app-data-category
          :data="categories"
          @create="popUpDialogCreate"
        />
      </v-col>
    </v-row>
    <app-data-create
      :dialog="dialogCreate"
      @input="createDataCategory"
    />
  </v-container>
</template>

<script>
  import componentsCategory from './components_core/_dataTable.vue'
  import dialogForm from './components/__dialogForm.vue'
  export default {
    components: {
      'app-data-category': componentsCategory,
      'app-data-create': dialogForm,
    },
    data: () => ({
      dialogCreate: {
        open: false,
      },
    }),
    computed: {
      categories () {
        return this.$store.state.studioCategories.data
      },
    },
    mounted () {
      this.getDataStudioCategories()
    },
    methods: {
      getDataStudioCategories () {
        this.$store.dispatch('studioCategories/getDataStudioCategories')
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
      popUpDialogCreate () {
        this.dialogCreate.open = true
      },
    },
  }
</script>

<style></style>
