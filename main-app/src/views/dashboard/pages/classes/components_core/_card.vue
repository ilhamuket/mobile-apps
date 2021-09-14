<template>
  <v-row>
    <v-col
      v-for="(item, i) in classes"
      :key="i"
      cols="12"
      md="4"
    >
      <v-card
        class="mx-auto"
        max-width="344"
      >
        <v-img
          v-if="item.img"
          :src="item.img.url"
          height="200px"
        />
        <v-img
          v-else
          class="white--text align-end"
          height="200px"
          src="https://cdn.vuetifyjs.com/images/cards/docks.jpg"
        />

        <v-card-actions class="font-spartan primary--text">
          {{ item.name }}
          <span class="orange--text text-caption ml-2"> (200 Reviews) </span>
          <v-spacer />
          <span class="orange--text text-caption"> ({{ rating }}) </span>
          <v-rating
            v-model="rating"
            background-color="white"
            color="yellow accent-4"
            readonly
            dense
            half-increments
            hover
            size="18"
          />
        </v-card-actions>

        <v-card-text class="text--primary">
          <v-chip
            v-if="item.studio"
            label
            outlined
            color="btn_primary"
            class=" text-h4 font-spartan"
          >
            Studio : {{ item.studio.name }}
          </v-chip>
          <v-divider
            class="mt-1 mb-1 divider--opacity"
            dark
          />
          <v-chip
            label
            color="primary"
            class="text-subtitle-1 font-spartan font-italic font-weight-thin"
          >
            Capacity : 0 / {{ item.kapasitas }}
          </v-chip>
          <br>
          <span class="text-subtitle-1 font-spartan font-italic">
            Duration : {{ item.durasi }} Minutes
          </span>
          <br>
          <span class="text-subtitle-1 font-spartan font-italic">
            Rp.20000
          </span>
        </v-card-text>

        <v-card-actions>
          <v-btn
            color="primary"
            text
          >
            See Class Online
          </v-btn>

          <v-spacer />

          <v-btn
            icon
            dark
            @click="item.show = !item.show"
          >
            <v-icon color="primary">
              {{ item.show ? 'mdi-chevron-up' : 'mdi-chevron-down' }}
            </v-icon>
          </v-btn>
        </v-card-actions>

        <v-expand-transition>
          <div v-show="item.show">
            <v-divider class="divider--opacity" />

            <v-card-text> " {{ item.about }} " </v-card-text>
          </div>
        </v-expand-transition>
      </v-card>
    </v-col>
  </v-row>
</template>

<script>
  export default {
    props: {
      classes: {
        type: Array,
        default: null,
      },
    },
    data: () => ({
      show: false,
      rating: 4.5,
    }),
  }
</script>

<style lang="sass" scoped>
.theme--dark
  .divider--opacity
    opacity: .2
</style>
