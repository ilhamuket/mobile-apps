<template>
  <v-dialog
    v-model="dialog.open"
    width="70%"
  >
    <v-card>
      <base-system
        :icon="iconSystemBar"
        :title="titleSystemBar"
        :color="colorSystemBar"
        @close="dialog.open = false"
      />
      <v-card-text>
        <v-container>
          <v-row>
            <v-col cols="12">
              <v-text-field
                v-model="dialog.data.title"
                placeholder="Title"
                label="Title"
              />
            </v-col>
            <v-col cols="12">
              <quillEditor
                v-model="dialog.data.content"
                class="quill--editor"
              />
            </v-col>
            <v-col
              cols="12"
              class="d-flex justify-end"
            >
              <v-btn
                text
                color="red"
                @click="dialog.open = false"
              >
                cancel
              </v-btn>
              <v-btn
                color="btn_primary mr-2"
                @click="buttonActions"
              >
                Save
              </v-btn>
            </v-col>
          </v-row>
        </v-container>
      </v-card-text>
    </v-card>
  </v-dialog>
</template>

<script>
  import "quill/dist/quill.core.css"
  import "quill/dist/quill.snow.css"
  import "quill/dist/quill.bubble.css"

  import { quillEditor } from "vue-quill-editor"

  export default {
    components: {
      quillEditor,
    },
    props: {
      dialog: {
        type: Object,
        default: null,
      },
      iconSystemBar: {
        type: String,
        default: null,
      },
      titleSystemBar: {
        type: String,
        default: null,
      },
      colorSystemBar: {
        type: String,
        default: null,
      },
    },
    methods: {
      buttonActions () {
        this.$emit("input", { item: this.dialog.data })
      },
    },
  }
</script>

<style lang="sass">
.quill--editor
  height: 100vh
  margin: 0 0 5rem 0
</style>
