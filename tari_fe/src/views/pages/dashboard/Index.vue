<template>
  <v-app>
    <v-container>
      <v-row>
        <v-col>
          <app-for-you />
        </v-col>
      </v-row>
    </v-container>
  </v-app>
</template>

<script>
  import forYou from './_forYou.vue'
  export default {
    components: {
      'app-for-you': forYou,
    },
  }
</script>

<style></style>
