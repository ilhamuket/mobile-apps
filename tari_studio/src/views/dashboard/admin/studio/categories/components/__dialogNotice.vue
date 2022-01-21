<template>
  <v-container v-resize="onResize">
    <v-dialog
      v-model="dialog.open"
      :width="isMobile ? '100%' : '50%'"
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
            <v-icon :color="iconColor">
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
          {{ textBody }}
          <br>
          #{{ dialog.data.id }} - {{ dialog.data.display_name }}
        </v-card-text>
        <v-card-text v-else>
          {{ textBody }}
          <v-list>
            <v-list-item
              v-for="(item, i) in dialog.data"
              :key="i"
            >
              #{{ item.id }} - {{ item.display_name }}
            </v-list-item>
          </v-list>
        </v-card-text>

        <v-card-actions class="d-flex flex-row-reverse">
          <v-btn
            v-if="byId"
            :color="colorBtn1"
            @click="actionsById"
          >
            {{ textBtn }}
            <v-icon
              small
              class="ml-1"
            >
              {{ iconBtn }}
            </v-icon>
          </v-btn>
          <v-btn
            v-else
            :color="colorBtn1"
            @click="actionSelected"
          >
            {{ textBtnSelected }}
            <v-icon>
              {{ iconBtn }}
            </v-icon>
          </v-btn>
          <v-btn
            text
            :color="colorBtn2"
            @click="dialog.open = false"
          >
            Cancel
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
      icon: {
        type: String,
        default: "mdi-trash-can-outline",
      },
      title: {
        type: String,
        default: "Delete",
      },
      textBody: {
        type: String,
        default:
          " Are You sure want to delete Everyting that related With Category Name :",
      },
      byId: {
        type: Boolean,
        default: false,
      },
      textBtn: {
        type: String,
        default: "Delete",
      },
      iconBtn: {
        type: String,
        default: "mdi-trash-can-outline",
      },
      colorBtn1: {
        type: String,
        default: "red",
      },
      colorBtn2: {
        type: String,
        default: "primary",
      },
      textBtnSelected: {
        type: String,
        default: "Delete",
      },
      iconColor: {
        type: String,
        default: "btn_primary",
      },
    },
    data: () => ({
      isMobile: false,
    }),
    methods: {
      actionsById () {
        this.$emit("input", { item: this.dialog.data })
      },
      actionSelected () {
        this.$emit("input", { item: this.dialog.data })
      },
      onResize () {
        if (window.innerWidth < 769) this.isMobile = true
        else this.isMobile = false
      },
    },
  }
</script>

<style></style>
