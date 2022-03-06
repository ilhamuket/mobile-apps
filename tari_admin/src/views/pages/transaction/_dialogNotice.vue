<template>
  <base-dialog
    :open="dialogAction"
    :icon-system-bar="iconSystemBar"
    :title-system-bar="titleSystemBar"
    :color-system-bar="colorSystemBar"
    @close="dialog.open = false"
  >
    >
    <template #notice>
      <v-container>
        <v-row>
          <v-col cols="12">
            <span class="font-spartan">
              {{ title }} -
              {{ dialog.data.user ? dialog.data.user.nickName : '' }} -
              {{ dialog.data.bank ? dialog.data.bank.account_bank_number : '' }}
              -
              {{ dialog.data.bank ? dialog.data.bank.bank_name : '' }}
            </span>
          </v-col>
          <v-col
            cols="12"
            class="d-flex justify-end"
          >
            <v-btn
              color="red"
              text
              @click="dialog.open = false"
            >
              Cancel
            </v-btn>
            <v-btn
              color="btn_primary"
              @click="actionClick"
            >
              {{ textBtn }}
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
      title: {
        type: String,
        default: null,
      },
      titleSystemBar: {
        type: String,
        default: null,
      },
      iconSystemBar: {
        type: String,
        default: null,
      },
      colorSystemBar: {
        type: String,
        default: null,
      },
      textBtn: {
        type: String,
        default: null,
      },
    },
    computed: {
      dialogAction: {
        get () {
          return this.dialog.open
        },
        set () {
          this.dialog.open = !this.dialog.open
        },
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
