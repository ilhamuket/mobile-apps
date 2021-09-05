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
            icon="mdi-account-tie"
            title="All"
            :value="String(cumputedSummary.all)"
            sub-icon="mdi-tag"
            sub-text="Tracked from Google Analytics"
            style="cursor:pointer"
            @click.native="orderBySummary('all')"
          />
        </v-col>
        <v-col
          cols="12"
          sm="6"
          lg="3"
        >
          <base-material-stats-card
            color="secondary"
            icon="mdi-account-check-outline"
            title="Approved"
            :value="String(cumputedSummary.approved)"
            sub-icon="mdi-tag"
            sub-text="Tracked from Google Analytics"
            style="cursor:pointer"
            @click.native="orderBySummary('approved')"
          />
        </v-col>
        <v-col
          cols="12"
          sm="6"
          lg="3"
        >
          <base-material-stats-card
            color="red"
            icon="mdi-account-cancel"
            title="Non Approved"
            :value="String(cumputedSummary.non_approved)"
            sub-icon="mdi-tag"
            sub-text="Tracked from Google Analytics"
            style="cursor:pointer"
            @click.native="orderBySummary('non_approved')"
          />
        </v-col>
        <v-col
          cols="12"
          sm="6"
          lg="3"
        >
          <base-material-stats-card
            color="pallet1"
            icon="mdi-account-reactivate-outline"
            title="New"
            :value="String(cumputedSummary.new)"
            sub-icon="mdi-tag"
            sub-text="Tracked from Google Analytics"
            style="cursor:pointer"
            @click.native="orderBySummary('new')"
          />
        </v-col>
        <v-col cols="12">
          <app-data-table
            :data="computedInstructor"
            @create="popDialogForm"
          />
        </v-col>
      </v-row>
    </v-container>
    <app-dialog-form
      :dialog="dialogForm"
      @input="insertDataTeacherStudio"
    />
  </v-app>
</template>

<script>
  import dataTable from './component_core/_dataTable.vue'
  import dialogForm from './component/__dialogForm.vue'

  export default {
    components: {
      'app-data-table': dataTable,
      'app-dialog-form': dialogForm,
    },
    data: () => ({
      summary: '',
      dialogForm: {
        open: false,
      },
    }),
    computed: {
      computedInstructor () {
        return this.$store.state.studioInstructor.data
      },
      cumputedSummary () {
        return this.$store.state.studioInstructorSummary.data
      },
    },
    watch: {
      summary (val) {
        this.$router.push({ query: { ...this.$route.query, summary: val } })
      },
      '$router.push.query': function (newVal) {
        this.summary = newVal
        this.getDataTeacherStudio()
      },
    },
    mounted () {
      this.getDataTeacherStudio()
      this.getDataSummaryTeachers()
    },
    methods: {
      getDataTeacherStudio () {
        this.$store.dispatch('studioInstructor/getDataTeacherStudio', {
          entities: 'studio',
          summary: this.summary,
        })
      },
      getDataSummaryTeachers () {
        this.$store.dispatch('studioInstructorSummary/getDataSummaryTeachers')
      },
      orderBySummary (val) {
        this.summary = val
        this.getDataTeacherStudio()
      },
      popDialogForm () {
        this.dialogForm.open = true
      },
      insertDataTeacherStudio ({ item }) {
        this.$store
          .dispatch('studioInstructor/insertDataTeacherStudio', {
            name: item.name,
            email: item.email,
            profession: item.profession,
            region: item.region,
            contact: item.contact,
            about: item.about,
          })
          .then(res => {
            console.log(res)
            if (res.data.meta.status) {
              item.name = null
              item.email = null
              item.profession = null
              item.region = null
              item.contact = null
              item.about = null
              this.dialogForm.open = false
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
                title: 'Teaches Created Successfully',
              })
            }
          })
        console.log(item)
      },
    },
  }
</script>

<style></style>
