<template>
  <v-dialog v-model="dialog.open">
    <base-material-card>
      <!--  -->
    </base-material-card>
  </v-dialog>
</template>

<script>
  export default {
    props: {
      dialog: {
        type: Object,
        default: () => ({
          open: false,
          name: '',
        }),
      },
    },
  }
</script>

<style></style>
