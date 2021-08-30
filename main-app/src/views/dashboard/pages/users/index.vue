<template>
  <v-container id="user-profile">
    <v-row
      class="ml-2"
      justify="center"
    >
      <v-col cols="12">
        <v-card class="rounded-xl">
          <v-img
            height="160"
            src="https://demos.creative-tim.com/muse-vue-ant-design-dashboard/images/bg-profile.jpg"
          />
        </v-card>
      </v-col>
      <v-col
        class="d-flex justify-center"
        cols="12"
      >
        <app-data-card :me="cumputedMe" />
      </v-col>
      <v-col
        cols="12"
        md="4"
      >
        <app-data-profile :me="cumputedMe" />
      </v-col>
      <v-col
        cols="12"
        md="4"
      >
        <app-list-following />
      </v-col>

      <v-col cols="12">
        <timelines id="timeLines" />
      </v-col>

      <!-- <v-col
        cols="12"
        md="4"
      >
        <base-material-card
          class="v-card-profile"
          avatar="https://demos.creative-tim.com/vue-material-dashboard/img/marc.aba54d65.jpg"
        >
          <v-card-text class="text-center">
            <h6 class="mb-1 grey--text">
              CEO / CO-FOUNDER
            </h6>

            <h4 class="font-weight-light mb-3 black--text">
              Alec Thompson
            </h4>

            <p class="font-weight-light grey--text">
              Don't be scared of the truth because we need to restart the human
              foundation in truth And I love you like Kanye loves Kanye I love
              Rick Owens’ bed design but the back is...
            </p>

            <v-btn
              color="success"
              rounded
              class="mr-0"
            >
              Follow
            </v-btn>
          </v-card-text>
        </base-material-card>
      </v-col> -->
    </v-row>
  </v-container>
</template>

<script>
  import card from './component_core/_cardDetail.vue'
  import timelines from './component_core/Timeline.vue'
  import cardInformation from './component_core/_cardDetailProfile.vue'
  import cardList from './component_core/_cardInformation.vue'
  export default {
    components: {
      timelines,
      'app-data-card': card,
      'app-data-profile': cardInformation,
      'app-list-following': cardList,
    },
    computed: {
      cumputedMe () {
        return this.$store.state.user.me
      },
    },
    mounted () {
      this.getMe()
    },
    methods: {
      getMe () {
        this.$store.dispatch('user/me')
      },
    },
  }
</script>
