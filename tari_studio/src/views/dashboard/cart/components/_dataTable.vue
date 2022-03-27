<template>
  <base-material-card
    icon="mdi-cart"
    color="btn_primary"
  >
    <template #after-heading>
      <span class="font-spartan btn_primary--text">
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
          <v-text-field
            v-model="search"
            append-icon="mdi-magnify"
            :label="$t('search')"
            :placeholder="$t('search')"
          />
        </v-col>
        <v-col cols="12">
          <v-data-table
            :selected="selected"
            :search="search"
            :headers="headers"
            :items="data"
            show-expand
            show-select
          >
            <template #expanded-item="{ headers, item }">
              <td :colspan="headers.length">
                <v-container v-if="item.form">
                  <v-row class="p-6">
                    <v-col
                      cols="12"
                      md="11"
                      class="mt-8"
                    >
                      <div>
                        <span> {{ item.form.fullName }} </span>
                      </div>
                      <v-divider class="mt-2 mb-2" />
                      <div>
                        <span>
                          {{ item.form.contact }}
                        </span>
                      </div>
                      <v-divider class="mt-2 mb-2" />
                      <div>{{ item.form.email }}</div>
                      <v-divider class="mt-2 mb-2" />
                      <div>
                        <span>
                          {{ item.form.address }}
                        </span>
                      </div>
                      <v-divider class="mt-2 mb-2" />
                    </v-col>
                  </v-row>
                </v-container>
              </td>
            </template>
            <template #[`item.id`]="{ item }">
              <v-hover v-slot="{ hover }">
                <v-card
                  :elevation="hover ? 12 : 2"
                  :class="{ 'on-hover': hover }"
                  width="150"
                  color="grey"
                >
                  <v-img
                    v-if="item.class.img"
                    :src="item.class.img.url"
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
            <template #[`item.class.name`]="{ item }">
              <div
                v-if="item.class"
                class="mt-2"
              >
                {{ item.class.name }}
              </div>
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
            <template #[`item.status`]="{ item }">
              <v-chip :color="setColor(item.status)">
                {{ setName(item.status) }}
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
          text: "Class",
          value: "class.name",
          sortable: false,
        },
        {
          text: "Price",
          value: "class.harga",
          sortable: false,
        },
        { text: "Form name", value: "form.fullName", sortable: false },
        { text: "User", value: "user.nickName" },
        { text: "Contact WA User", value: "user.noHp", sortable: false },
        { text: "Status", value: "status", sortable: false },
      // { text: 'Last Login', value: 'last_login', sortable: false },
      ],
      search: "",
      selected: [],
    }),
    computed: {
      computedTitle () {
        let name = "Cart EnsikloLive - All"
        if (this.$route.query.summary === "paid") name = "Cart EnsikloLive - Paid"
        if (this.$route.query.summary === "waiting_confirmation")
          name = "Cart EnsikloLive - Waiting Confirmation"
        if (this.$route.query.summary === "waiting_payment")
          name = "Cart EnsikloLive - Waiting Payment"
        return name
      },
    },
    methods: {
      setName (name) {
        if (name === "waiting_payment") return "Waiting Payment"
        if (name === "waiting_confirmation")
          return "Waiting Confimation From EnsikloTari"
        else return name
      },
      setColor (name) {
        if (name === "waiting_payment") return "warning"
        else if (name === "waiting_confirmation") return "info"
        else if (name === "paid") return "success"
        else if (name === "pending") return "error"
        else return "red"
      },
      sendWaToAdmin (item) {
        this.$emit("waAdmin", { item: item })
      },
      refresh () {
        this.$emit("refresh")
      },
    },
  }
</script>

<style lang="sass" scoped>
.hover__opacity-0
  opacity: 0
.hover
  &__btn
    opacity: 1
</style>
