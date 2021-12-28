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
          >
            <v-icon color="blue">
              mdi-share-variant
            </v-icon>
            <span class="font-spartan-small"> Form Register </span>
          </v-toolbar-title>

          <v-spacer />

          <v-icon @click="dialog.open = false">
            mdi-close
          </v-icon>
        </v-system-bar>
        <v-card-text>
          <v-container>
            <v-row>
              <v-col cols="12">
                <v-text-field
                  :value="fullName"
                  label="Fullname"
                  prepend-icon="mdi-account"
                  disabled
                />
              </v-col>
              <v-col cols="12">
                <v-text-field
                  v-model="dialog.user.email"
                  label="E-mail"
                  prepend-icon="mdi-email-box"
                  disabled
                />
              </v-col>
              <v-col cols="12">
                <v-text-field
                  v-model="dialog.user.noHp"
                  label="Contact"
                  prepend-icon="mdi-account-box-outline"
                />
              </v-col>
              <v-col cols="12">
                <v-text-field
                  v-model="dialog.user.homeAddress"
                  label="Address"
                  prepend-icon="mdi-map-marker"
                />
              </v-col>
              <v-col cols="12">
                <v-menu
                  ref="menu"
                  v-model="menu"
                  :close-on-content-click="false"
                  :return-value.sync="dialog.user.dateOfBirth"
                  transition="scale-transition"
                  offset-y
                  min-width="auto"
                >
                  <template v-slot:activator="{ on, attrs }">
                    <v-text-field
                      v-model="dialog.user.dateOfBirth"
                      label="Date Of Birth"
                      prepend-icon="mdi-calendar"
                      readonly
                      v-bind="attrs"
                      v-on="on"
                    />
                  </template>
                  <v-date-picker
                    v-model="dialog.user.dateOfBirth"
                    no-title
                    scrollable
                    class="picker__register"
                  >
                    <v-spacer />
                    <v-btn
                      text
                      color="primary"
                      @click="menu = false"
                    >
                      Cancel
                    </v-btn>
                    <v-btn
                      text
                      color="primary"
                      @click="$refs.menu.save(dialog.user.dateOfBirth)"
                    >
                      OK
                    </v-btn>
                  </v-date-picker>
                </v-menu>
              </v-col>
              <v-col class="d-flex flex-row-reverse">
                <v-btn
                  color="btn_primary"
                  class="ml-2"
                  @click="registerEnsikloVideo"
                >
                  Register
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
      date: new Date(Date.now() - new Date().getTimezoneOffset() * 60000)
        .toISOString()
        .substr(0, 10),
      menu: false,
      modal: false,
      menu2: false,
      form: {
        contact: "",
        address: "",
        ttl: "",
      },
    }),
    computed: {
      fullName () {
        let name = ""
        if (this.dialog.user) {
          name = this.dialog.user.firstName + " " + this.dialog.user.lastName
        }
        return name
      },
    },
    methods: {
      registerEnsikloVideo () {
        this.$emit("input", { item: this.dialog.user })
      },
    },
  }
</script>

<style lang="sass">
.theme--dark
    .picker
       &__register
        .v-picker
            &__body
                background-color: #252935 !important
        .v-picker
            &__actions
                background-color: #252935 !important
</style>
