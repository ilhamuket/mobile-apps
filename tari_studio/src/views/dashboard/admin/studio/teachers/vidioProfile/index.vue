<template>
  <v-container>
    <v-row>
      <v-col
        cols="12"
        sm="6"
        lg="3"
      >
        <base-material-stats-card
          color="btn_primary"
          icon="mdi-sofa"
          title="All"
          :value="String(summary.all)"
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
          color="btn_primary"
          icon="mdi-sofa"
          title="Publish"
          :value="String(summary.publish)"
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
          color="primary"
          icon="mdi-sofa"
          title="Draft"
          :value="String(summary.draft)"
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
          color="third"
          icon="mdi-sofa"
          title="New"
          :value="String(summary.new)"
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
          @approves="upApproveSelected"
          @approve="upApproved"
          @deleteSelected="upDeletes"
          @deleteById="upDelete"
          @edit="upEdit"
          @deactive="deactive"
        />
      </v-col>
    </v-row>
    <app-dialog-form
      :dialog="addVidio"
      @input="saveFormUrl"
    />
    <app-dialog-approve-selected
      :dialog="approvedSelected"
      icon="mdi-check"
      :text="'Are You sure want to Approved Videos'"
      title="Approved"
      :text-btn1="'Approved'"
      :text-btn2="'Cancel'"
      @input="approveDataVidioProfileSelected"
    />
    <app-dialog-approve
      :dialog="approveById"
      :icon="'mdi-check'"
      :by-id="true"
      text="Are you sure want to Approved Video"
      title="Approved"
      text-btn1="Approved"
      :text-btn2="'Cancel'"
      @input="approveDataVidioById"
    />
    <app-dialog-delete
      :dialog="deleteSelected"
      :icon="'mdi-delete-empty'"
      :text="'Are you sure want to deleted Video'"
      title="Deleted"
      :text-btn1="'Delete'"
      :color-btn1="'red'"
      :text-btn2="'Cancel'"
      :color-btn2="'btn_primary'"
      :outline1="true"
      :outline2="false"
      @input="deleteDataVidioProfileSelected"
    />
    <app-dialog-delete-by-id
      :dialog="deleteById"
      :by-id="true"
      :icon="'mdi-delete-empty'"
      :text="'Are you sure want to deleted Video'"
      title="Deleted"
      :text-btn1="'Delete'"
      :color-btn1="'red'"
      :text-btn2="'Cancel'"
      :color-btn2="'btn_primary'"
      :outline1="true"
      :outline2="false"
      @input="deleteDataVidioProfileById"
    />
    <app-dialog-edit
      :dialog="edit"
      @input="updateVidioProfile"
    />
    <app-dialog-hidden
      :dialog="hidden"
      :by-id="true"
      :icon="'mdi-eye-off'"
      :text="'Are you sure want to Hiden Video'"
      title="Hiden"
      :text-btn1="'Hiden'"
      :color-btn1="'red'"
      :text-btn2="'Cancel'"
      :color-btn2="'btn_primary'"
      :outline1="true"
      :outline2="false"
      @input="hidenDataProfileVidio"
    />
  </v-container>
</template>

