<template>
  <base-material-card icon="mdi-book-plus-multiple-outline">
    <template #after-heading>
      <span
        :class="
          $vuetify.theme.dark
            ? 'info--text font-spartan'
            : 'info--text font-spartan'
        "
      >
        Article
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
        <v-col
          cols="12"
          md="4"
          lg="4"
          xl="4"
        >
          <v-text-field
            v-model="search"
            append-icon="mdi-magnify"
            :label="$t('search')"
          />
        </v-col>
        <v-col
          cols="12"
          md="8"
          lg="8"
          xl="8"
          class="d-flex justify-end"
        >
          <v-btn
            color="red"
            class="mr-2"
            :disabled="selected.length === 0"
            @click="deleteDataArticles(selected)"
          >
            Delete {{ selected.length }} item
          </v-btn>
          <v-btn
            class=""
            color="info"
            :disabled="selected.length === 0"
            @click="approveDataArticle(selected)"
          >
            Publish {{ selected.length }} item
          </v-btn>
          <v-btn
            color="btn_primary"
            class="ml-2"
            to="/create-article"
          >
            Create
          </v-btn>
        </v-col>
        <v-col cols="12">
          <v-data-table
            v-model="selected"
            :headers="headers"
            :items="data"
            show-expand
            :search="search"
            show-select
          >
            <!-- headers -->
            <template #[`header.title`]="{ header }">
              {{ $t(header.text) }}
            </template>
            <template #[`header.views`]="{ header }">
              {{ $t(header.text) }}
            </template>
            <template #[`header.created_at`]="{ header }">
              {{ $t(header.text) }}
            </template>
            <!-- item -->
            <template #[`item.id`]="{ item }">
              <v-hover v-slot="{ hover }">
                <v-card
                  :elevation="hover ? 12 : 2"
                  :class="{ 'on-hover': hover }"
                  width="150"
                  class="justify-center"
                  color="grey"
                >
                  <v-img
                    width="140"
                    height="100"
                    gradient="to top right, rgba(0,0,0,.33), rgba(0,0,0,.7)"
                    style="cursor: pointer"
                    :src="item.thumbnail_url"
                    class="img__hover"
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

                  <!-- <input
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
                  > -->
                </v-card>
              </v-hover>
            </template>
            <template #[`item.title`]="{ item }">
              <div class="mt-6 item--title">
                <span class="font-spartan-small cursor-pointer">{{
                  item.title
                }}</span>
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
                        @click="hideDataById(item)"
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
                :color="setColorStatus(item.status)"
                class="text-capitalize"
              >
                {{ item.status }}
              </v-chip>
            </template>
            <template #[`item.created_at`]="{ item }">
              <span class="font-spartan-small">
                {{ item.created_at | moment("MMMM Do YYYY") }}
              </span>
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
      search: "",
      selected: [],
      headers: [
        { text: "#", value: "id", sortable: false, align: "" },
        { text: "table.article.th.title", value: "title", sortable: false },
        { text: "table.article.th.views", value: "views", sortable: false },
        { text: "Status", value: "status", sortable: false },
        {
          text: "table.article.th.created_at",
          value: "created_at",
          sortable: false,
        },
      ],
    }),
    methods: {
      refresh () {
        this.$emit("refresh")
      },
      setColorStatus (status) {
        if (status === "publish") return "btn_primary"
        else return "red"
      },
      deleteDataArticles (item) {
        this.$emit("deletes", { item: item })
        this.selected = []
      },
      approveDataArticle (item) {
        this.$emit("approves", { item: item })
        this.selected = []
      },
    },
  }
</script>

<style></style>
