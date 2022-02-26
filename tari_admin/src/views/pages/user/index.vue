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
            icon=" mdi-account-group-outline"
            title="Total"
            :value="String(computedSummary.total)"
            sub-icon="mdi-heart-outline"
            sub-text="EnsikloTari"
            style="cursor: pointer"
            :class="`${$route.query.summary === '' ? 'selected' : ''}`"
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
            icon="mdi-account-tie"
            title="SuperAdministrator"
            :value="String(computedSummary.superadministrator)"
            sub-icon="mdi-heart-outline"
            sub-text="EnsikloTari"
            style="cursor: pointer"
            :class="`${
              $route.query.summary === 'superadministrator' ? 'selected' : ''
            }`"
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
            icon="mdi-account-tie-outline"
            title="Student"
            :value="String(computedSummary.student)"
            sub-icon="mdi-heart-outline"
            sub-text="EnsikloTari"
            style="cursor: pointer"
            :class="`${$route.query.summary === 'student' ? 'selected' : ''}`"
            @click.native="setSummary('student')"
          />
        </v-col>
        <v-col
          cols="12"
          sm="6"
          lg="3"
        >
          <base-material-stats-card
            color="info"
            icon="mdi-account-music-outline"
            title="Owner"
            :value="String(computedSummary.owner)"
            sub-icon="mdi-heart-outline"
            sub-text="EnsikloTari"
            style="cursor: pointer"
            :class="`${$route.query.summary === 'owner' ? 'selected' : ''}`"
            @click.native="setSummary('owner')"
          />
        </v-col>

        <v-col cols="12">
          <app-data-table
            :data="user"
            :computed-title="cumputedTitle"
          />
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
      summary: '',
    }),
    computed: {
      user () {
        return this.$store.state.user.indexAll
      },
      computedSummary () {
        return this.$store.state.user.summary
      },
      cumputedTitle () {
        if (this.summary === 'superadministrator') {
          return 'User - Super Administrator'
        }
        if (this.summary === 'student') {
          return 'User - Student'
        }
        if (this.summary === 'owner') {
          return 'User - Owner Studio'
        }

        return 'User - All'
      },
    },
    watch: {
      summary (newVal) {
        this.$router.push({ query: { ...this.$route.query, summary: newVal } })
      },
      '$route.query.summary': function (val) {
        this.summary = val
      },
    },
    mounted () {
      this.getIndexUser()
      this.getSummary()
    },
    methods: {
      getIndexUser () {
        this.$store.dispatch('user/getIndexUser', {
          summary: this.summary,
          entities: 'roles',
        })
      },
      getSummary () {
        this.$store.dispatch('user/getSummary')
      },
      setSummary (val) {
        this.summary = val
        this.getIndexUser()
      },
    },
  }
</script>

<style></style>
