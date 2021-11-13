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
            <span class="font-spartan-small"> Create Class </span>
          </v-toolbar-title>

          <v-spacer />

          <v-icon @click="dialog.open = false">
            mdi-close
          </v-icon>
        </v-system-bar>
        <v-card-text>
          <v-container class="">
            <v-row class="d-flex justify-center">
              <v-col
                cols="12"
                md="4"
              >
                <v-icon
                  v-for="(item, i) in icon"
                  :key="i"
                  class="mdi-custome ml-2"
                  large
                  style="cursor: pointer"
                  :color="item.color"
                >
                  {{ item.text }}
                </v-icon>
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
    },
    data: () => ({
      icon: [
        {
          text: "mdi-facebook",
          color: "blue",
        },
        {
          text: "mdi-instagram",
          color: "red",
        },
        {
          text: "mdi-twitter",
          color: "blue",
        },
        {
          text: "mdi-whatsapp",
          color: "blue",
        },
      ],
    }),
  }
</script>

<style lang="sass">
.mdi-custome
    font-size: 70px !important
</style>
