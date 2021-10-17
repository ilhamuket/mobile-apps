<template>
  <v-navigation-drawer
    id="core-navigation-drawer"
    v-model="drawer"
    :class="
      $vuetify.theme.dark
        ? 'custumize-dark height-max'
        : 'custumize-light height-max'
    "
    :mini-variant="!drawer"
    :right="$vuetify.rtl"
    mobile-breakpoint="960"
    app
    width="260"
    v-bind="$attrs"
    permanent
    hide-overlay
    bottom
  >
    <template v-slot:img="props">
      <v-img
        :gradient="`to bottom, ${barColor}`"
        v-bind="props"
      />
    </template>

    <!-- <v-divider class="mb-1" /> -->

    <v-list nav>
      <v-list-item>
        <v-list-item-avatar v-if="users.img">
          <v-img :src="users.img.url" />
        </v-list-item-avatar>
        <v-list-item-avatar
          v-else
          class="align-self-center"
          :color="$vuetify.theme.dark ? 'primary' : 'third'"
          contain
        >
          <!-- <v-img
            src="@/assets/logo-e-color (1).png"
            max-height="30"
          /> -->
          <span class="text-capitalize">{{ users.nickName.charAt(0) }}</span>
        </v-list-item-avatar>

        <v-list-item-content>
          <v-list-item-title class="font-spartan-small">
            <h3>
              {{ users.nickName }}
            </h3>
          </v-list-item-title>
          <v-list-item-subtitle
            class="font-spartan-small custome-font"
            v-text="users.email"
          />
        </v-list-item-content>

        <v-btn
          dark
          :color="$vuetify.theme.dark ? 'primary' : 'third'"
          icon
          class="ml-1"
          outlined
          small
          @click.stop="drawer = !drawer"
        >
          <v-icon>mdi-chevron-left</v-icon>
        </v-btn>
      </v-list-item>
    </v-list>

    <v-list
      expand
      nav
      :class="$vuetify.theme.dark ? 'height-max' : 'height-max'"
    >
      <!-- Style cascading bug  -->
      <!-- https://github.com/vuetifyjs/vuetify/pull/8574 -->
      <div />

      <template v-for="(item, i) in computedItems">
        <base-item-group
          v-if="item.children"
          :key="`group-${i}`"
          :item="item"
        >
          <!--  -->
        </base-item-group>

        <base-item
          v-else
          :key="`item-${i}`"
          :item="item"
        />
      </template>

      <!-- Style cascading bug  -->
      <!-- https://github.com/vuetifyjs/vuetify/pull/8574 -->
      <div />
    </v-list>

    <template #prepend>
      <v-list nav>
        <v-btn
          v-if="!drawer"
          icon
          outlined
          class="ml-3 mt-3"
          small
          :color="$vuetify.theme.dark ? 'primary' : 'third'"
          @click.stop="drawerBtn"
        >
          <v-icon dark>
            mdi-chevron-right
          </v-icon>
        </v-btn>
      </v-list>
    </template>
  </v-navigation-drawer>
</template>

