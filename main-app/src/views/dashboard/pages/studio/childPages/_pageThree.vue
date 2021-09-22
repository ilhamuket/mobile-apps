<template>
  <v-container>
    <v-row>
      <v-col cols="12">
        <v-img src="@/assets/img/progres1.svg" />
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
  export default {
    props: {
      data: {
        type: Array,
        default: () => [
          {
            ratings: 0,
          },
        ],
      },
    },
    data: () => ({
      mean: 0,
      sum: 0,
    }),
    computed: {},
    mounted () {
    // this.reduce()
    },
    methods: {
      reduce () {},
    },
  }
</script>

<style></style>
