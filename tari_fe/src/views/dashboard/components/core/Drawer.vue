<template>
  <v-navigation-drawer
    id="core-navigation-drawer"
    v-model="drawer"
    class="on-hover"
    :expand-on-hover="drawer === false"
    :right="$vuetify.rtl"
    :class="$vuetify.theme.dark ? 'custumize-dark' : 'custumize-light'"
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
      :class="$vuetify.theme.dark ? 'bg--dark' : 'bg--light'"
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
      </v-list-item>
    </v-list>

    <v-list
      v-if="users && filterAdmin"
      expand
      nav
      :class="$vuetify.theme.dark ? 'bg--dark' : 'bg--light'"
    >
      <!-- Style cascading bug  -->
      <!-- https://github.com/vuetifyjs/vuetify/pull/8574 -->

      <template v-for="(item, i) in computedItemsForAdmin">
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

    <v-list
      expand
      nav
      :class="
        $vuetify.theme.dark ? 'bg--dark height-max' : 'bg--light height-max'
      "
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

    <!-- <template v-slot:append>
      <base-item
        :item="{
          title: $t('logout'),
          icon: 'mdi-logout',
          to: '/logout',
        }"
      />
    </template> -->
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
          icon: 'mdi-view-dashboard-variant-outline',
          title: 'dashboard',
          to: '/dashboard',
        },
        {
          icon: 'mdi-view-dashboard',
          title: 'menu',
          to: '/',
        },
        {
          icon: 'mdi-account',
          title: 'user',
          to: '/pages/user',
        },
        {
          title: 'rtables',
          icon: 'mdi-clipboard-outline',
          to: '/tables/regular-tables',
        },
        {
          title: 'typography',
          icon: 'mdi-format-font',
          to: '/components/typography',
        },
        {
          title: 'icons',
          icon: 'mdi-chart-bubble',
          to: '/components/icons',
        },
        {
          title: 'google',
          icon: 'mdi-map-marker',
          to: '/maps/google-maps',
        },
        {
          title: 'notifications',
          icon: 'mdi-bell',
          to: '/components/notifications',
        },
      ],
      itemsAdmin: [
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
      ],
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
          return users.role.some(x => x.name === 'superadmin')
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
    },
  }
</script>

<style lang="sass">
@import '~vuetify/src/styles/tools/_rtl.sass'
.v-navigation-drawer--mini-variant
  width: 90px !important
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
  font-weight: bold
  font-size: 20px
  height: 100% !important
.bg--light
  background-color: #F0F2F5 !important
  border-bottom: 1px double #fff !important
.bg--dark
  background-color: #121212 !important
  border-bottom: 1px double #848E84 !important
on-hover
  overflow-y: hidden !important
.height-max
  height: 100%
.custumize-dark
  font-weight: bold
.text-capitalize
  text-transform: capitalize
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
