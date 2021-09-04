<template>
  <base-material-card icon="mdi-alpha-t-box">
    <template #after-heading>
      <span
        :class="
          $vuetify.theme.dark
            ? 'text-h3 white--text font-customize font-size-ather-roboto-mono-name-page'
            : 'text-h3 pallet1--text font-customize font-size-ather-roboto-mono-name-page'
        "
      >
        Index Teachers - All
      </span>
    </template>
    <v-container>
      <v-row>
        <v-col>
          <v-data-table
            :headers="headers"
            :items="data"
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
            <template #[`header.classes.name`]="{ header }">
              {{ $t(header.text) }}
            </template>
            <template #[`header.status`]="{ header }">
              {{ $t(header.text) }}
            </template>
            <template #[`header.profession`]="{ header }">
              {{ $t(header.text) }}
            </template>
            <template #[`header.is_verified`]="{ header }">
              {{ $t(header.text) }}
            </template>

            <!-- Item -->
            <template #[`item.is_verified`]="{item}">
              {{
                item.is_verified === 1
                  ? $t('table.approved')
                  : $t('table.non_approved')
              }}
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
          text: 'table.sub-class.th.title',
          align: 'start',
          sortable: false,
          value: 'name',
        },
        { text: 'table.sub-class.th.status', value: 'email' },
        { text: 'table.sub-class.th.levels', value: 'region' },
        { text: 'table.sub-class.th.class', value: 'contact' },
        { text: 'table.sub-class.th.approved', value: 'profession' },
        { text: 'table.sub-class.th.approved', value: 'is_verified' },
      ],
    }),
  }
</script>

<style></style>
