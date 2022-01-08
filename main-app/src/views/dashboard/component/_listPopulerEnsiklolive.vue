<template>
  <v-container>
    <v-row>
      <v-col
        v-for="(item, i) in classes"
        :key="i"
        cols="12"
        md="4"
      >
        <v-card class="card__populer--love">
          <v-img
            v-if="item.img"
            class="white--text layout__fhd align-end"
            :src="item.img.url"
            width="400"
            height="400"
            style="cursor: pointer"
            gradient="to top right, rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.05)"
            @click="toPush(item)"
          >
            <v-container>
              <v-row v-if="item.category">
                <v-col
                  class="d-flex flex-row-reverse"
                  cols="12"
                >
                  <v-chip
                    label
                    class="font-spartan mr-1 text-uppercase"
                    color="btn_primary"
                    text-color="white"
                    small
                    @click.stop=""
                  >
                    Class Zoom
                  </v-chip>
                  <v-chip
                    label
                    class="font-spartan mr-1 text-uppercase"
                    color="btn_primary"
                    text-color="white"
                    small
                    @click.stop=""
                  >
                    {{ item.category.name }}
                  </v-chip>
                </v-col>
                <v-col
                  class="d-flex flex-row-reverse"
                  cols="12"
                >
                  <!--  -->
                </v-col>
              </v-row>
              <v-row class="rows__populer">
                <v-card-subtitle>
                  <div class="d-flex flex-row mb-2">
                    <div class="d-flex flex-column">
                      <h3 class="">
                        {{ item.name }}
                      </h3>
                    </div>
                  </div>
                  <div class="d-flex flex-row mb-2">
                    <div class="d-flex flex-column">
                      <span class="font-spartan primary--text">
                        {{ item.harga }}
                      </span>
                    </div>
                  </div>
                  <div class="d-flex flex-row mb-2">
                    <div class="d-flex flex-column">
                      <span class="font-spartan primary--text">
                        {{ item.levels }}
                      </span>
                    </div>
                  </div>

                  <!-- <div class="grey--text ms-4">
                  4.5 (413)
                </div> -->
                </v-card-subtitle>
              </v-row>
            </v-container>
          </v-img>
          <v-img
            v-else
            class="white--text layout__fhd align-end"
            src="https://ecs7.tokopedia.net/img/cache/300/default_picture_user/default_toped-22.jpg"
            gradient="to top right, rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.05)"
            style="cursor: pointer"
            @click="toPush(item)"
          >
            <v-container>
              <v-row v-if="item.category">
                <v-col
                  class="d-flex flex-row-reverse"
                  cols="12"
                >
                  <v-chip
                    label
                    class="font-spartan mr-1 text-uppercase"
                    color="btn_primary"
                    text-color="white"
                    small
                    @click.stop=""
                  >
                    Class Zoom
                  </v-chip>
                  <v-chip
                    label
                    class="font-spartan mr-1 text-uppercase"
                    color="btn_primary"
                    text-color="white"
                    small
                    @click.stop=""
                  >
                    {{ item.category.name }}
                  </v-chip>
                </v-col>
                <v-col
                  class="d-flex flex-row-reverse"
                  cols="12"
                >
                  <!--  -->
                </v-col>
              </v-row>
              <v-row class="rows__populer">
                <v-card-subtitle>
                  <div class="d-flex flex-row mb-2">
                    <div class="d-flex flex-column">
                      <h3 class="">
                        {{ item.name }}
                      </h3>
                    </div>
                  </div>
                  <div class="d-flex flex-row mb-2">
                    <div class="d-flex flex-column">
                      <span class="font-spartan primary--text">
                        {{ item.harga }}
                      </span>
                    </div>
                  </div>
                  <div class="d-flex flex-row mb-2">
                    <div class="d-flex flex-column">
                      <span class="font-spartan primary--text">
                        {{ item.levels }}
                      </span>
                    </div>
                  </div>

                  <!-- <div class="grey--text ms-4">
                  4.5 (413)
                </div> -->
                </v-card-subtitle>
              </v-row>
            </v-container>
          </v-img>
        </v-card>
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
    },
    methods: {
      toPush (link) {
        this.$router.push(
          `/detail/class/live/${link.studio.slug}/${link.slug}/keyword/${link.keyword}`,
        )
      },
    },
  }
</script>

<style lang="sass">
.rows__populer
    margin-top: 72% !important
.card
  &__populer--love
    &:hover
      transform: scale(.9)
      border: 2px double #9DC4D1
// @media screen and (min-width: 1600px)
//   .layout
//     &__fhd
//       width: 100% !important
</style>
