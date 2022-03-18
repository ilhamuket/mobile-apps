<template>
  <base-dialog
    :open="dialogAction"
    :icon-system-bar="iconSystemBar"
    :title-system-bar="titleSystemBar"
    :color-system-bar="colorSystemBar"
    @close="dialog.open = false"
  >
    <template #form>
      <v-container v-if="isForm">
        <v-row>
          <v-col
            v-if="isEdit"
            cols="12"
          >
            <v-text-field
              v-model="dialog.form.name"
              label="Name Plan"
              placeholder="name"
            />
            <v-select
              v-model="dialog.form.type"
              label="Type Plan"
              placeholder="Type Plan"
              :items="typeForm"
              item-text="text"
              item-value="value"
            />
            <v-text-field
              v-model="dialog.form.duration"
              label="Duration (Month)"
              placeholder="Duration"
              type="number"
            />
            <vue-editor
              v-model="dialog.form.about"
              placeholder="About"
            />
          </v-col>
          <v-col
            v-else
            cols="12"
          >
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
    <template #notice>
      <v-container v-if="isNotice">
        <v-row>
          <v-col cols="12">
            <span class="font-spartan btn_primary--text">
              {{ title }}
            </span>
          </v-col>
          <v-col
            cols="12"
            class="d-flex justify-end"
          >
            <v-btn
              :color="colorBtn1"
              :text="isTextBtn1"
              :outlined="isOutlinedBtn1"
              :class="classBtn1"
              @click="btnAction1"
            >
              {{ textBtn1 }}
            </v-btn>
            <v-btn
              :color="colorBtn2"
              :class="classBtn2"
              :text="isTextBtn2"
              :outlined="isOutlinedBtn2"
              @click="btnAction2"
            >
              {{ textBtn2 }}
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
      title: {
        type: String,
        default: null,
      },
      colorBtn1: {
        type: String,
        default: null,
      },
      isTextBtn1: {
        type: Boolean,
        default: false,
      },
      isOutlinedBtn1: {
        type: Boolean,
        default: false,
      },
      textBtn1: {
        type: String,
        default: null,
      },
      colorBtn2: {
        type: String,
        default: null,
      },
      isTextBtn2: {
        type: Boolean,
        default: false,
      },
      isOutlinedBtn2: {
        type: Boolean,
        default: false,
      },
      textBtn2: {
        type: String,
        default: null,
      },
      classBtn1: {
        type: String,
        default: null,
      },
      classBtn2: {
        type: String,
        default: null,
      },
      isArray: {
        type: Boolean,
        default: false,
      },
      isForm: {
        type: Boolean,
        default: false,
      },
      isNotice: {
        type: Boolean,
        default: false,
      },
      isEdit: {
        type: Boolean,
        default: false,
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
        if (this.isEdit) {
          this.$emit('edit', { item: this.dialog.form })
        } else {
          this.$emit('save', { item: this.form })
        }
      },
      btnAction1 () {
        this.$emit('actionBtnOne', { item: this.dialog.data })
      },
      btnAction2 () {
        this.$emit('actionBtnTwo', { item: this.dialog.data })
      },
    },
  }
</script>

<style></style>
