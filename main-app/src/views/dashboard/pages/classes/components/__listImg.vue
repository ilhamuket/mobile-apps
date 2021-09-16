<template>
  <v-row v-if="data.length !== 0">
    <v-col
      v-for="(item, i) in data"
      :key="i"
      cols="12"
      sm="4"
      md="4"
    >
      <v-img
        height="100"
        :src="item.url"
        gradient="to top right, rgba(100,115,201,.33), rgba(25,32,72,.7)"
      />
    </v-col>
  </v-row>
</template>

<script>
  export default {
    props: {
      data: {
        type: Array,
        default: null,
      },
    },
    mounted () {
      console.log(this.data)
    },
  }
</script>

<style></style>
