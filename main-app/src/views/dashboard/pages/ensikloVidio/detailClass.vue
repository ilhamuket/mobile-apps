<template>
  <v-container>
    <v-card>
      <v-row class="ml-2">
        <v-col
          cols="12"
          md="4"
          sm="12"
        >
          <app-card-one :data="computedClass" />
          <app-btn-buy @buyNow="clickBuyNow" />
        </v-col>
        <v-col
          cols="12"
          md="8"
        >
          <app-card-two
            :data="computedClass"
            :user="computedMe"
          />
        </v-col>
      </v-row>
    </v-card>
    <v-card class="card--reviews">
      <v-row>
        <v-col cols="12">
          <app-card-reviews
            :value="valueReviews"
            :reviews="computedReviews"
          />
        </v-col>
      </v-row>
    </v-card>
    <app-dialog-buy
      :dialog="dialogBuy"
      :subcription="computedPlans"
      @input="storeCartEnsikloVideo"
    />
  </v-container>
</template>

<script>
  import cardOne from "./component_core/__cardOne.vue"
  import cardTwo from "./component_core/__cardTwo.vue"
  import cardReviews from "./component_core/__cardReviews.vue"
  import btn from "./components/__btn.vue"
  import componentDialogBuy from "./components/child/___dialogBuyNow.vue"
  export default {
    components: {
      "app-card-one": cardOne,
      "app-card-two": cardTwo,
      "app-card-reviews": cardReviews,
      "app-btn-buy": btn,
      "app-dialog-buy": componentDialogBuy,
    },
    data: () => ({
      isMobile: false,
      dialogBuy: {
        open: false,
        data: {},
      },
    }),
    computed: {
      computedClass () {
        return this.$store.state.ensikloVidio.show
      },
      computedMe () {
        return this.$store.state.user.me
      },
      valueReviews () {
        return this.$store.state.ensikloVidio.value
      },
      computedReviews () {
        return this.$store.state.ensikloVidio.reviews
      },
      computedPlans () {
        return this.$store.state.plan.data
      },
    },
    mounted () {
      this.showDataEnsikloVidio()
      this.getValueReviewsEnsiloVidio()
      this.getDataEnsikloVidioReviews()
      this.onResize()
      this.getDataPlans()
    },
    methods: {
      onResize () {
        if (window.innerWidth < 883) this.isMobile = true
        else this.isMobile = false
      },
      showDataEnsikloVidio () {
        this.$store
          .dispatch("ensikloVidio/showDataEnsikloVidio", {
            slug: this.$route.params.slug,
            entities: "category,studio.img,studio.reviews,studio.followers",
          })
          .then((res) => {})
      },
      getValueReviewsEnsiloVidio () {
        this.$store.dispatch("ensikloVidio/getValueReviewsEnsiloVidio", {
          class_id: this.$route.params.slug,
        })
      },
      getDataEnsikloVidioReviews () {
        this.$store.dispatch("ensikloVidio/getDataEnsikloVidioReviews", {
          class_slug: this.$route.params.slug,
          entities: "user,response",
        })
      },
      clickBuyNow () {
        this.dialogBuy.open = true
        this.dialogBuy.data = this.computedClass
        console.log(this.$route.params.id)
      },
      submit ({ item }) {
        // console.log(item)
        this.$store
          .dispatch("my_class/formRegisterEnsikloVideo", {
            video_id: this.$route.params.id,
            address: item.homeAddress,
            email: item.email,
            ttl: item.dateOfBirth,
            contact: item.noHp,
          })
          .then((res) => {
            this.$router.push("/cart-video")
            if (res.data.meta.status) {
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
                title: "Waiting for payment",
              })
            }
          })
      },
      getDataPlans () {
        this.$store
          .dispatch("plan/getDataPlans", {
            summary: "active",
          })
          .then((res) => {
            console.log(res.data.data)
          })
      },
      storeCartEnsikloVideo ({ item, planId }) {
        this.$store
          .dispatch("cart/storeCartEnsikloVideo", {
            video_id: item.id,
            plan_id: planId,
          })
          .then((res) => {
            if (res.data.meta.status) {
              this.$router.push("/cart-video")
              this.dialogBuy.open = false
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
                title: "Created Cart Successfully",
              })
            }
          })
      },
    },
  }
</script>

<style lang="sass">
.card--reviews
    margin-top: -10px
</style>
