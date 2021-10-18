<template>
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
    <v-row class="mt-5">
      <v-col
        cols="12"
        md="4"
      >
        <v-text-field
          v-model="search"
          :label="$t('search')"
          :placeholder="$t('type')"
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
          :disabled="selected.length === 0"
          class="ml-2"
          outlined
          color="blue"
          @click="upHide(selected)"
        >
          <v-icon>
            mdi-check-decagram
          </v-icon>
          Hide {{ selected.length }} item
        </v-btn>
        <v-btn
          :disabled="selected.length === 0"
          outlined
          color="red"
          @click="upDelete(selected)"
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
          :search="search"
          :items="data"
          :headers="headers"
          show-select
          mobile-breakpoint="0"
          :items-per-page="5"
        >
          <template #[`header.user.firstName`]="{ header }">
            {{ $t(header.text) }}
          </template>
          <template #[`header.body`]="{ header }">
            {{ $t(header.text) }}
          </template>
          <template #[`header.class.name`]="{ header }">
            {{ $t(header.text) }}
          </template>
          <template #[`header.child.firstName`]="{ header }">
            {{ $t(header.text) }}
          </template>
          <template #[`header.likes`]="{ header }">
            {{ $t(header.text) }}
          </template>

          <!-- Items -->
          <template #[`item.id`]="{item}">
            <v-avatar
              v-if="item.user.img"
              size="60"
            >
              <v-img :src="item.user.img.url" />
            </v-avatar>
            <v-avatar v-else>
              <v-img
                src="https://ecs7.tokopedia.net/img/cache/100-square/user-1/2021/1/22/38585570/38585570_bd6dcd82-263e-45e4-bb8f-725e0088068b.jpg"
              />
            </v-avatar>
          </template>
          <template #[`item.user.firstName`]="{item}">
            <div class="mt-6">
              <span class="nickName">
                {{ item.user.nickName }}
              </span>
            </div>
            <div class="bg-hover">
              <div class="d-flex flex-row flex-nowrap">
                <!-- <div>
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
                </div> -->
                <div>
                  <div class="d-flex flex-column mt-2 ml-1 mr-1">
                    <a
                      class="d-flex blue--text flex-nowrap"
                      @click="reply(item)"
                    >
                      <v-icon
                        color="blue"
                        small
                        class="mr-1"
                      >
                        mdi-reply-all-outline
                      </v-icon>
                      Reply
                    </a>
                  </div>
                </div>
                <div>
                  <div class="d-flex flex-column mt-2">
                    <a
                      class="font-a-delete d-flex flex-nowrap"
                      @click="deleteDiscuss(item)"
                    >
                      <v-icon
                        color="red"
                        small
                      >
                        mdi-delete
                      </v-icon>
                      Delete
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </template>
          <template #[`item.class.name`]="{item}">
            {{ item.class.name }}
          </template>
          <template #[`item.child.firstName`]="{item}">
            {{ item.child.length }}
          </template>
          <template #[`item.likes`]="{item}">
            {{ item.likes.length }}
          </template>

          <template #[`item.status`]="{item}">
            <v-chip
              label
              :color="setColorStatus(item.status)"
              text-color="white"
            >
              {{ $t(item.status) }}
            </v-chip>
          </template>
        </v-data-table>
      </v-col>
    </v-row>
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
          text: "table.discusses.th.author",
          align: "start",
          sortable: false,
          value: "user.firstName",
        },
        {
          text: "table.discusses.th.body",
          align: "start",
          sortable: false,
          value: "body",
        },
        {
          text: "table.discusses.th.name_class",
          align: "start",
          sortable: false,
          value: "class.name",
        },
        {
          text: "table.discusses.th.comments",
          align: "start",
          sortable: false,
          value: "child.firstName",
        },
        {
          text: "table.discusses.th.like",
          align: "start",
          sortable: false,
          value: "likes",
        },
        {
          text: "Status",
          align: "start",
          sortable: false,
          value: "status",
        },
      ],
      search: "",
      selected: [],
    }),
    methods: {
      reply (item) {
        this.$emit("reply", { item: item })
      },
      refreshMethods () {
        this.$emit("refresh")
      },
      deleteDiscuss (item) {
        this.$emit("delete", { item: item })
      },
      setColorStatus (status) {
        if (status === "belum ditanggapi") return "red"
        if (status === "ditanggapi") return "btn_primary"
      },
      upDelete (item) {
        this.$emit("deleteSelected", { item: item })
      },
      upHide (item) {
        this.$emit("hideSelected", { item: item })
        console.log("ja")
      },
    },
  }
</script>
<style lang="sass">
.size__icon_refresh
  font-size: 20px
// .nickName
//   padding: 20px
</style>
