<template>
  <base-dialog
    :open="dialogAction"
    :icon-system-bar="iconSystemBar"
    :title-system-bar="titleSystemBar"
    :color-system-bar="colorSystemBar"
    @close="dialog.open = false"
  >
    <template #notice>
      <v-container>
        <v-row v-if="!isArray">
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
              class="mr-2"
              :color="colorBtn1"
              :text="isTextBtn1"
              :outlined="isOutlinedBtn1"
              @click="action1"
            >
              {{ textBtn1 }}
            </v-btn>
            <v-btn
              :color="colorBtn2"
              :text="isTextBtn2"
              :outlined="isOutlinedBtn2"
              @click="action2"
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
      isArray: {
        type: Boolean,
        default: false,
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
      action1 () {
        this.$emit('input1', { item: this.dialog.data })
      },
      action2 () {
        this.$emit('input2', { item: this.dialog.data })
      },
    },
  }
</script>

<style></style>
