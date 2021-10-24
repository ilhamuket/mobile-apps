<template>
  <v-container>
    <v-row>
      <v-col cols="12">
        <app-list-wishlist
          v-if="user.wishlist"
          :data="user.wishlist"
          @del="delWishlist"
        />
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
  import list from "../components/__listWishlist.vue"
  export default {
    components: {
      "app-list-wishlist": list,
    },
    props: {
      user: {
        type: Object,
        default: null,
      },
    },
    methods: {
      delWishlist ({ item }) {
        this.$emit("del", { item })
      },
    },
  }
</script>

<style></style>
