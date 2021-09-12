<template>
  <v-container>
    <v-dialog
      v-model="dialog.open"
      width="50%"
    >
      <v-card>
        <v-card-title class="font-spartan font-italic primary--text">
          Change Foto Profile

          <v-spacer />

          <v-icon
            aria-label="Close"
            @click="dialog.open = false"
          >
            mdi-close
          </v-icon>
        </v-card-title>
        <v-container>
          <v-row>
            <v-col>
              <v-file-input
                v-model="files"
                outlined
                dense
                show-size
                accept="image/png, image/jpeg, image/bmp"
              />
            </v-col>
          </v-row>
          <div class="d-flex flex-row-reverse">
            <div class="d-flex flex-column">
              <v-btn
                color="primary"
                @click="update"
              >
                Update
              </v-btn>
            </div>
            <div class="d-flex flex-column">
              <v-btn
                text
                color="red"
                @click="dialog.open = false"
              >
                Cancel
              </v-btn>
            </div>
          </div>
        </v-container>
      </v-card>
    </v-dialog>
  </v-container>
</template>

<script>
//   import axios from 'axios'
  export default {
    props: {
      dialog: {
        type: Object,
        default: null,
      },
    },
    data: () => ({
      files: null,
    }),
    methods: {
      update () {
        this.$emit('input', { item: this.files })
      },
    },
  }
</script>

<style></style>
