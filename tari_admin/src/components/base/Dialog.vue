<template>
  <v-container>
    <v-dialog
      v-model="open"
      width="70%"
    >
      <v-card>
        <base-system
          :icon="iconSystemBar"
          :title="titleSystemBar"
          :color="colorSystemBar"
          @close="open = false"
        />
        <v-card-text v-if="$slots.form">
          <slot name="form" />
        </v-card-text>
        <v-card-text v-if="$slots.notice">
          <slot name="notice" />
        </v-card-text>
      </v-card>
    </v-dialog>
  </v-container>
</template>

<script>
  export default {
    props: {
      open: {
        type: Boolean,
        default: false,
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
  }
</script>

<style></style>
