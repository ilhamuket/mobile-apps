<template>
  <v-container fluid>
    <v-row>
      <v-col cols="12">
        <v-carousel
          v-model="model"
          class="width--carousel"
          cycle
          height="400"
          hide-delimiter-background
          show-arrows-on-hover
        >
          <v-carousel-item
            v-for="(color, i) in colors"
            :key="i"
          >
            <v-sheet
              :color="color"
              height="100%"
              tile
            >
              <v-row
                class="fill-height row--corousel"
                align="center"
                justify="center"
              >
                <div class="text-h1 font-spartan">
                  EnsikloTari
                </div>
              </v-row>
            </v-sheet>
          </v-carousel-item>
        </v-carousel>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
  export default {
    data: () => ({
      model: 0,
      colors: ["primary"],
    }),
  }
</script>

<style lang="sass">
.row--corousel
    .font-spartan
        font-size: 200px !important
        color: white
</style>
