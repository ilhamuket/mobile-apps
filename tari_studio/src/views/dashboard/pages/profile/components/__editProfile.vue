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
            class="font-spartan-small"
          >
            <v-icon
              class="font__icon__edit"
              color="primary"
            >
              mdi-pencil
            </v-icon>
            Edit Profile
          </v-toolbar-title>

          <v-spacer />

          <v-icon @click="dialog.open = false">
            mdi-close
          </v-icon>
        </v-system-bar>
        <v-container>
          <v-row>
            <v-col cols="12">
              <v-text-field
                v-model="dialog.data.name"
                label="Name Studio"
                prepend-icon="mdi-rename-box"
                clearable
              />
            </v-col>
            <v-col cols="12">
              <v-text-field
                v-model="dialog.data.prefix"
                label="Keyword"
                prepend-icon="mdi-alpha-k-circle-outline"
                clearable
              />
            </v-col>
            <v-col cols="12">
              <v-text-field
                v-model="dialog.data.email"
                label="Email"
                prepend-icon="mdi-at"
                clearable
              />
            </v-col>
            <v-col cols="12">
              <v-text-field
                v-model="dialog.data.contact"
                label="Contact"
                prepend-icon="mdi-phone"
                clearable
              />
            </v-col>
            <v-col cols="12">
              <v-text-field
                v-model="dialog.data.address"
                label="Address"
                prepend-icon="mdi-map-marker-outline"
                clearable
              />
            </v-col>
            <v-col cols="12">
              <v-textarea
                v-model="dialog.data.about"
                label="About"
                prepend-icon="mdi-information-outline"
              />
            </v-col>
            <v-col
              cols="12"
              class="d-flex flex-row-reverse"
            >
              <v-btn
                color="btn_primary"
                @click="updateProfile"
              >
                update
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
    methods: {
      updateProfile () {
        this.$emit('update', { item: this.dialog.data })
      },
    },
  }
</script>

<style lang="sass">
.font__icon__edit
    font-size: 14px !important
</style>
