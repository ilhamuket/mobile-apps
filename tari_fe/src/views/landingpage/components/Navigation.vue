<template>
  <div>
    <v-navigation-drawer
      v-model="drawer"
      app
      temporary
      dark
      src="@/assets/img/bgDrawer.jpg"
    >
      <v-list>
        <v-list-item>
          <v-list-item-avatar>
            <img
              src="@/assets/img/logo1.png"
              alt="Logo"
            >
          </v-list-item-avatar>
          <v-list-item-content>
            <v-list-item-title class="">
              Calango
            </v-list-item-title>
            <v-list-item-subtitle>WEB</v-list-item-subtitle>
          </v-list-item-content>
        </v-list-item>
      </v-list>

      <v-divider />

      <v-list dense>
        <v-list-item
          v-for="([icon, text, link], i) in items"
          :key="i"
          link
          @click="$vuetify.goTo(link)"
        >
          <v-list-item-icon class="justify-center">
            <v-icon>{{ icon }}</v-icon>
          </v-list-item-icon>
          <v-list-item-content>
            <v-list-item-title class="subtitile-1">
              {{ text }}
            </v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>

    <v-app-bar
      app
      :color="color"
      :flat="flat"
      dark
      class="px-15"
      :class="{ expand: flat }"
    >
      <v-toolbar-title>
        <v-img
          class="mt-4"
          src="@/assets/img/ensiklotari.png"
          width="90px"
          height="79px"
        />
      </v-toolbar-title>
      <v-spacer class="ml-12" />
      <v-spacer class="ml-12" />
      <v-spacer class="ml-12" />
      <v-spacer class="ml-12" />
      <v-spacer class="ml-12" />
      <v-spacer class="ml-12" />
      <v-spacer class="ml-12" />
      <v-spacer />
      <v-col
        class="ml-12"
        offset="4"
      >
        <v-toolbar-title class="mt-6 ml-12">
          <v-select
            v-model="$i18n.locale"
            dense
            class="ml-12"
            :items="lenguage"
            item-text="name"
            item-value="name"
            width="20"
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
        </v-toolbar-title>
      </v-col>

      <v-spacer />
      <v-app-bar-nav-icon
        v-if="isXs"
        class="mr-4"
        @click.stop="drawer = !drawer"
      />

      <div v-else>
        <v-btn
          v-if="!pageLogin"
          text
          @click="$vuetify.goTo('#hero')"
        >
          <span class="mr-2 font-roboto">{{ $t('landingPage.home') }}</span>
        </v-btn>
        <v-btn
          v-if="!pageLogin"
          text
          @click="$vuetify.goTo('#features')"
        >
          <span class="mr-2">{{ $t('landingPage.about_us') }}</span>
        </v-btn>
        <!-- <v-btn
          text
          @click="$vuetify.goTo('#download')"
        >
          <span class="mr-2">Event</span>
        </v-btn> -->
        <v-btn
          v-if="!pageLogin"
          text
          @click="$vuetify.goTo('#pricing')"
        >
          <span class="mr-2 font-roboto">{{ $t('landingPage.pricing') }}</span>
        </v-btn>
        <v-btn
          v-if="!pageLogin"
          text
          @click="$vuetify.goTo('#contact')"
        >
          <span class="mr-2">{{ $t('landingPage.contact') }}</span>
        </v-btn>
        <v-btn
          v-if="!pageLogin"
          rounded
          outlined
          text
          to="/login"
        >
          <span class="mr-2">{{ $t('login') }} </span>
        </v-btn>
        <v-btn
          v-if="pageLogin"
          class="mt-2"
          rounded
          outlined
          text
          to="/landingpage"
        >
          <span class="mr-2">Home</span>
        </v-btn>
      </div>
    </v-app-bar>
  </div>
</template>

<style scoped>
.v-toolbar {
  transition: 0.6s;
}

.expand {
  height: 80px !important;
  padding-top: 10px;
}
</style>

<script>
  export default {
    props: {
      color: {
        type: String,
        default: '#DD5B87',
      },
      flat: Boolean,
      pageLogin: {
        type: Boolean,
        default: false,
      },
    },
    data: () => ({
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
      drawer: null,
      isXs: false,
      items: [
        ['mdi-home-outline', 'Home', '#hero'],
        ['mdi-information-outline', 'Sobre', '#features'],
        // ['mdi-download-box-outline', 'Download', '#download'],
        ['mdi-currency-usd', 'Preços', '#pricing'],
        ['mdi-email-outline', 'Contatos', '#contact'],
      ],
    }),

    watch: {
      isXs (value) {
        if (!value) {
          if (this.drawer) {
            this.drawer = false
          }
        }
      },
    },
    mounted () {
      this.onResize()
      window.addEventListener('resize', this.onResize, { passive: true })
    },
    methods: {
      onResize () {
        this.isXs = window.innerWidth < 850
      },
    },
  }
</script>

<style lang="sass">
@import url('https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap')
.font-roboto
  font-family: 'Roboto', sans-serif !important
.font-roboto-thin
  font-family: 'Roboto', sans-serif !important
  // background-color: red
</style>
