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
          icon="mdi-account-tie"
          title="All"
          :value="String(cumputedSummary.all)"
          sub-icon="mdi-heart-outline"
          sub-text="EnsikloTari"
          style="cursor: pointer"
          :class="`${$route.query.summary === 'all' ? 'selected' : ''}`"
          @click.native="orderBySummary('all')"
        />
      </v-col>
      <v-col
        cols="12"
        sm="6"
        lg="3"
      >
        <base-material-stats-card
          color="info"
          icon="mdi-account-check-outline"
          title="Approved"
          :value="String(cumputedSummary.approved)"
          sub-icon="mdi-heart-outline"
          sub-text="EnsikloTari"
          style="cursor: pointer"
          :class="`${$route.query.summary === 'approved' ? 'selected' : ''}`"
          @click.native="orderBySummary('approved')"
        />
      </v-col>
      <v-col
        cols="12"
        sm="6"
        lg="3"
      >
        <base-material-stats-card
          color="info"
          icon="mdi-account-cancel"
          title="Non Approved"
          :value="String(cumputedSummary.non_approved)"
          sub-icon="mdi-heart-outline"
          sub-text="EnsikloTari"
          style="cursor: pointer"
          :class="`${
            $route.query.summary === 'non_approved' ? 'selected' : ''
          }`"
          @click.native="orderBySummary('non_approved')"
        />
      </v-col>
      <v-col
        cols="12"
        sm="6"
        lg="3"
      >
        <base-material-stats-card
          color="info"
          icon="mdi-account-reactivate-outline"
          title="New"
          :value="String(cumputedSummary.new)"
          sub-icon="mdi-heart-outline"
          sub-text="EnsikloTari"
          style="cursor: pointer"
          :class="`${$route.query.summary === 'new' ? 'selected' : ''}`"
          @click.native="orderBySummary('new')"
        />
      </v-col>
      <v-col
        cols="12"
        lg="12"
      >
        <app-data-table
          :data="computedInstructor"
          @create="popDialogForm"
          @edit="popEdit"
          @approve="popUpApprove"
          @deletes="popUpDeleted"
          @deleteById="popUpDeletedById"
          @refresh="refreshMethods"
          @change="changePictProfile"
          @deactive="upDeactive"
          @pict="uploadPictProfile"
          @vidioProfile="popUpYoutube"
        />
      </v-col>
    </v-row>
    <app-dialog-form
      :dialog="dialogForm"
      @input="insertDataTeacherStudio"
    />
    <app-dialog-edit
      :dialog="edit"
      @input="updateDataTeacherStudio"
    />
    <app-dialog-notice
      :dialog="approve"
      icon="mdi-check-decagram"
      title="Approve"
      text-button1="Approve"
      text="card_notice.approved"
      @input="approveDataTeacherStudioBoadCast"
    />
    <app-dialog-notice
      :dialog="deleted"
      title="Delete"
      text="card_notice.text"
      text-button1="Delete"
      icon="mdi-delete "
      color-button1="red"
      color-button2="primary"
      @input="deletesDataTeacherStudioBroadCast"
    />
    <app-dialog-notice
      :dialog="dialogDeleteById"
      :by-id="true"
      title="Delete"
      text="card_notice.textById"
      text-button1="Delete"
      icon="mdi-delete "
      color-button1="red"
      color-button2="primary"
      @input="deleteDataTeacherStudioById"
    />
    <app-dialog-notice
      :dialog="dialogDeactive"
      :by-id="true"
      title="Deactive"
      text="card_notice.deactive"
      text-button1="Deactive"
      icon="mdi-eye-off"
      color-button1="red"
      color-button2="primary"
      @input="deactiveDataTeachers"
    />
    <app-dialog-yt
      :dialog="dialogUploadYt"
      @input="addDataVidioUrl"
    />
  </v-container>
</template>

<script>
  import dataTable from "./component_core/_dataTable.vue"
  import dialogForm from "./component/__dialogForm.vue"
  import dialogEdit from "./component/__dialogEdit.vue"
  import dialogNotice from "./component/__dialogNotice.vue"
  import dialogYt from "./component/__dialogUploadYt.vue"

  export default {
    components: {
      "app-data-table": dataTable,
      "app-dialog-form": dialogForm,
      "app-dialog-edit": dialogEdit,
      "app-dialog-notice": dialogNotice,
      "app-dialog-yt": dialogYt,
    },
    data: () => ({
      summary: "",
      dialogForm: {
        open: false,
      },
      edit: {
        open: false,
        name: "",
        email: "",
        region: "",
        contact: "",
        profession: "",
        about: "",
        username_fb: "",
        username_tw: "",
        username_ig: "",
      },
      approve: {
        open: false,
        id: 0,
        data: [],
      },
      deleted: {
        open: false,
        id: 0,
        data: [],
      },
      dialogDeleteById: {
        open: false,
        id: 0,
        name: "",
      },
      dialogDeactive: {
        open: false,
        id: 0,
        name: "",
      },
      dialogUploadYt: {
        open: false,
        data: {},
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
      "$router.push.query": function (newVal) {
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
        this.$store.dispatch("studioInstructor/getDataTeacherStudio", {
          entities: "studio,img",
          summary: this.summary,
        })
      },
      refreshMethods () {
        this.getDataTeacherStudio()
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
      getDataSummaryTeachers () {
        this.$store.dispatch("studioInstructorSummary/getDataSummaryTeachers")
      },
      orderBySummary (val) {
        this.summary = val
        this.getDataTeacherStudio()
      },
      popDialogForm () {
        this.dialogForm.open = true
      },
      popEdit ({ item }) {
        this.edit.open = true
        this.edit.id = item.id
        this.edit.name = item.name
        this.edit.email = item.email
        this.edit.region = item.region
        this.edit.contact = item.contact
        this.edit.profession = item.profession
        this.edit.about = item.about
        this.edit.username_fb = item.username_fb
        this.edit.username_tw = item.username_tw
        this.edit.username_ig = item.username_ig
      },
      popUpApprove ({ item }) {
        this.approve.open = true
        this.approve.id = item.id
        this.approve.data = item
      },
      popUpDeleted ({ item }) {
        this.deleted.open = true
        this.deleted.id = item.id
        this.deleted.data = item
      },
      popUpDeletedById ({ item }) {
        this.dialogDeleteById.open = true
        this.dialogDeleteById.id = item.id
        this.dialogDeleteById.name = item.name
      },
      insertDataTeacherStudio ({ item }) {
        this.$store
          .dispatch("studioInstructor/insertDataTeacherStudio", {
            name: item.name,
            email: item.email,
            profession: item.profession,
            region: item.region,
            contact: item.contact,
            about: item.about,
          })
          .then((res) => {
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
                title: "Teaches Created Successfully",
              })
            }
          })
      },
      updateDataTeacherStudio ({ item }) {
        console.log(item)
        this.$store
          .dispatch("studioInstructor/updateDataTeacherStudio", {
            id: item.id,
            name: item.name,
            email: item.email,
            region: item.region,
            contact: item.contact,
            profession: item.profession,
            about: item.about,
            username_fb: item.username_fb,
            username_tw: item.username_tw,
            username_ig: item.username_ig,
          })
          .then((res) => {
            if (res.data.meta.status) {
              this.edit.open = false
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
                title: "Data Teachers Updated Successfully",
              })
            }
          })
      },
      approveDataTeacherStudioBoadCast ({ item }) {
        console.log(item)
        this.$store
          .dispatch("studioInstructor/approveDataTeacherStudioBoadCast", item)
          .then((res) => {
            if (res.data.meta.status) {
              this.approve.open = false
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
                title: "Data Teachers Approved Successfully",
              })
            }
          })
      },
      deletesDataTeacherStudioBroadCast ({ item }) {
        this.$store
          .dispatch("studioInstructor/deletesDataTeacherStudioBroadCast", item)
          .then((res) => {
            if (res.data.meta.status) {
              this.deleted.open = false
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
                title: "Data Teachers Deleted Successfully",
              })
            }
          })
      },
      deleteDataTeacherStudioById ({ item }) {
        this.$store
          .dispatch("studioInstructor/deleteDataTeacherStudioById", {
            id: item.id,
          })
          .then((res) => {
            if (res.data.meta.status) {
              this.dialogDeleteById.open = false
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
                title: "Data Teachers Deleted Successfully",
              })
            }
          })
      },
      uploadPictProfile ({ item }) {
        this.$store
          .dispatch("studioInstructor/uploadPictProfile", {
            files: item.files,
            instructor_id: item.id,
          })
          .then((res) => {
            if (res.data.meta.status) {
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
                title: "Edit Photo Profile Successfully",
              })
              this.getDataTeacherStudio()
            }
          })
      },
      changePictProfile ({ item }) {
        this.$store
          .dispatch("studioInstructor/changePictProfile", {
            files: item.files,
            instructor_id: item.id,
          })
          .then((res) => {
            if (res.data.meta.status) {
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
                title: "Edit Photo Profile Successfully",
              })
              this.getDataTeacherStudio()
            }
          })
      },
      upDeactive ({ item }) {
        this.dialogDeactive.open = true
        this.dialogDeactive.id = item.id
        this.dialogDeactive.name = item.name
      },
      deactiveDataTeachers ({ item }) {
        this.$store
          .dispatch("studioInstructor/deactiveDataTeachers", {
            id: item.id,
          })
          .then((res) => {
            if (res.data.meta.status) {
              this.dialogDeactive.open = false
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
                title: "Data Teachers Deactive Successfully",
              })
            }
          })
      },
      popUpYoutube ({ item }) {
        this.dialogUploadYt.open = true
        this.dialogUploadYt.data = item
      },
      addDataVidioUrl ({ item, id }) {
        const arr = item.map((x) => x.url)
        console.log(arr)
        this.$store
          .dispatch("vidioInstructor/addDataVidioUrl", {
            url: arr,
            instructor_id: id,
          })
          .then((res) => {
            if (res.data.meta.status) {
              this.getDataTeacherStudio()
              this.dialogUploadYt.open = false
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
    },
  }
</script>

<style></style>
