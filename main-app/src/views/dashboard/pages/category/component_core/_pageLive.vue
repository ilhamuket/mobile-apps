<template>
  <v-container class="mt-4">
    <v-row v-if="classes.length !== 0">
      <v-col
        v-for="(item, i) in classes"
        :key="i"
        cols="12"
        md="4"
      >
        <v-hover v-slot="{ hover }">
          <v-card
            :elevation="hover ? 12 : 2"
            :class="{ 'on-hover': hover }"
          >
            <v-img
              v-if="item.img"
              :src="item.img.url"
              width="400"
              height="300"
              gradient="to top right, rgba(0,0,0,.7), rgba(0,0,0,.7)"
              style="cursor: pointer"
              @click="
                navigate(
                  `/detail/class/live/${item.studio.slug}/${item.slug}/keyword/${item.keyword}`
                )
              "
            >
              <v-container>
                <v-row>
                  <v-col
                    class="d-flex flex-row-reverse"
                    cols="12"
                  >
                    <v-icon color="primary">
                      mdi-heart-outline
                    </v-icon>
                    <v-icon
                      class="mr-2"
                      color="primary"
                    >
                      mdi-share-variant
                    </v-icon>
                  </v-col>
                </v-row>
                <v-row class="cols__list__ensiklolive">
                  <v-col
                    class="mt-8"
                    cols="12"
                  >
                    <span class="font-spartan btn_primary--text">
                      {{ item.name }}
                    </span>
                    <br>
                    <span class="font-spartan btn_primary--text">
                      Rp.{{ item.harga }}
                    </span>

                    <!-- <v-rating
                      :value="2"
                      class="ratings__class__category"
                      small
                      background-color="grey"
                      color="orange"
                    /> -->

                    <!-- <br> -->
                    <!-- <v-btn
                      small
                      outlined
                      color="primary"
                      class="btn_explore"
                    >
                      Rp.2000
                    </v-btn>
                    <v-btn
                      small
                      outlined
                      color="primary"
                      class="btn_explore ml-1"

                    >
                      Explore
                    </v-btn> -->
                  </v-col>
                </v-row>
              </v-container>
            </v-img>
            <v-img
              v-else-if="!item.img"
              src="https://images.tokopedia.net/img/cache/200-square/attachment/2019/2/18/20723472/20723472_abf0b8ac-7f50-4c95-be2d-7a9ae559df19.jpg.webp?ect=4g"
              width="400"
              height="300"
              gradient="to top right, rgba(0,0,0,.33), rgba(0,0,0,.7)"
              style="cursor: pointer"
              @click="
                navigate(
                  `/detail/class/live/${item.studio.slug}/${item.slug}/keyword/${item.keyword}`
                )
              "
            >
              <v-container>
                <v-row>
                  <v-col
                    class="d-flex flex-row-reverse"
                    cols="12"
                  >
                    <v-icon color="primary">
                      mdi-heart-outline
                    </v-icon>
                    <v-icon
                      class="mr-2"
                      color="primary"
                    >
                      mdi-share-variant
                    </v-icon>
                  </v-col>
                </v-row>
                <v-row class="cols__list_category">
                  <v-col cols="12">
                    <span class="font-spartan primary--text">
                      {{ item.name }}
                    </span>
                    <br>
                    <span
                      v-if="item.studio"
                      class="font-spartan primary--text"
                    >
                      {{ item.studio.display_name }}
                    </span>

                    <!-- <v-rating
                      :value="2"
                      class="ratings__class__category"
                      small
                      background-color="grey"
                      color="orange"
                    /> -->

                    <!-- <br> -->
                    <!-- <v-btn
                      small
                      outlined
                      color="primary"
                      class="btn_explore"
                    >
                      Rp.2000
                    </v-btn>
                    <v-btn
                      small
                      outlined
                      color="primary"
                      class="btn_explore ml-1"
                    >
                      Explore
                    </v-btn> -->
                  </v-col>
                </v-row>
              </v-container>
            </v-img>
            <v-container>
              <v-row>
                <v-col cols="12">
                  <span class="font-spartan-small">
                    Registration : {{ item.start_at | moment("MMMM Do") }} -
                    {{ item.end_at | moment("MMMM Do YYYY") }}
                  </span>
                  <br>
                  <span class="font-spartan-small">
                    Levels :
                    <v-chip
                      small
                      :color="setColorLevels(item.levels)"
                      text-color="white"
                    >
                      {{ item.levels }}
                    </v-chip>
                  </span>
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
      classes: {
        type: Array,
        default: null,
      },
      me: {
        type: Object,
        default: null,
      },
    },
    data: () => ({}),
    methods: {
      navigate (link) {
        this.$router.push(link)
      },
      setColorLevels (level) {
        if (level.toLowerCase() === "beginner") return "info"
        if (level.toLowerCase() === "intermediate") return "secondary"
        if (level.toLowerCase() === "advance") return "btn_primary"
      },
    },
  }
</script>

<style lang="sass">
.cols
  &__list
    &__ensiklolive
      margin-top: 44% !important
.btn_explore
  &:hover
    background-color: #9DC4D1
    color: white !important
.ratings__class__category
  margin-top: -6px
  margin-bottom: -20px
  margin-left: -8px
</style>
<style scoped>
.v-card {
  transition: opacity 0.7s ease-in-out;
}

.v-card:not(.on-hover) {
  opacity: 0.9;
}
.v-card:hover {
  opacity: 1;
}

.show-btns {
  color: rgba(255, 255, 255, 1) !important;
}
</style>
