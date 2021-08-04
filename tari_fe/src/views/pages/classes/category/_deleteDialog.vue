<template>
  <v-dialog v-model="dialog.open">
    <base-material-card icon="mdi-eye">
      <template v-slot:heading>
        <v-chip>
          <h3>
            Delete
          </h3>
        </v-chip>
      </template>
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
