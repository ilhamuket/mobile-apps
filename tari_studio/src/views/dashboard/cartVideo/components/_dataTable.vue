<template>
  <base-material-card
    color="btn_primary"
    icon="mdi-cart"
  >
    <template #after-heading>
      <span class="font-spartan btn_primary--text">
        Cart EnsikloVideo - All
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
          <v-text-field
            v-model="search"
            class=""
            append-icon="mdi-magnify"
            :label="$t('search')"
            :placeholder="$t('search')"
          />
        </v-col>
        <v-col cols="12">
          <v-data-table
            v-model="selected"
            :search="search"
            show-expand
            show-select
            :headers="headers"
            :items="data"
          >
            <template #[`item.id`]="{ item }">
              <v-hover v-slot="{ hover }">
                <v-card
                  :elevation="hover ? 12 : 2"
                  :class="{ 'on-hover': hover }"
                  width="150"
                  color="grey"
                >
                  <v-img
                    v-if="item.video"
                    :src="item.video.url_thumbnail"
                    width="100%"
                    height="100"
                    gradient="to top right, rgba(0,0,0,.33), rgba(0,0,0,.7)"
                    style="cursor: pointer"
                  />
                  <v-img
                    v-else
                    src="https://assets.tokopedia.net/assets-tokopedia-lite/v2/zeus/kratos/62cb37c4.png"
                    width="140"
                    height="100"
                    gradient="to top right, rgba(0, 0, 0, 0.05), rgba(20, 20, 20, 0.05)"
                    style="background-color: rgba(0, 0, 0, 0.05)"
                  />
                  <!-- <input
                    ref="fileUpload"
                    type="file"
                    style="display: none"
                    accept="image/*"
                  > -->
                </v-card>
              </v-hover>
            </template>

            <template #[`item.video.name`]="{ item }">
              <v-tooltip
                color="btn_primary"
                bottom
              >
                <template #activator="{ on, attrs }">
                  <span
                    v-bind="attrs"
                    v-on="on"
                  >
                    {{
                      item.video.name
                        ? item.video.name.substr(0, 15) + "..."
                        : "-"
                    }}
                  </span>
                </template>
                <span
                  v-if="item.video"
                  class="white--text"
                >
                  {{ item.video.name }}
                </span>
              </v-tooltip>
              <div class="bg-hover">
                <div class="d-flex flex-row flex-nowrap">
                  <div>
                    <div class="d-flex flex-column flex-nowrap mt-2">
                      <a
                        class="font-a d-flex flex-nowrap"
                        @click="sendWaToAdmin(item)"
                      >
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
                              mdi-whatsapp
                            </v-icon>
                          </template>
                          <span class="font-spartan-small blue--text">
                            Contact EnsikloTari
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
                              color="btn_primary"
                              small
                              v-on="on"
                            >
                              mdi-whatsapp
                            </v-icon>
                          </template>
                          <span
                            class="font-spartan-small btn_primary--text"
                          >Contact User</span>
                        </v-tooltip>
                      </a>
                    </div>
                  </div>
                  <!-- <div>
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
                          <span class="font-spartan-small red--text">Hide</span>
                        </v-tooltip>
                      </a>
                    </div>
                  </div> -->
                </div>
              </div>
            </template>
            <template #[`item.subscription.plan.name`]="{ item }">
              <v-chip
                v-if="item.subscription"
                color="btn_primary"
                dark
                small
                label
              >
                {{ item.subscription.plan ? item.subscription.plan.name : "-" }}
              </v-chip>
              <div v-else>
                -
              </div>
            </template>
            <template #[`item.video.price`]="{ item }">
              <div v-if="item.video && item.subscription">
                {{ item.video.price * item.subscription.plan.date_count }}
              </div>
              <div v-else>
                {{ item.video ? item.video.price : "-" }}
              </div>
            </template>
            <template #[`item.status`]="{ item }">
              <v-chip :color="setColor(item.status)">
                {{ setNameStatus(item.status) }}
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
          text: "#",
          value: "id",
          sortable: false,
        },
        {
          text: "Video Name",
          value: "video.name",
          sortable: false,
        },
        {
          text: "Plan",
          value: "subscription.plan.name",
          sortable: false,
        },
        { text: "User NickName", value: "user.nickName", sortable: false },
        { text: "Price", value: "video.price", sortable: false },
        // // { text: "Payment Method", value: "bank.bank_name", sortable: false },
        // // {
        // //   text: "Bank Account",
        // //   value: "bank.account_bank_number",
        // //   sortable: false,
        // // },
        { text: "Status", value: "status", sortable: false },
      // { text: 'Last Login', value: 'last_login', sortable: false },
      ],
      search: "",
      selected: [],
    }),
    methods: {
      refresh () {
        this.$emit("refresh")
      },
      setNameStatus (name) {
        if (name === "waiting_payment") return "Waiting Payment"
        if (name === "waiting_confirmation") return "Waiting Confirmation"
        return name
      },
      setColor (name) {
        if (name === "waiting_payment") return "warning"
        else if (name === "waiting_confirmation") return "info"
        else if (name === "paid") return "success"
        else if (name === "pending") return "error"
        else return "red"
      },
    },
  }
</script>

<style></style>
