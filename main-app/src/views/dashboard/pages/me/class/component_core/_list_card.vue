<template>
  <v-container>
    <v-row>
      <v-col
        v-for="(item, i) in data"
        :key="i"
        cols="12"
        md="4"
      >
        <v-hover v-slot="{ hover }">
          <v-card
            v-if="item.classes"
            :elevation="hover ? 12 : 2"
            :class="{ 'on-hover': hover }"
            style="cursor: pointer"
          >
            <v-img
              v-if="item.classes.img"
              width="450"
              height="276"
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
                    <v-chip
                      v-if="item.classes"
                      small
                      class="ml-2 text-capitalize"
                      color="red"
                      text-color="white"
                    >
                      {{ item.classes.time_status }}
                    </v-chip>
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
                    <br>
                    <v-btn
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
                      color="btn_primary"
                      small
                      width="90"
                      class="mr-2"
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
  </v-container>
</template>

<script>
  export default {
    props: {
      data: {
        type: Array,
        default: null,
      },
    },
    methods: {
      setColorStatus (status) {
        if (status === "ongoing") return "btn_primary"
        if (status === "upcomming") return "secondary"
        else return "red"
      },
    },
  }
</script>

<style lang="sass">
.row__list--myclass
    margin-top: 42% !important
</style>
