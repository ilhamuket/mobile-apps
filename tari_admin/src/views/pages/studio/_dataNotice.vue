<template>
  <base-dialog
    :open="dialog.open"
    :icon-system-bar="iconSystemBar"
    :title-system-bar="titleSystemBar"
    :color-system-bar="colorSystemBar"
    @close="dialog.open = false"
  >
    <template #notice>
      <v-container>
        <v-row>
          <v-col
            v-if="isDataArray"
            cols="12"
          >
            <span class="font-spartan">
              {{ title }}
            </span>
            <ol class="list-decimal">
              <li
                v-for="(item, i) in dialog.data"
                :key="i"
              >
                {{ item.name }} - {{ item.address }}
              </li>
            </ol>
          </v-col>
          <v-col v-else>
            <span class="font-spartan">
              {{ title }} - {{ dialog.data.name }}
            </span>
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
              Cancel
            </v-btn>
            <v-btn
              color="btn_primary"
              @click="actionClick"
            >
              Approved
            </v-btn>
          </v-col>
        </v-row>
      </v-container>
    </template>
  </base-dialog>
</template>

<script>
  export default {
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
      isDataArray: {
        type: Boolean,
        default: true,
      },
    },
    methods: {
      actionClick () {
        this.$emit('input', { item: this.dialog.data })
      },
    },
  }
</script>

<style></style>
