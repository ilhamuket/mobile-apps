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
                    class="text-h2 text-capitalize font-weight-bold ml-2"
                    color="btn_primary"
                    text-color="white"
                    label
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
                  Payment Method {{ methods }} (Otomatis)
                </span>
              </v-col>
            </v-row>
          </v-container>
          <v-divider class="divider__dark" />
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
          <v-divider class="divider__dark" />
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
        v-if="computedInvoice.cart"
        cols="12"
        md="3"
      >
        <v-card v-if="computedInvoice.cart.status !== 'paid'">
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
            <!-- <v-divider class="divider__dark"class="mt-2 mb-2" /> -->
            <v-row>
              <v-col cols="12">
                <v-select
                  v-model="methods"
                  :items="computedListBank"
                  item-text="bank_name"
                  item-value="id"
                >
                  <template #selection="data">
                    <slot
                      name="item"
                      v-bind="data"
                    >
                      {{ data.item.bank_name }} -
                      {{ data.item.account_bank_number }} -
                      {{ data.item.name }}
                    </slot>
                    <!-- {{ data.item.item.id }} -->
                  </template>
                  <template #item="data">
                    <div>
                      <h3>{{ data.item.name }}</h3>
                      <p>
                        {{ data.item.account_bank_number }} -
                        {{ data.item.bank_name }}
                      </p>
                    </div>
                  </template>
                </v-select>
              </v-col>
            </v-row>
            <!-- <v-divider class="divider__dark"class="mt-2 mb-2" /> -->
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
                  @click="paymentData"
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
        <span
          v-else
          class="font-spartan-small btn_primary--text text--download mobile__query"
        >Download</span>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
  export default {
    data: () => ({
      items: ["AlfaMart", "VA BCA"],
      methods: 1,
      invoice: {
        class: {},
      },
    }),
    computed: {
      computedInvoice () {
        return this.$store.state.invoice.data
      },
      computedListBank () {
        return this.$store.state.bank.data
      },
    },
    mounted () {
      this.getDataInvoice()
      this.getDataBank()
    },
    methods: {
      getDataInvoice () {
        this.$store
          .dispatch("invoice/getDataInvoice", {
            id: this.$route.params.id,
            entities: "cart, class.category,class.img",
          })
          .then((res) => {
            this.invoice.class = res.data.data.class
          // console.log(this.invoice.class)
          })
      },
      paymentData () {
        this.$store
          .dispatch("payment/paymentData", {
            id: this.$route.params.cart_id,
            bank_id: this.methods,
          })
          .then((res) => {
            console.log(this.methods)
            if (res.data.meta.status) {
              this.$router.push("/cart")
              const Toast = this.$swal.mixin({
                toast: true,
                position: "bottom-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                  toast.addEventListener("mouseenter", this.$swal.stopTimer)
                  toast.addEventListener("mouseleave", this.$swal.resumeTimer)
                },
                popup: "swal2-show",
                backdrop: "swal2-backdrop-show",
                icon: "swal2-icon-show",
              })
              Toast.fire({
                icon: "success",
                title: "Fetch Data",
              })
            }
          })
      },
      getDataBank () {
        this.$store.dispatch("bank/getDataBank", {})
      },
    },
  }
</script>

<style lang="sass">
.chips--status--views
    width: 81px !important
    .v-chip__content
        font-size: 15px !important
.text--download
  cursor: pointer
hr.divider__dark.v-divider.theme--dark
    opacity: .2
@media screen and (max-width: 883px)
  .mobile
    &__query
      padding-left: 40%
@media screen and (min-width: 884px)
  .mobile
    &__query
      padding-left: 3%
</style>
