<template>
  <v-container>
    <v-row>
      <v-col cols="12">
        <app-reviews
          :data="computedDataClasses"
          @input="insertUserReviews"
        />
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
  import cardReviews from "./components_core/__cardReviews.vue"
  export default {
    components: {
      "app-reviews": cardReviews,
    },
    computed: {
      computedDataClasses () {
        return this.$store.state.studioClasses.show
      },
    },
    mounted () {
      this.getShowDataClasses()
      console.log(this.$route.params)
    },
    methods: {
      getShowDataClasses () {
        this.$store
          .dispatch("studioClasses/getShowDataClasses", {
            slug: this.$route.params.class_slug,
            entities: "img,studio,category",
          })
          .then()
      },
      insertUserReviews ({ item }) {
        this.$store
          .dispatch("studioReviews/insertUserReviews", {
            id: this.$route.params.id,
            body: item.body,
            ratings: item.ratings,
            class_id: this.computedDataClasses.id,
            studio_id: this.computedDataClasses.studio_id,
          })
          .then((res) => {
            if (res.data.meta.status) {
              this.$router.push("/pages/user/my-reviews")
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
                title: "Reviews Sucessfully",
              })
            }
          })
      },
    },
  }
</script>

<style></style>
