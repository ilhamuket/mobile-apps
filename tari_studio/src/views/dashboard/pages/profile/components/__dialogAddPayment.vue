<template>
  <v-container>
    <v-dialog v-model="dialog.open">
      <v-card>
        <v-system-bar
          :color="$vuetify.theme.dark ? '#141C31' : '#F0F8FF'"
          window
        >
          <v-toolbar-title
            :class="$vuetify.theme.dark ? 'white--text' : ' black--text'"
            class="font-size-ather-roboto-mono"
          >
            <v-icon :color="$vuetify.theme.dark ? 'white' : 'black'">
              mdi-pen-plus
            </v-icon>
            Add Bank Account
          </v-toolbar-title>

          <v-spacer />

          <v-icon @click="dialog.open = false">
            mdi-close
          </v-icon>
        </v-system-bar>
        <v-card-text>
          <v-row>
            <v-col cols="12">
              <v-text-field
                v-model="form.name"
                label="A / N *"
                placeholder="Name"
                prepend-icon="mdi-head-dots-horizontal-outline"
              />
            </v-col>
            <v-col cols="12">
              <v-text-field
                v-model="form.no_rek"
                label="Bank account number"
                placeholder="Bank account number"
                prepend-icon="mdi-bank-plus"
              />
            </v-col>
            <v-col cols="12">
              <v-text-field
                v-model="form.bank_name"
                label="Bank"
                placeholder="Bank Name"
                prepend-icon="mdi-bank-outline"
              />
            </v-col>
            <v-col
              cols="12"
              class="d-flex flex-row-reverse"
            >
              <v-btn
                color="btn_primary"
                @click="save"
              >
                Add Bank Account
                <v-icon class="ml-2">
                  mdi-bank-plus
                </v-icon>
              </v-btn>
              <v-btn
                text
                color="red"
                @click="dialog.open = false"
              >
                Cancel
              </v-btn>
            </v-col>
          </v-row>
        </v-card-text>
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
      form: {
        name: "",
        no_rek: "",
        bank_name: "",
        status: "not active",
      },
    }),
    methods: {
      save () {
        this.$emit("input", { item: this.form })
      },
    },
  }
</script>

<style></style>
