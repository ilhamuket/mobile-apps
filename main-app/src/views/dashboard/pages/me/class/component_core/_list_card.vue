<template>
  <v-container>
    <v-row v-if="!isLoad">
      <v-col
        v-for="(item, i) in data.data"
        :key="i"
        cols="12"
        md="4"
      >
        <v-hover v-slot="{ hover }">
          <v-card
            v-if="item.classess"
            class="card__list"
            :elevation="hover ? 12 : 2"
            :class="{ 'on-hover': hover }"
            style="cursor: pointer"
          >
            <v-img
              v-if="item.classes.img"
              width="450"
              height="400"
              gradient="to top right, rgba(0,0,0,.33), rgba(0,0,0,.7)"
              style="background-color: grey"
              :src="item.classes.img.url"
            >
              <v-container>
                <v-row>
                  <v-col
                    cols="12"
                    class="d-flex flex-row-reverse"
                  >
                    <v-tooltip
                      color="btn_primary"
                      bottom
                    >
                      <template #activator="{ on, attrs }">
                        <v-icon
                          v-bind="attrs"
                          color="primary"
                          v-on="on"
                        >
                          mdi-share-variant
                        </v-icon>
                      </template>
                      <span
                        class="font-spartan-small white--text font-weight-bold"
                      >
                        Share
                      </span>
                    </v-tooltip>
                    <v-tooltip
                      color="btn_primary"
                      bottom
                    >
                      <template #activator="{ on, attrs }">
                        <v-icon
                          v-bind="attrs"
                          color="primary"
                          class="mr-2"
                          v-on="on"
                        >
                          mdi-video-check-outline
                        </v-icon>
                      </template>
                      <span
                        class="font-spartan-small white--text font-weight-bold"
                      >Room</span>
                    </v-tooltip>
                  </v-col>
                </v-row>
                <v-row class="row__list--myclass">
                  <v-col cols="12">
                    <span
                      class="font-spartan white--text font-weight-bold mb-2"
                    >
                      {{ item.classes.name }}
                    </span>
                    <br>
                    <span
                      v-if="item.classes.studio"
                      class="font-spartan white--text font-weight-bold mb-2"
                    >
                      {{ item.classes.studio.name }}
                    </span>
                    <br>
                    <v-btn
                      v-if="item.status_responded === null"
                      color="btn_primary"
                      small
                      :href="item.classes.url_meets"
                      target="__blank"
                      width="200"
                    >
                      <v-tooltip
                        color="primary"
                        bottom
                      >
                        <template #activator="{ on, attrs }">
                          <v-icon
                            v-bind="attrs"
                            color="white"
                            v-on="on"
                          >
                            mdi-video-check-outline
                          </v-icon>
                        </template>
                        <span
                          class="
                            font-spartan-small
                            white--text
                            font-weight-bold
                          "
                        >
                          Enter Zoom Class
                        </span>
                      </v-tooltip>
                    </v-btn>
                    <v-btn
                      v-else
                      color="btn_primary"
                      small
                      target="__blank"
                      width="200"
                      @click="toReviews('/pages/user/waiting-reviews')"
                    >
                      Reviews
                    </v-btn>
                    <v-btn
                      color="btn_primary"
                      small
                      width="90"
                      class="ml-2"
                    >
                      See Detail
                    </v-btn>
                  </v-col>
                </v-row>
              </v-container>
            </v-img>
          </v-card>
        </v-hover>
      </v-col>
    </v-row>
    <v-row v-else>
      <v-col class="d-flex justify-center">
        <v-progress-circular
          indeterminate
          color="primary"
        />
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
  export default {
    props: {
      data: {
        type: Object,
        default: null,
      },
      isLoad: {
        type: Boolean,
        default: false,
      },
    },
    methods: {
      setColorStatus (status) {
        if (status === "ongoing") return "btn_primary"
        if (status === "upcomming") return "secondary"
        else return "red"
      },
      toReviews (link) {
        this.$router.push(link)
      },
    },
  }
</script>

<style lang="sass">
.row__list--myclass
    margin-top: 72% !important
</style>
