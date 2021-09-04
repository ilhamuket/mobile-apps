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
            color="primary"
            icon="mdi-poll"
            title="Website Visits"
            value="75.521"
            sub-icon="mdi-tag"
            sub-text="Tracked from Google Analytics"
          />
        </v-col>
        <v-col
          cols="12"
          sm="6"
          lg="3"
        >
          <base-material-stats-card
            color="primary"
            icon="mdi-poll"
            title="Website Visits"
            value="75.521"
            sub-icon="mdi-tag"
            sub-text="Tracked from Google Analytics"
          />
        </v-col>
        <v-col
          cols="12"
          sm="6"
          lg="3"
        >
          <base-material-stats-card
            color="primary"
            icon="mdi-poll"
            title="Website Visits"
            value="75.521"
            sub-icon="mdi-tag"
            sub-text="Tracked from Google Analytics"
          />
        </v-col>
        <v-col
          cols="12"
          sm="6"
          lg="3"
        >
          <base-material-stats-card
            color="primary"
            icon="mdi-poll"
            title="Website Visits"
            value="75.521"
            sub-icon="mdi-tag"
            sub-text="Tracked from Google Analytics"
          />
        </v-col>
        <v-col cols="12">
          <app-data-table :data="computedInstructor" />
        </v-col>
      </v-row>
    </v-container>
  </v-app>
</template>

<script>
  import dataTable from './component_core/_dataTable.vue'
  export default {
    components: {
      'app-data-table': dataTable,
    },
    data: () => ({}),
    computed: {
      computedInstructor () {
        return this.$store.state.studioInstructor.data
      },
    },
    mounted () {
      this.getDataTeacherStudio()
    },
    methods: {
      getDataTeacherStudio () {
        this.$store.dispatch('studioInstructor/getDataTeacherStudio', {
          entities: 'studio',
        })
      },
    },
  }
</script>

<style></style>
