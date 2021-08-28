<template>
  <v-dialog
    v-model="dialog.open"
    width="30%"
    class="rounded-xl"
  >
    <v-card class="rounded-xl">
      <v-card-text>
        <v-avatar
          size="100"
          class="d-flex justify-center mx-auto elevation-6 mt-2"
          color="grey"
        >
          <v-img :src="dialog.img" />
        </v-avatar>
        <div
          class="d-flex flex-row justify-center mt-2 font-roboto-mono-small customize-font"
        >
          <div class="d-flex flex-column">
            <h2>Stopped Followed {{ dialog.name }} ?</h2>
          </div>
        </div>
      </v-card-text>
      <v-divider
        class="mb-1 mt-1"
        :class="$vuetify.theme.dark ? 'bg-divider' : ''"
      />
      <div class="d-flex flex-row justify-center">
        <div class="d-flex flex-column">
          <v-btn
            text
            color="red"
            @click="execute(dialog)"
          >
            UnFollow
          </v-btn>
        </div>
      </div>
      <v-divider
        :class="$vuetify.theme.dark ? 'bg-divider' : ''"
        class="mt-1 mb-1"
      />
      <div class="d-flex flex-row justify-center">
        <div class="d-flex flex-column">
          <v-btn
            text
            @click="dialog.open = false"
          >
            Cancel
          </v-btn>
        </div>
      </div>
    </v-card>
  </v-dialog>
</template>

<script>
  export default {
    props: {
      dialog: {
        type: Object,
        default: () => ({
          open: false,
        }),
      },
    },
    methods: {
      execute (item) {
        this.$emit('input', { item: item })
      },
    },
  }
</script>

<style lang="sass" scoped>
.theme--light
    .customize-font
        color: #1E2424 !important
//    font-size: 12px
.theme--dark
    .customize-font
        color: #AEB4B0 !important
//    font-size: 12p
.bg-divider
    opacity: .2
</style>
