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
    >
      <v-btn
        :width="isMobile ? '313' : '370'"
        outlined
        color="btn_primary"
      >
        <v-icon>mdi-cart-check</v-icon>
        Buy Now
      </v-btn>
    </v-col>
    <v-col
      :class="isMobile ? '' : 'col__buying__modified'"
      cols="12"
    >
      <v-row>
        <v-col
          v-resize="onResize"
          :cols="isMobile ? '12' : '6'"
        >
          <v-btn
            :width="isMobile ? '313' : '183'"
            small
            outlined
            color="red"
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
            :width="isMobile ? '313' : '183'"
            small
            color="btn_primary"
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
