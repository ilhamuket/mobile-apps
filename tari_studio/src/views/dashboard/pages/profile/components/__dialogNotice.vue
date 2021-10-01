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
                {{ dialog.data.user.nickName }}
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
            {{ text }}
          </span>
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
        default: '',
      },
      icon: {
        type: String,
        default: '',
      },
      text: {
        type: String,
        default: '',
      },
      textButton1: {
        type: String,
        default: '',
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
      },
      inputById () {
        this.$emit('input', { item: this.dialog })
      },
      onResize () {
        if (window.innerWidth < 769) this.isMobile = true
        else this.isMobile = false
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
