<template>
  <v-card class="rounded stadarlize">
    <div class="d-flex flex-row">
      <div class="d-flex-column">
        <v-card-title>
          <span class="text-h4 font-size-ather-roboto-mono">Following</span>
        </v-card-title>
      </div>
    </div>
    <div class="d-flex flex-row mt-2">
      <div class="d-flex-column">
        <v-card-title>
          <span class="text-h5 font-size-ather-roboto-mono">Group</span>
        </v-card-title>
      </div>
    </div>

    <v-list>
      <v-list-item>
        <v-list-item-avatar>
          <v-img src="https://cdn.vuetifyjs.com/images/lists/4.jpg" />
        </v-list-item-avatar>
        <v-list-item-content>
          <v-list-item-title>Hurip Studio</v-list-item-title>
          <v-list-item-title>Hurip Studio</v-list-item-title>
        </v-list-item-content>
      </v-list-item>
    </v-list>
  </v-card>
</template>

<script>
  export default {}
</script>

<style lang="sass" scoped>
.stadarlize
  margin-top: -5px
.rounded
  border-radius: 20px !important
</style>
