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
          outlined
          color="red"
        >
          Delete Item
        </v-btn>
      </v-col>
      <v-col cols="12">
        <v-data-table :headers="headers">
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
          <!-- Items -->
        </v-data-table>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
  export default {
    data: () => ({
      selected: [],
      headers: [
        {
          text: "#",
          value: "id",
        },
        {
          text: "table.bank.th.name",
          align: "start",
          sortable: false,
          value: "user.firstName",
        },
        {
          text: "table.bank.th.noRek",
          align: "start",
          sortable: false,
          value: "body",
        },
        {
          text: "table.bank.th.name_bank",
          align: "start",
          sortable: false,
          value: "class.name",
        },
        {
          text: "table.bank.th.status",
          align: "start",
          sortable: false,
          value: "ratings",
        },
      // {
      //   text: "Status",
      //   align: "start",
      //   sortable: false,
      //   value: "status",
      // },
      ],
    }),
  }
</script>

<style></style>
