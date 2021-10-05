<template>
  <base-material-card icon="mdi-clipboard-outline">
    <template #after-heading>
      <span
        :class="
          $vuetify.theme.dark
            ? 'text-h3 white--text font-customize font-size-ather-roboto-mono-name-page'
            : 'text-h3 pallet1--text font-customize font-size-ather-roboto-mono-name-page'
        "
      >
        <!-- {{ computudTitle }} -->
        {{ $t('index_class_data_table') }}
      </span>
    </template>
    <v-container>
      <v-row>
        <v-col
          cols="12"
          md="4"
          class="mt-2"
        >
          <v-text-field
            v-model="search"
            append-icon="mdi-magnify"
            color="pallet1"
            dense
          />
        </v-col>

        <v-col
          cols="12"
          md="8"
          class="d-flex flex-row-reverse"
        >
          <div class="ml-2">
            <v-menu offset-y>
              <template v-slot:activator="{ on, attrs }">
                <v-btn
                  color="btn_primary"
                  dark
                  v-bind="attrs"
                  outlined
                  v-on="on"
                >
                  <v-icon>mdi-chevron-down</v-icon>
                </v-btn>
              </template>
              <v-list>
                <v-list-item-group>
                  <v-list-item>
                    <v-list-item-action>
                      <v-btn
                        width="400"
                        outlined
                        color="btn_primary"
                      >
                        Export
                      </v-btn>
                    </v-list-item-action>
                  </v-list-item>
                </v-list-item-group>
              </v-list>
            </v-menu>
          </div>
          <v-btn
            outlined
            color="btn_primary"
            class="ml-2"
            @click="upDialog"
          >
            <v-icon>
              mdi-plus
            </v-icon>
            Add Class
          </v-btn>

          <v-btn
            :disabled="selected.length === 0"
            class="ml-2"
            outlined
            color="blue"
            @click="upDialogApproves(selected)"
          >
            <v-icon>
              mdi-check-decagram
            </v-icon>
            Approve {{ selected.length }} item
          </v-btn>
          <v-btn
            :disabled="selected.length === 0"
            outlined
            color="red"
            @click="upDialogDeletes(selected)"
          >
            <v-icon>
              mdi-delete-empty-outline
            </v-icon>
            Delete {{ selected.length }} item
          </v-btn>
        </v-col>
        <v-col cols="12">
          <v-data-table
            v-model="selected"
            show-select
            :search="search"
            :headers="headers"
            :items="data"
            mobile-breakpoint="0"
          >
            <!-- Header -->
            <template #[`header.name`]="{ header }">
              {{ $t(header.text) }}
            </template>
            <template #[`header.levels`]="{ header }">
              {{ $t(header.text) }}
            </template>
            <template #[`header.harga`]="{ header }">
              {{ $t(header.text) }}
            </template>
            <template #[`header.created_at`]="{ header }">
              {{ $t(header.text) }}
            </template>
            <template #[`header.kapasitas`]="{ header }">
              {{ $t(header.text) }}
            </template>
            <template #[`header.status`]="{ header }">
              {{ $t(header.text) }}
            </template>
            <template #[`header.category.display_name`]="{ header }">
              {{ $t(header.text) }}
            </template>
            <template #[`header.durasi`]="{ header }">
              {{ $t(header.text) }}
            </template>
            <template #[`header.keyword`]="{ header }">
              {{ $t(header.text) }}
            </template>
            <template #[`header.status_kelas`]="{header}">
              {{ $t(header.text) }}
            </template>

            <!-- Item -->
            <template #[`item.img.url`]="{item}">
              <v-hover v-slot="{ hover }">
                <v-card
                  :elevation="hover ? 12 : 2"
                  :class="{ 'on-hover': hover }"
                  width="150"
                  color="grey"
                >
                  <v-img
                    v-if="item.img"
                    :src="item.img.url"
                    width="140"
                    height="100"
                    gradient="to top right, rgba(0,0,0,.33), rgba(0,0,0,.7)"
                    style="cursor:pointer"
                    @click="changePict(item)"
                  >
                    <v-container>
                      <v-row>
                        <v-col
                          cols="12"
                          class="col__img__class"
                        >
                          <v-btn
                            icon
                            dark
                            :class="{ 'show-btns': hover }"
                            :color="transparent"
                          >
                            <v-icon
                              :class="{ 'show-btns': hover }"
                              :color="transparent"
                            >
                              mdi-camera-flip-outline
                            </v-icon>
                          </v-btn>
                        </v-col>
                      </v-row>
                    </v-container>
                  </v-img>
                  <input
                    ref="fileUpload"
                    type="file"
                    style="display: none"
                    accept="image/*"
                    @change="changePictProfile"
                  >
                </v-card>
              </v-hover>
            </template>
            <template #[`item.name`]="{item}">
              <div class="mt-6">
                {{ item.name }}
              </div>
              <div class="bg-hover">
                <div class="d-flex flex-row flex-nowrap">
                  <div>
                    <div class="d-flex flex-column flex-nowrap mt-2">
                      <a
                        class="font-a d-flex flex-nowrap"
                        @click="upDialogeditClass(item)"
                      >
                        <v-icon
                          small
                          color="blue"
                          class="mr-1"
                        >
                          mdi-pencil
                        </v-icon>
                        Edit
                      </a>
                    </div>
                  </div>
                  <div>
                    <div class="d-flex flex-column mt-2 ml-1 mr-1">
                      <a
                        class="d-flex blue--text flex-nowrap"
                        @click="upInfoClass(item)"
                      >
                        <v-icon
                          color="blue"
                          small
                        >
                          mdi-eye
                        </v-icon>
                        Info
                      </a>
                    </div>
                  </div>
                  <div>
                    <div class="d-flex flex-column mt-2">
                      <a
                        class="font-a-delete d-flex flex-nowrap"
                        @click="uploadMatery(item)"
                      >
                        <v-icon
                          color="btn_primary"
                          small
                        >
                          mdi-camera
                        </v-icon>
                        Upload
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </template>
            <template #[`item.levels`]="{item}">
              <v-chip
                label
                text-color="white"
                :color="setColorLevels(item.levels)"
                class="text-capitalize chips--weight"
              >
                {{ item.levels }}
              </v-chip>
            </template>
            <template #[`item.keyword`]="{item}">
              <span>{{ item.keyword ? item.keyword : '-' }}</span>
            </template>
            <template #[`item.status`]="{item}">
              <v-chip
                :color="setColorStatus(item.status)"
                label
                text-color="white"
                class="chips--weight"
              >
                {{ item.status }}
              </v-chip>
            </template>
            <template #[`item.kapasitas`]="{item}">
              <v-chip
                label
                color="primary"
              >
                0 / {{ item.kapasitas }}
              </v-chip>
            </template>
            <template #[`item.created_at`]="{item}">
              {{ item.created_at | moment('MMMM Do YYYY') }}
            </template>
            <template #[`item.status_kelas`]="{item}">
              <v-chip
                label
                :color="setStatusClass(item.status_kelas)"
              >
                {{ item.status_kelas }}
              </v-chip>
            </template>
          </v-data-table>
        </v-col>
      </v-row>
    </v-container>
  </base-material-card>
