<template>
  <v-container>
    <v-row>
      <v-col
        cols="12"
        md="4"
      >
        <v-hover v-slot="{ hover }">
          <v-card :elevation="hover ? 12 : 2">
            <v-img
              style="cursor:pointer"
              src="https://www.ensiklotari.com/_nuxt/img/t1.51b60a5.jpg"
            >
              <v-container>
                <v-row class="cols__margin--name">
                  <v-col>
                    <div class="d-flex flex-row">
                      <div class="d-flex flex-column">
                        <v-chip
                          small
                          label
                          color="btn_primary"
                          class="font-spartan"
                          text-color="white"
                        >
                          Mahardika Kessuma Denie
                        </v-chip>
                      </div>
                    </div>
                  </v-col>
                  <v-col
                    cols="12"
                    class="cols__studio"
                  >
                    <div class="d-flex flex-row">
                      <div class="d-flex flex-column">
                        <v-chip
                          color="btn_primary"
                          text-color="white"
                          class="font-spartan-text font-weight-bold"
                          small
                        >
                          Dancer - Hurip Studio
                        </v-chip>
                      </div>
                    </div>
                  </v-col>
                </v-row>
              </v-container>
            </v-img>
            <v-container>
              <v-row>
                <v-col
                  cols="12"
                  class="d-flex flex-row-reverse margin-callbacks"
                >
                  <div class="d-flex flex-row margin--icon">
                    <div class="d-flex flex-column">
                      <v-icon
                        color="red"
                        class="mr-2"
                      >
                        mdi-instagram
                      </v-icon>
                    </div>
                    <div class="d-flex flex-column">
                      <v-icon
                        color="blue"
                        class="mr-2"
                      >
                        mdi-facebook
                      </v-icon>
                    </div>
                    <div class="d-flex flex-column">
                      <v-icon color="blue">
                        mdi-twitter
                      </v-icon>
                    </div>
                  </div>
                </v-col>
              </v-row>
            </v-container>
          </v-card>
        </v-hover>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
  export default {}
</script>

<style lang="sass">
.margin-callbacks
    margin-top: -20px
.cols__margin--name
    margin-top: 290px
.margin--icon
    margin-right: 135px
    margin-top: 20px
    .v-icon
        font-size: 26px !important
.cols__studio
    margin-top: -20px !important
</style>
