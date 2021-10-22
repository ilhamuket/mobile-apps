<template>
  <v-container>
    <v-row>
      <v-col cols="12">
        <v-tabs
          v-model="tabs"
          class="tabs__etc"
          color="btn_primary"
        >
          <v-tab class="">
            <v-icon class="mr-2">
              mdi-heart-outline
            </v-icon>Wishlist
          </v-tab>
          <v-tab class="">
            <v-icon class="mr-2">
              mdi-heart-outline
            </v-icon>Followed
          </v-tab>
        </v-tabs>
        <v-tabs-items>
          <v-tab-item>
            <!--  -->
          </v-tab-item>
        </v-tabs-items>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
  export default {
    data: () => ({
      tabs: null,
    }),
  }
</script>

<style lang="sass">
.tabs__etc
    .v-item-group
        border-bottom: 2px double #9DACC2 !important
        .v-tab
            text-transform: capitalize
            font-family: "Spartan", sans-serif
            font-size: 14px
            margin-top: 14px
</style>
