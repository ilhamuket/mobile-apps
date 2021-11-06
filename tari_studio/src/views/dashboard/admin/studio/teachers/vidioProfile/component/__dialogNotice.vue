<template>
  <v-container>
    <v-dialog v-model="dialog.open">
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
                  <v-list-item-title>
                    {{ item.title }}
                  </v-list-item-title>
                </v-list-item>
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
    },
  }
</script>

<style></style>
