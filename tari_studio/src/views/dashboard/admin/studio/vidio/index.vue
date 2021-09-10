<template>
  <v-container>
    <!-- Dekstop -->
    <v-row class="d-none d-sm-flex">
      <v-col
        cols="12"
        md="4"
      >
        <base-material-stats-card
          color="info"
          icon="mdi-twitter"
          title="All"
          :value="String(summary.all)"
          sub-icon="mdi-clock"
          sub-text="Just Updated"
          style="cursor:pointer"
          @click.native="setStatus('all')"
        />
      </v-col>
      <v-col
        cols="12"
        md="4"
      >
        <base-material-stats-card
          color="info"
          icon="mdi-twitter"
          title="Publish"
          :value="String(summary.publish)"
          sub-icon="mdi-clock"
          sub-text="Just Updated"
          style="cursor:pointer"
          @click.native="setStatus('publish')"
        />
      </v-col>
      <v-col
        cols="12"
        md="4"
      >
        <base-material-stats-card
          color="info"
          icon="mdi-twitter"
          title="New"
          :value="String(summary.new)"
          sub-icon="mdi-clock"
          sub-text="Just Updated"
          style="cursor:pointer"
          @click.native="setStatus('new')"
        />
      </v-col>
    </v-row>
    <!-- End Deskstop -->
    <!-- mobile -->
    <v-row
      align="center"
      justify="center"
      class="d-flex d-sm-none"
    >
      <v-col
        cols="12"
        style="padding: 0"
      >
        <v-tabs
          v-model="tab"
          show-arrows
        >
          <v-tab
            v-for="item in items"
            :key="item.tab"
            class="mx-auto"
          >
            <v-badge
              color="green"
              :content="item.summary ? item.summary : '0'"
            >
              {{ item.title }}
            </v-badge>
          </v-tab>
        </v-tabs>
        <v-tabs-items v-model="tab">
          <v-tab-item
            v-for="item in items"
            :key="item.tab"
          >
            <v-card flat>
              <v-card-text>
                <v-col
                  cols="12"
                  sm="6"
                  lg="3"
                >
                  <base-material-stats-card
                    color="info"
                    :icon="item.icon"
                    :title="item.title"
                    :value="String(item.summary)"
                    style="cursor: pointer;"
                    @click.native="setStatus(item.status)"
                  />
                </v-col>
                {{ item.content }}
              </v-card-text>
            </v-card>
          </v-tab-item>
        </v-tabs-items>
      </v-col>
    </v-row>
    <!-- Endmobile -->
    <v-row>
      <v-col>
        <app-data-table
          :data="vidio"
          @create="upDialog"
          @approve="upDialogPublish"
          @deleted="upDialogDeleted"
        />
      </v-col>
    </v-row>
    <app-data-form
      :dialog="add"
      @input="insertDataVidio"
    />
    <app-dialog-notice
      :dialog="goPublish"
      icon="mdi-check-decagram"
      title="Approve"
      text-button1="Approve"
      text="card_notice.approved"
      @input="publishVidio"
    />
    <app-dialog-notice
      :dialog="deleted"
      title="Delete"
      text="card_notice.text"
      text-button1="Delete"
      icon="mdi-delete "
      color-button1="red"
      color-button2="primary"
      @input="deletesDataVidio"
    />
  </v-container>
</template>

<script>
  import dataTable from './components_core/_dataTable.vue'
  import dialogForm from './components/__dialogForm.vue'
  import dialogNotice from './components/__dialogNotice.vue'
  export default {
    components: {
      'app-data-form': dialogForm,
      'app-data-table': dataTable,
      'app-dialog-notice': dialogNotice,
    },
    data: () => ({
      tab: null,
      summary: {
        all: 0,
        publish: 0,
        new: 0,
      },
      items: [
        {
          tab: 'all',
          title: 'All',
          icon: 'mdi-send',
          summary: '0',
          status: 'all',
        },
        {
          tab: 'publish',
          title: 'Publish',
          icon: 'mdi-send-check',
          summary: '0',
          status: 'publish',
        },
        {
          tab: 'new',
          title: 'New',
          icon: 'mdi-send-lock',
          summary: '0',
          status: 'new',
        },
      ],
      add: {
        open: false,
      },
      goPublish: {
        open: false,
        id: 0,
        data: [],
      },
      deleted: {
        open: false,
        id: 0,
        data: [],
      },
      status: '',
    }),
    computed: {
      vidio () {
        return this.$store.state.studioOwnerVidio.data
      },
      computedSummary: {
        get () {
          return this.$store.state.studioOwnerVidio.summary
        },
        set (val) {
          return val
        },
      },
    },
    watch: {
      status (newVal) {
        this.$router.push({ query: { ...this.$route.query, summary: newVal } })
      },
      '$route.query.status': function (val) {
        this.$status = val
        this.studioOwnerVidio()
      },
    },
    mounted () {
      this.studioOwnerVidio()
      this.getDataSummary()
    },
    methods: {
      studioOwnerVidio () {
        this.$store.dispatch('studioOwnerVidio/getDataVidio', {
          entities: 'author, studio',
          summary: this.status,
        })
      },
      getDataSummary () {
        this.$store.dispatch('studioOwnerVidio/getDataSummary', {}).then(res => {
          this.summary = res.data.data
          this.setSummary(res.data.data)
          console.log(this.summary)
        })
      },
      setSummary (data) {
        this.summary = data
        this.items.forEach(item => {
          if (item.status === 'all') {
            item.summary = this.summary.all
          } else if (item.status === 'publish') {
            item.summary = this.summary.publish
          } else if (item.status === 'new') {
            item.summary = this.summary.new
          } else {
            item.summary = 0
          }
        })
      },
      setStatus (val) {
        this.status = val
        this.studioOwnerVidio()
      },
      upDialog () {
        this.add.open = true
      },
      upDialogPublish ({ item }) {
        this.goPublish.open = true
        this.goPublish.id = item.id
        this.goPublish.data = item
      },
      upDialogDeleted ({ item }) {
        this.deleted.open = true
        this.deleted.id = item.id
        this.deleted.data = item
      },
      insertDataVidio ({ item }) {
        console.log(item)
        this.$store
          .dispatch('studioOwnerVidio/insertDataVidio', {
            status: item.status,
            url: item.url,
          })
          .then(res => {
            if (res.data.meta.status) {
              item.status = null
              item.url = null
              this.add.open = false
              const Toast = this.$swal.mixin({
                toast: true,
                position: 'top-end',
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
                title: 'Data Added Successfully',
              })
            }
          })
      },
      publishVidio ({ item }) {
        this.$store.dispatch('studioOwnerVidio/publishVidio', item).then(res => {
          if (res.data.meta.status) {
            this.goPublish.open = false
            const Toast = this.$swal.mixin({
              toast: true,
              position: 'top-end',
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
              title: 'Data Approved Successfully',
            })
          }
        })
      },
      deletesDataVidio ({ item }) {
        this.$store
          .dispatch('studioOwnerVidio/deletesDataVidio', item)
          .then(res => {
            if (res.data.meta.status) {
              this.goPublish.open = false
              const Toast = this.$swal.mixin({
                toast: true,
                position: 'top-end',
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
                title: 'Data Deleted Successfully',
              })
            }
          })
      },
    },
  }
</script>

<style></style>
