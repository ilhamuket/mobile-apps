<template>
  <v-app-bar
    id="app-bar"
    absolute
    app
    :color="$vuetify.theme.dark ? 'secondary' : 'pallet1'"
    flat
    height="75"
  >
    <v-btn
      v-if="$vuetify.breakpoint.mdAndDown && !drawer"
      outlined
      elevation="1"
      :color="$vuetify.theme.dark ? 'pallet1' : 'primary'"
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
    <div class="mr-2" />

    <v-toolbar-title
      class="hidden-sm-and-down font-weight-light font-size-ather-roboto-mono-name-page"
      :class="!drawer ? 'ml-6' : ''"
      v-text="$route.name"
    />

    <v-spacer />
    <v-toolbar-title
      class="ml-12"
      dark
    >
      <v-img
        src="@/assets/img/ensiklotariLogo.svg"
        width="100"
        class="bg-red"
      />
      <!-- <v-list-item-title class="font-title-rampart-one custome-brad">
        <h3>
          ENSIKLOTARI
        </h3>
      </v-list-item-title> -->
    </v-toolbar-title>
    <v-spacer />
    <v-menu
      bottom
      class="mr-12 rounded-pill"
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
            color="primary"
            size="36"
          >
            <!-- <span class="white--text text-h5">{{ profile.initials }}</span> -->
            <v-img
              class="bg-img"
              src="https://image.shutterstock.com/image-vector/user-login-authenticate-icon-human-260nw-1365533969.jpg"
            />
          </v-list-item-avatar>
          Hi, {{ users.nickName }}
        </v-chip>
      </template>

      <v-list>
        <v-list-item class="d-flex justify-center">
          <v-list-item-avatar>
            <v-img src="https://cdn.vuetifyjs.com/images/john.png" />
          </v-list-item-avatar>
        </v-list-item>
        <v-list-item
          class="d-flex justify-center"
          link
        >
          <v-list-item-content>
            <v-list-item-title class="text-h5 font-spartan text-center">
              John Leider
            </v-list-item-title>
            <v-list-item-subtitle class="text-h6 font-spartan text-center">
              john@vuetifyjs.com
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
  import { mapState, mapMutations } from 'vuex'

  export default {
    name: 'DashboardCoreAppBar',

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
      lenguage: [
        {
          name: 'en',
          img:
            'https://media.istockphoto.com/vectors/flag-of-great-britain-vector-id497118178?s=612x612',
        },
        {
          name: 'id',
          img:
            'https://upload.wikimedia.org/wikipedia/commons/9/9f/Flag_of_Indonesia.svg',
        },
      ],
      items: [
        {
          icon: 'mdi-account-outline',
          text: 'myaccount',
          to: '/user/myaccount',
        },
        {
          icon: 'mdi-account',
          text: 'user',
          to: '/user/settings',
        },
        // {
        //   icon: 'mdi-bluetooth',
        //   text: 'Bluetooth',
        //   to: '/index/announcement',
        // },
        {
          icon: 'mdi-logout',
          text: 'logout',
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

    mounted () {
      this.getMe()
      const theme = localStorage.getItem('dark_theme')
      if (theme === 'true') {
        this.$vuetify.theme.dark = true
      } else {
        this.$vuetify.theme.dark = false
      }
    },
    methods: {
      ...mapMutations({
        setDrawer: 'SET_DRAWER',
      }),
      toogle_dark_theme () {
        localStorage.setItem('dark_theme', this.$vuetify.theme.dark.toString())
      },
      getMe () {
        this.$store.dispatch('user/me')
      },
    },
  }
</script>
