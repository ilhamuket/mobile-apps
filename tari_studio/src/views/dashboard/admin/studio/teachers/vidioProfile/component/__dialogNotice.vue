<template>
  <v-container>
    <v-dialog
      v-model="dialog.open"
      width="60%"
    >
      <v-card>
        <v-system-bar
          :color="$vuetify.theme.dark ? '#141C31' : '#F0F8FF'"
          window
        >
          <v-toolbar-title
            :class="$vuetify.theme.dark ? 'white--text' : ' black--text'"
            class="font-spartan-small"
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
          <v-container>
            <v-row>
              <v-col cols="12">
                <span class="font-spartan-small">
                  {{ text }}
                </span>
                <br>
                <v-avatar
                  size="100"
                  tile
                >
                  <v-img :src="dialog.data.url_thumbnail" />
                </v-avatar>
                <span class="font-spartan-small">
                  {{ dialog.data.title }}
                </span>
              </v-col>
            </v-row>
          </v-container>
        </v-card-text>
        <v-card-text v-else>
          <v-container>
            <v-row>
              <v-col>
                <span class="font-spartan-small">
                  {{ text }}
                </span>
                <v-list-item
                  v-for="(item, i) in dialog.data"
                  :key="i"
                >
                  <v-list-item-avatar
                    size="100"
                    tile
                  >
                    <v-img :src="item.url_thumbnail" />
                  </v-list-item-avatar>
                  <v-list-item-title>
                    {{ item.title }}
                  </v-list-item-title>
                </v-list-item>
              </v-col>
            </v-row>
          </v-container>
        </v-card-text>
        <v-card-actions class="d-flex flex-row-reverse">
          <v-btn
            :color="colorBtn1"
            :text="outline1"
            @click="action"
          >
            {{ textBtn1 }}
          </v-btn>

          <v-btn
            :color="colorBtn2"
            :text="outline2"
            class="mr-1"
            @click="dialog.open = false"
          >
            {{ textBtn2 }}
          </v-btn>
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
        default: null,
      },
      byId: {
        type: Boolean,
        default: null,
      },
      icon: {
        type: String,
        default: "",
      },
      title: {
        type: String,
        default: "",
      },
      text: {
        type: String,
        default: "Fill text",
      },
      textBtn1: {
        type: String,
        default: "textBtn1",
      },
      textBtn2: {
        type: String,
        default: "textBtn2",
      },
      colorBtn1: {
        type: String,
        default: "btn_primary",
      },
      colorBtn2: {
        type: String,
        default: "red",
      },
      outline1: {
        type: Boolean,
        default: false,
      },
      outline2: {
        type: Boolean,
        default: true,
      },
    },
    methods: {
      action () {
        this.$emit("input", { item: this.dialog.data })
      },
    },
  }
</script>

<style></style>
