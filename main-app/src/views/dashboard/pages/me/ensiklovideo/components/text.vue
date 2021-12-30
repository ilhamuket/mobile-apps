<template>
  <v-container>
    <v-row class="row__text--vue">
      <v-col class="cols__title">
        <div class="d-flex flex-row">
          <div class="d-flex flex-column">
            <span
              v-if="item.category"
              class="font-spartan"
            >
              {{ item.name }} - {{ item.category.display_name }}
            </span>
          </div>
        </div>
        <div class="d-flex flex-row mt-2 ml-2">
          <div class="d-flex flex-column">
            <span class="font-spartan-small">{{
              item.created_at | moment("dddd, MMMM Do YYYY")
            }}</span>
          </div>
        </div>
        <div class="d-flex flex-row justify-end">
          <div class="d-flex flex-column">
            <v-btn
              icon
              dark
            >
              <v-icon color="btn_primary">
                mdi-share-variant
              </v-icon>
            </v-btn>
          </div>
          <div class="d-flex flex-column">
            <v-btn
              icon
              dark
            >
              <v-icon color="btn_primary">
                mdi-thumb-up
              </v-icon>
            </v-btn>
          </div>
          <div class="d-flex flex-column">
            <span class="font-spartan-small btn_primary--text font-weight-bold">
              20
            </span>
          </div>
          <div class="d-flex flex-column">
            <v-btn
              icon
              dark
            >
              <v-icon color="btn_primary">
                mdi-thumb-down
              </v-icon>
            </v-btn>
          </div>
          <div class="d-flex flex-column">
            <span class="font-spartan-small btn_primary--text font-weight-bold">
              20
            </span>
          </div>
        </div>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
  export default {
    props: {
      item: {
        type: Object,
        default: null,
      },
    },
  }
</script>

<style lang="sass">
.row
    &__text-vue
        .cols
            &__title
                background-color: red
                // margin-top: 1170% !important
</style>
