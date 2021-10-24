<template>
  <v-container>
    <v-dialog
      v-model="dialog.open"
      width="50%"
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
          <span class="font-spartan-text">
            {{ text }} {{ dialog.data.name }} - {{ dialog.data.bank_name }} -
            {{ dialog.data.no_rek }}
          </span>
        </v-card-text>
        <v-card-text v-else>
          <span class="font-spartan-text">
            {{ text }}
          </span>
          <v-list-item
            v-for="(item, i) in dialog.data"
            :key="i"
          >
            <v-list-item-title>
              #{{ item.name }} - {{ item.bank_name }} - {{ item.no_rek }}
            </v-list-item-title>
          </v-list-item>
        </v-card-text>
        <v-card-actions
          v-if="byId"
          class="d-flex flex-row-reverse"
          @click="deleteById"
        >
          <v-btn color="red">
            Delete
          </v-btn>
          <v-btn
            color="btn_primary"
            @click="dialog.open = false"
          >
            Cancel
          </v-btn>
        </v-card-actions>
        <v-card-actions
          v-else
          class="d-flex flex-row-reverse"
          @click="action1"
        >
          <v-btn color="red">
            {{ textBtn1 }}
          </v-btn>
          <v-btn
            color="btn_primary"
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
        default: "mdi-trash",
      },
      title: {
        type: String,
        default: "Delete",
      },
      byId: {
        type: Boolean,
        default: false,
      },
      text: {
        type: String,
        default: "text",
      },
      textBtn1: {
        type: String,
        default: "Delete",
      },
    },
    methods: {
      deleteById () {
        this.$emit("input", { item: this.dialog.data })
      },
      action1 () {
        this.$emit("input", { item: this.dialog.data })
      },
    },
  }
</script>

<style></style>
