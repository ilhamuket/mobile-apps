<template>
  <v-container>
    <v-dialog
      v-model="dialog.open"
      :width="isMobile ? '100%' : '50%'"
      class=""
    >
      <v-card>
        <v-system-bar
          :color="$vuetify.theme.dark ? '#141C31' : '#F0F8FF'"
          window
        >
          <v-toolbar-title
            :class="$vuetify.theme.dark ? 'white--text' : ' black--text'"
            class="font-size-ather-roboto-mono"
          >
            <v-icon :color="$vuetify.theme.dark ? 'white' : 'black'">
              {{ icon }}
            </v-icon>
            {{ title }}
          </v-toolbar-title>

          <v-spacer />

          <v-icon @click="dialog.open = false">
            mdi-close
          </v-icon>
        </v-system-bar>
        <v-card-text v-if="byId">
          {{ $t(text) }} <br>
          <v-row>
            <v-col cols="1">
              <v-avatar v-if="dialog.data.user">
                <v-img :src="dialog.data.user.img.url" />
              </v-avatar>
              <v-avatar v-else>
                <v-img src="http://127.0.0.1:8000/images/469439.png" />
              </v-avatar>
            </v-col>
            <v-col cols="11">
              <span
                v-if="dialog.data.user"
                class="font-spartan-small"
              >
                {{ dialog.data.user.nickName }} - -
                {{ timeSince(dialog.data.created_at) }}
              </span>
              <br>
              <span class="font-spartan-small">
                {{ dialog.data.body }}
              </span>
            </v-col>
          </v-row>
        </v-card-text>
        <v-card-text v-else>
          <span class="font-spartan-small">
            {{ $t(text) }}
          </span>
          <br>
          <v-row
            v-for="(item, i) in dialog.data"
            :key="i"
          >
            <v-col cols="1">
              <v-avatar v-if="item.user">
                <v-img :src="item.user.img.url" />
              </v-avatar>
              <v-avatar v-else>
                <v-img src="http://127.0.0.1:8000/images/469439.png" />
              </v-avatar>
            </v-col>
            <v-col
              class=""
              cols="11"
            >
              <span
                v-if="item.user"
                class="font-spartan-small"
              >
                {{ item.user.nickName }} - {{ timeSince(item.created_at) }}
              </span>
              <br>
              <span class="font-spartan-small">
                {{ item.body }}
              </span>
            </v-col>
          </v-row>
        </v-card-text>
        <v-card-actions
          :color="$vuetify.theme.dark ? '#283046' : '#F0F8FF'"
          :class="$vuetify.theme.dark ? 'bg-dark' : 'bg-light'"
          class="d-flex flex-row-reverse"
        >
          <div class="d-flex flex-flow-reverse">
            <div class="d-flex flex-column mr-2">
              <v-btn
                :color="colorButton2"
                outlined
                @click="dialog.open = false"
              >
                Cancel
              </v-btn>
            </div>
            <div
              v-if="byId"
              class="d-flex flex-column"
            >
              <v-btn
                :color="colorButton1"
                outlined
                @click="inputById"
              >
                {{ textButton1 }}
              </v-btn>
            </div>
            <div
              v-else
              class="d-flex flex-column"
            >
              <v-btn
                :color="colorButton1"
                outlined
                @click="input"
              >
                {{ textButton1 }}
              </v-btn>
            </div>
          </div>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-container>
</template>

<script>
  export default {
    props: {
      dialog: {
        type: Object,
        default: () => ({
          open: false,
          title: '',
          data: [],
        }),
      },
      byId: {
        type: Boolean,
        default: false,
      },
      title: {
        type: String,
        default: 'delete',
      },
      icon: {
        type: String,
        default: 'mdi-trush-can-outline',
      },
      text: {
        type: String,
        default: 'delete',
      },
      textButton1: {
        type: String,
        default: 'delete',
      },
      colorButton1: {
        type: String,
        default: 'primary',
      },
      colorButton2: {
        type: String,
        default: 'red',
      },
    },
    data: () => ({
      isMobile: false,
    }),
    methods: {
      input () {
        this.$emit('input', { item: this.dialog.data })
      // this.dialog.data = []
      },
      inputById () {
        this.$emit('input', { item: this.dialog })
      },
      onResize () {
        if (window.innerWidth < 769) this.isMobile = true
        else this.isMobile = false
      },
      timeSince (time) {
        switch (typeof time) {
          case 'number':
            break
          case 'string':
            time = +new Date(time)
            break
          case 'object':
            if (time.constructor === Date) time = time.getTime()
            break
          default:
            time = +new Date()
        }
        const timeformats = [
          [60, 'seconds', 1], // 60
          [120, '1 minute ago', '1 minute from now'], // 60*2
          [3600, 'minutes', 60], // 60*60, 60
          [7200, '1 hour ago', '1 hour from now'], // 60*60*2
          [86400, 'hours', 3600], // 60*60*24, 60*60
          [172800, 'Yesterday', 'Tomorrow'], // 60*60*24*2
          [604800, 'days', 86400], // 60*60*24*7, 60*60*24
          [1209600, 'Last week', 'Next week'], // 60*60*24*7*4*2
          [2419200, 'weeks', 604800], // 60*60*24*7*4, 60*60*24*7
          [4838400, 'Last month', 'Next month'], // 60*60*24*7*4*2
          [29030400, 'months', 2419200], // 60*60*24*7*4*12, 60*60*24*7*4
          [58060800, 'Last year', 'Next year'], // 60*60*24*7*4*12*2
          [2903040000, 'years', 29030400], // 60*60*24*7*4*12*100, 60*60*24*7*4*12
          [5806080000, 'Last century', 'Next century'], // 60*60*24*7*4*12*100*2
          [58060800000, 'centuries', 2903040000], // 60*60*24*7*4*12*100*20, 60*60*24*7*4*12*100
        ]
        let seconds = (+new Date() - time) / 1000
        let token = 'ago'
        let listchoice = 1

        if (seconds === 0) {
          return 'Just now'
        }
        if (seconds < 0) {
          seconds = Math.abs(seconds)
          token = 'from now'
          listchoice = 2
        }
        let i = 0
        let format
        while ((format = timeformats[i++])) {
          if (seconds < format[0]) {
            if (typeof format[2] === 'string') return format[listchoice]
            else {
              return (
                Math.floor(seconds / format[2]) + ' ' + format[1] + ' ' + token
              )
            }
          }
        }
        return time
      },
    },
  }
</script>

<style lang="sass" scoped>
.bg-light
    background-color: #F0F8FF !important
.bg-dark
    background-color: #141C31 !important
.font
  font-weight: bold !important
</style>
