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
        <v-col>
          <app-data-table
            :items="cumputedSubClass"
            @popUpForm="popUpDialog"
          />
        </v-col>
      </v-row>
    </v-container>
    <app-dialog-form :dialog="form" />
  </v-app>
</template>

<script>
  import dataTable from './component_core/_dataTable.vue'
  import dialogForm from './component/__dialogForm.vue'
  export default {
    components: {
      'app-data-table': dataTable,
      'app-dialog-form': dialogForm,
    },
    data: () => ({
      form: {
        open: false,
      },
    }),
    computed: {
      cumputedSubClass () {
        return this.$store.state.subClassStudio.data
      },
    },
    mounted () {
      this.getDataSubClass()
    },
    methods: {
      getDataSubClass () {
        this.$store.dispatch('subClassStudio/getDataSubClass', {
          entities: 'classes',
        })
      },
      popUpDialog () {
        this.form.open = true
      },
    },
  }
</script>

<style></style>
