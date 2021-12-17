<template>
  <v-app-bar
    id="app-bar"
    absolute
    app
    :class="drawer ? 'modified--drawer' : 'modified'"
    :color="$vuetify.theme.dark ? '#283046' : '#E8F0F3'"
    flat
    height="75"
    elevation="3"
  >
    <v-toolbar-title dark>
      <v-img
        src="@/assets/img/logo.svg"
        width="120"
        class="bg-red mr-12"
      />
      <!-- <v-list-item-title
        class="font-title-rampart-one-black custome-brad-pallet1"
      >
        <h3>
          ENSIKLOTARI
        </h3>
      </v-list-item-title> -->
    </v-toolbar-title>
    <v-spacer />

    <v-col
      cols="12"
      md="2"
    >
      <div class="d-flex flex-row mt-6 mr-2">
        <div class="d-flex flex-column justify-start ml-6">
          <v-select
            v-model="$i18n.locale"
            dense
            class="ml-9"
            :items="lenguage"
            item-text="name"
            item-value="name"
          >
            <template
              slot="selection"
              slot-scope="data"
            >
              <slot
                name="item"
                v-bind="data"
              >
                <v-chip
                  color="transparent"
                  style="text-transform: uppercase"
                >
                  <v-avatar left>
                    <v-img :src="data.item.img" />
                  </v-avatar>
                  {{ data.item.name }}
                </v-chip>
              </slot>
            </template>
            <template
              slot="item"
              slot-scope="data"
            >
              <slot
                name="item"
                v-bind="data"
              >
                <v-chip
                  color="transparent"
                  class="text-uppercase"
                >
                  <v-avatar left>
                    <v-img :src="data.item.img" />
                  </v-avatar>
                  {{ data.item.name }}
                </v-chip>
              </slot>
            </template>
          </v-select>
        </div>
      </div>
    </v-col>

    <v-switch
      v-model="$vuetify.theme.dark"
      :prepend-icon="
        $vuetify.theme.dark ? 'mdi-theme-light-dark' : 'mdi-white-balance-sunny'
      "
      class="mt-2"
      color="success"
      hide-details
      @click="toggle_theme"
    />

    <v-menu
      bottom
      class="mr-3 rounded-pill"
      left
      offset-y
      origin="top right"
      max-width="1000px"
      transition="scale-transition"
      rounded
    >
      <template v-slot:activator="{ attrs, on }">
        <v-chip
          class="ma-2"
          :color="$vuetify.theme.dark ? '#121212' : '#eeeeee'"
          text-color="primary"
          outlined
          v-bind="attrs"
          style="text-transform: capitalize"
          v-on="on"
        >
          <v-list-item-avatar
            v-if="computedStudio.img"
            color="primary"
            size="60"
          >
            <!-- <span class="white--text text-h5">{{ profile.initials }}</span> -->
            <v-img
              class="bg-img"
              :src="computedStudio.img.url"
            />
          </v-list-item-avatar>
          <v-list-item-avatar
            v-else
            color="primary"
            size="36"
          >
            <v-img src="http://127.0.0.1:8000/images/469439.png" />
          </v-list-item-avatar>
          Hi, {{ users.nickName }}
        </v-chip>
      </template>

      <v-list width="400">
        <v-list-item class="d-flex justify-center">
          <v-list-item-avatar
            v-if="computedStudio.img"
            size="60"
          >
            <v-img :src="computedStudio.img.url" />
          </v-list-item-avatar>
          <v-list-item-avatar
            v-else
            color="primary"
            size="36"
          >
            <v-img src="http://127.0.0.1:8000/images/469439.png" />
          </v-list-item-avatar>
        </v-list-item>
        <v-list-item
          class="d-flex justify-center"
          link
          to="/"
        >
          <v-list-item-content>
            <v-list-item-title
              class="text-h4 font-spartan text-center text-capitalize"
            >
              {{ users.nickName }}
            </v-list-item-title>
            <v-list-item-subtitle class="text-h5 font-spartan text-center">
              {{ users.email }}
            </v-list-item-subtitle>
          </v-list-item-content>
        </v-list-item>
        <v-divider />
        <v-list-item-group
          v-model="model"
          active-class="border"
          color="indigo"
        >
          <v-list-item
            v-for="(item, i) in items"
            :key="i"
            :to="item.to"
          >
            <v-divider
              v-if="!item"
              :key="`divider-${i}`"
            />
            <v-list-item-icon>
              <v-icon v-text="item.icon" />
            </v-list-item-icon>

            <v-list-item-content>
              <v-list-item-title v-text="$t(item.text)" />
            </v-list-item-content>
          </v-list-item>
        </v-list-item-group>
      </v-list>
    </v-menu>
  </v-app-bar>
