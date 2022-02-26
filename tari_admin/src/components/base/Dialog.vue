<template>
  <v-container>
    <v-dialog
      v-model="openDialog"
      persistent
      width="70%"
    >
      <v-card>
        <base-system
          :icon="iconSystemBar"
          :title="titleSystemBar"
          :color="colorSystemBar"
          @close="closeDialog"
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
    computed: {
      openDialog: {
        get () {
          return this.open
        },
        set () {
          this.open = !this.open
        },
      },
    },
    methods: {
      closeDialog () {
        this.$emit('close')
      },
    },
  }
</script>

<style></style>
