<template>
  <v-container class="mt-4">
    <v-row>
      <v-col cols="12">
        <v-btn
          v-for="(btn, i) in itemBtn"
          :key="i"
          small
          :class="i !== 0 ? 'ml-1' : ''"
          outlined
        >
          {{ btn.text }}
        </v-btn>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
  export default {
    data: () => ({
      itemBtn: [
        {
          text: 'All',
        },
        {
          text: 'Beginner',
        },
        {
          text: 'Intermediate',
        },
        {
          text: 'Advance',
        },
      ],
    }),
  }
</script>

<style></style>
