<template>
  <v-container>
    <v-row>
      <v-col
        cols="12"
        md="3"
      >
        <base-material-stats-card
          color="info"
          icon="mdi-twitter"
          title="All"
          :value="String(computedSummary.all)"
          style="cursor: pointer"
          @click.native="getSummary('')"
        />
      </v-col>
      <v-col
        cols="12"
        md="3"
      >
        <base-material-stats-card
          color="info"
          icon="mdi-twitter"
          title="Present"
          :value="String(computedSummary.present)"
          style="cursor: pointer"
          @click.native="getSummary('present')"
        />
      </v-col>
      <v-col
        cols="12"
        md="3"
      >
        <base-material-stats-card
          color="info"
          icon="mdi-twitter"
          title="Miss Absent"
          :value="String(computedSummary.miss_absent)"
          style="cursor: pointer"
          @click.native="getSummary('miss_absent')"
        />
      </v-col>

      <v-col cols="12">
        <app-data-table
          :data="computedStudent"
          @absent="getAbsentDataStudent"
        />
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
  import dataTable from "./component_core/_dataTable.vue"
  export default {
    components: {
      "app-data-table": dataTable,
    },
    data: () => ({
      summary: "",
    }),
    computed: {
      computedStudent () {
        return this.$store.state.student.data
      },
      computedSummary () {
        return this.$store.state.student.summary
      },
    },
    watch: {
      summary (val) {
        this.$router.push({ query: { ...this.$route.query, summary: val } })
      },
      "$route.query.summary": function (val) {
        this.summary = val
        this.getDataStudent()
      },
    },
    mounted () {
      this.getDataStudent()
      this.getDataStudentSummary()
    },
    methods: {
      getDataStudent () {
        this.$store
          .dispatch("student/getDataStudent", {
            slug: this.$route.params.slug,
            entities: "form,classes",
            summary: this.$route.query.summary,
          })
          .then((res) => {
            if (res.data.data.length > 0) {
              localStorage.setItem("class_name", res.data.data[0].classes.name)
            }
          })
      },
      getDataStudentSummary () {
        this.$store.dispatch("student/getDataStudentSummary", {
          class_slug: this.$route.params.slug,
        })
      },
      getSummary (item) {
        this.summary = item
        this.getDataStudent()
      },
      getAbsentDataStudent ({ item }) {
        this.$store
          .dispatch("student/getAbsentDataStudent", {
            id: item.id,
            value: item.absent,
          })
          .then((res) => {
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
              title: "Successfully",
            })
          })
      },
    },
  }
</script>

<style></style>
