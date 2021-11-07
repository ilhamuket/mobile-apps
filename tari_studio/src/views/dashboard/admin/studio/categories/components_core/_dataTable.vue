<template>
  <base-material-card
    color="btn_primary"
    icon="mdi-playlist-check"
  >
    <template #after-heading>
      <span class="text-h3 btn_primary--text font-spartan">
        {{ cumputedName }}
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
            @click="refreshMethods"
          >
            <v-tooltip
              color="primary"
              bottom
            >
              <template #activator="{ on, attrs }">
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
            append-icon="mdi-magnify"
            :label="$t('search')"
            :placeholder="$t('search')"
          />
        </v-col>
        <v-col
          class="d-flex flex-row-reverse"
          cols="8"
        >
          <v-btn
            color="btn_primary"
            outlined
            @click="popUpCreateCategory"
          >
            Create category
          </v-btn>
          <v-btn
            :disabled="disableApproveBtn"
            class="mr-1"
            color="blue"
            outlined
            @click="approveSelected(selected)"
          >
            Approve {{ selected.length }} category
          </v-btn>
          <v-btn
            :disabled="selected.length === 0"
            class="mr-1"
            color="red"
            outlined
            @click="deleteSelected(selected)"
          >
            Delete {{ selected.length }} category
          </v-btn>
        </v-col>
        <v-col cols="12">
          <v-data-table
            v-model="selected"
            :headers="headers"
            :items="data"
            show-select
            :search="search"
            :items-per-page="5"
          >
            <!-- Header -->
            <template #[`header.name`]="{ header }">
              {{ $t(header.text) }}
            </template>
            <template #[`header.display_name`]="{ header }">
              {{ $t(header.text) }}
            </template>
            <template #[`header.status`]="{ header }">
              {{ $t(header.text) }}
            </template>
            <template #[`header.created_at`]="{ header }">
              {{ $t(header.text) }}
            </template>
            <template #[`header.class`]="{ header }">
              {{ $t(header.text) }}
            </template>
            <template #[`header.follow`]="{ header }">
              {{ $t(header.text) }}
            </template>
            <template #[`header.likes`]="{ header }">
              {{ $t(header.text) }}
            </template>

            <!-- Items -->
            <template #[`item.img.url`]="{ item }">
              <v-hover v-slot="{ hover }">
                <v-card
                  :elevation="hover ? 12 : 2"
                  :class="{ 'on-hover': hover }"
                  width="150"
                  color="grey"
                >
                  <v-img
                    v-if="item.img"
                    width="140"
                    height="100"
                    gradient="to top right, rgba(0,0,0,.33), rgba(0,0,0,.7)"
                    style="cursor: pointer"
                    :src="item.img.url"
                    class="img__hover"
                    @click="changePicture(item)"
                  >
                    <template v-slot:placeholder>
                      <v-row
                        class="fill-height ma-0"
                        align="center"
                        justify="center"
                      >
                        <v-progress-circular
                          indeterminate
                          color="grey lighten-5"
                        />
                      </v-row>
                    </template>
                    <v-container>
                      <v-row>
                        <v-col cols="12">
                          <v-icon
                            large
                            class="mt-5 ml-10 show-btn"
                            color="transparent"
                          >
                            mdi-camera-flip
                          </v-icon>
                        </v-col>
                      </v-row>
                    </v-container>
                  </v-img>
                  <v-img
                    v-else
                    src="https://assets.tokopedia.net/assets-tokopedia-lite/v2/zeus/kratos/62cb37c4.png"
                    width="140"
                    height="100"
                    gradient="to top right, rgba(0, 0, 0, 0.05), rgba(20, 20, 20, 0.05)"
                    style="
                      background-color: rgba(0, 0, 0, 0.05);
                      cursor: pointer;
                    "
                    @click="postPicture(item)"
                  />
                  <input
                    ref="change"
                    type="file"
                    style="display: none"
                    accept="image/*"
                    @change="onChangePicture"
                  >
                  <input
                    ref="input"
                    type="file"
                    style="display: none"
                    accept="image/*"
                    @change="onInputPicture"
                  >
                </v-card>
              </v-hover>
            </template>
            <template #[`item.name`]="{ item }">
              <div class="mt-6">
                {{ item.name }}
              </div>
              <div class="bg-hover">
                <div class="d-flex flex-row flex-nowrap">
                  <div>
                    <div class="d-flex flex-column flex-nowrap mt-2">
                      <a
                        class="font-a d-flex flex-nowrap"
                        @click="upDialogUpdateCategory(item)"
                      >
                        <v-tooltip
                          color="primary"
                          bottom
                        >
                          <template #activator="{ on, attrs }">
                            <v-icon
                              v-bind="attrs"
                              small
                              color="blue"
                              v-on="on"
                            >
                              mdi-pencil
                            </v-icon>
                          </template>
                          <span
                            class="font-spartan-small blue--text"
                          >Edit</span>
                        </v-tooltip>
                      </a>
                    </div>
                  </div>
                  <div>
                    <div class="d-flex flex-column mt-2 ml-1 mr-1">
                      <a
                        class="d-flex blue--text flex-nowrap"
                        @click="upInfoClass(item)"
                      >
                        <v-tooltip
                          bottom
                          color="primary"
                        >
                          <template #activator="{ on, attrs }">
                            <v-icon
                              v-bind="attrs"
                              small
                              class="ml-1"
                              color="blue"
                              v-on="on"
                            >
                              mdi-eye
                            </v-icon>
                          </template>
                          <span class="font-spartan-small blue--text">
                            Info
                          </span>
                        </v-tooltip>
                      </a>
                    </div>
                  </div>
                  <div>
                    <div class="d-flex flex-column mt-2">
                      <a
                        class="font-a-delete d-flex flex-nowrap"
                        @click="deleteById(item)"
                      >
                        <v-tooltip
                          color="primary"
                          bottom
                        >
                          <template #activator="{ on, attrs }">
                            <v-icon
                              v-bind="attrs"
                              small
                              class="ml-1"
                              color="red"
                              v-on="on"
                            >
                              mdi-delete
                            </v-icon>
                          </template>
                          <span
                            class="font-spartan-small red--text"
                          >Delete</span>
                        </v-tooltip>
                      </a>
                    </div>
                  </div>
                  <div>
                    <div class="d-flex flex-column mt-2">
                      <a
                        class="font-a-delete d-flex flex-nowrap"
                        @click="deleteById(item)"
                      >
                        <v-tooltip
                          color="primary"
                          bottom
                        >
                          <template #activator="{ on, attrs }">
                            <v-icon
                              v-bind="attrs"
                              small
                              class="ml-1"
                              color="red"
                              v-on="on"
                            >
                              mdi-eye-off
                            </v-icon>
                          </template>
                          <span class="font-spartan-small red--text">Hide</span>
                        </v-tooltip>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </template>
            <template #[`item.status`]="{ item }">
              <v-chip
                label
                :color="setColorStatus(item.status)"
                class="text-capitalize"
              >
                {{ item.status }}
              </v-chip>
            </template>
            <template #[`item.created_at`]="{ item }">
              {{ item.created_at | moment("MMMM Do YYYY") }}
            </template>
            <template #[`item.class`]="{ item }">
              <span> {{ item.class ? item.class.length : "0" }}</span>
            </template>
            <template #[`item.follow`]="{ item }">
              <span>{{ item.follow ? item.follow.length : "0" }}</span>
            </template>
            <template #[`item.likes`]="{ item }">
              <span> {{ item.likes ? item.likes.length : "0" }}</span>
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
          text: "#",
          value: "img.url",
        },
        {
          text: "table.category.th.name",
          align: "start",
          sortable: false,
          value: "name",
        },
        {
          text: "table.category.th.display_name",
          align: "start",
          sortable: false,
          value: "display_name",
        },
        {
          text: "table.category.th.created_at",
          align: "start",
          sortable: false,
          value: "created_at",
        },
        {
          text: "table.category.th.status",
          align: "start",
          sortable: false,
          value: "status",
        },
        {
          text: "table.category.th.class",
          align: "start",
          sortable: false,
          value: "class",
        },
        {
          text: "table.category.th.follow",
          value: "follow",
        },
        {
          text: "table.category.th.likes",
          value: "likes",
        },
      ],
      selected: [],
      search: "",
      files: null,
      category_id: 0,
    }),
    computed: {
      disableApproveBtn () {
        let bool = true
        const nonPublish = this.selected.some((x) => x.status === "publish")
        if (this.selected.length !== 0 && nonPublish) {
          bool = true
        } else if (this.selected.length !== 0 && !nonPublish) {
          bool = false
        }
        return bool
      },
      cumputedName () {
        let name = "Category - All"
        if (this.$route.query.summary === "publish") {
          name = "Category - Publish"
        } else if (this.$route.query.summary === "concept") {
          name = "Category - Concept"
        } else if (this.$route.query.summary === "draft") {
          name = "Category - Draft"
        }
        return name
      },
    },
    methods: {
      setColorStatus (item) {
        if (item === "publish") return "btn_primary"
        if (item === "draft") return "primary"
        else return "red"
      },
      popUpCreateCategory () {
        this.$emit("create")
      },
      deleteById (item) {
        this.$emit("deleteById", { item: item })
      },
      deleteSelected (item) {
        this.$emit("deleteSelected", { item: item })
        this.selected = []
      },
      approveSelected (item) {
        this.$emit("approveSelected", { item: item })
        this.selected = []
      },
      upDialogUpdateCategory (item) {
        this.$emit("update", { item: item })
      },
      refreshMethods () {
        this.$emit("refresh")
      },
      changePicture (item) {
        this.$refs.change.click()
        this.category_id = item.id
      },
      postPicture (item) {
        this.$refs.input.click()
        this.category_id = item.id
      },
      onChangePicture (event) {
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
            didOpen: (toast) => {
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
              category_id: this.category_id,
            },
          })
        }
      },
      onInputPicture (event) {
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
            didOpen: (toast) => {
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
          this.$emit("input", {
            item: {
              files: this.files,
              category_id: this.category_id,
            },
          })
        }
      },
    },
  }
</script>

<style lang="sass">
.img__hover
  &:hover
    .show-btn
      color: white !important
</style>
