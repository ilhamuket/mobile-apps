<template>
  <v-container>
    <v-row>
      <v-col cols="12">
        <v-card>
          <v-container>
            <v-row>
              <v-col
                cols="12"
                md="5"
              >
                <v-img
                  v-if="data.img"
                  class="rounded-xl"
                  :src="data.img.url"
                  width="400"
                  height="400"
                />
              </v-col>
              <v-col
                cols="12"
                md="7"
              >
                <v-row>
                  <v-col cols="12">
                    <span class="font-spartan grey--text">
                      Name : {{ data.name }}
                    </span>
                    <br>
                    <span
                      v-if="data.studio"
                      class="font-spartan grey--text"
                    >Studio : {{ data.studio.name }}</span>
                    <br>
                    <span
                      v-if="data.category"
                      class="font-spartan grey--text"
                    >Category : {{ data.category.display_name }}</span>
                  </v-col>
                  <v-divider />
                  <v-col cols="12">
                    <v-rating
                      v-model="reviews.rating"
                      size="35"
                      background-color="grey"
                    />
                  </v-col>
                  <v-col cols="12">
                    <v-textarea
                      v-model="reviews.body"
                      rounded
                      outlined
                      label="reviews"
                      placeholder="send A reviews"
                    />
                  </v-col>
                  <v-col
                    cols="12"
                    class="d-flex flex-row-reverse"
                  >
                    <v-btn
                      color="btn_primary"
                      @click="send"
                    >
                      Send <v-icon class="ml-2">
                        mdi-send
                      </v-icon>
                    </v-btn>
                  </v-col>
                </v-row>
              </v-col>
            </v-row>
          </v-container>
        </v-card>
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
      reviews: {
        rating: 0,
        body: "",
      },
    }),
    methods: {
      send () {
        this.$emit("input", { item: this.reviews })
      },
    },
  }
</script>

<style></style>
