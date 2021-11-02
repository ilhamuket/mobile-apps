<template>
  <base-material-card
    icon="mdi-alpha-t-box"
    color="primary"
  >
    <template #after-heading>
      <span
        :class="
          $vuetify.theme.dark
            ? 'text-h3 btn_primary--text font-spartan'
            : 'text-h3 btn_primary--text font-spartan'
        "
      >
        {{ computedTitle }}
      </span>
    </template>
    <v-container>
      <v-row>
        <v-col cols="12">
          <v-btn
            class="mr-1"
            outlined
            rounded
            small
            dark
            color="primary"
            @click="refreshClick"
          >
            <v-tooltip
              color="primary"
              bottom
            >
              <template #activator="{on, attrs}">
                <v-icon
                  v-bind="attrs"
                  color="size__icon_refresh"
                  v-on="on"
                >
                  mdi-cached
                </v-icon>
              </template>
              <span class="font-spartan-small">
                {{ $t("Segarkan") }}
              </span>
            </v-tooltip>
          </v-btn>
        </v-col>
      </v-row>
      <v-row>
        <v-col cols="4">
          <v-text-field
            v-model="search"
            :label="$t('search')"
            append-icon="mdi-magnify"
          />
        </v-col>
        <v-col
          cols="12"
          md="8"
          class="d-flex flex-row-reverse"
        >
          <div class="text-center ml-2">
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
                    <v-list-item-title>
                      Export
                    </v-list-item-title>
                  </v-list-item>
                </v-list-item-group>
              </v-list>
            </v-menu>
          </div>
          <v-btn
            outlined
            color="btn_primary"
            class="ml-2"
            @click="createTeachers"
          >
            <v-icon>
              mdi-plus
            </v-icon>
            Add instructor
          </v-btn>

          <v-btn
            :disabled="selected.length === 0"
            class="ml-2"
            outlined
            color="blue"
            @click="popUpApprove(selected)"
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
            @click="popDelete(selected)"
          >
            <v-icon>
              mdi-delete-empty-outline
            </v-icon>
            Delete {{ selected.length }} item
          </v-btn>
        </v-col>
        <v-col v-resize="onResize">
          <v-data-table
            v-model="selected"
            :headers="headers"
            :items="data"
            show-select
            :search="search"
            :class="{ mobile: isMobile }"
            mobile-breakpoint="0"
          >
            <!-- Mobile -->

            <!-- Header -->
            <template #[`header.name`]="{ header }">
              {{ $t(header.text) }}
            </template>
            <template #[`header.email`]="{ header }">
              {{ $t(header.text) }}
            </template>
            <template #[`header.region`]="{ header }">
              {{ $t(header.text) }}
            </template>
            <template #[`header.contact`]="{ header }">
              {{ $t(header.text) }}
            </template>
            <template #[`header.end_at`]="{ header }">
              {{ $t(header.text) }}
            </template>
            <template #[`header.classes.name`]="{ header }">
              {{ $t(header.text) }}
            </template>
            <template #[`header.status`]="{ header }">
              {{ $t(header.text) }}
            </template>
            <template #[`header.profession`]="{ header }">
              {{ $t(header.text) }}
            </template>
            <template #[`header.is_verified`]="{ header }">
              {{ $t(header.text) }}
            </template>

            <!-- Item -->
            <template #[`item.#`]="{item}">
              <v-hover
                v-if="item.img"
                v-slot="{ hover }"
              >
                <v-card
                  :elevation="hover ? 12 : 2"
                  :class="{ 'on-hover': hover }"
                >
                  <v-img
                    width="100"
                    height="100"
                    :src="item.img.url"
                    gradient="to top right, rgba(0,0,0,.33), rgba(0,0,0,.7)"
                    style="cursor:pointer"
                    @click="clickImg(item)"
                  />
                  <input
                    ref="fileUpload"
                    type="file"
                    style="display: none"
                    accept="image/*"
                    @change="changePictProfile"
                  >
                </v-card>
              </v-hover>
              <v-hover
                v-else
                v-slot="{ hover }"
              >
                <v-card
                  :elevation="hover ? 12 : 2"
                  :class="{ 'on-hover': hover }"
                >
                  <v-img
                    width="100"
                    src="https://assets.tokopedia.net/assets-tokopedia-lite/v2/zeus/kratos/62cb37c4.png"
                    gradient="to top right, rgba(0,0,0,.33), rgba(0,0,0,.7)"
                    style="cursor:pointer"
                    @click="clickImgPicture(item)"
                  />
                  <input
                    ref="upload"
                    type="file"
                    style="display: none"
                    accept="image/*"
                    @change="uploadPictProfile"
                  >
                </v-card>
              </v-hover>
            </template>
            <template #[`item.name`]="{item}">
              <div class="mt-6">
                <v-tooltip
                  v-if="item.name.length > 9"
                  bottom
                  color="blue"
                >
                  <template #activator="{on, attrs}">
                    <span
                      v-bind="attrs"
                      v-on="on"
                    >
                      {{ item.name.substr(0, 9) + ".." }}
                    </span>
                  </template>
                  <span>{{ item.name }}</span>
                </v-tooltip>
                <span v-else>{{ item.name }}</span>
              </div>
              <div class="bg-hover">
                <div class="d-flex flex-row flex-nowrap">
                  <div>
                    <div class="d-flex flex-column flex-nowrap mt-2">
                      <a
                        class="font-a d-flex flex-nowrap"
                        @click="popEditForm(item)"
                      >
                        <v-tooltip
                          bottom
                          color="primary"
                        >
                          <template #activator="{on,attrs}">
                            <v-icon
                              v-bind="attrs"
                              small
                              color="blue"
                              class="mr-1"
                              v-on="on"
                            >
                              mdi-pencil
                            </v-icon>
                          </template>
                          <span class="font-spartan-small">
                            Edit
                          </span>
                        </v-tooltip>
                      </a>
                    </div>
                  </div>
                  <div>
                    <div class="d-flex flex-column mt-2">
                      <a
                        class="font-a-delete d-flex flex-nowrap"
                        @click="deleteByIdPopUp(item)"
                      >
                        <v-tooltip
                          bottom
                          color="primary"
                        >
                          <template #activator="{on,attrs}">
                            <v-icon
                              color="red"
                              small
                              v-bind="attrs"
                              v-on="on"
                            >
                              mdi-delete
                            </v-icon>
                          </template>
                          <span class="font-spartan-small red--text">
                            Delete
                          </span>
                        </v-tooltip>
                      </a>
                    </div>
                  </div>
                  <div>
                    <div class="d-flex flex-column mt-2">
                      <a
                        class="font-a-delete d-flex flex-nowrap"
                        @click="deactive(item)"
                      >
                        <v-tooltip
                          bottom
                          color="primary"
                        >
                          <template #activator="{on,attrs}">
                            <v-icon
                              color="red"
                              small
                              v-bind="attrs"
                              v-on="on"
                            >
                              mdi-eye-off
                            </v-icon>
                          </template>
                          <span class="font-spartan-small red--text">
                            Deactivate
                          </span>
                        </v-tooltip>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </template>
            <template #[`item.is_verified`]="{item}">
              <v-chip
                :color="setColorVerified(item.is_verified)"
                class="text-capitalize chips--weight"
                text-color="white"
              >
                {{
                  item.is_verified === 1
                    ? $t("table.approved")
                    : $t("table.non_approved")
                }}
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
      isMobile: false,
      headers: [
        {
          text: "#",
          value: "#",
        },
        {
          text: "table.teachers.th.fullName",
          align: "start",
          sortable: false,
          value: "name",
        },
        { text: "table.teachers.th.email", value: "email" },
        { text: "table.teachers.th.region", value: "region", sortable: false },
        { text: "table.teachers.th.contact", value: "contact" },
        { text: "table.teachers.th.profession", value: "profession" },
        { text: "table.teachers.th.approved", value: "is_verified" },
      ],
      search: "",
      selected: [],
      instructor_id: 0,
    }),
    computed: {
      computedTitle () {
        let title = "Index Instructor - All"
        if (this.$route.query.summary === "all") {
          title = "Index Instructor - All"
        }
        if (this.$route.query.summary === "approved") {
          title = "Index Instructor - Approved"
        }
        if (this.$route.query.summary === "non_approved") {
          title = "Index Instructor - Non Approved"
        }
        if (this.$route.query.summary === "new") {
          title = "Index Instructor - New"
        }
        return title
      },
    },
    mounted () {},
    methods: {
      onResize () {
        if (window.innerWidth < 769) this.isMobile = true
        else this.isMobile = false
      },
      createTeachers () {
        this.$emit("create")
      },
      popEditForm (item) {
        this.$emit("edit", { item: item })
      },
      popUpApprove (item) {
        this.$emit("approve", { item: item })
      },
      popDelete (item) {
        this.$emit("deletes", { item: item })
      },
      deleteByIdPopUp (item) {
        this.$emit("deleteById", { item: item })
      },
      setColorVerified (status) {
        if (status === 1) return "btn_primary"
        else return "red"
      },
      refreshClick () {
        this.$emit("refresh")
      },
      clickImg (item) {
        this.$refs.fileUpload.click()
        this.instructor_id = item.id
      },
      clickImgPicture (item) {
        this.$refs.upload.click()
        this.instructor_id = item.id
      },
      uploadPictProfile (event) {
        const files = event.target.files
        const filename = files[0].name
        console.log(filename)
        const fileReader = new FileReader()
        fileReader.addEventListener("load", () => {
          this.imageUrl = fileReader.result
        //   console.log(this.imageUrl)
        })
        fileReader.readAsDataURL(files[0])
        this.files = files[0]

        if (this.files.size > 2000000) {
          console.log("too big")
          const Toast = this.$swal.mixin({
            toast: true,
            position: "bottom-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: toast => {
              toast.addEventListener("mouseenter", this.$swal.stopTimer)
              toast.addEventListener("mouseleave", this.$swal.resumeTimer)
            },
            popup: "swal2-show",
            backdrop: "swal2-backdrop-show",
            icon: "swal2-icon-show",
          })
          Toast.fire({
            icon: "error",
            title: "file too big",
          })
        } else {
          this.$emit("pict", {
            item: {
              files: this.files,
              id: this.instructor_id,
            },
          })
        }
      },
      changePictProfile (event) {
        const files = event.target.files
        const filename = files[0].name
        console.log(filename)
        const fileReader = new FileReader()
        fileReader.addEventListener("load", () => {
          this.imageUrl = fileReader.result
        //   console.log(this.imageUrl)
        })
        fileReader.readAsDataURL(files[0])
        this.files = files[0]

        if (this.files.size > 2000000) {
          console.log("too big")
          const Toast = this.$swal.mixin({
            toast: true,
            position: "bottom-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: toast => {
              toast.addEventListener("mouseenter", this.$swal.stopTimer)
              toast.addEventListener("mouseleave", this.$swal.resumeTimer)
            },
            popup: "swal2-show",
            backdrop: "swal2-backdrop-show",
            icon: "swal2-icon-show",
          })
          Toast.fire({
            icon: "error",
            title: "file too big",
          })
        } else {
          this.$emit("change", {
            item: {
              files: this.files,
              id: this.instructor_id,
            },
          })
        }
      },
      deactive (item) {
        this.$emit("deactive", { item: item })
      },
    },
  }
</script>

<style lang="sass" scoped>
.v-input--selection-controls__input
    .mdi
        width: 100%
        color: #4CAF50 !important
</style>
