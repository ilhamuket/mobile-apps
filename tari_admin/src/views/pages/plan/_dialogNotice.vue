<template>
  <base-dialog
    :open="dialogAction"
    :icon-system-bar="iconSystemBar"
    :title-system-bar="titleSystemBar"
    :color-system-bar="colorSystemBar"
    @close="dialog.open = false"
  >
    <template #form>
      <v-container>
        <v-row>
          <v-col cols="12">
            <v-text-field
              v-model="form.name"
              label="Name Plan"
              placeholder="name"
            />
            <v-select
              v-model="form.type"
              label="Type Plan"
              placeholder="Type Plan"
              :items="typeForm"
              item-text="text"
              item-value="value"
            />
            <v-text-field
              v-model="form.duration"
              label="Duration (Month)"
              placeholder="Duration"
              type="number"
            />
            <vue-editor
              v-model="form.about"
              placeholder="About"
            />
          </v-col>
          <v-col
            cols="12"
            class="d-flex justify-end"
          >
            <v-btn
              text
              color="red"
              class="mr-2"
            >
              cancel
            </v-btn>
            <v-btn
              color="btn_primary"
              @click="save"
            >
              Save
            </v-btn>
          </v-col>
        </v-row>
      </v-container>
    </template>
  </base-dialog>
</template>

<script>
  import { VueEditor } from 'vue2-quill-editor'
  export default {
    components: {
      VueEditor,
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
    data: () => ({
      form: {
        name: '',
        type: '',
        duration: '',
        about: '',
      },
      typeForm: [
        {
          text: 'EnsikloVideo',
          value: 'ensiklo-video',
        },
      ],
    }),
    computed: {
      dialogAction: {
        get () {
          return this.dialog.open
        },
        set (value) {
          this.dialog.open = !this.dialog.open
        },
      },
    },
    methods: {
      save () {
        this.$emit('input', { item: this.form })
      },
    },
  }
</script>

<style></style>
