<template>
  <base-dialog
    :open="dialog.open"
    :icon-system-bar="iconSystemBar"
    :title-system-bar="titleSystemBar"
    :color-system-bar="colorSystemBar"
  >
    <template #notice>
      <v-container>
        <v-row>
          <v-col cols="12">
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
    },
  }
</script>

<style></style>
