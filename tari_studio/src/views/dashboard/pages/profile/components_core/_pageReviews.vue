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
                @click="refresh"
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
          :placeholder="$t('type')"
          :label="$t('search')"
          append-icon="mdi-magnify"
        />
      </v-col>
      <v-col
        cols="12"
        md="8"
        sm="4"
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

        <!-- <v-btn
          :disabled="selected.length === 0"
          class="ml-2"
          outlined
          color="blue"
          @click="hide(selected)"
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
          @click="deleteSelected(selected)"
        >
          <v-icon>
            mdi-delete-empty-outline
          </v-icon>
          Delete {{ selected.length }} item
        </v-btn> -->
      </v-col>
      <v-col cols="12">
        <v-data-table
          v-model="selected"
          :items="data"
          :headers="headers"
          show-select
          mobile-breakpoint="0"
          :items-per-page="5"
        >
          <!-- Headers -->
          <template #[`header.user.firstName`]="{ header }">
            {{ $t(header.text) }}
          </template>
          <template #[`header.body`]="{ header }">
            {{ $t(header.text) }}
          </template>
          <template #[`header.class.name`]="{ header }">
            {{ $t(header.text) }}
          </template>
          <template #[`header.ratings`]="{ header }">
            {{ $t(header.text) }}
          </template>
          <template #[`header.class_vidio.name`]="{ header }">
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
            <v-avatar
              v-else
              color="primary"
            >
              <span class="font-spartan">
                {{ item.user.nickName.charAt(0) }}
              </span>
            </v-avatar>
          </template>
          <template #[`item.class.name`]="{item}">
            <span>
              {{ item.class ? item.class.name : "-" }}
            </span>
          </template>
          <template #[`item.user.firstName`]="{item}">
            <div class="mt-6">
              <span class="nickName"> {{ item.user.nickName }} </span>
            </div>
            <div class="bg-hover">
              <div class="d-flex flex-row flex-nowrap">
                <!-- <div>
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
                </div> -->
                <div>
                  <div class="d-flex flex-column mt-2">
                    <a
                      class="font-a-delete d-flex flex-nowrap"
                      @click="replyReviews(item)"
                    >
                      <v-tooltip
                        color="primary"
                        bottom
                      >
                        <template #activator="{on,attrs}">
                          <v-icon
                            v-bind="attrs"
                            color="blue"
                            small
                            v-on="on"
                          >
                            mdi-reply-all-outline
                          </v-icon>
                        </template>
                        <span class="font-spartan-spartan blue--text">
                          reply
                        </span>
                      </v-tooltip>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </template>
          <template #[`item.ratings`]="{item}">
            <v-rating
              v-model="item.ratings"
              readonly
              background-color="grey"
              color="orange"
              small
            />
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
          <template #[`item.class_vidio.name`]="{item}">
            <span v-if="item.class_vidio">
              <v-tooltip
                v-if="item.class_vidio.name.length > 20"
                color="primary"
                bottom
              >
                <template #activator="{on, attrs}">
                  <span
                    class="font-spartan-small"
                    v-bind="attrs"
                    v-on="on"
                  >
                    {{ item.class_vidio.name.substr(0, 20) + "..." }}
                  </span>
                </template>
                <span class="font-spartan-small">
                  {{ item.class_vidio.name }}
                </span>
              </v-tooltip>
              <span v-else>
                {{ item.class_vidio.name }}
              </span>
            </span>
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
      selected: [],
      headers: [
        {
          text: "#",
          value: "id",
        },
        {
          text: "table.reviews.th.author",
          align: "start",
          sortable: false,
          value: "user.firstName",
        },
        // {
        //   text: "table.reviews.th.body",
        //   align: "start",
        //   sortable: false,
        //   value: "body",
        // },
        {
          text: "table.reviews.th.name_class",
          align: "start",
          sortable: false,
          value: "class.name",
        },
        {
          text: "table.reviews.th.name_class_vidio",
          align: "start",
          sortable: false,
          value: "class_vidio.name",
        },
        {
          text: "table.reviews.th.ratings",
          align: "start",
          sortable: false,
          value: "ratings",
        },
        {
          text: "Status",
          align: "start",
          sortable: false,
          value: "status",
        },
      ],
    }),
    methods: {
      setColorStatus (status) {
        if (status === "belum ditanggapi") return "red"
        if (status === "ditanggapi") return "btn_primary"
      },
      hide (item) {
        this.$emit("hide", { item: item })
      },
      deleteSelected (item) {
        this.$emit("delete", { item: item })
      },
      reply (item) {
        this.$emit("reply", { item: item })
      },
      refresh () {
        this.$emit("refresh")
      },
      replyReviews (item) {
        this.$emit("reply", { item: item })
      },
    },
  }
</script>

<style></style>
