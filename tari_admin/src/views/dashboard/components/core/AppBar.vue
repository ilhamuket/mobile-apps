<template>
  <v-app-bar
    id="app-bar"
    class="modified"
    absolute
    app
    :color="$vuetify.theme.dark ? '#283046' : '#E8F0F3'"
    flat
    height="75"
    elevation="3"
  >
    <v-toolbar-title
      class="mr-12"
      dark
    >
      <v-img
        src="@/assets/img/ensiklotariLogo.svg"
        width="120"
        class="bg-red mr-12"
      />
    </v-toolbar-title>
    <v-spacer />

    <v-col cols="2">
      <div class="d-flex flex-row mt-6 mr-2">
        <div class="d-flex flex-column justify-start ml-6">
          <v-select
            v-model="$i18n.locale"
            outlined
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

    <!-- <v-menu
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
          >
            <v-list-item-title v-text="n" />
          </v-list-item>
        </v-list-item-group>
      </v-list>
    </v-menu> -->

    <v-switch
      v-model="$vuetify.theme.dark"
      :prepend-icon="
        $vuetify.theme.dark ? 'mdi-theme-light-dark' : 'mdi-white-balance-sunny'
      "
      class="ma-0 pa-0 ml-5"
      color="success"
      hide-details
      @click="toogle_dark_theme"
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
      lenguage: [
        {
          name: 'en',
          img: 'https://media.istockphoto.com/vectors/flag-of-great-britain-vector-id497118178?s=612x612',
        },
        {
          name: 'id',
          img: 'https://upload.wikimedia.org/wikipedia/commons/9/9f/Flag_of_Indonesia.svg',
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

    created () {
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
      getMe () {
        this.$store.dispatch('user/me')
      },
      toogle_dark_theme () {
        localStorage.setItem('dark_theme', this.$vuetify.theme.dark.toString())
      },
      translet (item) {
        return this.$t(item)
      },
    },
  }
</script>

<style lang="sass">
.modified
  border-radius: 10px !important
  margin-left: 57px !important
  margin-right: 27px !important
  margin-top: 21px !important
.bg-red
 color: red !important
</style>
