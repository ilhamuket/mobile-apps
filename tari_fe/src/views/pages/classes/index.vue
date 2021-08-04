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
        <v-col
          cols="12"
          md="12"
        >
          <app-data-table
            :data="list"
            @remove="removeItem"
            @open="openDialogAddClass"
          />
        </v-col>
      </v-row>
    </v-container>
    <app-add-dialog :dialog="dialogAdd" />
  </v-app>
</template>

<script>
  import dataTable from './_dataTable.vue'
  import addDialog from './_addDialog.vue'
  export default {
    components: {
      'app-data-table': dataTable,
      'app-add-dialog': addDialog,
    },
    data: () => ({
      dialogAdd: {},
    }),
    computed: {
      list () {
        return this.$store.state.class.classes
      },
    },
    mounted () {
      this.getClasses()
    },
    methods: {
      getClasses () {
        this.$store.dispatch('class/getClasses')
      },
      removeItem (event) {
        console.log(event.item)
        this.$swal
          .fire({
            text: `${event.item.posts.title_yt}`,
            title: `Are You Sure Want To Delete Class ${event.item.display_name}`,
            imageUrl: `${event.item.posts.thumbnail_url}`,
            imageWidth: 400,
            imageHeight: 200,
            imageAlt: 'Custom image',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
          })
          .then(res => {
            if (res.isConfirmed) {
              this.$swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success',
              )
            } else if (
              /* Read more about handling dismissals below */
              res.dismiss === this.$swal.DismissReason.cancel
            ) {
              this.$swal.fire(
                'Cancelled',
                'Your imaginary file is safe :)',
                'error',
              )
            }
          })
      },
      openDialogAddClass (event) {
        this.dialogAdd = event.item
        console.log(event.item)
      },
    },
  }
</script>

<style></style>
