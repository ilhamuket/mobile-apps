<template>
  <base-material-card icon="mdi-shopping-music">
    <template #after-heading>
      <span
        :class="
          $vuetify.theme.dark
            ? 'btn_primary--text font-spartan'
            : 'btn_primary--text font-spartan'
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
                  mdi-refresh
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
        >
          <v-text-field append-icon="mdi-magnify" />
        </v-col>
        <v-col
          v-resize="onResize"
          cols="12"
          md="8"
          class="d-flex flex-row-reverse"
        >
          <div
            v-if="isMobile"
            class="text-center ml-2"
          >
            <v-menu offset-y>
              <template v-slot:activator="{ on, attrs }">
                <v-btn
                  color="btn_primary"
                  dark
                  v-bind="attrs"
                  outlined
                  width="439"
                  v-on="on"
                >
                  <v-icon>mdi-chevron-down</v-icon>
                </v-btn>
              </template>
              <v-list>
                <v-list-item-group>
                  <v-list-item @click="approve(selected)">
                    <v-list-item-action>
                      <v-btn
                        :disabled="selected.length === 0"
                        width="400"
                        outlined
                        color="btn_primary"
                      >
                        Approve {{ selected.length }} Item
                      </v-btn>
                    </v-list-item-action>
                  </v-list-item>
                  <v-list-item @click="approve(selected)">
                    <v-list-item-action>
                      <v-btn
                        :disabled="selected.length === 0"
                        width="400"
                        outlined
                        color="btn_primary"
                      >
                        Approve {{ selected.length }} Item
                      </v-btn>
                    </v-list-item-action>
                  </v-list-item>
                </v-list-item-group>
              </v-list>
            </v-menu>
          </div>
          <div
            v-if="!isMobile"
            class="ml-2"
          >
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
            v-if="!isMobile"
            outlined
            color="btn_primary"
            class="ml-2"
            @click="addVidio"
          >
            <v-icon> mdi-plus </v-icon>
            Add Vidio Profile
          </v-btn>

          <v-btn
            v-if="!isMobile"
            :disabled="selected.length === 0"
            class="ml-2"
            outlined
            color="blue"
            @click="approve(selected)"
          >
            <v-icon> mdi-check-decagram </v-icon>
            Approve {{ selected.length }} item
          </v-btn>
          <v-btn
            v-if="!isMobile"
            :disabled="selected.length === 0"
            outlined
            color="red"
            @click="deletedVidio(selected)"
          >
            <v-icon> mdi-delete-empty-outline </v-icon>
            Delete {{ selected.length }} item
          </v-btn>
        </v-col>
        <v-col cols="12">
          <v-data-table
            v-model="selected"
            show-select
            :headers="headers"
            :items="data"
            mobile-breakpoint="0"
          >
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
            <template #[`header.comment`]="{ header }">
              {{ $t(header.text) }}
            </template>
            <template #[`header.status`]="{ header }">
              {{ $t(header.text) }}
            </template>
            <template #[`header.author.nickName`]="{ header }">
              {{ $t(header.text) }}
            </template>
            <!-- Itmes -->
            <template #[`item.id`]="{ item }">
              <v-img
                :src="item.url_thumbnail_youtube"
                width="100"
              />
            </template>
            <template #[`item.name`]="{ item }">
              <div class="d-flex flex-row">
                <div class="d-flex flex-column ml-2">
                  <span>{{ item.name }}</span>
                  <div class="bg-hover">
                    <div class="d-flex flex-row flex-nowrap">
                      <div>
                        <div class="d-flex flex-column flex-nowrap mt-2">
                          <a class="font-a d-flex flex-nowrap">
                            <v-tooltip
                              color="primary"
                              bottom
                              close-delay
                            >
                              <template #activator="{ on, attrs }">
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
                              <span class="font-spartan-small blue--text">
                                Edit
                              </span>
                            </v-tooltip>
                          </a>
                        </div>
                      </div>
                      <div>
                        <div class="d-flex flex-column mt-2 ml-2">
                          <a
                            class="font-a-delete d-flex flex-nowrap"
                            @click="deleteById(item)"
                          >
                            <v-tooltip
                              color="primary"
                              bottom
                              close-delay
                            >
                              <template #activator="{ on, attrs }">
                                <v-icon
                                  v-bind="attrs"
                                  color="red"
                                  small
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
                        <div class="d-flex flex-column mt-2 ml-2">
                          <a
                            class="font-a-delete d-flex flex-nowrap"
                            @click="deleteById(item)"
                          >
                            <v-tooltip
                              color="primary"
                              bottom
                              close-delay
                            >
                              <template #activator="{ on, attrs }">
                                <v-icon
                                  v-bind="attrs"
                                  color="red"
                                  small
                                  v-on="on"
                                >
                                  mdi-delete-variant
                                </v-icon>
                              </template>
                              <span
                                class="font-spartan-small red--text"
                              >Hide</span>
                            </v-tooltip>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- <v-list-item-avatar> -->

              <!-- </v-list-item-avatar> -->
            </template>
            <template #[`item.status`]="{ item }">
              <v-chip
                label
                :color="setColourStatus(item.status)"
                class="text-capitalize"
              >
                {{ item.status }}
              </v-chip>
            </template>
            <template #[`item.comment`]="{ item }">
              {{ item.comment ? item.comment.length : 0 }}
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
      selected: [],
      status: "",
      headers: [
        { text: "#", value: "id", sortable: false },
        { text: "table.vidio.th.title", value: "name", sortable: false },
        {
          text: "table.vidio.th.status",
          value: "status",
          sortable: false,
          align: "left",
        },
        {
          text: "table.vidio.th.comments",
          value: "comment",
          sortable: false,
        },
      ],
    }),
    computed: {
      computedTitle () {
        let name = "Video - All"
        if (this.$route.query.summary === "publish")
          return (name = "Video - Publish")
        if (this.$route.query.summary === "new") return (name = "Video - New")
        return name
      },
    },
    methods: {
      onResize () {
        if (window.innerWidth < 769) this.isMobile = true
        else this.isMobile = false
      },
      approve (item) {
        this.$emit("approve", { item: item })
      },
      setColourStatus (status) {
        if (status === "publish") return "primary"
        if (status === "previews") return "secondary"
        else return "red"
      },
      setStatus (val) {
        this.status = val
      },
      addVidio () {
        this.$emit("create")
      },
      deletedVidio (item) {
        this.$emit("deleted", { item: item })
      },
      deleteById (item) {
        this.$emit("deleteById", { item: item })
      },
      refresh () {
        this.$emit("refresh")
        const Toast = this.$swal.mixin({
          toast: true,
          position: "top-right",
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
          title: "Fecth Data",
        })
      },
    },
  }
</script>

<style lang="sass" scoped>
.bg-hover
    &:hover
        opacity: 1 !important
</style>
