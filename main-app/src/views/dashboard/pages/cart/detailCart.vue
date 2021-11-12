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
                    label
                    class="text-h2 font-weight-bold"
                    color="btn_primary"
                    text-color="white"
                    widt
                  >Paid</v-chip>
                </span>
              </v-col>
              <v-col
                cols="12"
                md="5"
              >
                <span class="font-spartan-small">
                  Invoice Date 08/10/2021 <br>
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
                  Mahardika Kessuma Denie <br>
                  8907656876 <br>
                  dikamahar884@gmail.com <br><br>
                  Jalan Antasari 23b, Antapani, Bandung, JawaBarat INDONESIA
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
            </v-row>
          </v-container>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
  export default {}
</script>

<style></style>
