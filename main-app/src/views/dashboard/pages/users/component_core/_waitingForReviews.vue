<template>
  <v-container>
    <v-row v-if="data.data.length === 0">
      <v-col>
        <v-img
          width="400"
          class="img--margin"
          :src="require('@/assets/img/ensiklo-vidio-kosong.svg')"
        />
      </v-col>
    </v-row>
    <v-row v-else>
      <v-col
        v-for="(item, i) in data.data"
        :key="i"
        cols="12"
        md="4"
      >
        <v-hover v-slot="{ hover }">
          <v-card
            v-if="item.classes"
            :elevation="hover ? 12 : 2"
            :class="{ 'on-hover': hover }"
          >
            <v-img
              v-if="item.classes.img"
              class="white--text align-end"
              width="400"
              height="200"
              :src="item.classes.img.url"
              gradient="to top right, rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.05)"
              style="cursor: pointer"
            >
              <v-container>
                <v-row class="rows__status_waiting-reviews">
                  <v-col
                    cols="12"
                    class="d-flex flex-row-reverse"
                  >
                    <v-chip> {{ item.status_responded }} </v-chip>
                  </v-col>
                </v-row>
                <v-row class="row__detail--class__waiting-reviews">
                  <v-col cols="12">
                    <span class="font-spartan white--text font-weight-bold">
                      {{ item.classes.name }} - {{ item.classes.levels }}
                    </span>
                    <br>
                    <span
                      v-if="item.classes.category"
                      class="
                        font-spartan-small
                        btn_primary--text
                        font-weight-bold
                        mt-2
                        mb-2
                      "
                    >
                      {{ item.classes.category.display_name }}
                    </span>
                  </v-col>
                </v-row>
              </v-container>
            </v-img>
            <v-card-text v-if="item.classes.studio">
              <v-container>
                <v-row>
                  <v-col
                    cols="12"
                    md="3"
                    sm="6"
                  >
                    <v-avatar size="40">
                      <v-img
                        v-if="item.classes.studio.img"
                        :src="item.classes.studio.img.url"
                      />
                      <v-img
                        v-else
                        src="https://ecs7.tokopedia.net/img/cache/300/default_picture_user/default_toped-22.jpg"
                      />
                    </v-avatar>
                  </v-col>
                  <v-col
                    cols="12"
                    md="9"
                    sm="6"
                  >
                    <span class="font-spartan-small"> Hurip Studio </span>
                    <v-rating
                      :value="computedCount[i]"
                      readonly
                      background-color="secondary"
                      small
                    />
                    <br>
                    <v-btn
                      v-if="item.classes"
                      class="btn--margin"
                      small
                      color="btn_primary"
                      @click="sendReviews(item)"
                    >
                      Send A Review
                    </v-btn>
                  </v-col>
                </v-row>
              </v-container>
            </v-card-text>
          </v-card>
        </v-hover>
      </v-col>
    </v-row>
    <v-row>
      <v-col cols="12">
        <v-pagination
          v-if="data.meta"
          v-model="page"
          circle
          :length="data.meta.last_page"
          @input="changePage"
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
    },
    data: () => ({
      page: 1,
    }),
    computed: {
      computedCount () {
        const aay = []
        if (this.data.data) {
          // eslint-disable-next-line no-unused-vars
          for (const item in this.data.data) {
            if (Object.hasOwnProperty.call(this.data.data, item)) {
              const classes = this.data.data[item]

              const studio = classes.classes.studio
              const reviews = studio.reviews
              const allRatings = reviews.map((x) => x.ratings)

              const sum = allRatings.filter((x) => x > 0).reduce((x, y) => x + y)
              const avarage = sum / allRatings.length

              aay.push(avarage)
            }
          }
        }

        return aay
      },
    },

    methods: {
      changePage () {
        this.$emit("paginate", { item: this.page })
      },
      sendReviews (item) {
        this.$router.push(
          `/reviews/${item.classes.studio.slug}/detail/${item.classes.slug}/user-have/${item.id}`,
        )
      },
    },
  }
</script>

<style lang="sass">
.rows__status_waiting-reviews
  margin-top: -3%
.row__detail--class__waiting-reviews
  margin-top: 35% !important
.btn--margin
  margin-left: -41% !important
.img--margin
  margin-left: 20%
</style>
