<template>
  <v-container>
    <v-dialog
      v-model="dialog.open"
      width="70%"
    >
      <v-card>
        <v-card-title class="text-h2 primary--text font-spartan">
          Create Category

          <v-spacer />

          <v-icon
            aria-label="Close"
            @click="dialog.open = false"
          >
            mdi-close
          </v-icon>
        </v-card-title>
        <v-container>
          <v-form v-model="invalid">
            <v-row>
              <v-col cols="12">
                <v-text-field
                  v-model="form.name"
                  :rules="[rules.required]"
                  label="Name"
                  placeholder="Input Name Category"
                  prepend-icon="mdi-rename-box"
                />
              </v-col>
              <v-col cols="12">
                <v-text-field
                  v-model="form.display_name"
                  :rules="[rules.required]"
                  label="Display Name"
                  placeholder="Input Diplay Name"
                  prepend-icon="mdi-alpha-d-box"
                />
              </v-col>
              <v-col cols="12">
                <v-select
                  v-model="form.status"
                  :rules="[rules.required]"
                  prepend-icon="mdi-alpha-s-box"
                  label="Status"
                  placeholder="Input Status"
                  :items="itemsStatus"
                />
              </v-col>
            </v-row>
            <div class="d-flex flex-row-reverse">
              <div class="d-flex flex-column">
                <v-btn
                  color="primary"
                  :disabled="!invalid"
                  @click="createForm"
                >
                  Create
                </v-btn>
              </div>

              <div class="d-flex flex-column ml-1">
                <v-btn
                  color="red"
                  text
                  @click="dialog.open = false"
                >
                  Cancel
                </v-btn>
              </div>
            </div>
          </v-form>
        </v-container>
      </v-card>
    </v-dialog>
  </v-container>
</template>

<script>
  export default {
    props: {
      dialog: {
        type: Object,
        default: null,
      },
    },
    data: () => ({
      itemsStatus: ["concept", "draft"],
      form: {
        name: "",
        display_name: "",
        status: "",
      },
      invalid: true,
      rules: {
        required: (value) => !!value || "Filled Form",
      },
    }),
    methods: {
      createForm () {
        this.$emit("input", { item: this.form })
      },
    },
  }
</script>

<style></style>