<script>
// Utilities
  import { mapState } from "vuex"

  export default {
    name: "DashboardCoreDrawer",

    props: {
      expandOnHover: {
        type: Boolean,
        default: true,
      },
    },

    data: () => ({
      items: [
        {
          icon: "mdi-view-dashboard",
          title: "dashboard",
          to: "/",
        },
        {
          icon: "mdi-shopping-music",
          title: "Studio",
          to: "/studio",
        },
        {
          icon: "mdi-playlist-check",
          title: "category",
          to: "/category",
        },
        {
          icon: "mdi-account-group-outline",
          title: "ensiklo_live",
          to: "/classes",
        },

        {
          title: "ensiklo_vidio",
          icon: "mdi-clipboard-outline",
          to: "/class-vidio",
        },
        {
          title: "typography",
          icon: "mdi-format-font",
          to: "/components/typography",
        },
        {
          title: "icons",
          icon: "mdi-chart-bubble",
          to: "/components/icons",
        },
        {
          title: "google",
          icon: "mdi-map-marker",
          to: "/maps/google-maps",
        },
        {
          title: "notifications",
          icon: "mdi-bell",
          to: "/components/notifications",
        },
      ],
    }),

    computed: {
      ...mapState(["barColor", "barImage"]),
      drawer: {
        get () {
          return this.$store.state.drawer
        },
        set (val) {
          this.$store.commit("SET_DRAWER", (val = false))
        },
      },
      computedItems () {
        return this.items.map(this.mapItem)
      },
      users () {
        const Me = localStorage.getItem("ME")
        const users = JSON.parse(Me)

        return users
      },
      profile () {
        return {
          avatar: true,
          title: "EnsikloTari",
        }
      },
    },

    methods: {
      mapItem (item) {
        return {
          ...item,
          children: item.children ? item.children.map(this.mapItem) : undefined,
          title: this.$t(item.title),
        }
      },
      drawerBtn () {
        this.$store.state.drawer = !this.$store.state.drawer
      },
    },
  }
</script>

<style lang="sass">
@import '~vuetify/src/styles/tools/_rtl.sass'

#core-navigation-drawer
  .v-list-group__header.v-list-item--active:before
    opacity: .24

  .v-list-item
    &__icon--text,
    &__icon:first-child
      justify-content: center
      text-align: center
      width: 20px

      +ltr()
        margin-right: 24px
        margin-left: 12px !important

      +rtl()
        margin-left: 24px
        margin-right: 12px !important

  .v-list--dense
    .v-list-item
      &__icon--text,
      &__icon:first-child
        margin-top: 10px

  .v-list-group--sub-group
    .v-list-item
      +ltr()
        padding-left: 8px

      +rtl()
        padding-right: 8px

    .v-list-group__header
      +ltr()
        padding-right: 0

      +rtl()
        padding-right: 0

      .v-list-item__icon--text
        margin-top: 19px
        order: 0

      .v-list-group__header__prepend-icon
        order: 2

        +ltr()
          margin-right: 8px

        +rtl()
          margin-left: 8px
.custumize-light
  background-color: #fff !important
  font-family: 'Roboto', sans-serif !important
  font-weight: bold
  font-size: 20px
  height: 100% !important
.bg--light
  border-bottom: 1px double #fff !important
.bg--dark
  border-bottom: 1px double #848E84 !important
.on-hover
  overflow-y: hidden !important
// .height-max
//   height: 500px !important
.custumize-dark
  font-weight: bold
  font-family: 'Roboto', sans-serif !important
.custome-brad
  font-size: 20px !important
  color: #6B75AA !important

.theme--light
  .custome-title-name-email
    font-size: 9px !important
    color: #6B75AA !important
  .custome-title-name
    font-size: 10px !important
    color: #6B75AA !important
.theme--dark
  .custome-title-name-email
    font-size: 9px !important
    color: #ffff !important
  .custome-title-name
    font-size: 10px !important
    color: #ffff !important
.custome-font
  font-size: 8px
  color: black
</style>

<style>
.custumize-dark
  /* width */
  ::-webkit-scrollbar {
  width: 2px !important;
  background-color: #efefef;
}

/* Track */
::-webkit-scrollbar-track {
  box-shadow: inset 0 0 1px rgb(250, 243, 243);
  border-radius: 1px;
}

/* Handle */
::-webkit-scrollbar-thumb {
  background: #ede8e8;
  border-radius: 10px;
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: #dfd7d7;
}
.custumize-light
  /* width */
  ::-webkit-scrollbar {
  width: 2px !important;
  background-color: #efefef;
}

/* Track */
::-webkit-scrollbar-track {
  box-shadow: inset 0 0 1px rgb(250, 243, 243);
  border-radius: 1px;
}

/* Handle */
::-webkit-scrollbar-thumb {
  background: #ede8e8;
  border-radius: 10px;
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: #dfd7d7;
}
</style>
