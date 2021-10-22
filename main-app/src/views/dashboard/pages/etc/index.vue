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
              mdi-account-check
            </v-icon>Followed
          </v-tab>
        </v-tabs>
        <v-tabs-items v-model="tabs">
          <v-tab-item>
            <app-tabs-wishlist :user="user" />
          </v-tab-item>
          <v-tab-item>
            <app-tabs-followed :user="user" />
          </v-tab-item>
        </v-tabs-items>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
  import tabWishlist from "./component_core/_tabWishlist.vue"
  import tabFollowed from "./component_core/_tabFollowed.vue"
  export default {
    components: {
      "app-tabs-wishlist": tabWishlist,
      "app-tabs-followed": tabFollowed,
    },
    data: () => ({
      tabs: null,
      user: {},
    }),
    computed: {
      computedMe () {
        return this.$store.state.user.me
      },
    },
    watch: {
      tabs () {
        if (this.tabs === 0) {
          const params = (this.$route.params.variable = "wish-list")
          this.$router.push(params).catch(() => {})
        } else if (this.tabs === 1) {
          const params = (this.$route.params.variable = "followed")
          this.$router.push(params).catch(() => {})
        }
      },
    },
    mounted () {
      this.getMe()
      this.firstLoad()
    },
    methods: {
      getMe () {
        this.$store
          .dispatch("user/me", {
            entities: "followingStudio.img,followingStudio.reviews,wishlist.img",
          })
          .then(res => {
            if (res.data.meta.status) {
              this.user = res.data.data
            }
          })
      },
      firstLoad () {
        if (this.$route.params.variable === "wist-list") {
          this.tabs = 0
        } else if (this.$route.params.variable === "followed") {
          this.tabs = 1
        }
      },
    },
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
