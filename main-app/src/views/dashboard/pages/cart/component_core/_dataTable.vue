<template>
  <v-container>
    <v-row>
      <v-col cols="12">
        <v-data-table
          show-select
          :headers="headers"
        />
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
  export default {
    data: () => ({
      headers: [
        {
          text: "#",
          value: "name",
        },
        {
          text: "Name",
          value: "name",
        },
        {
          text: "Type",
          value: "name",
        },
        {
          text: "Price",
          value: "name",
        },
        {
          text: "Actions",
          value: "name",
        },
      ],
    }),
  }
</script>

<style></style>
