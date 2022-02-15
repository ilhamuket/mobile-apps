<template>
  <v-dialog
    v-model="dialog.open"
    width="80%"
  >
    <base-material-card
      class="mt-6"
      icon="mdi-plus"
    >
      <template #heading>
        <h3>
          Add Studio
        </h3>
      </template>

      <v-form class="mt-6">
        <v-text-field
          v-model="form.name"
          label="Name"
          placeholder="Input Name"
          outlined
          dense
        />
        <v-text-field
          v-model="form.prefix"
          label="Prefix"
          placeholder="Input Prefix"
          outlined
          dense
        />
        <v-text-field
          v-model="form.username"
          label="Username"
          placeholder="Input Username"
          outlined
          dense
        />
        <v-text-field
          v-model="form.email"
          label="Email"
          placeholder="Input Email"
          outlined
          dense
        />

        <v-text-field
          v-model="form.contact"
          label="Contact"
          placeholder="Input Contact"
          outlined
          dense
        />

        <v-text-field
          v-model="form.region"
          label="Region"
          placeholder="Input Region"
          outlined
          dense
        />

        <v-textarea
          v-model="form.about"
          outlined
          label="About"
          placeholder="About"
          dense
        />

        <div class="d-flex flex-row-reverse">
          <div class="d-flex flex-column ml-2">
            <v-btn
              outlined
              color="red"
              @click="dialog.open = false"
            >
              Cancel
            </v-btn>
          </div>
          <div class="d-flex flex-column">
            <v-btn
              outlined
              color="primary"
              @click="insertData"
            >
              Save
            </v-btn>
          </div>
        </div>
      </v-form>
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
        }),
      },
    },
    data: () => ({
      form: {
        name: '',
        prefix: '',
        username: '',
        email: '',
        region: '',
        contact: '',
        about: '',
      },
    }),
    methods: {
      insertData () {
        this.$emit('input', { item: this.form })
      },
    },
  }
</script>

<style></style>
