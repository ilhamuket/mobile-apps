<template>
  <v-container class="mt-4">
    <v-row v-if="data.length !== 0">
      <v-col
        v-for="(item, i) in data"
        :key="i"
        cols="12"
        md="4"
      >
        <v-hover v-slot="{ hover }">
          <v-card
            class="card__list"
            :elevation="hover ? 12 : 4"
            :class="{ 'on-hover': hover }"
          >
            <v-img
              :src="item.url_thumbnail"
              style="cursor: pointer"
              width="100%"
              height="276"
              gradient="to top right, rgba(0,0,0,.33), rgba(0,0,10,.7)"
              @click="toPush(`/class-vidio/detail/${item.slug}`)"
            >
              <v-container>
                <v-row>
                  <v-col
                    class="d-flex flex-row-reverse"
                    cols="12"
                  >
                    <v-icon color="primary">
                      mdi-lock
                    </v-icon>
                    <!-- <v-icon
                  v-else
                  color="red"
                  @click="unLike(item)"
                >
                  mdi-heart
                </v-icon> -->
                    <v-icon
                      class="mr-2"
                      color="primary"
                    >
                      mdi-share-variant
                    </v-icon>
                  </v-col>
                </v-row>
                <!-- <v-row>
                </v-row> -->
              </v-container>
            </v-img>
            <v-container>
              <v-row>
                <v-col
                  cols="12"
                  class="d-flex align-center"
                >
                  <span
                    :class="`font-spartan-small font-weight-bold ${
                      $vuetify.theme.dark ? 'white--text' : 'black--text'
                    }`"
                  >
                    {{ item.name }}
                  </span>
                </v-col>
                <v-col cols="12">
                  Levels :
                  <v-chip
                    :color="setColorLevels(item.levels)"
                    text-color="white"
                    label
                    small
                  >
                    {{ item.levels }}
                  </v-chip>
                  <br>
                  Price : {{ item.price }}
                </v-col>
              </v-row>
            </v-container>
          </v-card>
        </v-hover>
      </v-col>
    </v-row>
    <v-row v-else>
      <v-col
        cols="12"
        class="d-flex justify-center"
      >
        <span class="font-spartan text-capitalize grey--text">
          data not available
        </span>
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
    data: () => ({
      itemBtn: [
        {
          text: "All",
        },
        {
          text: "Beginner",
        },
        {
          text: "Intermediate",
        },
        {
          text: "Advance",
        },
      ],
    }),
    methods: {
      setColorLevels (level) {
        if (level === "beginner") return "info"
        if (level === "intermediate") return "secondary"
        if (level === "advance") return "btn_primary"
      },
      toPush (link) {
        this.$emit("push", { item: link })
      },
    },
  }
</script>

<style lang="sass">
.cols__class-vidio
  &__category
    margin-top: 40% !important
</style>
