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
            <v-icon :color="$vuetify.theme.dark ? 'white' : 'black'">
              mdi-pencil
            </v-icon>
            <span class="font-spartan-small"> Edit Profile </span>
          </v-toolbar-title>

          <v-spacer />

          <v-icon @click="dialog.open = false">
            mdi-close
          </v-icon>
        </v-system-bar>
        <v-card-text>
          <v-row>
            <v-col cols="12">
              <v-text-field
                v-model="dialog.data.username_ig"
                label="Contact"
                placeholder="Edit Contact"
                type="number"
              />
            </v-col>
            <v-col cols="12">
              <v-text-field
                v-model="dialog.data.email"
                label="Email"
                placeholder="Edit Email"
              />
            </v-col>
            <v-col
              cols="12"
              class="d-flex flex-row-reverse"
            >
              <v-btn
                color="btn_primary"
                @click="update"
              >
                Update
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
      update () {
        this.$emit("input", { item: this.dialog.data })
      },
    },
  }
</script>

<style></style>
