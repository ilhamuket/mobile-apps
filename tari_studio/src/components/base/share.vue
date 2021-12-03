<template>
  <v-container>
    <v-dialog
      v-model="dialog.open"
      width="70%"
    >
      <v-card>
        <v-system-bar
          :color="$vuetify.theme.dark ? '#141C31' : '#F0F8FF'"
          window
        >
          <v-toolbar-title
            :class="$vuetify.theme.dark ? 'white--text' : ' black--text'"
          >
            <v-icon color="blue">
              mdi-share-variant
            </v-icon>
            <span class="font-spartan-small"> {{ titleText }} </span>
          </v-toolbar-title>

          <v-spacer />

          <v-icon @click="dialog.open = false">
            mdi-close
          </v-icon>
        </v-system-bar>
        <v-card-text>
          <v-container class="">
            <v-row class="d-flex justify-center">
              <v-hover v-slot="{ hover }">
                <v-col
                  cols="12"
                  md="4"
                >
                  <v-icon
                    v-for="(item, i) in icon"
                    :key="i"
                    :class="{ 'v--share': hover }"
                    class="mdi-custome ml-2"
                    large
                    style="cursor: pointer"
                    :color="item.color"
                    @click="currentTextUrl(item.value)"
                  >
                    {{ item.text }}
                  </v-icon>
                </v-col>
              </v-hover>
              <v-col
                cols="12"
                class="d-flex justify-center"
              >
                <v-row dense>
                  <v-col
                    cols="12"
                    class="d-flex justify-center"
                  >
                    <v-text-field
                      v-if="currentUrl === 'facebook'"
                      id="text-field"
                      :value="dialog.data.link"
                      readonly
                      dense
                      outlined
                    />
                    <v-text-field
                      v-if="currentUrl === 'instagram'"
                      id="text-field"
                      readonly
                      :value="valueText[1]"
                      dense
                      outlined
                    />
                    <v-text-field
                      v-if="currentUrl === 'twitter'"
                      id="text-field"
                      readonly
                      :value="valueText[2]"
                      dense
                      outlined
                    />
                    <v-text-field
                      v-if="currentUrl === 'whatsapp'"
                      id="text-field"
                      :value="valueText[3]"
                      readonly
                      dense
                      outlined
                    />
                    <v-btn
                      outlined
                      color="btn_primary"
                      class="ml-1"
                      @click="copy"
                    >
                      <v-icon> mdi-content-copy </v-icon>
                    </v-btn>
                  </v-col>
                  <v-col
                    cols="12"
                    md="8"
                  />
                </v-row>
              </v-col>
            </v-row>
          </v-container>
        </v-card-text>
      </v-card>
    </v-dialog>
  </v-container>
</template>

<script>
  export default {
    props: {
      dialog: {
        type: Object,
        default: null,
      },
      titleText: {
        type: String,
        default: "Share",
      },
    },
    data: () => ({
      icon: [
        {
          text: "mdi-facebook",
          color: "blue",
          value: "facebook",
          name: "facebook",
          link: "",
        },
        {
          text: "mdi-instagram",
          color: "red",
          value: "instagram",
          name: "instagram",
          link: "",
        },
        {
          text: "mdi-twitter",
          color: "blue",
          value: "twitter",
          name: "twitter",
          link: "",
        },
        {
          text: "mdi-whatsapp",
          color: "green",
          value: "whatsapp",
          name: "whatsapp",
          link: "",
        },
      ],
      currentUrl: "facebook",
    }),
    computed: {
      valueText () {
        const value = this.icon.map((x) => x.value)
        return value
      },
    },
    mounted () {
      console.log(this.dialog)
    },
    methods: {
      copy () {
        const copyText = document.getElementById("text-field")
        console.log(copyText.value)
        this.$emit("copy", { text: copyText.value })
      },
      currentTextUrl (text) {
        this.currentUrl = text
      },
      referalLink () {
        let text = ""
        if (this.currentUrl === "facebook") {
          const indexFB = this.icon.findIndex((x) => (x.name = "facebook"))
          text = this.icon[indexFB].value = this.dialog.data.link
        }
        if (this.currentUrl === "instagram") {
          const indexIG = this.icon.findIndex((x) => (x.name = "instagram"))
          text = this.icon[indexIG].value = this.dialog.data.link
        }
        if (this.currentUrl === "twitter") {
          const indexTW = this.icon.findIndex((x) => (x.name = "twitter"))
          text = this.icon[indexTW].value = this.dialog.data.link
        }
        if (this.currentUrl === "whatsapp") {
          const indexWA = this.icon.findIndex((x) => (x.name = "whatsapp"))
          text = this.icon[indexWA].value = this.dialog.data.link
        }
        return text
      },
    },
  }
</script>

<style lang="sass">
.mdi-custome
    font-size: 70px !important
.v--share
    transform: scale(1.1)
</style>
