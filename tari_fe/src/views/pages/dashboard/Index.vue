<template>
  <v-app>
    <v-container>
      <v-row>
        <v-col>
          <app-for-you
            :vidios="vidios"
            :play-list="playlist"
          />
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
    data: () => ({
      search: '',
    }),
    computed: {
      vidios () {
        return this.$store.state.vidios.vidios
      },
      playlist () {
        return this.$store.state.vidios.playlist
      },
    },
    mounted () {
      this.getVidios()
      this.getPlayList()
    },
    methods: {
      getVidios (id) {
        this.$store.dispatch('vidios/showVidios', {
          schedule_id: id,
        })
      },
      getPlayList () {
        this.$store.dispatch('vidios/getPlayList')
      },
    },
  }
</script>

<style></style>