</template>

<script>
// Components
// import { VHover, VListItem } from 'vuetify/lib'

// Utilities
  import { mapState, mapMutations } from "vuex"

  export default {
    name: "DashboardCoreAppBar",

    props: {
      value: {
        type: Boolean,
        default: false,
      },
    },

    data: () => ({
      notifications: [
        "Mike John Responded to your email",
        "You have 5 new tasks",
        "You're now friends with Andrew",
        "Another Notification",
        "Another one",
      ],
      notify: false,
      model: null,
      lenguage: [
        {
          name: "en",
          img: "https://media.istockphoto.com/vectors/flag-of-great-britain-vector-id497118178?s=612x612",
        },
        {
          name: "id",
          img: "https://upload.wikimedia.org/wikipedia/commons/9/9f/Flag_of_Indonesia.svg",
        },
      ],
      items: [
        {
          icon: "mdi-account-outline",
          text: "myaccount",
          to: "/dashboard/profile",
        },
        {
          icon: "mdi-account",
          text: "user",
          to: "/user/settings",
        },
        // {
        //   icon: 'mdi-bluetooth',
        //   text: 'Bluetooth',
        //   to: '/index/announcement',
        // },
        {
          icon: "mdi-logout",
          text: "logout",
          to: "/logout",
        },
      ],
    }),

    computed: {
      ...mapState(["drawer"]),
      users () {
        return this.$store.state.user.me
      },
      fullName () {
        return (
          this.$store.state.user.me.firstName +
          " " +
          this.$store.state.user.me.lastName
        )
      },
      profile () {
        return {
          initials:
            this.$store.state.user.firstName.charAt(0) +
            this.$store.state.user.lastName.charAt(0),
        }
      },
      computedStudio () {
        return this.$store.state.studio.me
      },
    },

    mounted () {
      this.getMe()
      const theme = localStorage.getItem("dark_theme")
      if (theme === "true") {
        this.$vuetify.theme.dark = true
      } else {
        this.$vuetify.theme.dark = false
      }
      this.getStudioMe()
    },
    methods: {
      ...mapMutations({
        setDrawer: "SET_DRAWER",
      }),
      getStudioMe () {
        this.$store
          .dispatch("studio/getDataMeStudio", {
            entities: "likes,followers,img",
          })
          .then((res) => {
            if (res.data.meta.status) {
              this.is_load = false
            }
          })
      },
      toogle_dark_theme () {
        localStorage.setItem("dark_theme", this.$vuetify.theme.dark.toString())
      },
      toggle_theme () {
        localStorage.setItem("dark_theme", this.$vuetify.theme.dark.toString())
      },
      getMe () {
        this.$store.dispatch("user/me", {
          entities: "studio.img",
        })
      },
    },
  }
</script>

<style lang="sass" scoped>
.card--margin
  margin-right: 200px
.font-customize
  font-style: italic
.modified
  border-radius: 10px !important
  margin-left: 57px !important
  margin-right: 27px !important
  margin-top: 21px !important
.modified--drawer
  border-radius: 10px !important
  margin-left: 16px !important
  margin-right: 27px !important
  margin-top: 21px !important
.theme--light
  .icon__swicth
    .v-input__prepend-outer
      .v-icon
        color: white !important

.icon__len
  .v-input__control
    .v-input__slot
      .v-select__slot
        .v-input__append-inner
          .v-input__icon
            .v-icon .mdi
              color: white !important
</style>
