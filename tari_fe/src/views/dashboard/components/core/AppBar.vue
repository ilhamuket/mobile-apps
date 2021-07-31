<template>
  <v-app-bar
    id="app-bar"
    absolute
    app
    color="transparent"
    flat
    height="75"
  >
    <v-btn
      class="ml-3"
      elevation="1"
      fab
      small
      @click="setDrawer(!drawer)"
    >
      <v-icon v-if="value">
        mdi-view-quilt
      </v-icon>

      <v-icon v-else>
        mdi-dots-vertical
      </v-icon>
    </v-btn>

    <v-toolbar-title
      class="hidden-sm-and-down font-weight-light"
      v-text="$route.name"
    />

    <v-spacer />

    <div class="mx-3" />

    <v-menu
      bottom
      left
      offset-y
      origin="top right"
      transition="scale-transition"
    >
      <template v-slot:activator="{ attrs, on }">
        <v-btn
          class="ml-2"
          min-width="0"
          text
          v-bind="attrs"
          v-on="on"
        >
          <v-badge
            color="red"
            overlap
            bordered
          >
            <template v-slot:badge>
              <span>5</span>
            </template>

            <v-icon>mdi-bell</v-icon>
          </v-badge>
        </v-btn>
      </template>

      <v-list
        :tile="false"
        nav
      >
        <v-list-item-group v-model="notify">
          <v-list-item
            v-for="(n, i) in notifications"
            :key="`item-${i}`"
            class="overflow-y"
          >
            <v-list-item-title v-text="n" />
          </v-list-item>
        </v-list-item-group>
      </v-list>
    </v-menu>

    <v-switch
      v-model="$vuetify.theme.dark"
      :prepend-icon="
        $vuetify.theme.dark ? 'mdi-theme-light-dark' : 'mdi-white-balance-sunny'
      "
      class="ma-0 pa-0 ml-5"
      color="success"
      hide-details
    />

    <v-menu
      bottom
      class="mr-3 rounded-pill"
      left
      offset-y
      origin="top right"
      max-width="1000px"
      transition="scale-transition"
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
            color="primary"
            size="36"
          >
            <!-- <span class="white--text text-h5">{{ profile.initials }}</span> -->
            <v-img
              class="bg-img"
              src="https://image.shutterstock.com/image-vector/user-login-authenticate-icon-human-260nw-1365533969.jpg"
            />
          </v-list-item-avatar>
          Hi, {{ fullName }}
        </v-chip>
      </template>

      <v-list>
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
              <v-list-item-title v-text="item.text" />
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
  import { mapState, mapMutations } from 'vuex'

  export default {
    name: 'DashboardCoreAppBar',

    components: {
    // AppBarItem: {
    //   render (h) {
    //     return h(VHover, {
    //       scopedSlots: {
    //         default: ({ hover }) => {
    //           return h(
    //             VListItem,
    //             {
    //               attrs: this.$attrs,
    //               class: {
    //                 'black--text': !hover,
    //                 'white--text secondary elevation-12': hover,
    //               },
    //               props: {
    //                 activeClass: '',
    //                 dark: hover,
    //                 link: true,
    //                 ...this.$attrs,
    //               },
    //             },
    //             this.$slots.default,
    //           )
    //         },
    //       },
    //     })
    //   },
    // },
    },

    props: {
      value: {
        type: Boolean,
        default: false,
      },
    },

    data: () => ({
      notifications: [
        'Mike John Responded to your email',
        'You have 5 new tasks',
        "You're now friends with Andrew",
        'Another Notification',
        'Another one',
      ],
      notify: false,
      model: null,
      items: [
        {
          icon: 'mdi-wifi',
          text: 'Setting',
          to: '/pages/user',
        },
        {
          icon: 'mdi-bluetooth',
          text: 'Bluetooth',
          to: '/index/announcement',
        },
        {
          icon: 'mdi-logout',
          text: 'Logout',
          to: '/logout',
        },
      ],
    }),

    computed: {
      ...mapState(['drawer']),
      users () {
        const me = localStorage.getItem('ME')
        const users = JSON.parse(me)

        return users
      },
      fullName () {
        return (
          this.$store.state.user.me.firstName +
          ' ' +
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
    },

    created () {
      this.getMe()
    // console.log(this.$vuetify.breakpoint.smAndDown)
    },
    methods: {
      ...mapMutations({
        setDrawer: 'SET_DRAWER',
      }),
      getMe () {
        this.$store.dispatch('user/me')
      },
    },
  }
</script>

<style lang="sass" scoped>
.bg-img
  color: red !important
</style>