<script>
  import dataTable from "./component_core/_dataTable.vue"
  import dialogForm from "./component/__dialogForm.vue"
  import dialogNotice from "./component/__dialogNotice.vue"
  import dialogEdit from "./component/__dialogEdit.vue"
  export default {
    components: {
      "app-data-table": dataTable,
      "app-dialog-form": dialogForm,
      "app-dialog-approve-selected": dialogNotice,
      "app-dialog-approve": dialogNotice,
      "app-dialog-delete": dialogNotice,
      "app-dialog-delete-by-id": dialogNotice,
      "app-dialog-hidden": dialogNotice,
      "app-dialog-edit": dialogEdit,
    },
    data: () => ({
      addVidio: {
        open: false,
      },
      approveById: {
        open: false,
        data: {},
      },
      approvedSelected: {
        open: false,
        data: [],
      },
      deleteById: {
        open: false,
        data: {},
      },
      deleteSelected: {
        open: false,
        data: [],
      },
      edit: {
        open: false,
        data: {},
      },
      hidden: {
        open: false,
        data: {},
      },
      instructor_id: 0,
      instructor: {},
    }),
    computed: {
      computedVidioInstructor () {
        return this.$store.state.vidioInstructor.data
      },
      summary () {
        return this.$store.state.vidioInstructor.summary
      },
    },
    mounted () {
      this.getDataVidioProfile()
      this.showData()
      this.getDataSummaryVideoProfile()
    },
    methods: {
      upAddForm () {
        this.addVidio.open = true
      },
      getDataSummaryVideoProfile () {
        this.$store.dispatch("vidioInstructor/getDataSummaryVideoProfile", {
          slug: this.$route.params.slug,
        })
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
            // this.getDataVidioProfile()
            }
          })
      },
      getDataVidioProfile () {
        this.$store.dispatch("vidioInstructor/getDataVidioProfile", {
          slug: this.$route.params.slug,
          entities: "instructor.img,instructor.studio",
        })
      },
      showData () {
        this.$store
          .dispatch("vidioInstructor/showData", {
            slug: this.$route.params.slug,
          })
          .then((res) => {
            localStorage.setItem("instructor", res.data.data.name)
          })
      },
      upApproveSelected ({ item }) {
        this.approvedSelected.open = true
        this.approvedSelected.data = item
      },
      approveDataVidioProfileSelected ({ item }) {
        this.$store
          .dispatch("vidioInstructor/approveDataVidioProfileSelected", item)
          .then((res) => {
            if (res.data.meta.status) {
              this.approvedSelected.open = false
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
            }
          })
      },
      upApproved ({ item }) {
        this.approveById.open = true
        this.approveById.data = item
      },
      approveDataVidioById ({ item }) {
        this.$store
          .dispatch("vidioInstructor/approveDataVidioById", {
            id: item.id,
          })
          .then((res) => {
            if (res.data.meta.status) {
              this.approveById.open = false
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
                title: "Data Teachers vidio profile Approved Successfully",
              })
            }
          })
      },
      upDeletes ({ item }) {
        this.deleteSelected.open = true
        this.deleteSelected.data = item
      },
      deleteDataVidioProfileSelected ({ item }) {
        this.$store
          .dispatch("vidioInstructor/deleteDataVidioProfileSelected", item)
          .then((res) => {
            if (res.data.meta.status) {
              this.deleteSelected.open = false
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
                title: "Data Teachers vidio profile deleted Successfully",
              })
            }
          })
      },
      upDelete ({ item }) {
        this.deleteById.open = true
        this.deleteById.data = item
      },
      deleteDataVidioProfileById ({ item }) {
        this.$store
          .dispatch("vidioInstructor/deleteDataVidioProfileById", {
            id: item.id,
          })
          .then((res) => {
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
                title: "Data Teachers vidio profile deleted Successfully",
              })
            }
          })
      },
      upEdit ({ item }) {
        this.edit.open = true
        this.edit.data = item
      },
      updateVidioProfile ({ item }) {
        this.$store
          .dispatch("vidioInstructor/updateVidioProfile", {
            title: item.title,
            id: item.id,
          })
          .then((res) => {
            if (res.data.meta.status) {
              this.edit.open = false
              const Toast = this.swal.mixin({
                toast: true,
                position: "bottom-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                  toast.addEventListener("mouseenter", this.swal.stopTimer)
                  toast.addEventListener("mouseleave", this.swal.resumeTimer)
                },
                popup: "swal2-show",
                backdrop: "swal2-backdrop-show",
                icon: "swal2-icon-show",
              })
              Toast.fire({
                icon: "success",
                title: "Vidio Profile Intructor Edited Successfully",
              })
            }
          })
      },
      deactive ({ item }) {
        this.hidden.open = true
        this.hidden.data = item
      },
      hidenDataProfileVidio ({ item }) {
        this.$store
          .dispatch("vidioInstructor/hidenDataProfileVidio", {
            id: item.id,
          })
          .then((res) => {
            if (res.data.meta.status) {
              this.hidden.open = false
              const Toast = this.swal.mixin({
                toast: true,
                position: "bottom-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                  toast.addEventListener("mouseenter", this.swal.stopTimer)
                  toast.addEventListener("mouseleave", this.swal.resumeTimer)
                },
                popup: "swal2-show",
                backdrop: "swal2-backdrop-show",
                icon: "swal2-icon-show",
              })
              Toast.fire({
                icon: "success",
                title: "Fetch Data",
              })
            }
          })
      },
    },
  }
</script>

<style></style>
