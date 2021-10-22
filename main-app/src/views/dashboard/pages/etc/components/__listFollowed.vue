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
              width="400"
              height="276"
              gradient="to top right, rgba(0,0,0,.33), rgba(0,0,0,.7)"
              style="background-color: grey"
              :src="item.img.url"
            >
              <v-container>
                <v-row>
                  <v-col
                    class="d-flex flex-row-reverse"
                    cols="12"
                  >
                    <v-icon color="red">
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
                <v-row>
                  <v-col
                    class="cols__followed"
                    cols="12"
                  >
                    <span class="font-spartan white--text">
                      {{ item.name }}
                    </span>
                    <br>
                    <span
                      v-if="item.author"
                      class="font-spartan white--text"
                    >
                      Studio
                    </span>

                    <v-rating
                      :value="computedCount[i]"
                      half-increments
                      color="orange"
                      background-color="grey"
                    />
                    <v-btn
                      small
                      width="190"
                      color="btn_primary"
                      class="btn-expolore-studio ml-1"
                    >
                      Explore
                    </v-btn>
                    <v-btn
                      width="100"
                      small
                      color="third"
                      class="btn-expolore-studio ml-1"
                    >
                      <v-tooltip
                        color="primary"
                        bottom
                      >
                        <template #activator="{on, attrs}">
                          <v-icon
                            v-bind="attrs"
                            v-on="on"
                          >
                            mdi-account-check
                          </v-icon>
                        </template>
                        <span class="font-spartan-small white--text">
                          UnFollow
                        </span>
                      </v-tooltip>
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
    computed: {
      computedCount () {
        let array = []
        const arrayFinal = []

        // eslint-disable-next-line no-unused-vars
        for (const item in this.data) {
          if (Object.hasOwnProperty.call(this.data, item)) {
            const user = this.data[item]
            array = user.reviews
            const ratings = array.map(x => x.ratings)
            if (ratings.length > 0) {
              const sum = ratings.filter(x => x > 0).reduce((x, y) => x + y)
              const avarage = sum / array.length
              arrayFinal.push(avarage)
            }
          }
        }
        return arrayFinal
      },
    },
    mounted () {
      console.log(this.computedCount)
    },
  }
</script>

<style lang="sass">
.cols__followed
    margin-top: 120px !important
</style>
