<template>
  <v-container>
    <v-row>
      <v-col
        v-for="list in data"
        :key="list.id"
        cols="12"
      >
        <v-card height="200">
          <div class="d-flex flex-no-wrap justify-space-between">
            <div>
              <v-chip
                class="text-h5 ml-2 mt-3"
                color="transparent"
              >
                <h1>{{ list.name }}</h1>
              </v-chip>

              <v-card-subtitle style="text-transform: capitalize">
                <div class="d-flex flex-row">
                  <div class="d-flex flex-column">
                    <v-chip
                      outlined
                      label
                      small
                      color="primary"
                      class="text-capitalize"
                    >
                      {{ list.type }}
                    </v-chip>
                  </div>

                  <div
                    class="d-flex flex-column flex-nowrap text-capitalize ml-2"
                  >
                    <v-chip
                      color="primary"
                      small
                      label
                      outlined
                    >
                      <v-icon>
                        mdi-map-marker
                      </v-icon>
                      {{ list.region }}
                    </v-chip>
                  </div>

                  <div class="d-flex flex-column ml-2">
                    <v-chip
                      color="primary"
                      small
                      label
                      outlined
                    >
                      20 Folowers
                    </v-chip>
                  </div>

                  <div class="d-flex flex-column ml-2">
                    <v-chip
                      color="primary"
                      small
                      label
                      outlined
                    >
                      20 likes
                    </v-chip>
                  </div>
                </div>
                <div class="d-flex flex-row mt-2">
                  <div class="d-flex flex-column">
                    <v-rating
                      :value="4.5"
                      color="amber"
                      dense
                      half-increments
                      readonly
                      size="20"
                    />
                  </div>
                  <div class="d-flex flex-column font-size-small mr-4">
                    <v-chip
                      color="amber"
                      small
                      label
                      outlined
                    >
                      (200 Review)
                    </v-chip>
                  </div>
                </div>

                <!-- <div class="grey--text ms-4">
                  4.5 (413)
                </div> -->
              </v-card-subtitle>

              <v-card-actions class="">
                <v-btn
                  class="ml-2"
                  outlined
                  medium
                  width="200"
                  rounded
                  @click="clickPush(list.slug)"
                >
                  DETAIL
                </v-btn>
              </v-card-actions>
            </div>

            <v-avatar
              class="mt-5 mr-2 mb-2"
              size="160"
              tile
            >
              <v-img :src="list.img.url" />
            </v-avatar>
          </div>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
  export default {}
</script>

<style></style>
