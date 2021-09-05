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
            title="Total"
            :value="String(computedSummary.all)"
            sub-icon="mdi-tag"
            sub-text="Tracked from Google Analytics"
            style="cursor:pointer"
            @click.native="orderBy('all')"
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
            title="Approved"
            :value="String(computedSummary.approved)"
            sub-icon="mdi-tag"
            sub-text="Tracked from Google Analytics"
            style="cursor:pointer"
            @click.native="orderBy('approved')"
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
            title="Non Approved"
            :value="String(computedSummary.non_approved)"
            sub-icon="mdi-tag"
            sub-text="Tracked from Google Analytics"
            style="cursor:pointer"
            @click.native="orderBy('non-approved')"
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
            title="New"
            :value="String(computedSummary.new)"
            sub-icon="mdi-tag"
            sub-text="Tracked from Google Analytics"
            style="cursor:pointer"
            @click.native="orderBy('new')"
          />
        </v-col>
        <v-col>
          <app-data-table
            :data="computedClasses"
            @add="popDialog"
            @deletes="popDeletes"
            @approves="popApproves"
            @update="popUpdate"
            @del="removeStudioById"
          />
        </v-col>
      </v-row>
    </v-container>
    <app-data-form
      :dialog="addForm"
      @input="createClasses"
    />
    <app-dialog-notice
      title="Delete"
      text="Are You Sure Want to Delete"
      text-button1="Delete"
      icon="mdi-delete "
      color-button1="red"
      color-button2="primary"
      :dialog="deletes"
      @input="deletesData"
    />
    <app-dialog-notice
      :dialog="approves"
      icon="mdi-check-decagram"
      title="Approve"
      text-button1="Approve"
      text="Are You Sure Want to Approve"
      @input="approvesDataClassesStudio"
    />
    <app-dialog-notice
      :by-id="true"
      :dialog="dialogDeleteById"
      title="Delete"
      text="Are You Sure Want to Delete"
      text-button1="Delete"
      icon="mdi-delete "
      color-button1="red"
      color-button2="primary"
      @input="delDataClassesStudio"
    />
    <app-data-edit
      :dialog="update"
      @input="updateDataClassesStudio"
    />
  </v-app>
</template>

<script>
  import table from './component_core/_dataTable.vue'
  import dialogForm from './component/__dialogFormAdd.vue'
  import dialogNotice from './component/__dialogNotice.vue'
  import dialogEdit from './component/__dialogEdit.vue'
  export default {
    components: {
      'app-data-table': table,
      'app-data-form': dialogForm,
      'app-dialog-notice': dialogNotice,
      'app-data-edit': dialogEdit,
    },
    data: () => ({
      addForm: {
        open: false,
      },
      deletes: {
        open: false,
        id: 0,
        data: [],
      },
      approves: {
        open: false,
        id: 0,
        data: [],
      },
      update: {
        open: false,
        id: 0,
        name: '',
        levels: '',
        about: '',
        instructor_id: 0,
      },
      dialogDeleteById: {
        id: 0,
        open: false,
        title: '',
      },
      summary: '',
    }),
    computed: {
      computedClasses () {
        return this.$store.state.ownerStudioClasses.data
      },
      computedSummary () {
        return this.$store.state.studioSummary.data
      },
    },
    watch: {
      summary (newVal) {
        this.$router.push({ query: { ...this.$route.query, summary: newVal } })
      },
      '$route.query.summary': function (val) {
        this.summary = val
      },
    },
    mounted () {
      this.getDataClassesStudio()
      this.getDataSummary()
    },
    methods: {
      getDataClassesStudio () {
        this.$store.dispatch('ownerStudioClasses/getDataClassesStudio', {
          entities: 'studio, author, instructor',
          summary: this.summary,
        })
      },
      popDialog () {
        this.addForm.open = true
      },
      closeDialogForm () {
        this.addForm.open = false
      },
      createClasses ({ item }) {
        this.$store
          .dispatch('ownerStudioClasses/insertDataClassesStudio', {
            name: item.name,
            levels: item.levels,
            about: item.about,
            instructor_id: item.instructor_id,
          })
          .then(({ data }) => {
            if (data.meta.status) {
              item.name = ''
              item.levels = ''
              item.about = ''
              this.addForm.open = false
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
            } else {
              item.name = ''
              item.levels = ''
              item.about = ''
              this.addForm.open = false
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
                title: `${data.meta.message}`,
              })
            }
          })
      },
      popDeletes ({ item }) {
        this.deletes.open = true
        this.deletes.data = item
      },
      popApproves ({ item }) {
        this.approves.open = true
        this.approves.data = item
      },
      popUpdate ({ item }) {
        const instructorId = item.instructor.map(x => x.id)
        this.update.open = true
        this.update.name = item.name
        this.update.id = item.id
        this.update.about = item.about
        this.update.levels = item.levels
        this.update.instructor_id = instructorId
      },
      removeStudioById ({ item }) {
        this.dialogDeleteById.open = true
        this.dialogDeleteById.title = item.name
        this.dialogDeleteById.id = item.id
      },
      deletesData ({ item }) {
        // console.log(item)
        this.$store
          .dispatch('ownerStudioClasses/deleteDataClassesStudio', item)
          .then(res => {
            if (res.data.meta.status) {
              this.deletes.open = false
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
                title: 'Class Deleted Successfully',
              })
            }
          })
      // this.$store.commit('ownerStudioClasses/DELETES_DATA', item)
      },
      approvesDataClassesStudio ({ item }) {
        this.$store
          .dispatch('ownerStudioClasses/approvesDataClassesStudio', item)
          .then(res => {
            this.approves.open = false
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
                title: 'Class Approved Successfully',
              })
              this.getDataClassesStudio()
            }
          })
      },
      updateDataClassesStudio ({ item }) {
        this.$store
          .dispatch('ownerStudioClasses/updateDataClassesStudio', {
            id: item.id,
            name: item.name,
            levels: item.levels,
            about: item.about,
            instructor_id: item.instructor_id,
          })
          .then(res => {
            if (res.data.meta.status) {
              this.update.open = false
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
                title: 'Class Edited Successfully',
              })
              this.getDataClassesStudio()
            }
          })
      },
      delDataClassesStudio ({ item }) {
        this.$store
          .dispatch('ownerStudioClasses/delDataClassesStudio', {
            id: item.id,
          })
          .then(({ data }) => {
            if (data.meta.status) {
              this.dialogDeleteById.open = false
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
                title: 'Class Deleted Successfully',
              })
            }
          })
      },
      getDataSummary () {
        this.$store.dispatch('studioSummary/getDataSummary')
      },
      orderBy (val) {
        this.summary = val
        this.getDataClassesStudio()
      },
    },
  }
</script>

<style></style>
