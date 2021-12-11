<template>
  <v-container class="mt-4">
    <v-row>
      <v-col
        v-for="(item, i) in data"
        :key="i"
        cols="12"
        md="4"
      >
        <v-hover v-slot="{ hover }">
          <v-card
            :elevation="hover ? 12 : 4"
            :class="{ 'on-hover': hover }"
          >
            <v-img :src="item.url_thumbnail">
              <!--  -->
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
    data: () => ({
      itemBtn: [
        {
          text: "All",
        },
        {
          text: "Beginner",
        },
        {
          text: "Intermediate",
        },
        {
          text: "Advance",
        },
      ],
    }),
  }
</script>

<style></style>
