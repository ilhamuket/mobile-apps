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
            title="Total"
            :value="String(summary.total)"
            sub-icon="mdi-clock"
            sub-text="Just Updated"
            style="cursor:pointer"
            @click.native="setSummary('')"
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
            title="SuperAdministrator"
            :value="String(summary.superadmin)"
            sub-icon="mdi-clock"
            sub-text="Just Updated"
            style="cursor:pointer"
            @click.native="setSummary('superadministrator')"
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
            title="Admin"
            :value="String(summary.admin)"
            sub-icon="mdi-clock"
            sub-text="Just Updated"
            style="cursor:pointer"
            @click.native="setSummary('administrator')"
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
            title="Instructor"
            :value="String(summary.instructor)"
            sub-icon="mdi-clock"
            sub-text="Just Updated"
            style="cursor:pointer"
            @click.native="setSummary('instructor')"
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
    data: () => ({
      type: '',
    }),
    computed: {
      user () {
        return this.$store.state.user.indexAll
      },
      summary () {
        return this.$store.state.user.summary
      },
      cumputedTitle () {
        if (this.type === 'superadministrator') {
          return 'User - Super Administrator'
        }
        if (this.type === 'administrator') {
          return 'User - Administrator'
        }
        if (this.type === 'administrator') {
          return 'User - Administrator'
        }
        return 'User - All'
      },
    },
    watch: {
      type (newVal) {
        this.$router.push({ query: { ...this.$route.query, type: newVal } })
      },
      '$route.query.type': function (val) {
        this.type = val
      },
    },
    mounted () {
      this.getIndexUser()
      this.getSummary()
    },
    methods: {
      getIndexUser () {
        this.$store.dispatch('user/getIndexUser', {
          type: this.type,
        })
      },
      getSummary () {
        this.$store.dispatch('user/getSummary')
      },
      setSummary (val) {
        this.type = val
        this.getIndexUser()
      },
    },
  }
</script>

<style></style>
