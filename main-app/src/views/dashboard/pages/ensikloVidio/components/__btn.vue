<template>
  <v-row
    class=""
    :class="isMobile ? 'd-flex justify-center' : 'row__buyying'"
  >
    <!-- <v-col md="6" cols="12">
      <v-btn
        width="185"
        color="btn_primary"
      >
        <v-icon class="mr-1">
          mdi-cart
        </v-icon>
        Cart
      </v-btn>
    </v-col> -->
    <v-col
      v-resize="onResize"
      cols="12"
      class="mobile__col--buynow mobile__cols--375 cols__btn"
    >
      <v-btn
        outlined
        color="btn_primary"
        class="width--btn-buynow width-375 width-desktop"
        @click="buyNow"
      >
        <v-icon>mdi-cart-check</v-icon>
        Buy Now
      </v-btn>
    </v-col>
    <v-col
      class="mobile__col--buynow mobile__cols--375 cols__btn--two"
      :class="isMobile ? '' : 'col__buying__modified'"
      cols="12"
    >
      <v-row>
        <v-col
          v-resize="onResize"
          :cols="isMobile ? '12' : '6'"
        >
          <v-btn
            small
            outlined
            color="red"
            class="width--btn-buynow width-375 btn--two"
          >
            <v-icon class="mr-2">
              mdi-heart
            </v-icon>
            WishList
          </v-btn>
        </v-col>
        <v-col
          v-resize="onResize"
          :cols="isMobile ? '12' : '6'"
        >
          <v-btn
            small
            color="btn_primary"
            class="width--btn-buynow width-375 btn--share"
            @click="openDialogShare"
          >
            <v-icon class="mr-2">
              mdi-share-variant
            </v-icon>
            Share
          </v-btn>
        </v-col>
      </v-row>
    </v-col>
    <app-dialog-share :dialog="share" />
  </v-row>
</template>

<script>
  import noticeShare from "./__dialogNoticeShare.vue"
  export default {
    components: {
      "app-dialog-share": noticeShare,
    },
    data: () => ({
      share: {
        open: false,
      },
      isMobile: false,
    }),
    created () {
      this.onResize()
      console.log("IsmObile :", this.isMobile)
      console.log("Tinggi : ", window.innerHeight)
      console.log("Lebar : ", window.innerWidth)
    },
    methods: {
      openDialogShare () {
        this.share.open = true
      },
      onResize () {
        if (window.innerWidth < 883) this.isMobile = true
        // if (window.innerWidth > 883) this.isMobile = false
        else this.isMobile = false
      },
      buyNow () {
        this.$emit("buyNow")
      },
    },
  }
</script>

<style lang="sass" scoped>
.row__buyying
    margin-top: 90px
.col__buying__modified
    margin-top: -20px !important
    margin-left: -1px !important
</style>
<style lang="sass">
@media screen and (min-width: 884px)
  .cols
    &__btn
      padding-left: 3%
      .width-desktop
        width: 95% !important
    &__btn--two
      padding-left: 3%
      .btn--two
        width: 110% !important
      .btn--share
        width: 90% !important
@media screen and (min-width: 410px) and (max-width: 883px)
  .mobile
    &__col--buynow
      padding-left: 3%
      .width--btn-buynow
        width: 95% !important
@media screen and (max-width: 376px)
  .mobile
    &__cols--375
      padding-left: 3%
      .width-375
        width: 95% !important
</style>
