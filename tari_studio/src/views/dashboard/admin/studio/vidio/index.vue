<template>
  <v-app>
    <v-container>
      <v-row>
        <v-col
          cols="12"
          md="4"
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
          md="4"
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
          md="4"
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
        <v-col>
          <app-data-table :data="vidio" />
        </v-col>
      </v-row>
    </v-container>
  </v-app>
</template>

<script>
  import dataTable from './components_core/_dataTable.vue'
  export default {
    components: {
      'app-data-table': dataTable,
    },
    computed: {
      vidio () {
        return this.$store.state.studioOwnerVidio.data
      },
    },
    mounted () {
      this.studioOwnerVidio()
      console.log(this.vidio)
    },
    methods: {
      studioOwnerVidio () {
        this.$store.dispatch('studioOwnerVidio/getDataVidio', {
          entities: 'author, studio',
        })
      },
    },
  }
</script>

<style></style>
