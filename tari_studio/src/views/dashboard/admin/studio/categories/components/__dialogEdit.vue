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
            class="font-spartan-small"
          >
            <v-icon :color="$vuetify.theme.dark ? 'white' : 'black'">
              mdi-pencil
            </v-icon>
            Edit Category
          </v-toolbar-title>

          <v-spacer />

          <v-icon @click="dialog.open = false">
            mdi-close
          </v-icon>
        </v-system-bar>
        <v-container>
          <v-row>
            <v-col cols="12">
              <v-text-field
                v-model="dialog.data.name"
                label="Name Category"
                placeholder="Input Name Category"
                prepend-icon="mdi-rename-box"
              />
            </v-col>
            <v-col cols="12">
              <v-text-field
                v-model="dialog.data.display_name"
                label="Display Name"
                placeholder="Input Diplay Name"
                prepend-icon="mdi-alpha-d-box"
              />
            </v-col>
            <v-col
              cols="12"
              class="d-flex flex-row-reverse"
            >
              <v-btn
                color="primary"
                @click="updateData"
              >
                update
                <v-icon class="ml-2">
                  mdi-pencil-box-multiple-outline
                </v-icon>
              </v-btn>
              <v-btn
                text
                color="red"
                @click="dialog.open = false"
              >
                cancel
              </v-btn>
            </v-col>
          </v-row>
        </v-container>
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
      updateData () {
        this.$emit("input", { item: this.dialog.data })
      },
    },
  }
</script>

<style></style>
