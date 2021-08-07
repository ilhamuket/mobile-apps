<template>
  <v-app>
    <navigation
      :color="color"
      :flat="flat"
    />
    <v-main class="pt-0">
      <home />
      <about />
      <!-- <download /> -->
      <pricing />
      <contact />
    </v-main>
    <v-scale-transition>
      <v-btn
        v-show="fab"
        v-scroll="onScroll"
        fab
        dark
        fixed
        bottom
        right
        color="secondary"
        @click="toTop"
      >
        <v-icon>mdi-arrow-up</v-icon>
      </v-btn>
    </v-scale-transition>
    <foote />
  </v-app>
</template>

<style scoped>
.v-main {
  background-image: url('~@/assets/img/bgMain.png');
  background-attachment: fixed;
  background-position: center;
  background-size: cover;
}
</style>

<script>
  import navigation from './components/Navigation.vue'
  import foote from './components/Footer.vue'
  import home from './components/HomeSection.vue'
  import about from './components/AboutSections.vue'
  //   import download from './components/DonwloadSection.vue'
  import pricing from './components/PricingSection.vue'
  import contact from './components/ContactSection.vue'

  export default {
    name: 'App',

    components: {
      navigation,
      foote,
      home,
      about,
      //   download,
      pricing,
      contact,
    },

    data: () => ({
      fab: null,
      color: '',
      flat: null,
    }),

    watch: {
      fab (value) {
        if (value) {
          this.color = 'landingpage'
          this.flat = false
        } else {
          this.color = 'transparent'
          this.flat = true
        }
      },
    },

    created () {
      const top = window.pageYOffset || 0
      if (top <= 60) {
        this.color = 'transparent'
        this.flat = true
      }
    },

    methods: {
      onScroll (e) {
        if (typeof window === 'undefined') return
        const top = window.pageYOffset || e.target.scrollTop || 0
        this.fab = top > 60
      },
      toTop () {
        this.$vuetify.goTo(0)
      },
    },
  }
</script>
