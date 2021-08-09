<template>
  <v-app>
    <v-container>
      <v-row>
        <v-col
          cols="12"
          sm="6"
          lg="3"
        >
          <base-material-stats-card
            color="info"
            icon="mdi-twitter"
            title="Followers"
            value="+245"
            sub-icon="mdi-clock"
            sub-text="Just Updated"
          />
        </v-col>
        <v-col
          cols="12"
          sm="6"
          lg="3"
        >
          <base-material-stats-card
            color="info"
            icon="mdi-twitter"
            title="Followers"
            value="+245"
            sub-icon="mdi-clock"
            sub-text="Just Updated"
          />
        </v-col>
        <v-col
          cols="12"
          sm="6"
          lg="3"
        >
          <base-material-stats-card
            color="info"
            icon="mdi-twitter"
            title="Followers"
            value="+245"
            sub-icon="mdi-clock"
            sub-text="Just Updated"
          />
        </v-col>
        <v-col
          cols="12"
          sm="6"
          lg="3"
        >
          <base-material-stats-card
            color="info"
            icon="mdi-twitter"
            title="Followers"
            value="+245"
            sub-icon="mdi-clock"
            sub-text="Just Updated"
          />
        </v-col>

        <v-col cols="12">
          <app-data-table :data="user" />
        </v-col>
      </v-row>
    </v-container>
  </v-app>
</template>

<script>
  import dataTable from './_dataTable.vue'
  export default {
    components: {
      'app-data-table': dataTable,
    },
    computed: {
      user () {
        return this.$store.state.user.indexAll
      },
    },
    mounted () {
      this.getIndexUser()
    },
    methods: {
      getIndexUser () {
        this.$store.dispatch('user/getIndexUser')
      },
    },
  }
</script>

<style></style>
