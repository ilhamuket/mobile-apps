<template>
  <v-contaner>
    <v-row>
      <v-col
        cols="12"
        md="4"
      >
        <v-hover v-slot="{ hover }">
          <v-card
            :elevation="hover ? 12 : 2"
            :class="{ 'on-hover': hover }"
          >
            <v-img />
          </v-card>
        </v-hover>
      </v-col>
    </v-row>
  </v-contaner>
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

<style></style>
