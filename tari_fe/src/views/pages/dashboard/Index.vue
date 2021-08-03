<template>
  <v-app>
    <v-container>
      <v-row>
        <v-col>
          <app-for-you
            :vidios="vidios"
            :schedule="playlist"
            @input="getPlay"
            @dialog="openDialog"
            @close="closeDialog"
          />
        </v-col>
      </v-row>
    </v-container>
    <app-dialog-add
      :dialog="dialog"
      :classes="classes"
    />
  </v-app>
</template>

<script>
  import forYou from './_forYou.vue'
  import dialogAdd from './_addDialog.vue'
  export default {
    components: {
      'app-for-you': forYou,
      'app-dialog-add': dialogAdd,
    },
    data: () => ({
      search: '',
      list: [],
      id: null,
      is_display: false,
      dialog: {},
    }),
    computed: {
      vidios () {
        return this.$store.state.vidios.vidios
      },
      playlist () {
        return this.$store.state.vidios.playlist
      },
      classes () {
        return this.$store.state.class.classes
      },
      currentDate () {
        const today = new Date()
        const year = today.getFullYear()
        // const month = today.getMonth()
        const day = today.getDate()

        const full = year + '-' + '08' + '-' + day
        return full
      },
    },
    mounted () {
      this.getVidios()
      this.getPlayList()
      this.getClasses()
    },
    methods: {
      // vidios SHow
      getVidios () {
        this.$store.dispatch('vidios/showVidios', {
          schedule_id: localStorage.getItem('schedule_id'),
        })
      },
      // Playlist
      getPlayList () {
        this.$store.dispatch('vidios/getPlayList', {
          start: this.currentDate,
        })
      },
      getPlay (event) {
        this.id = event.item.id
        localStorage.setItem('schedule_id', this.id)
        this.getVidios()
      },
      // Dialog
      openDialog (event) {
        this.dialog = event.item
      },
      closeDialog (event) {
        this.dialog = event.item
        const Toast = this.$swal.mixin({
          toast: true,
          position: 'bottom-end',
          showConfirmButton: false,
          timer: 3000,
          timerProgressBar: true,
          didOpen: toast => {
            toast.addEventListener('mouseenter', this.$swal.stopTimer)
            toast.addEventListener('mouseleave', this.$swal.resumeTimer)
          },
          popup: 'swal2-show',
          backdrop: 'swal2-backdrop-show',
          icon: 'swal2-icon-show',
        })

        Toast.fire({
          icon: 'error',
          title: 'Password atau Email Anda salah',
        })
      },
      // classes List
      getClasses () {
        this.$store.dispatch('class/getClasses').then(res => {
          console.log(res)
        })
      },
    },
  }
</script>

<style></style>
