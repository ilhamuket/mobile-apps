<template>
  <v-container>
    <v-row v-if="$store.state.studioPopuler.load_data">
      <!-- <loader
        object="#ff9633"
        color1="#ffffff"
        color2="#17fd3d"
        size="5"
        speed="2"
        bg="#343a40"
        objectbg="#999793"
        opacity="80"
        disable-scrolling="false"
        name="dots"
      /> -->
      <v-col>
        <v-skeleton-loader type="card-avatar, article, actions" />
      </v-col>
    </v-row>
    <v-row v-else>
      <v-col
        cols="12"
        md="8"
        class="mx-auto"
      >
        <v-card>
          <v-card-text class="text-center text-capitalize font-spartan">
            Hi, {{ users.nickName }}
          </v-card-text>
        </v-card>
      </v-col>
      <v-col cols="12">
        <v-card-title class="">
          <span class="text-capitalize text-center mx-auto font-spartan">
            {{ $t("dahsboard.cds") }}
          </span>
        </v-card-title>
        <v-divider class="divider--opacity mt-2 mb-2" />
        <v-card-text>
          <v-row class="ml-6">
            <app-list-populer-studio :studio="studio" />
          </v-row>
          <v-row>
            <v-col
              cols="12"
              class="d-flex justify-end"
            >
              <span
                style="cursor: pointer"
                class="font-spartan-small hover--text font-weight-bold"
                @click="toPush('/studio')"
              >
                {{ $t("dahsboard.see") }} <v-icon>mdi-chevron-right</v-icon>
              </span>
            </v-col>
          </v-row>
        </v-card-text>
      </v-col>
      <v-col
        cols="12"
        md="12"
        sm="12"
        lg="12"
      >
        <v-card-title>
          <span class="text-capitalize text-center mx-auto font-spartan">
            {{ $t("dahsboard.cls") }}
          </span>
        </v-card-title>
        <v-divider class="divider--opacity mt-2 mb-2" />
        <v-card-text>
          <v-row class="ml-6">
            <app-list-populer-ensiklolive :classes="classes" />
          </v-row>
          <v-row>
            <v-col
              cols="12"
              class="d-flex justify-end"
            >
              <span
                class="font-spartan-small hover--text font-weight-bold"
                style="cursor: pointer"
                @click="toPush('/classes')"
              >
                {{ $t("dahsboard.see") }} <v-icon>mdi-chevron-right</v-icon>
              </span>
            </v-col>
          </v-row>
        </v-card-text>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
  import listSTudio from "./component/_listPopulerStudio.vue"
  import listEnsikloLive from "./component/_listPopulerEnsiklolive.vue"
  export default {
    components: {
      "app-list-populer-studio": listSTudio,
      "app-list-populer-ensiklolive": listEnsikloLive,
    },
    data: () => ({
      is_load: true,
    }),
    computed: {
      users () {
        const Me = localStorage.getItem("ME")
        const users = JSON.parse(Me)

        return users
      },
      studio () {
        return this.$store.state.studioPopuler.data
      },
      classes () {
        return this.$store.state.classesPopuler.data
      },
    },
    mounted () {
      this.getDataMostPopuler()
      this.getDataPopulerClasses()
    },
    methods: {
      getDataMostPopuler () {
        this.$store
          .dispatch("studioPopuler/getDataMostPopuler", {
            entities: "img, followers, likes,reviews",
          })
          .then((res) => {
            if (res.data.meta.status) {
              this.is_load = false
              this.$store.commit("studioPopuler/LOAD")
            }
          })
      },
      getDataPopulerClasses () {
        this.$store.dispatch("classesPopuler/getDataPopulerClasses", {
          entities: "category, img,studio",
        })
      },
      toPush (link) {
        this.$router.push(link)
      },
    },
  }
</script>

<style lang="sass">
a
  text-decoration: underline
.theme--dark
  .divider--opacity
    opacity: .2
.mt-g
  margin-top: -200px
.col__
  margin-top: -20px
.card__titleImg
  margin-top: 100px
  // width: 90px !important
  .v-chip__content
    margin-left: 8px !important
    font-size: 20px
    font-weight: 900 !important
.font__price
  font-weight: 900
  font-size: 1.6rem
  color: orange !important
.hover--text
  &:hover
    color: #4CAF50 !important
</style>
