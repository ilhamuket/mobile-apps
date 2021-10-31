<template>
  <div>
    <!-- -----------------------------------------------
          Start Header
    ----------------------------------------------- -->
    <v-app-bar app absolute class="app-header" flat elevate-on-scroll>
      <v-container class="py-0 fill-height">
        <!-- Logo -->
        <Logo />

        <v-spacer></v-spacer>
        <v-btn class="d-block d-md-none" text @click="toggleClass()">
          <v-app-bar-nav-icon class="white--text" />
        </v-btn>
        <!-- Desktop view Navigation -->
        <div
          class="navigation"
          v-bind:class="[isActive ? 'd-block' : '']"
          @click="isActive = !isActive"
        >
          <ul class="navbar-nav">
            <li class="nav-item" text>
              <a href="#what" class="headers__sanggar"> Sanggar </a>
            </li>
            <li>
              <v-menu>
                <template v-slot:activator="{ on: menu, attrs }">
                  <v-tooltip bottom>
                    <template v-slot:activator="{ on: tooltip }">
                      <a
                        color="white"
                        dark
                        class="headers__sanggar"
                        v-bind="attrs"
                        text
                        v-on="{ ...tooltip, ...menu }"
                      >
                        Lain-nya
                      </a>
                    </template>
                    <span>Im A ToolTip</span>
                  </v-tooltip>
                </template>
                <v-list>
                  <v-list-item-group>
                    <v-list-item v-for="(item, index) in items" :key="index" :href="item.id">
                      <v-list-item-title>{{
                        item.title
                      }}</v-list-item-title>
                    </v-list-item>
                  </v-list-item-group>
                </v-list>
              </v-menu>
            </li>
            <li class="nav-item" text>
              <a
                color="white"
                nuxt
                text
                class="headers__sanggar"
                target="_blank"
                href="https://studio.ensiklotari.com"
                elevation="0"
              >
                Masuk-Sanggar
              </a>
            </li>
            <li class="nav-item">
              <!-- login-regiter -->
              <a
                color="white"
                nuxt
                class="headers__sanggar"
                text
                target="_blank"
                href="https://app.ensiklotari.com"
                elevation="0"
              >
                Masuk-Murid
              </a>
            </li>
          </ul>
        </div>
      </v-container>
    </v-app-bar>
    <!-- -----------------------------------------------
          End Header
    ----------------------------------------------- -->
  </div>
</template>

<script>
export default {
  name: "Header",

  components: {
    Logo: () => import("@/layouts/sections/Logo"),
  },
  data() {
    return {
      isActive: false,
      fav: true,
      menu: false,
      message: false,
      items: [
        { title: "keunggulan", id: "#keunggulan" },
        { title: "Fitur", id: "#fitur" },
        {title: "Payment", id: "#payment"},
        { title: "EnsikloLive", id: "#live" },
        { title: "EnsikloVidio", id: "#vidio" },
      ],
      hints: true,
    };
  },
  methods: {
    toggleClass: function (event) {
      this.isActive = !this.isActive;
      console.log("has");
    },
  },
};
</script>
<style lang="sass">
.headers__sanggar
  color: white !important
  text-decoration: none
  margin-left: 20px
</style>