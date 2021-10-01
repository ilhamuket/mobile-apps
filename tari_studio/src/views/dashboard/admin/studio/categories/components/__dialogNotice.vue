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
        <v-card-text>
          {{ textBody }}
          {{ dialog.data.display_name }} - # {{ dialog.data.id }}
        </v-card-text>

        <v-card-actions class="d-flex flex-row-reverse">
          <v-btn
            color="red"
            @click="actionsById"
          >
            {{ textBtn }}
            <v-icon
              small
              class="ml-1"
            >
              {{ textIconBtn }}
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
        default: 'mdi-trash-can-outline',
      },
      title: {
        type: String,
        default: 'Delete',
      },
      textBody: {
        type: String,
        default:
          ' Are You sure want to delete Everyting that related With Category Name :',
      },
      textBtn: {
        type: String,
        default: 'Delete',
      },
      textIconBtn: {
        type: String,
        default: 'mdi-trash-can-outline',
      },
      colorBtn2: {
        type: String,
        default: 'primary',
      },
    },
    data: () => ({
      isMobile: false,
    }),
    methods: {
      actionsById () {
        this.$emit('input', { item: this.dialog.data })
      },
      onResize () {
        if (window.innerWidth < 769) this.isMobile = true
        else this.isMobile = false
      },
    },
  }
</script>

<style></style>
