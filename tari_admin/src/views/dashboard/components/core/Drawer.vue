<template>
  <v-navigation-drawer
    id="core-navigation-drawer"
    v-model="drawer"
    color="#141C31"
    class="on-hover overflow--hide"
    :mini-variant="!drawer"
    :right="$vuetify.rtl"
    :class="
      $vuetify.theme.dark
        ? 'custumize-dark height-max'
        : 'custumize-light height-max'
    "
    mobile-breakpoint="960"
    app
    width="260"
    v-bind="$attrs"
    permanent
  >
    <template v-slot:img="props">
      <v-img
        :gradient="`to bottom, ${barColor}`"
        v-bind="props"
      />
    </template>

    <v-list
      dense
      nav
      :class="drawer ? '' : 'drawer--active'"
    >
      <v-list-item>
        <v-list-item-avatar
          class="align-self-center"
          color="white"
          contain
        >
          <v-img
            src="https://eshendetesia.com/images/user-profile.png"
            max-height="40"
          />
          <!-- <span v-if="profile">{{ profile.initials }}</span> -->
        </v-list-item-avatar>

        <v-list-item-content>
          <v-list-item-title
            class="text-capitalize"
            v-text="profile.title"
          />
          <v-list-item-subtitle
            class="text-capitalize"
            v-text="users.role_name"
          />
        </v-list-item-content>

        <v-btn
          dark
          color="pallet1"
          icon
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
      class="height-max"
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
          :color="$vuetify.theme.dark ? 'white' : 'black'"
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
  import { mapState } from 'vuex'

  export default {
    name: 'DashboardCoreDrawer',

    props: {
      expandOnHover: {
        type: Boolean,
        default: false,
      },
    },

    data: () => ({
      items: [
        {
          icon: 'mdi-view-dashboard',
          title: 'menu',
          to: '/',
        },
        {
          icon: 'mdi-cart',
          title: 'Payment / Monetisasi',
          to: '/payment',
        },
        {
          icon: 'mdi-account',
          title: 'users',
          to: '/user?summary=',
        },
        {
          icon: 'mdi-shopping-music',
          title: 'studio',
          to: '/studio?summary=',
        },
        {
          icon: 'mdi-notebook-outline',
          title: 'plan',
          to: '/plan?summary=',
        },
        {
          icon: 'mdi-cart',
          title: 'transaction_live',
          to: '/transaction-live',
        },
        {
          icon: 'mdi-cart',
          title: 'transaction_video',
          to: '/transaction-video',
        },
        {
          icon: 'mdi-notebook-multiple',
          title: 'journal',
          to: '/journal',
        },

        {
          title: 'class',
          icon: 'mdi-google-classroom',
          to: '/class',
        },
        {
          icon: 'mdi-shape-outline',
          title: 'category',
          to: '/category',
        },
        {
          icon: 'mdi-view-dashboard-variant-outline',
          title: 'dashboard',
          to: '/dashboard',
        },

        {
          icon: 'mdi-account',
          title: 'user',
          to: '/user/settings',
        },

        {
          title: 'google',
          icon: 'mdi-map-marker',
          to: '/maps/google-maps',
        },
        {
          icon: 'mdi-notebook',
          title: 'journal_page',
          to: '/u/journal',
        },
      ],
      itemsAdmin: [],
    }),

    computed: {
      ...mapState(['barColor', 'barImage']),
      drawer: {
        get () {
          return this.$store.state.drawer
        },
        set (val) {
          this.$store.commit('SET_DRAWER', (val = false))
        },
      },
      filterAdmin () {
        // const Me = localStorage.getItem('ME')
        const users = this.users
        if (users.role) {
          return users.role.some((x) => x.name === 'superadministrator')
        }

        return false
      },
      computedItems () {
        return this.items.map(this.mapItem)
      },
      computedItemsForAdmin () {
        return this.itemsAdmin.map(this.mapItemAdmin)
      },
      profile () {
        return {
          avatar: true,
          title: this.users.firstName + ' ' + this.users.lastName,
        }
      },
      users () {
        return this.$store.state.user.me
      },
    },

    mounted () {
      this.getMe()
    },
    methods: {
      mapItem (item) {
        return {
          ...item,
          children: item.children ? item.children.map(this.mapItem) : undefined,
          title: this.$t(item.title),
        }
      },
      mapItemAdmin (item) {
        return {
          ...item,
          children: item.children
            ? item.children.map(this.mapItemAdmin)
            : undefined,
          title: this.$t(item.title),
        }
      },
      getMe () {
        this.$store.dispatch('user/me')
      },
      drawerBtn () {
        this.$store.state.drawer = !this.$store.state.drawer
      },
    },
  }
</script>

<style lang="sass">
@import '~vuetify/src/styles/tools/_rtl.sass'
@import url('https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap')
.v-navigation-drawer--mini-variant
  width: 100px !important
#core-navigation-drawer
  .v-list-group__header.v-list-item--active:before
    opacity: .3
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
        margin-left: 10px

  .v-list-group--sub-group
    .v-list-item
      +ltr()
        padding-left: 8px

      +rtl()
        padding-right: 80px

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
.bg--light
  border-bottom: 1px double #fff !important
.bg--dark
  border-bottom: 1px double #848E84 !important
on-hover
  overflow-y: hidden !important
.custumize-dark
  font-weight: bold
  font-family: 'Roboto', sans-serif !important
.text-capitalize
  text-transform: capitalize
.height-max
  height: 100vh !important
  overflow: auto
.overflow--hide
  height: 100vh !important
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
</style>
