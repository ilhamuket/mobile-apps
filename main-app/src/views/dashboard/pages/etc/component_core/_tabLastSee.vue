<template>
  <v-container>
    <v-col cols="12">
      <app-list
        v-if="user.last"
        :data="user.last"
      />
    </v-col>
  </v-container>
</template>

<script>
  import list from "../components/__listTabSee.vue"
  export default {
    components: {
      "app-list": list,
    },
    props: {
      user: {
        type: Object,
        default: null,
      },
    },
  }
</script>

<style></style>
