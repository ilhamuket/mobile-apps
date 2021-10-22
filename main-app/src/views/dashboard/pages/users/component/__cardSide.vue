<template>
  <v-container>
    <v-row>
      <v-col cols="12">
        <v-avatar
          class="mt-2"
          size="50"
        >
          <v-img
            v-if="user.img"
            :src="user.img.url"
            style="cursor:pointer"
            @click="see(user.img.url)"
          />
          <v-img
            v-else
            src="https://ecs7.tokopedia.net/img/cache/300/default_picture_user/default_toped-22.jpg"
          />
        </v-avatar>
        <div class="d-flex-flex-row margin--name--user">
          <div class="d-flex-flex-column margin--name-user">
            <span
              class="font-spartan-small ml-2 btn_primary--text margin--span"
            >
              {{ user.nickName }}
            </span>
          </div>
        </div>
        <div class="d-flex flex-row margin--name">
          <div class="d-flex flex-column">
            <span class="font-spartan-small">
              {{ user.email }}
            </span>
          </div>
        </div>
      </v-col>
      <v-divider />
      <v-col cols="12">
        <v-expansion-panels>
          <v-expansion-panel>
            <v-expansion-panel-header disable-icon-rotate>
              {{ $t("pembelian") }}
              <template v-slot:actions>
                <v-icon color="teal">
                  mdi-check
                </v-icon>
              </template>
            </v-expansion-panel-header>
            <v-divider class="mb-2" />
            <v-expansion-panel-content>
              <v-list dense>
                <v-list-item-group
                  v-model="selectedItem"
                  color="white"
                >
                  <v-list-item
                    v-for="(item, i) in items"
                    :key="i"
                  >
                    <v-list-item-content>
                      <v-list-item-title
                        class="list--title"
                        v-text="$t(item.text)"
                      />
                    </v-list-item-content>
                  </v-list-item>
                </v-list-item-group>
              </v-list>
            </v-expansion-panel-content>
          </v-expansion-panel>
        </v-expansion-panels>
      </v-col>
      <v-divider class="mb-2" />
      <v-col
        class="cols--profile"
        cols="12"
      >
        <v-expansion-panels>
          <v-expansion-panel>
            <v-expansion-panel-header disable-icon-rotate>
              {{ $t("profile_") }}
              <template v-slot:actions>
                <v-icon color="teal">
                  mdi-account
                </v-icon>
              </template>
            </v-expansion-panel-header>
            <v-divider class="mb-2" />
            <v-expansion-panel-content>
              <v-list dense>
                <v-list-item-group
                  v-model="selectedItem"
                  color="white"
                >
                  <v-list-item
                    v-for="(item, i) in itemProfile"
                    :key="i"
                  >
                    <v-list-item-content @click="push(item.to)">
                      <v-list-item-title
                        class="list--title"
                        v-text="$t(item.text)"
                      />
                    </v-list-item-content>
                  </v-list-item>
                </v-list-item-group>
              </v-list>
            </v-expansion-panel-content>
          </v-expansion-panel>
        </v-expansion-panels>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
  export default {
    props: {
      user: {
        type: Object,
        default: null,
      },
    },
    data: () => ({
      selectedItem: 1,
      items: [
        { text: "profile.wait", icon: "mdi-clock" },
        { text: "profile.list", icon: "mdi-account" },
      ],
      itemProfile: [
        {
          text: "profile.wishlist",
          icon: "mdi-clock",
          to: "/pages/user/etc/wishlist",
        },
        {
          text: "profile.followed",
          icon: "mdi-account",
          to: "/pages/user/etc/followed",
        },
      ],
      panel: true,
    }),
    methods: {
      see (value) {
        window.open(value, "_blank")
      },
      push (link) {
        this.$router.push(link)
      },
    },
  }
</script>

<style lang="sass" scoped>
.margin--name
    margin-left: 62px !important
    margin-top: 5px
.margin--name--user
    margin-left: 62px !important
    margin-top: -47px
.margin--span
    margin-top: -20px
.v-list
    background-color: white !important
    margin-left: -20px !important
.icon--list
    margin-right: -20px !important
.cols--profile
    margin-top: -20px
</style>
