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
                </span>
              </v-col>
              <v-col
                cols="12"
                md="5"
              >
                <span
                  v-if="computedDetail.form"
                  class="font-spartan-small"
                >
                  Invoice Date
                  {{
                    computedDetail.form.created_at
                      | moment("dddd, MMMM Do YYYY")
                  }}
                  <br>
                  Payment Method {{ methods }} (Otomatis)
                </span>
              </v-col>
            </v-row>
            <v-divider class="divider__dark mt-2 mb-2" />
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
                v-if="computedDetail.form"
                cols="12"
                md="5"
              >
                <div class="d-flex flex-row">
                  <div class="d-flex flex-column">
                    <h3>Invoiced To :</h3>
                  </div>
                </div>
                <div class="d-flex flex-row">
                  <div class="d-flex flex-column font-spartan-small">
                    {{ computedDetail.form.fullName }}
                  </div>
                </div>
                <div class="d-flex flex-row">
                  <div class="d-flex flex-column font-spartan-small">
                    {{ computedDetail.form.contact }}
                  </div>
                </div>
                <div class="d-flex flex-row">
                  <div class="d-flex flex-column font-spartan-small">
                    {{ computedDetail.form.email }}
                  </div>
                </div>
                <div class="d-flex flex-row pt-8">
                  <div class="d-flex flex-column font-spartan-small">
                    {{ computedDetail.form.email }}
                  </div>
                </div>
              </v-col>
            </v-row>
            <v-divider class="divider__dark mt-2 mb-2" />
            <v-row v-if="computedDetail.video">
              <v-col cols="12">
                <div class="d-flex flex-row">
                  <div class="d-flex flex-column">
                    <h2>Invoice Item</h2>
                  </div>
                </div>

                <div class="d-flex flex-row mt-7">
                  <div class="d-flex flex-column">
                    <span class="font-spartan font-weight-bold grey--text">
                      {{
                        computedDetail.video ? computedDetail.video.name : "-"
                      }}
                      -
                      <span class="text-capitalize">
                        {{
                          computedDetail.video
                            ? computedDetail.video.levels
                            : "-"
                        }}
                      </span>
                    </span>
                  </div>
                </div>

                <div class="d-flex flex-row mt-4">
                  <div class="d-flex flex-column">
                    <span
                      v-if="computedDetail.video"
                      class="font-spartan font-weight-bold grey--text"
                    >
                      Total :
                      {{
                        computedDetail.video ? computedDetail.video.price : "-"
                      }}
                    </span>
                  </div>
                </div>
              </v-col>
            </v-row>
          </v-container>
        </v-card>
      </v-col>
      <v-col
        cols="12"
        md="3"
      >
        <v-card v-if="computedDetail.status === 'pending'">
          <v-container>
            <v-row>
              <v-col cols="12">
                <div class="d-flex flex-row">
                  <div class="d-flex flex-column">
                    <span class="font-spartan font-weight-bold">
                      EnsikloTari
                    </span>
                  </div>
                </div>
                <div class="d-flex flex-row">
                  <div class="d-flex flex-column">
                    <span class="font-spartan-small"> Actions </span>
                  </div>
                </div>
                <v-divider class="divider__dark mt-2 mb-2" />
                <div class="d-flex flex-row mt-4">
                  <div class="d-flex flex-column">
                    <v-select
                      v-model="methods"
                      outlined
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
                  </div>
                </div>
                <v-divider class="divider__dark mt-2 mb-2" />
                <div class="d-flex flex-row mt-2">
                  <div class="d-flex flex-column">
                    Total :
                    {{
                      computedDetail.video && computedDetail.form
                        ? computedDetail.video.price *
                          computedDetail.form.plan.date_count
                        : 0
                    }}
                  </div>
                </div>
                <div class="d-flex flex-row-reverse mt-2">
                  <div class="d-flex flex-column">
                    <v-btn
                      color="btn_primary"
                      small
                      @click="paymentData"
                    >
                      Pay Now
                      <v-icon
                        color="blue"
                        class="ml-2"
                      >
                        mdi-send
                      </v-icon>
                    </v-btn>
                  </div>
                </div>
              </v-col>
            </v-row>
          </v-container>
        </v-card>
        <div
          v-else
          class="mt-4"
        >
          <span class="mt-4 font-spartan btn_primary--text">
            {{ setNameStatus(computedDetail.status) }}
          </span>
        </div>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
  export default {
    data: () => ({
      items: ["BCA", "Alfa"],
      methods: 1,
    }),
    computed: {
      computedDetail () {
        return this.$store.state.cart.detail_cart_video
      },
      computedListBank () {
        return this.$store.state.bank.data
      },
    },
    mounted () {
      this.getDataDetailCartEnsikloVideo()
      this.getDataBank()
    },
    methods: {
      getDataDetailCartEnsikloVideo () {
        this.$store.dispatch("cart/getDataDetailCartEnsikloVideo", {
          id: this.$route.params.id,
          entities: "form.plan,video",
        })
      },
      getDataBank () {
        this.$store.dispatch("bank/getDataBank", {})
      },
      paymentData () {
        this.$store
          .dispatch("payment/paymentDataVideo", {
            bank_id: this.methods,
            cart_id: this.$route.params.id,
          })
          .then((res) => {
            if (res.data.meta.status) {
              this.$router.push("/cart-video")
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
      setNameStatus (status) {
        if (status === "waiting_confirmation") {
          return "Waiting Confirmation"
        } else if (status === "waiting_payment") {
          return "Waiting Payment"
        } else if (status === "paid") {
          return "Paid"
        }
      },
    },
  }
</script>

<style lang="sass">
hr.divider__dark.v-divider.theme--dark
    opacity: .2
</style>
