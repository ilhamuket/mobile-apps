<template>
  <v-container>
    <v-row>
      <v-col
        cols="12"
        md="9"
      >
        <v-card>
          <v-container>
            <v-row>
              <v-col
                cols="12"
                md="7"
              >
                <span class="font-spartan">
                  Invoice #{{ $route.params.id }}
                  <v-chip
                    v-if="computedInvoice.cart"
                    width="200"
                    class="
                      text-h2 text-capitalize
                      font-weight-bold
                      chips--status--views
                    "
                    color="btn_primary"
                    text-color="white"
                  >{{ computedInvoice.cart.status }}</v-chip>
                </span>
              </v-col>
              <v-col
                cols="12"
                md="5"
              >
                <span class="font-spartan-small">
                  Invoice Date
                  {{
                    computedInvoice.created_at | moment("dddd, MMMM Do YYYY")
                  }}
                  <br>
                  Payment Method Indomaret/Alfamart (Otomatis)
                </span>
              </v-col>
            </v-row>
          </v-container>
          <v-divider />
          <v-container>
            <v-row>
              <v-col
                cols="12"
                md="7"
              >
                <h3>Pay To :</h3>
                <span class="font-spartan-small">
                  PT ENSIKLOTARI INDONESIA <br>
                  NPWP : 95.495.386.5-447.000<br>
                  Bank BCA : 296-0571960
                </span>
                <br>
                <br>
                <span class="font-spartan-small">
                  Antapani, Jl. Terusan Sekolah No.1-2, Cicaheum, Kec.
                  Kiaracondong, Kota Bandung, Jawa Barat 40282
                </span>
              </v-col>
              <v-col
                cols="12"
                md="5"
              >
                <h3>Invoiced To :</h3>
                <span class="font-spartan-small">
                  {{ computedInvoice.fullName }} <br>
                  {{ computedInvoice.contact }} <br>
                  {{ computedInvoice.email }} <br><br>
                  {{ computedInvoice.address }}
                </span>
              </v-col>
            </v-row>
          </v-container>
          <v-divider />
          <v-container>
            <v-row>
              <v-col cols="12">
                <h2>Invoice Items</h2>
              </v-col>

              <v-col
                v-if="computedInvoice.class"
                cols="12"
                md="7"
              >
                <span class="font-spartan grey--text font-weight-bold">
                  {{ computedInvoice.class.name }} -
                  {{ computedInvoice.class.levels }}
                </span>
                <br>
                <span
                  v-if="computedInvoice.class.category"
                  class="font-spartan-text grey--text"
                >
                  {{ computedInvoice.class.category.display_name }} <br>

                  {{
                    computedInvoice.class.end_at | moment("dddd, MMMM Do YYYY")
                  }}
                  - {{ computedInvoice.class.time_start }} s/d
                  {{ computedInvoice.class.time_end }}
                </span>
                <br>
                <br>
                <span
                  v-if="computedInvoice.class"
                  class="font-spartan font-weight-bold grey--text"
                >
                  Total : Rp{{ computedInvoice.class.harga }}
                </span>
              </v-col>
            </v-row>
          </v-container>
        </v-card>
      </v-col>
      <v-col
        cols="12"
        md="3"
      >
        <v-card>
          <v-container>
            <v-row>
              <v-col>
                <span class="font-spartan primary--text font-weight-bold">
                  EnsikloTari
                </span>
                <br>
                <span class="font-spartan-small grey--text"> Actions </span>
              </v-col>
            </v-row>
            <v-divider class="mt-2 mb-2" />
            <v-row>
              <v-col cols="12">
                <v-select
                  v-model="methods"
                  :items="items"
                />
              </v-col>
            </v-row>
            <v-divider class="mt-2 mb-2" />
            <v-row>
              <v-col cols="12">
                <span
                  v-if="computedInvoice.class"
                  class="font-spartan-text grey--text"
                >
                  SubTotal :
                  {{ computedInvoice.class.harga }}
                </span>
                <br>
                <span
                  v-if="computedInvoice.class"
                  class="font-spartan-text grey--text"
                >
                  credit : 0
                </span>
              </v-col>
            </v-row>
            <v-divider class="mt-2 mb-2" />
            <v-row>
              <v-col cols="12">
                <span
                  v-if="computedInvoice.class"
                  class="font-spartan-text grey--text"
                >
                  Total :
                  {{ computedInvoice.class.harga }}
                </span>
              </v-col>
              <v-col
                class="d-flex flex-row-reverse"
                cols="12"
              >
                <v-btn
                  color="btn_primary"
                  small
                >
                  Pay Now
                  <v-icon
                    class="ml-2"
                    color="primary"
                  >
                    mdi-send
                  </v-icon>
                </v-btn>
              </v-col>
            </v-row>
          </v-container>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
  export default {
    data: () => ({
      items: ["AlfaMart", "VA BCA"],
      methods: "VA BCA",
    }),
    computed: {
      computedInvoice () {
        return this.$store.state.invoice.data
      },
    },
    mounted () {
      this.getDataInvoice()
    },
    methods: {
      getDataInvoice () {
        this.$store.dispatch("invoice/getDataInvoice", {
          id: this.$route.params.id,
          entities: "cart, class.category,class.img",
        })
      },
    },
  }
</script>

<style lang="sass">
.chips--status--views
    width: 81px !important
    .v-chip__content
        font-size: 15px !important
</style>
