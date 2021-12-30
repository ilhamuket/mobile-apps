<template>
  <base-material-card icon="mdi-cart">
    <template #after-heading>
      <span class="font-spartan btn_primary--text"> EnsikloVideo Cart </span>
    </template>
    <v-container>
      <v-row>
        <v-col
          cols="12"
          md="4"
        >
          <v-text-field
            :label="$t('search')"
            append-icon="mdi-magnify"
          />
        </v-col>
        <v-col cols="12">
          <v-data-table
            :items="data"
            :headers="headers"
            show-select
            :search="search"
          >
            <template #[`item.img`]="{ item }">
              <v-img
                :src="item.video.url_thumbnail"
                width="200"
                class="img__video"
              />
            </template>
            <template #[`item.actions`]="{ item }">
              <v-btn
                v-if="item"
                icon
                :to="`/cart/video/detail/${item.id}`"
              >
                <v-icon color="btn_primary">
                  mdi-eye
                </v-icon>
              </v-btn>
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
          value: "img",
        },
        {
          text: "Name",
          value: "video.name",
        },
        {
          text: "Type",
          value: "type",
        },
        {
          text: "Price",
          value: "video.price",
        },
        {
          text: "Status",
          value: "status",
        },
        {
          text: "Actions",
          value: "actions",
        },
      ],
      search: "",
    }),
  }
</script>

<style lang="sass">
.img
  &__video
    &:hover
      transform: scale(.9)
      box-shadow: inset 0px 33px 25px 0 red
</style>
