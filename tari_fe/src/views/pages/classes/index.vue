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
            @edit="editClass"
          />
        </v-col>
      </v-row>
    </v-container>
    <app-add-dialog
      :dialog="dialogAdd"
      :instructor="instructor"
      :category="category"
      @send="insertClass"
    />
    <app-edit-dialog
      :dialog="dialogEdit"
      :instructor="instructor"
      @edit="updateClass"
    />
  </v-app>
</template>

<script>
  import dataTable from './_dataTable.vue'
  import addDialog from './_addDialog.vue'
  import editDialog from './_editDialog.vue'
  //   import swicth from '../../../i18n'
  export default {
    components: {
      'app-data-table': dataTable,
      'app-add-dialog': addDialog,
      'app-edit-dialog': editDialog,
    },
    data: () => ({
      dialogAdd: {},
      dialogEdit: {},
    }),
    computed: {
      list () {
        return this.$store.state.class.classes
      },
      instructor () {
        return this.$store.state.user.data
      },
      category () {
        return this.$store.state.category.list
      },
    },
    mounted () {
      this.getClasses()
      this.getDataInstructor()
      this.getDataCategory()
    },
    methods: {
      getClasses () {
        this.$store.dispatch('class/getClasses')
      },
      removeItem (event) {
        this.$swal
          .fire({
            text: `${event.item.posts.title_yt}`,
            title: `Are you sure want To Delete Class ${event.item.display_name}`,
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
              this.$store
                .dispatch('class/deleteClass', {
                  id: event.item.id,
                })
                .then(res => {
                  if (res.data.meta.status) {
                    this.$swal.fire(
                      'Deleted!',
                      'Your file has been deleted.',
                      'success',
                    )
                  }
                })
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
      },
      insertClass ({ item }) {
        this.$store
          .dispatch('class/insertClass', {
            name: item.title,
            display_name: item.title.replace(/(?:^|\s)\S/g, function (a) {
              return a.toUpperCase()
            }),
            teacher_id: item.instructor_id,
            type: item.type,
            status: item.status,
            category_id: item.category_id,
            typeLevelsPost: item.typeLevelsPost,
            url: item.url,
          })
          .then(res => {
            if (res.data.meta.status) {
              item.title = ''
              item.instructor_id = null
              item.type = ''
              item.status = ''
              item.category_id = null
              item.url = ''
              this.dialogAdd.open = false
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
      editClass ({ item }) {
        this.dialogEdit = item
      },
      getDataInstructor () {
        this.$store.dispatch('user/getDataUser', {
          role_id: 3,
        })
      },
      getDataCategory () {
        this.$store.dispatch('category/getData')
      },
      updateClass ({ item }) {
        console.log(item)
        this.$store
          .dispatch('class/editClass', {
            id: item.id,
            name: item.name,
            display_name: item.name.replace(/(?:^|\s)\S/g, function (a) {
              return a.toUpperCase()
            }),
            teacher_id: item.teacher_id,
            status: item.status,
            type: item.type,
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
                title: 'Data has been successfully Editted',
              })
              this.getClasses()
            }
          })
      },
    },
  }
</script>

<style></style>
