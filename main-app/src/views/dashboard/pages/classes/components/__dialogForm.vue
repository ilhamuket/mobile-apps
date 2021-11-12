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
            class="font-size-ather-roboto-mono"
          >
            <v-icon :color="$vuetify.theme.dark ? 'white' : 'black'">
              mdi-pen-plus
            </v-icon>
            Register Form
          </v-toolbar-title>

          <v-spacer />

          <v-icon @click="dialog.open = false">
            mdi-close
          </v-icon>
        </v-system-bar>
        <v-card-text>
          <v-container>
            <v-form>
              <v-row>
                <v-col cols="12">
                  <v-text-field
                    v-model="fullName"
                    label="FullName"
                    placeholder="Fullname"
                  />
                </v-col>
                <v-col cols="12">
                  <v-text-field
                    v-model="user.noHp"
                    label="Contact"
                    placeholder="Contact"
                    type="number"
                  />
                </v-col>
                <v-col cols="12">
                  <v-text-field
                    v-model="address"
                    label="Address"
                    placeholder="Address"
                  />
                </v-col>
                <v-col cols="12">
                  <v-text-field
                    v-model="user.email"
                    label="E-mail"
                    placeholder="E-mail"
                    type="email"
                  />
                </v-col>
                <v-col cols="12">
                  <v-col cols="12">
                    <v-menu
                      ref="menu"
                      v-model="menu"
                      :close-on-content-click="false"
                      :return-value.sync="date"
                      transition="scale-transition"
                      offset-y
                      min-width="auto"
                    >
                      <template v-slot:activator="{ on, attrs }">
                        <v-text-field
                          v-model="user.dateOfBirth"
                          label="Date Of Birth"
                          readonly
                          v-bind="attrs"
                          v-on="on"
                        />
                      </template>
                      <v-date-picker
                        v-model="user.dateOfBirth"
                        no-title
                        scrollable
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
                          @click="$refs.menu.save(date)"
                        >
                          OK
                        </v-btn>
                      </v-date-picker>
                    </v-menu>
                  </v-col>
                </v-col>
                <v-col
                  cols="12"
                  class="d-flex flex-row-reverse"
                >
                  <v-btn
                    color="btn_primary"
                    @click="submit"
                  >
                    Submit <v-icon class="ml-2">
                      mdi-send
                    </v-icon>
                  </v-btn>
                  <v-btn
                    color="red"
                    text
                    @click="dialog.open = false"
                  >
                    Cancel
                  </v-btn>
                </v-col>
              </v-row>
            </v-form>
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
      user: {
        type: Object,
        default: null,
      },
    },
    data: () => ({
      date: "",
      menu: false,
      fullName: "",
      address: "",
    }),
    methods: {
      submit () {
        this.$emit("input", {
          item: {
            fullname: this.fullName,
            contact: this.user.noHp,
            email: this.user.email,
            ttl: this.user.dateOfBirth,
            address: this.address,
          },
        })
      },
    },
  }
</script>

<style></style>
