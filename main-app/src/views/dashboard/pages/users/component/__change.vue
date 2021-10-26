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
          >
            <v-icon :color="$vuetify.theme.dark ? 'white' : 'black'">
              mdi-pencil
            </v-icon>
            <span class="font-spartan-small">
              Edit Profile
            </span>
          </v-toolbar-title>

          <v-spacer />

          <v-icon @click="dialog.open = false">
            mdi-close
          </v-icon>
        </v-system-bar>
        <v-card-text>
          <v-form>
            <v-row>
              <v-col cols="12">
                <v-text-field
                  v-model="dialog.data.firstName"
                  label="firstName"
                  placeholder="Update FirstName"
                />
              </v-col>
              <v-col cols="12">
                <v-text-field
                  v-model="dialog.data.lastName"
                  label="lastName"
                  placeholder="Update lastName"
                />
              </v-col>
              <v-col cols="12">
                <v-text-field
                  v-model="dialog.data.nickName"
                  label="nickName"
                  placeholder="Update nickName"
                />
              </v-col>
              <v-col cols="12">
                <v-menu
                  v-model="menu2"
                  :close-on-content-click="false"
                  max-width="290"
                >
                  <template v-slot:activator="{ on, attrs }">
                    <v-text-field
                      :value="computedDateFormattedDatefns"
                      clearable
                      label="Formatted with datefns"
                      readonly
                      v-bind="attrs"
                      v-on="on"
                      @click:clear="date = null"
                    />
                  </template>
                  <v-date-picker
                    v-model="dialog.data.dateOfBirth"
                    @change="menu2 = false"
                  />
                </v-menu>
              </v-col>

              <v-col
                cols="12"
                class="d-flex flex-row-reverse"
              >
                <v-btn
                  color="btn_primary"
                  @click="update"
                >
                  Update
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
          </v-form>
        </v-card-text>
      </v-card>
    </v-dialog>
  </v-container>
</template>

<script>
  import moment from "moment"
  //   import { format, parseISO } from "date-fns"
  export default {
    props: {
      dialog: {
        type: Object,
        default: null,
      },
    },
    data: () => ({
      // https://github.com/date-fns/date-fns/blob/master/docs/upgradeGuide.md#string-arguments

      menu1: false,
      menu2: false,
    }),
    computed: {
      computedDateFormattedMomentjs () {
        return this.dialog.dialog.dateOfBirth
          ? moment(this.dialog.data.dateOfBirth).format("dddd, MMMM Do YYYY")
          : ""
      },
      computedDateFormattedDatefns () {
        return this.dialog.data.dateOfBirth
          ? moment(this.dialog.data.dateOfBirth).format("dddd, MMMM Do YYYY")
          : ""
      },
    },
    methods: {
      update () {
        this.$emit("input", { item: this.dialog.data })
      },
    },
  }
</script>

<style></style>
