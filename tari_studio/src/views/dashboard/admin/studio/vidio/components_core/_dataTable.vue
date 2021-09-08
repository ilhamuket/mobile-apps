<template>
  <base-material-card icon="mdi-shopping-music">
    <template #after-heading>
      <span
        :class="
          $vuetify.theme.dark
            ? 'text-h3 white--text font-customize font-size-ather-roboto-mono-name-page'
            : 'text-h3 pallet1--text font-customize font-size-ather-roboto-mono-name-page'
        "
      >
        Index Vidio
      </span>
    </template>
    <v-container>
      <v-row>
        <v-col>
          <v-data-table
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
            <template #[`header.studio.name`]="{ header }">
              {{ $t(header.text) }}
            </template>
            <template #[`header.status`]="{ header }">
              {{ $t(header.text) }}
            </template>
            <template #[`header.author.nickName`]="{ header }">
              {{ $t(header.text) }}
            </template>
            <!-- Itmes -->
            <template #[`item.status`]="{item}">
              <v-chip
                label
                color="primary"
                class="text-captilize"
              >
                {{ item.status }}
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
          text: 'table.teachers.th.fullName',
          align: 'start',
          sortable: false,
          value: 'name',
        },
        { text: 'table.vidio.th.title', value: 'name', sortable: false },
        { text: 'table.vidio.th.status', value: 'status', sortable: false },
        { text: 'table.vidio.th.studio', value: 'studio.name' },
        { text: 'table.vidio.th.author', value: 'author.nickName' },
      // { text: 'table.vidio.th.approved', value: 'is_verified' },
      ],
    }),
  }
</script>

<style></style>
