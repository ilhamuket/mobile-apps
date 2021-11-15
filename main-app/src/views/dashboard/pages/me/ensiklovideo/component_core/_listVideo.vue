<template>
  <v-contaner>
    <v-row v-if="data.length > 0">
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
    <v-row v-else>
      <v-col cols="12">
        <div class="d-flex justify-center">
          <v-img
            width="900"
            height="400"
            src="@/assets/img/noclass.svg"
          />
        </div>
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
