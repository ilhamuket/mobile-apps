<template>
  <base-material-card
    color="btn_primary"
    icon="mdi-access-point"
  >
    <template #after-heading>
      <span
        :class="
          $vuetify.theme.dark
            ? 'btn_primary--text font-spartan'
            : 'btn_primary--text font-spartan'
        "
      >
        <!-- {{ computudTitle }} -->
        <!-- {{ $t("index_class_data_table") }} -->
        {{ computudTitle }}
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
            @click="refresh"
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
        <v-col
          cols="12"
          md="4"
          class="mt-2"
        >
          <v-text-field
            v-model="search"
            append-icon="mdi-magnify"
            color="primary"
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
            v-if="studio.bank"
            :disabled="studio.bank.length === 0"
            color="btn_primary"
            class="ml-2"
            @click="upDialog"
          >
            <v-icon> mdi-plus </v-icon>
            Add Class
          </v-btn>

          <v-btn
            :disabled="selected.length === 0"
            class="ml-2"
            outlined
            color="blue"
            @click="upDialogApproves(selected)"
          >
            <v-icon> mdi-check-decagram </v-icon>
            Approve {{ selected.length }} item
          </v-btn>
          <v-btn
            :disabled="selected.length === 0"
            outlined
            color="red"
            @click="upDialogDeletes(selected)"
          >
            <v-icon> mdi-delete-empty-outline </v-icon>
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
            show-expand
          >
            <!-- Expand -->
            <template #expanded-item="{ headers, item }">
              <td :colspan="headers.length">
                <v-container>
                  <v-row class="d-flex justify-around">
                    <v-col
                      cols="12"
                      class="d-flex flex-row-reverse"
                    >
                      <v-icon color="blue">
                        mdi-share-variant
                      </v-icon>
                    </v-col>
                    <v-col
                      cols="12"
                      lg="6"
                      md="6"
                      xl="6"
                    >
                      <base-material-stats-card
                        v-if="item.student"
                        color="info"
                        icon="mdi-account-multiple-plus-outline"
                        title="Registrant"
                        :value="String(item.student.length)"
                        sub-icon="mdi-heart-outline"
                        sub-text="EnsikloTari"
                      />
                    </v-col>
                    <v-col
                      cols="12"
                      md="6"
                      lg="6"
                      xl="6"
                    >
                      <base-material-stats-card
                        color="info"
                        icon="mdi-twitter"
                        title="Visitor"
                        :value="String(item.views)"
                        sub-icon="mdi-heart-outline"
                        sub-text="EnsikloTari"
                      />
                    </v-col>
                    <v-col cols="12">
                      <div class="detail-class__title">
                        <span class="font-spartan btn_primary--text">
                          Detail Class Live
                        </span>
                      </div>
                      <div class="detail-class__body">
                        <div class="pl-2 pt-2">
                          <span>Name Class : {{ item.name }}</span>
                        </div>
                        <div
                          v-if="item.category"
                          class="pl-2 pt-2"
                        >
                          <span>Category : {{ item.category.display_name }}</span>
                        </div>
                        <div class="pl-2 pt-2 secondary--text">
                          <span> Duration : {{ item.durasi }} Minutes </span>
                        </div>
                        <div class="pl-2 pt-2">
                          <span class="btn_primary--text">
                            Registration :
                            {{ item.start_at | moment("MMMM Do") }} -
                            {{ item.end_at | moment("MMMM Do YYYY") }}</span>
                          -
                          <v-chip
                            :color="setStatusClass(item.status_kelas)"
                            text-color="white"
                          >
                            {{ item.status_kelas }}
                          </v-chip>
                        </div>
                        <div class="pl-2 pt-2 btn_primary--text">
                          <span> Price : Rp{{ item.harga }} </span>
                        </div>
                        <div class="pl-2 pt-2 pb-2">
                          Link Meet:
                          <a
                            :href="item.url_meets"
                            target="__blank"
                          >{{
                            item.url_meets ? item.url_meets : "-"
                          }}</a>
                        </div>
                        <div class="pl-2">
                          <span>
                            #About
                            <br>
                            {{ item.about }}
                          </span>
                        </div>
                      </div>
                    </v-col>
                  </v-row>
                </v-container>
              </td>
            </template>
            <!-- Header -->
            <template #[`header.name`]="{ header }">
              {{ $t(header.text) }}
            </template>
            <template #[`header.levels`]="{ header }">
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
            <template #[`header.status_kelas`]="{ header }">
              {{ $t(header.text) }}
            </template>

            <!-- Item -->
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
                    :src="item.img.url"
                    width="140"
                    height="100"
                    gradient="to top right, rgba(0,0,0,.33), rgba(0,0,0,.7)"
                    style="cursor: pointer"
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
                  <v-img
                    v-else
                    src="https://assets.tokopedia.net/assets-tokopedia-lite/v2/zeus/kratos/62cb37c4.png"
                    width="100%"
                    height="100"
                    gradient="to top right, rgba(0, 0, 0, 0.05), rgba(20, 20, 20, 0.05)"
                    style="
                      background-color: rgba(0, 0, 0, 0.05);
                      cursor: pointer;
                    "
                    @click="uploadPict(item)"
                  />
                  <input
                    ref="fileUpload"
                    type="file"
                    style="display: none"
                    accept="image/*"
                    @change="changePictProfile"
                  >
                  <input
                    ref="upload"
                    type="file"
                    style="display: none"
                    accept="image/*"
                    @change="uploadPicture"
                  >
                </v-card>
              </v-hover>
            </template>
            <template #[`item.name`]="{ item }">
              <div class="ensiklo--live__name">
                <span
                  class="font-spartan-small cursor-pointer"
                  @click="
                    navigate(
                      `/class/${item.slug}/keyword/${item.keyword}/student`
                    )
                  "
                >
                  {{ item.name }}
                </span>
              </div>
              <!--  -->
              <div class="bg-hover">
                <div class="d-flex flex-row flex-nowrap">
                  <div>
                    <div class="d-flex flex-column flex-nowrap mt-2">
                      <a
                        class="font-a d-flex flex-nowrap"
                        @click="upDialogeditClass(item)"
                      >
                        <v-tooltip
                          bottom
                          color="blue"
                        >
                          <template #activator="{ on, attrs }">
                            <v-icon
                              small
                              color="blue"
                              class="mr-1"
                              v-bind="attrs"
                              v-on="on"
                            >
                              mdi-pencil
                            </v-icon>
                          </template>
                          <span class="font-spartan-small"> Edit </span>
                        </v-tooltip>
                      </a>
                    </div>
                  </div>
                  <div>
                    <!-- <div class="d-flex flex-column mt-2 ml-1">
                      <a
                        class="d-flex blue--text flex-nowrap"
                        @click="upInfoClass(item)"
                      >
                        <v-tooltip
                          color="blue"
                          bottom
                        >
                          <template #activator="{ on, attrs }">
                            <v-icon
                              v-bind="attrs"
                              color="blue"
                              small
                              v-on="on"
                            >
                              mdi-eye
                            </v-icon>
                          </template>
                          <span class="font-spartan-small"> Info </span>
                        </v-tooltip>
                      </a>
                    </div> -->
                  </div>
                  <div>
                    <div class="d-flex flex-column mt-2 ml-1">
                      <a
                        class="font-a-delete d-flex flex-nowrap"
                        @click="uploadMatery(item)"
                      >
                        <v-tooltip
                          color="btn_primary"
                          bottom
                        >
                          <template #activator="{ on, attrs }">
                            <v-icon
                              v-bind="attrs"
                              color="btn_primary"
                              small
                              v-on="on"
                            >
                              mdi-camera
                            </v-icon>
                          </template>
                          <span class="font-spartan-small"> Upload </span>
                        </v-tooltip>
                      </a>
                    </div>
                  </div>
                  <div>
                    <div class="d-flex flex-column mt-2 ml-1">
                      <a
                        class="font-a-delete d-flex flex-nowrap"
                        @click="hideDataClassesStudio(item)"
                      >
                        <v-tooltip
                          color="red"
                          bottom
                        >
                          <template #activator="{ on, attrs }">
                            <v-icon
                              v-bind="attrs"
                              color="red"
                              small
                              v-on="on"
                            >
                              mdi-eye-off
                            </v-icon>
                          </template>
                          <span class="font-spartan-small white--text">
                            Hided
                          </span>
                        </v-tooltip>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </template>
            <template #[`item.levels`]="{ item }">
              <v-chip
                label
                text-color="white"
                :color="setColorLevels(item.levels)"
                class="text-capitalize chips--weight"
              >
                {{ item.levels }}
              </v-chip>
            </template>
            <template #[`item.status`]="{ item }">
              <v-chip
                :color="setColorStatus(item.status)"
                label
                text-color="white"
                class="chips--weight"
              >
                {{ $t(item.status) }}
              </v-chip>
            </template>
            <template #[`item.kapasitas`]="{ item }">
              <v-chip
                label
                color="btn_primary"
                text-color="white"
              >
                {{ item.student ? item.student.length : "0" }} /
                {{ item.kapasitas }}
              </v-chip>
            </template>
            <template #[`item.status_kelas`]="{ item }">
              <v-chip
                label
                :color="setStatusClass(item.status_kelas)"
                text-color="white"
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
      studio: {
        type: Object,
        default: null,
      },
    },
    data: () => ({
      headers: [
        {
          text: "#",
          value: "img.url",
          sortable: false,
        },
        {
          text: "table.class.th.name",
          align: "start",
          sortable: false,
          value: "name",
        },
        { text: "table.class.th.levels", value: "levels", sortable: false },
        {
          text: "table.class.th.category",
          value: "category.display_name",
          sortable: false,
        },

        { text: "table.class.th.capacity", value: "kapasitas", sortable: false },
        { text: "table.class.th.status", value: "status", sortable: false },
        {
          text: "table.class.th.status_time",
          value: "status_kelas",
          sortable: false,
        },
      ],
      transparent: "rgba(255, 255, 255, 0)",
      selected: [],
      search: "",
      dialogAdd: {},
      dataItem: {},
      imageUrl: null,
      files: null,
    }),
    computed: {
      computudTitle () {
        let name = "EnsikloLive - All"
        if (this.$route.query.summary === "all") {
          name = "EnsikloLive - All"
        }
        if (this.$route.query.summary === "approved") {
          name = "EnsikloLive - Approved"
        }
        if (this.$route.query.summary === "non-approved") {
          name = "EnsikloLive - Non Approved"
        }
        if (this.$route.query.summary === "new") {
          name = "EnsikloLive - New"
        }
        return name
      },
    },
    watch: {
      search (value) {
        this.$router.push({ query: { ...this.$route.query, search: value } })
      },
      "$route.query.search": function (value) {
        this.search = value
      },
    },
    mounted () {
    // console.log(this.studio)
    },
    methods: {
      setColorLevels (levels) {
        if (levels === "beginner" || levels === "beginner") return "third"
        if (levels === "advance") return "secondary"
        if (levels === "intermediate" || levels === "Intermediate")
          return "btn_primary"
      },
      setColorStatus (status) {
        if (status === "publish") return "btn_primary"
        if (status === "draft") return "blue"
        else return "red"
      },
      setStatusClass (status) {
        if (status === "ongoing") return "btn_primary"
        if (status === "upcoming") return "secondary"
        else return "red"
      },
      upDialog () {
        this.$emit("add", { item: this.dialogAdd })
      },
      upDialogDeletes (item) {
        this.$emit("deletes", { item: item })
        this.selected = []
      },
      upDialogApproves (item) {
        this.$emit("approves", { item: item })
        this.selected = []
      },
      upDialogeditClass (item) {
        this.$emit("update", { item: item })
      },
      upDeleteClass (item) {
        this.$emit("del", { item: item })
      },
      upInfoClass (item) {
        this.$emit("info", { item: item })
      },
      uploadMatery (item) {
        this.$emit("upload", { item: item })
      },
      hideDataClassesStudio (item) {
        this.$emit("hide", { item: item })
      },
      refresh () {
        this.$emit("refresh")
      },
      changePict (item) {
        this.$refs.fileUpload.click()
        this.dataItem = item
      },
      navigate (link) {
        this.$router.push(link)
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
              id: this.dataItem.id,
            },
          })
        }
      },
      uploadPict (item) {
        this.$refs.upload.click()
        this.dataItem = item
      },
      uploadPicture (event) {
        const files = event.target.files
        const fileName = files[0].name
        console.log(fileName)
        const fileReader = new FileReader()
        fileReader.addEventListener("load", () => {
          this.imageUrl = fileReader.result
        })
        fileReader.readAsDataURL(files[0])
        this.files = files[0]
        if (files[0].size > 2000000) {
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
          this.$emit("uploadPict", {
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
$btn_primary: #4CAF50
.font-a-delete
  color: #4CAF50 !important
.show-btns
  color: rgba(255, 255, 255, 1) !important
.col__img__class
  margin-top: 19px
  margin-left: 40px
.detail-class
  &__title
    border-bottom: 1px solid
    border-color: linear-gradient(to left, #00C853, #B2FF59)
    margin: 5px 0
.ensiklo--live
  &__name > .cursor-pointer
    cursor: pointer
    transition: .9s
    &:hover
     color: $btn_primary
</style>