</template>

<script>
  export default {
    props: {
      data: {
        type: Array,
        default: null,
      },
    },
    data: () => ({
      headers: [
        {
          text: '#',
          value: 'img.url',
          sortable: false,
        },
        {
          text: 'table.class.th.name',
          align: 'start',
          sortable: false,
          value: 'name',
        },
        { text: 'table.class.th.levels', value: 'levels', sortable: false },
        // { text: 'table.class.th.price', value: 'harga', sortable: false },
        {
          text: 'table.class.th.category',
          value: 'category.display_name',
          sortable: false,
        },
        // { text: 'table.class.th.created_at', value: 'created_at' },
        // { text: 'table.class.th.prefix', value: 'keyword', sortable: false },
        { text: 'table.class.th.capacity', value: 'kapasitas', sortable: false },
        // { text: 'table.class.th.duration', value: 'durasi', sortable: false },
        { text: 'table.class.th.status', value: 'status', sortable: false },
        {
          text: 'table.class.th.status_time',
          value: 'status_kelas',
          sortable: false,
        },
      ],
      transparent: 'rgba(255, 255, 255, 0)',
      selected: [],
      search: '',
      dialogAdd: {},
      dataItem: {},
      imageUrl: null,
      files: null,
    }),
    computed: {
      computudTitle () {
        let name = 'Class - All'
        if (this.$route.query.summary === 'all') {
          name = 'Class - All'
        }
        if (this.$route.query.summary === 'approved') {
          name = 'Class - Approved'
        }
        if (this.$route.query.summary === 'non-approved') {
          name = 'Class - Non Approved'
        }
        if (this.$route.query.summary === 'new') {
          name = 'Class - New'
        }
        return name
      },
    },
    methods: {
      setColorLevels (levels) {
        if (levels === 'Beginner' || levels === 'beginner') return 'pallet1'
        if (levels === 'Advance') return 'secondary'
        if (levels === 'Intermediate') return 'btn_primary'
      },
      setColorStatus (status) {
        if (status === 'Publish') return 'btn_primary'
        if (status === 'Draft') return 'blue'
        else return 'red'
      },
      setStatusClass (status) {
        if (status === 'ongoing') return 'primary'
        if (status === 'upcoming') return 'btn_primary'
        else return 'red'
      },
      upDialog () {
        this.$emit('add', { item: this.dialogAdd })
      },
      upDialogDeletes (item) {
        this.$emit('deletes', { item: item })
        this.selected = []
      },
      upDialogApproves (item) {
        this.$emit('approves', { item: item })
        this.selected = []
      },
      upDialogeditClass (item) {
        this.$emit('update', { item: item })
      },
      upDeleteClass (item) {
        this.$emit('del', { item: item })
      },
      upInfoClass (item) {
        this.$emit('info', { item: item })
      },
      uploadMatery (item) {
        this.$emit('upload', { item: item })
      },
      changePict (item) {
        this.$refs.fileUpload.click()
        this.dataItem = item
        console.log(item.id)
      },
      changePictProfile (event) {
        const files = event.target.files
        const filename = files[0].name
        console.log(filename)
        const fileReader = new FileReader()
        fileReader.addEventListener('load', () => {
          this.imageUrl = fileReader.result
        //   console.log(this.imageUrl)
        })
        fileReader.readAsDataURL(files[0])
        this.files = files[0]

        if (this.files.size > 2000000) {
          console.log('too big')
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
            icon: 'error',
            title: 'file too big',
          })
        } else {
          this.$emit('change', {
            item: {
              files: this.files,
              id: this.dataItem.id,
            },
          })
        }
      },
    },
  }
</script>

<style lang="sass" scoped>
// .font-customize
//   color:
.font-a-delete
  color: #4CAF50 !important
.show-btns
  color: rgba(255, 255, 255, 1) !important
.col__img__class
  margin-top: 19px
  margin-left: 40px
</style>
