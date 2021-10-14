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
          @click="refresh"
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
      <v-col
        cols="12"
        md="4"
      >
        <v-text-field
          append-icon="mdi-magnify"
          :label="$t('search')"
          :placeholder="$t('type')"
        />
      </v-col>
      <v-col
        class="d-flex flex-row-reverse mt-1"
        cols="12"
        md="8"
      >
        <v-btn
          color="btn_primary"
          class=""
          @click="addBankAccount"
        >
          Add Bank Account
        </v-btn>
        <v-btn
          class="mr-1"
          :disabled="selected.length === 0"
          outlined
          color="red"
        >
          Delete {{ selected.length }} Item
        </v-btn>
        <v-btn
          class="mr-1"
          :disabled="computedIsActive || selected.length === 0"
          outlined
          color="blue"
        >
          Activate {{ selected.length }} Item
        </v-btn>
      </v-col>
      <v-col cols="12">
        <v-data-table
          v-model="selected"
          show-select
          :headers="headers"
          :items="data"
        >
          <!-- Headers -->
          <template #[`header.name`]="{ header }">
            {{ $t(header.text) }}
          </template>
          <template #[`header.no_rek`]="{ header }">
            {{ $t(header.text) }}
          </template>
          <template #[`header.bank_name`]="{ header }">
            {{ $t(header.text) }}
          </template>
          <template #[`header.status`]="{ header }">
            {{ $t(header.text) }}
          </template>
          <!-- Items -->
          <template #[`item.name`]="{item}">
            <div class="mt-6">
              <span class="nickName">
                {{ item.name }}
              </span>
            </div>
            <div class="bg-hover">
              <div class="d-flex flex-row flex-nowrap">
                <div>
                  <div class="d-flex flex-column mt-2">
                    <a
                      class="font-a-delete d-flex flex-nowrap"
                      @click="editBankAccount(item)"
                    >
                      <v-tooltip
                        color="primary"
                        bottom
                      >
                        <template #activator="{on, attrs}">
                          <v-icon
                            v-bind="attrs"
                            color="blue"
                            small
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
                      @click="deleteDiscuss(item)"
                    >
                      <v-tooltip
                        color="primary"
                        bottom
                      >
                        <template #activator="{on, attrs}">
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
              </div>
            </div>
          </template>
          <template #[`item.status`]="{item}">
            <v-chip
              label
              :color="setColorStatus(item.status)"
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
      selected: [],
      headers: [
        // {
        //   text: "#",
        //   value: "id",
        // },
        {
          text: "table.bank.th.name",
          align: "start",
          sortable: false,
          value: "name",
        },
        {
          text: "table.bank.th.noRek",
          align: "start",
          sortable: false,
          value: "no_rek",
        },
        {
          text: "table.bank.th.name_bank",
          align: "start",
          sortable: false,
          value: "bank_name",
        },
        {
          text: "table.bank.th.status",
          align: "start",
          sortable: false,
          value: "status",
        },
      // {
      //   text: "Status",
      //   align: "start",
      //   sortable: false,
      //   value: "status",
      // },
      ],
    }),
    computed: {
      computedIsActive () {
        let bool = false
        if (this.selected.length > 0 && this.selected.length !== 0) {
          bool = this.selected.some(x => x.status === "active")
        }
        return bool
      },
    },
    methods: {
      setColorStatus (status) {
        if (status === "active") return "btn_primary"
        else return "red"
      },
      addBankAccount () {
        this.$emit("add")
      },
      refresh () {
        this.$emit("refresh")
      },
      editBankAccount (item) {
        this.$emit("edit", { item: item })
      },
    },
  }
</script>

<style></style>
