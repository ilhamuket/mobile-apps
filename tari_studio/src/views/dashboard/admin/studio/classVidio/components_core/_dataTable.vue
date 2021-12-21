<template>
  <v-container>
    <base-material-card icon="mdi-account">
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
      <v-row class="mt-2">
        <v-col cols="12">
          <v-btn
            outlined
            rounded
            small
            dark
            color="primary"
            width="80"
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
        >
          <v-text-field
            v-model="search"
            append-icon="mdi-magnify"
          />
        </v-col>
        <v-col
          cols="12"
          md="8"
          class="d-flex flex-row-reverse"
        >
          <v-btn
            color="btn_primary"
            @click="create"
          >
            Create Class
          </v-btn>
          <v-btn
            class="mr-1"
            outlined
            color="blue"
            :disabled="computedIsPublish || selected.length === 0"
            @click="publishClassVidio(selected)"
          >
            Publish {{ selected.length }} items
          </v-btn>
          <v-btn
            class="mr-1"
            outlined
            color="red"
            :disabled="selected.length === 0"
            @click="deleteSelected(selected)"
          >
            Delete {{ selected.length }} items
          </v-btn>
        </v-col>
        <v-col cols="12">
          <v-data-table
            v-model="selected"
            :headers="headers"
            :items="data"
            :search="search"
            show-select
          >
            <!-- Items -->
            <template #[`item.id`]="{ item }">
              <v-img
                :src="item.url_thumbnail"
                width="140"
                height="100"
              />
            </template>
            <template #[`item.name`]="{ item }">
              <div
                v-if="item.name"
                class="mt-6"
              >
                <v-tooltip
                  v-if="item.name.length > 9"
                  bottom
                  color="blue"
                >
                  <template #activator="{ on, attrs }">
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
                        @click="edit(item)"
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
                              class="mr-1"
                              v-on="on"
                            >
                              mdi-pencil
                            </v-icon>
                          </template>
                          <span class="font-spartan-small blue--text">
                            Pencil
                          </span>
                        </v-tooltip>
                      </a>
                    </div>
                  </div>
                  <!-- <div>
                    <div class="d-flex flex-column mt-2">
                      <a
                        class="font-a-delete d-flex flex-nowrap"
                        @click="info(item)"
                      >
                        <v-tooltip
                          color="primary"
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
                          <span class="font-spartan-small blue--text">
                            Info
                          </span>
                        </v-tooltip>
                      </a>
                    </div>
                  </div> -->
                  <div>
                    <div class="d-flex flex-column mt-2">
                      <a
                        class="font-a-delete d-flex flex-nowrap"
                        @click="deletesById(item)"
                      >
                        <v-tooltip
                          color="primary"
                          bottom
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
                        @click="hide(item)"
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
                              mdi-bag-suitcase-off
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
            <template #[`item.levels`]="{ item }">
              <v-chip
                class="text-capitalize"
                text-color="white"
                :color="setColorLevels(item.levels)"
              >
                {{ item.levels }}
              </v-chip>
            </template>
            <template #[`item.status`]="{ item }">
              <v-chip
                :color="setColorStatus(item.status)"
                class="text-capitalize"
                text-color="white"
              >
                {{ item.status }}
              </v-chip>
            </template>
          </v-data-table>
        </v-col>
      </v-row>
    </base-material-card>
  </v-container>
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
          value: "id",
        },
        {
          text: "name",
          value: "name",
        },
        {
          text: "Category",
          value: "category.name",
        },
        {
          text: "levels",
          value: "levels",
        },
        {
          text: "price",
          value: "price",
        },
        {
          text: "status",
          value: "status",
        },
      ],
      selected: [],
      search: "",
    }),
    computed: {
      computedIsPublish () {
        let bool = false
        if (this.selected.length !== 0) {
          bool = this.selected.some((x) => x.status === "publish")
        }
        return bool
      },
      computedTitle () {
        let name = "EnsikloVideo - All"
        if (this.$route.query.summary === "publish")
          return (name = "EnsikloVideo - Publish")
        if (this.$route.query.summary === "draft")
          return (name = "EnsikloVideo - Draft")
        if (this.$route.query.summary === "new")
          return (name = "EnskloVideo - New")
        return name
      },
    },
    methods: {
      refresh () {
        this.$emit("refresh")
      },
      setColorStatus (status) {
        if (status === "publish") return "btn_primary"
        if (status === "draft") return "primary"
        else return "red"
      },
      setColorLevels (level) {
        if (level === "beginner") return "#C7DF1D"
        if (level === "intermediate") return "#66EC1A"
        if (level === "advance") return "#1AEC56"
      },
      create () {
        this.$emit("create")
      },
      publishClassVidio (item) {
        this.$emit("publish", { item: item })
      },
      hide (item) {
        this.$emit("hide", { item: item })
      },
      edit (item) {
        this.$emit("edit", { item: item })
      },
      deleteSelected (item) {
        this.$emit("deletes", { item: item })
      },
      deletesById (item) {
        this.$emit("deletesById", { item: item })
      },
    },
  }
</script>

<style></style>
