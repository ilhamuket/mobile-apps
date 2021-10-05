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
            :elevation="hover ? 12 : 2"
            :class="{ 'on-hover': hover }"
          >
            <v-img
              v-if="item.img"
              :src="item.img.url"
              width="400"
              height="276"
              gradient="to top right, rgba(0,0,0,.33), rgba(0,0,0,.7)"
              style="cursor:pointer"
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
                      {{ item.display_name }}
                    </span>
                    <br>
                    <span
                      v-if="item.studio"
                      class="font-spartan primary--text"
                    >
                      {{ item.studio.name }}
                    </span>
                    <br>
                    <v-btn
                      small
                      outlined
                      color="primary"
                      class="btn_explore"
                    >
                      Explore
                    </v-btn>
                    <v-btn
                      small
                      outlined
                      color="primary"
                      class="ml-1 btn_explore"
                    >
                      Follow
                    </v-btn>
                  </v-col>
                </v-row>
              </v-container>
            </v-img>
            <v-img
              v-else-if="item.studio.img"
              :src="item.studio.img.url"
              gradient="to top right, rgba(0,0,0,.33), rgba(0,0,0,.7)"
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
                      {{ item.display_name }}
                    </span>
                    <br>
                    <span
                      v-if="item.studio"
                      class="font-spartan primary--text"
                    >
                      {{ item.studio.name }}
                    </span>
                    <br>
                    <v-btn
                      small
                      outlined
                      color="primary"
                      class="btn_explore"
                    >
                      Explore
                    </v-btn>
                    <v-btn
                      small
                      outlined
                      color="primary"
                      class="ml-1 btn_explore"
                    >
                      Follow
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
  }
</script>

<style lang="sass">
.cols__list_category
    margin-top: 120px !important
.btn_explore
    &:hover
        background-color: #9DC4D1
        color: white !important
</style>
<style scoped>
.v-card {
  transition: opacity 0.7s ease-in-out;
}

.v-card:not(.on-hover) {
  opacity: 1;
}
.v-card:hover {
  opacity: 0.9;
  cursor: pointer;
}

.show-btns {
  color: rgba(255, 255, 255, 1) !important;
}
</style>
