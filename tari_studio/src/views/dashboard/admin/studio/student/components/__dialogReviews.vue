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
            class="font-size-ather-roboto-mono"
          >
            <v-icon :color="$vuetify.theme.dark ? 'white' : 'black'">
              mdi-message-draw
            </v-icon>
            Send Request
          </v-toolbar-title>

          <v-spacer />

          <v-icon @click="dialog.open = false">
            mdi-close
          </v-icon>
        </v-system-bar>
        <v-card-text>
          <v-container>
            <v-row>
              <v-col cols="12">
                <span class="font-spartan-text">
                  Are you sure want to send a request reviews to
                </span>
                <div v-if="dialog.data">
                  <v-list-item
                    v-for="(item, i) in dialog.data"
                    :key="i"
                  >
                    <v-list-item-title>
                      {{ item.form.fullName }} - {{ item.classes.name }} -
                      {{ item.form.contact }} - {{ item.form.email }}
                    </v-list-item-title>
                  </v-list-item>
                </div>
              </v-col>
              <v-col
                cols="12"
                class="d-flex flex-row-reverse"
              >
                <v-btn
                  color="btn_primary"
                  @click="send"
                >
                  Send
                </v-btn>
                <v-btn
                  color="red"
                  text
                  @click="dialog.open = false"
                >
                  Cancel
                </v-btn>
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
    methods: {
      send () {
        this.$emit("input", { item: this.dialog.data })
      },
    },
  }
</script>

<style></style>
