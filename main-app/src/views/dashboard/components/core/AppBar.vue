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

    <v-col
      cols="12"
      md="3"
      class="mt-6 ml-2 col--searching"
    >
      <v-form @submit.enter.prevent="searching">
        <v-text-field
          v-model="search"
          outlined
          :placeholder="$t('type')"
          class="ml-12"
          dense
          append-icon="mdi-magnify"
          :label="$t('search')"
        />
      </v-form>
    </v-col>

    <v-col
      cols="12"
      md="2"
    >
      <div class="d-flex flex-row mt-6 mr-2">
        <div class="d-flex flex-column justify-start ml-6">
          <v-select
            v-model="$i18n.locale"
            dense
            class="ml-9 icon__len"
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
                  text-color="btn_primary"
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
                  text-color="black"
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
          :text-color="$vuetify.theme.dark ? 'white' : 'btn_primary'"
          outlined
          v-bind="attrs"
          style="text-transform: capitalize"
          v-on="on"
        >
          <v-list-item-avatar
            v-if="dataUser.img"
            size="36"
          >
            <v-img
              class="bg-img"
              :src="dataUser.img.url"
            />
          </v-list-item-avatar>
          <v-list-item-avatar
            v-else
            color="primary"
            size="36"
          >
            <span class="pallet1--text text-h5">{{
              users.nickName.charAt(0)
            }}</span>
          </v-list-item-avatar>
          Hi, {{ user.nickName }}
        </v-chip>
      </template>

      <v-list>
        <v-list-item class="d-flex justify-center">
          <v-list-item-avatar v-if="dataUser.img">
            <v-img :src="dataUser.img.url" />
          </v-list-item-avatar>
          <v-list-item-avatar
            v-else
            color="secondary"
            size="36"
          >
            <span class="pallet1--text text-h5">{{
              users.nickName.charAt(0)
            }}</span>
          </v-list-item-avatar>
        </v-list-item>
        <v-list-item
          class="d-flex justify-center"
          link
          to="pages/user"
        >
          <v-list-item-content>
            <v-list-item-title
              class="text-h5 font-spartan text-center text-capitalize"
            >
              {{ users.nickName }}
            </v-list-item-title>
            <v-list-item-subtitle class="text-h6 font-spartan text-center">
              {{ users.email }}
            </v-list-item-subtitle>
          </v-list-item-content>
        </v-list-item>
        <v-divider />
        <v-list-item-group
          v-model="model"
          active-class="border"
          color="red"
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
              <v-badge
                v-if="item.badge"
                color="pink"
                :content="String(item.content)"
              >
                <v-icon v-text="item.icon" />
              </v-badge>
              <v-icon
                v-else
                v-text="item.icon"
              />
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
// import idL from 'moment/locale/id'
// import esL from 'moment/locale/es'
// import 'moment/locale/fr'
// import 'moment/locale/en-gb'
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
      dataUser: {
        cart: [],
        img: {},
      },
      notify: false,
      model: null,
      len: "en",
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
          to: "/pages/user/profile",
          badge: false,
        },
        {
          icon: "mdi-cart",
          text: "cart_video",
          to: "/cart",
          badge: true,
          content: "0",
        },
        {
          icon: "mdi-cart",
          text: "cart",
          to: "/cart",
          badge: true,
          content: "0",
        },
        {
          icon: "mdi-cart-variant",
          text: "me_ensiklovidio",
          to: "/me/ensiklovideo",
          badge: true,
          content: "0",
        },
        {
          icon: "mdi-cart-variant",
          text: "my_class",
          to: "/me/class",
          badge: true,
          content: "0",
        },
        {
          icon: "mdi-account-group-outline",
          text: "history_class",

          badge: false,
        },
        {
          icon: "mdi-mail",
          text: "review",

          badge: false,
        },
        {
          icon: "mdi-logout",
          text: "logout",
          to: "/logout",
          badge: false,
        },
      ],
      search: "",
    }),

    computed: {
      ...mapState(["drawer"]),
      user () {
        return this.$store.state.user.me
      },

      users () {
        const me = localStorage.getItem("ME")
        const users = JSON.parse(me)

        return users
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
      cart () {
        return this.$store.state.cart.data
      },
    },
    watch: {},

    mounted () {
      this.getMe()
      this.firstLoad()
      this.getDataCart()
    },

    methods: {
      searching () {
        console.log(this.search)
      },
      setLanguage (lang) {
        // console.log(lang)
        this.$moment().locale(lang)
      // console.log(this.$moment().locale(lang), 'hai')
      },
      getDataCart () {
        this.$store
          .dispatch("cart/getDataCart", {
            entities: "user,class.studio, class.category, class.img",
            type: "cart",
          })
          .then((res) => {
            if (res.data.meta.status) {
            // const index = this.items.findIndex((x) => x.text === "cart")
            // this.items[index].content = res.data.data.length
            }
          })
      },

      ...mapMutations({
        setDrawer: "SET_DRAWER",
      }),
      toogle_dark_theme () {
        localStorage.setItem("dark_theme", this.$vuetify.theme.dark.toString())
      },
      toggle_theme () {
        localStorage.setItem("dark_theme", this.$vuetify.theme.dark.toString())
      },
      firstLoad () {
        const theme = localStorage.getItem("dark_theme")
        if (theme === "true") {
          this.$vuetify.theme.dark = true
        } else {
          this.$vuetify.theme.dark = false
        }
      },
      getMe () {
        this.$store
          .dispatch("user/me", {
            entities: "cart,myClass,img",
          })
          .then((res) => {
            if (res.data.meta.status) {
              this.dataUser = res.data.data

              const index = this.items.findIndex((x) => x.text === "cart")
              const cartActive = this.dataUser.cart.filter(
                (x) => x.status !== "paid",
              )
              this.items[index].content = cartActive.length

              const findMyClass = this.items.findIndex(
                (x) => x.text === "my_class",
              )
              this.items[findMyClass].content = this.dataUser.my_class.length
            }
          })
      },
    },
  }
</script>
<style lang="sass">
.card--margin
  margin-right: 200px
.font-customize
  font-style: italic
.modified
  border-radius: 10px !important
  margin-left: 57px !important
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
<style lang="sass" scoped>
.v-list
  background-color: white !important
  color: green !important
.col--searching
  margin-right: -5% !important
</style>
