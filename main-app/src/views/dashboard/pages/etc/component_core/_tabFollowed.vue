<template>
  <v-container>
    <v-row>
      <v-col cols="12">
        <app-followed
          v-if="user.following_studio"
          :data="user.following_studio"
        />
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
  import listFollowed from "../components/__listFollowed.vue"
  export default {
    components: {
      "app-followed": listFollowed,
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
