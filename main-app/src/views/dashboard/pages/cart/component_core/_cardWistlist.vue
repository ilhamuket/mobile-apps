<template>
  <v-row>
    <v-col cols="12">
      <span class="font-spartan font-weight-bold ml-4">WistList</span>
      <span
        style="cursor:pointer"
        class="font-spartan-small margin__views hover--text font-weight-bold"
        @click="toPush('/studio')"
      >
        {{ $t('dahsboard.see') }} <v-icon>mdi-chevron-right</v-icon>
      </span>
    </v-col>
    <v-col
      cols="12"
      md="4"
      sm="4"
      class="col__wistlist"
    >
      <v-card color="#F0F2F5">
        <v-row>
          <v-col
            cols="12"
            md="4"
            sm="4"
          >
            <v-img
              width="100"
              src="https://images.tokopedia.net/img/cache/200-square/VqbcmM/2021/7/23/1e3d28f7-50ca-40b0-b4c1-b69da919a568.jpg.webp?ect=4g"
            />
          </v-col>
          <v-col
            cols="12"
            md="8"
            sm="8"
          >
            <span class="font-spartan-small"> Studio Hurip - </span>
            <span class="font-spartan-small">
              Gamyong
            </span>
            <br>
            <span
              class="font-spartan-small"
            >Kecak - <span class="font-spartan-small">Rp2000</span></span>
            <br>

            <div class="mt-6">
              <v-btn
                dark
                icon
              >
                <v-icon
                  medium
                  color="#8E8E8E"
                >
                  mdi-trash-can-outline
                </v-icon>
              </v-btn>
              <v-btn
                outlined
                small
                width="120"
                color="btn_primary"
              >
                <v-icon small>
                  mdi-plus
                </v-icon>
                Cart
              </v-btn>
            </div>
          </v-col>
        </v-row>
      </v-card>
    </v-col>
  </v-row>
</template>

<script>
  export default {}
</script>

<style lang="sass">
.margin__wistlist
    margin-top: -10px
.col__wistlist
    margin-top: -20px
    margin-left: 40px
.margin__views
    margin-left: 574px
    color: red
</style>
