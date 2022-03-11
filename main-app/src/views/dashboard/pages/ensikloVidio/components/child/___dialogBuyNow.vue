<template>
  <v-container>
    <v-dialog
      v-model="dialog.open"
      width="70%"
    >
      <v-card class="card--buy__dialog">
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
                  :value="dialog.data.name"
                  label="Video Name"
                  disabled
                />
              </v-col>

              <v-container>
                <v-row class="d-flex justify-center">
                  <v-col
                    class="d-flex justify-start"
                    cols="12"
                  >
                    <div class="font-spartan primary--text">
                      Type Subscription
                    </div>
                  </v-col>
                  <v-col
                    v-for="(data, i) in subcription"
                    :key="i"
                    cols="12"
                    md="3"
                  >
                    <v-card
                      :class="`form__card cursor-pointer ${
                        selectedType === data.id ? 'selected' : ''
                      }`"
                      width="250"
                      @click.native="setPacketBuy(data.id)"
                    >
                      <v-card-text>
                        <div>{{ data.name }}</div>
                        <p class="text-h4 text--primary">
                          Harga : Rp. {{ dialog.data.price * data.date_count }}
                        </p>
                        <p>{{ data.date_count * 30 }} Days</p>
                        <div class="text--primary">
                          {{ data.about }}
                        </div>
                      </v-card-text>
                    </v-card>
                  </v-col>
                </v-row>
              </v-container>

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
      subcription: {
        type: Array,
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
      // subcription: [
      //   {
      //     name: "Paket 1",
      //     date: 1,
      //     levels: "30 Days",
      //     about: `Lorem ipsum dolor, sit amet consectetur adipisicing
      //                     elit. Repellendus non error vero quibusdam dignissimos
      //                     sapiente repellat quis quidem doloribus commodi.`,
      //   },
      //   {
      //     name: "Paket 2",
      //     date: 2,
      //     levels: "60 Days",
      //     about: `Lorem ipsum dolor, sit amet consectetur adipisicing
      //                     elit. Repellendus non error vero quibusdam dignissimos
      //                     sapiente repellat quis quidem doloribus commodi.`,
      //   },
      //   {
      //     name: "Paket 3",
      //     date: 3,
      //     levels: "90 Days",
      //     about: `Lorem ipsum dolor, sit amet consectetur adipisicing
      //                     elit. Repellendus non error vero quibusdam dignissimos
      //                     sapiente repellat quis quidem doloribus commodi.`,
      //   },
      // ],
      selectedType: "",
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
        this.$emit("input", { item: this.dialog.data, planId: this.selectedType })
      },
      setPacketBuy (item) {
        this.selectedType = item
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
.form
  &__card
    z-index: 43000
    &.selected
      border: 2px double #9DC4D1
      box-sizing: border-box !important
    // position: fixed
    &:hover
      transform: scale(.9)
      border: 2px double #9DC4D1
      box-sizing: border-box !important
.card--buy
  &__dialog
    position: relative !important
    top: 0
    left: 0
</style>
