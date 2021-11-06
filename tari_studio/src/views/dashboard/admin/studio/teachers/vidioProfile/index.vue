<template>
  <v-container>
    <v-row>
      <v-col
        cols="12"
        sm="6"
        lg="3"
      >
        <base-material-stats-card
          color="orange"
          icon="mdi-sofa"
          title="Bookings"
          value="184"
          sub-icon="mdi-alert"
          sub-icon-color="red"
          sub-text="Get More Space..."
        />
      </v-col>
      <v-col
        cols="12"
        sm="6"
        lg="3"
      >
        <base-material-stats-card
          color="orange"
          icon="mdi-sofa"
          title="Bookings"
          value="184"
          sub-icon="mdi-alert"
          sub-icon-color="red"
          sub-text="Get More Space..."
        />
      </v-col>
      <v-col
        cols="12"
        sm="6"
        lg="3"
      >
        <base-material-stats-card
          color="orange"
          icon="mdi-sofa"
          title="Bookings"
          value="184"
          sub-icon="mdi-alert"
          sub-icon-color="red"
          sub-text="Get More Space..."
        />
      </v-col>
      <v-col
        cols="12"
        sm="6"
        lg="3"
      >
        <base-material-stats-card
          color="orange"
          icon="mdi-sofa"
          title="Bookings"
          value="184"
          sub-icon="mdi-alert"
          sub-icon-color="red"
          sub-text="Get More Space..."
        />
      </v-col>
      <v-col cols="12">
        <app-data-table
          :data="computedVidioInstructor"
          @add="upAddForm"
          @refresh="refresh"
        />
      </v-col>
    </v-row>
    <app-dialog-form
      :dialog="addVidio"
      @input="saveFormUrl"
    />
  </v-container>
</template>

<script>
  import dataTable from "./component_core/_dataTable.vue"
  import dialogForm from "./component/__dialogForm.vue"
  export default {
    components: {
      "app-data-table": dataTable,
      "app-dialog-form": dialogForm,
    },
    data: () => ({
      addVidio: {
        open: false,
      },
      instructor_id: 0,
    }),
    computed: {
      computedVidioInstructor () {
        return this.$store.state.vidioInstructor.data
      },
    },
    mounted () {
      this.getDataVidioProfile()
      console.log(this.computedVidioInstructor)
    },
    methods: {
      upAddForm () {
        this.addVidio.open = true
      },
      refresh () {
        this.getDataVidioProfile()
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
      saveFormUrl ({ item }) {
        const arr = item.map((x) => x.option)
        console.log(arr)
        this.$store
          .dispatch("vidioInstructor/addDataVidioUrlVidioUrl", {
            url: arr,
            slug: this.$route.params.slug,
          })
          .then((res) => {
            if (res.data.meta.status) {
              this.addVidio.open = false
              item = []
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
                title: "Data Teachers vidio profile Successfully",
              })
              this.getDataVidioProfile()
            }
          })
      },
      getDataVidioProfile () {
        this.$store.dispatch("vidioInstructor/getDataVidioProfile", {
          slug: this.$route.params.slug,
          entities: "instructor.img,instructor.studio",
        })
      },
    },
  }
</script>

<style></style>
