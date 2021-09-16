<template>
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

      <v-row
        v-if="isCollapse"
        class="d-flex justify-center"
      >
        <v-col
          cols="12"
          sm="6"
          lg="3"
        >
          <base-material-stats-card
            color="info"
            icon="mdi-twitter"
            title="Verified"
            value="1"
            sub-icon="mdi-clock"
            sub-text="Just Updated"
            style="cursor:pointer"
            @click.native="sortByType('verified')"
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
            title="UnVerified"
            value="1"
            sub-icon="mdi-clock"
            sub-text="Just Updated"
            style="cursor:pointer"
            @click.native="sortByType('unverified')"
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
            title="Deleted"
            value="1"
            sub-icon="mdi-clock"
            sub-text="Just Updated"
            style="cursor:pointer"
            @click.native="sortByType('deleted')"
          />
        </v-col>
      </v-row>

      <div class="d-flex flex-row-reverse">
        <div class="d-flex flex-column">
          <v-tooltip
            color="primary"
            bottom
          >
            <template #activator="{on ,attrs}">
              <v-btn
                v-bind="attrs"
                dark
                icon
                v-on="on"
                @click="isCollapse = !isCollapse"
              >
                <v-icon
                  color="primary"
                  large
                >
                  {{ isCollapse ? 'mdi-chevron-up' : 'mdi-chevron-down' }}
                </v-icon>
              </v-btn>
            </template>
            {{ isCollapse ? 'Hide Summary' : 'See Summary' }}
          </v-tooltip>
        </div>
      </div>
      <v-col cols="12">
        <app-data-table
          :data="computedClasses"
          @add="popDialog"
          @deletes="popDeletes"
          @approves="popApproves"
          @update="popUpdate"
          @del="removeStudioById"
          @info="popUpInfo"
          @upload="uploadMatery"
        />
      </v-col>
    </v-row>
    <app-data-form
      :dialog="addForm"
      :categories="computedCategories"
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
      :categories="computedCategories"
      @input="updateDataClassesStudio"
    />
    <app-data-info
      :dialog="info"
      @input="inputPicture"
      @change="changePicture"
    />
    <app-data-upload
      :dialog="list"
      @input="inputListMatery"
    />
  </v-container>
</template>

<script>
  import table from './component_core/_dataTable.vue'
  import dialogForm from './component/__dialogFormAdd.vue'
  import dialogNotice from './component/__dialogNotice.vue'
  import dialogEdit from './component/__dialogEdit.vue'
  import dialogInfo from './component/__dialogInfo.vue'
  import upload from './component/___dialogUploadImage.vue'
  import axios from 'axios'
  export default {
    components: {
      'app-data-table': table,
      'app-data-form': dialogForm,
      'app-dialog-notice': dialogNotice,
      'app-data-edit': dialogEdit,
      'app-data-info': dialogInfo,
      'app-data-upload': upload,
    },
    data: () => ({
      show: false,
      isCollapse: false,
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
      info: {
        open: false,
        data: {},
      },
      list: {
        open: false,
        data: {},
      },
      update: {
        open: false,
        id: 0,
        name: '',
        levels: '',
        about: '',
        url: '',
        duration: null,
        keyword: null,
        price: null,
        capacity: null,
        category_id: 0,
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
      computedCategories () {
        return this.$store.state.studioCategories.data
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
      this.getDataStudioCategories()
    },
    methods: {
      getDataClassesStudio () {
        this.$store.dispatch('ownerStudioClasses/getDataClassesStudio', {
          entities: 'studio, author, instructor, img, category,listImg',
          summary: this.summary,
        })
      },
      getDataStudioCategories () {
        this.$store.dispatch('studioCategories/getDataStudioCategories', {})
      },
      popDialog () {
        this.addForm.open = true
      },
      closeDialogForm () {
        this.addForm.open = false
      },
      uploadMatery ({ item }) {
        console.log(item)
        this.list.open = true
        this.list.data = item
      },
      createClasses ({ item }) {
        this.$store
          .dispatch('ownerStudioClasses/insertDataClassesStudio', {
            name: item.name,
            levels: item.levels,
            about: item.about,
            url_meets: item.url,
            keyword: item.keyword,
            duration: item.duration,
            harga: item.price,
            kapasitas: item.capacity,
            time_start: item.time_start,
            time_end: item.time_end,
            instructor_id: item.instructor_id,
            category_id: item.category_id,
            start_at: item.start_at,
            end_at: item.end_at,
          })
          .then(({ data }) => {
            if (data.meta.status) {
              item.name = ''
              item.levels = ''
              item.about = ''
              item = null
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
        this.update.url = item.url_meets
        this.update.keyword = item.keyword
        this.update.duration = item.durasi
        this.update.price = item.harga
        this.update.capacity = item.kapasitas
        this.update.category_id = item.category_id
        this.update.instructor_id = instructorId
      },
      popUpInfo ({ item }) {
        console.log(item)
        this.info.open = true
        this.info.data = item
      },
      inputListMatery ({ item }) {
        axios.defaults.headers.common.Authorization =
          'Bearer ' + localStorage.getItem('access_token')
        axios.defaults.baseURL = process.env.VUE_APP_API_URL

        const URL = 'owner/classes/thumbnail-list'
        const data = new FormData()
        data.append('img', item.files)
        data.append('class_id', item.id)
        const config = {
          header: {
            'Content-Type': 'image/png',
          },
        }

        axios.post(URL, data, config).then(res => {
          item = null
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
            title: 'Matery Added Successfully',
          })
          this.list.open = false
          this.getDataClassesStudio()
        })
      },
      inputPicture ({ item }) {
        axios.defaults.headers.common.Authorization =
          'Bearer ' + localStorage.getItem('access_token')
        axios.defaults.baseURL = process.env.VUE_APP_API_URL

        const URL = 'owner/classes/thumbnail'
        const data = new FormData()
        data.append('img', item.files)
        data.append('class_id', item.id)
        const config = {
          header: {
            'Content-Type': 'image/png',
          },
        }
        axios.post(URL, data, config).then(res => {
          if (res.data.meta.status) {
            item = null
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
              title: 'Profile Editted Successfully',
            })
            this.info.open = false
            this.getDataClassesStudio()
          }
        })
      },
      changePicture ({ item }) {
        axios.defaults.headers.common.Authorization =
          'Bearer ' + localStorage.getItem('access_token')
        axios.defaults.baseURL = process.env.VUE_APP_API_URL

        const URL = 'owner/classes/change-thumbnail'
        const data = new FormData()
        data.append('img', item.files)
        data.append('class_id', item.id)
        const config = {
          header: {
            'Content-Type': 'image/png',
          },
        }

        axios.post(URL, data, config).then(res => {
          if (res.data.meta.status) {
            item = null
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
              title: 'Profile Editted Successfully',
            })
            this.info.open = false
            this.getDataClassesStudio()
          }
        })
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
            durasi: item.duration,
            meets: item.url,
            keyword: item.keyword,
            harga: item.price,
            kapasitas: item.capacity,
            category_id: item.category_id,
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
      clickCollapse () {
        this.isCollapse = !this.isCollapse
      },
    },
  }
</script>

<style></style>
