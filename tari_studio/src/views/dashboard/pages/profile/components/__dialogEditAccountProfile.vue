<template>
  <v-container>
    <v-dialog
      v-model="dialog.open"
      width="70%"
    >
      <v-card>
        <v-system-bar
          :color="$vuetify.theme.dark ? '#141C31' : '#F0F8FF'"
          window
        >
          <v-toolbar-title
            :class="$vuetify.theme.dark ? 'white--text' : ' black--text'"
            class="font-spartan-small"
          >
            <v-tooltip>
              <template #activator="{ on, attrs }">
                <v-icon
                  v-bind="attrs"
                  class="font__icon__edit"
                  color="primary"
                  v-on="on"
                >
                  mdi-pencil
                </v-icon>
              </template>
              <span class="font-spartan-small"> Edit Profile Studio </span>
            </v-tooltip>
            Edit Profile
          </v-toolbar-title>

          <v-spacer />

          <v-icon @click="dialog.open = false">
            mdi-close
          </v-icon>
        </v-system-bar>
        <v-card-text>
          <v-container>
            <v-row>
              <v-col>
                <v-col cols="12">
                  <v-text-field
                    v-model="dialog.data.firstName"
                    label="FirstName"
                    placeholder="FirstName"
                    prepend-icon="mdi-alpha-f"
                    clearable
                  />
                </v-col>
                <v-col cols="12">
                  <v-text-field
                    v-model="dialog.data.lastName"
                    label="LastName"
                    placeholder="LastName"
                    prepend-icon="mdi-alpha-l"
                    clearable
                  />
                </v-col>
                <v-col cols="12">
                  <v-text-field
                    v-model="dialog.data.nickName"
                    label="Nickname"
                    placeholder="Nickname"
                    prepend-icon="mdi-account-outline"
                    clearable
                  />
                </v-col>
                <v-col cols="12">
                  <v-text-field
                    v-model="dialog.data.email"
                    label="email"
                    placeholder="email"
                    prepend-icon="mdi-at"
                    clearable
                  />
                </v-col>
                <v-col cols="12">
                  <v-text-field
                    v-model="dialog.data.noHp"
                    label="Contact"
                    placeholder="Contact"
                    prepend-icon="mdi-card-account-phone-outline"
                    clearable
                  />
                </v-col>
                <v-col cols="12">
                  <v-text-field
                    v-model="dialog.data.homeAddress"
                    label="Address"
                    placeholder="Address"
                    prepend-icon="mdi-map-marker-outline"
                    clearable
                  />
                </v-col>
              </v-col>
              <v-col
                cols="12"
                class="d-flex justify-end"
              >
                <v-btn
                  text
                  color="red"
                >
                  Cancel
                </v-btn>
                <v-btn
                  color="btn_primary"
                  @click="save"
                >
                  Save
                </v-btn>
              </v-col>
            </v-row>
          </v-container>
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
    methods: {
      save () {
        this.$emit("save", { item: this.dialog.data })
      },
    },
  }
</script>

<style></style>
