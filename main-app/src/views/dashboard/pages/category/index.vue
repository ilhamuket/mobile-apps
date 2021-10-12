<template>
  <v-container>
    <v-row v-if="load_first">
      <loader
        object="#ff9633"
        color1="#ffffff"
        color2="#17fd3d"
        size="5"
        speed="2"
        bg="#343a40"
        objectbg="#999793"
        opacity="80"
        disable-scrolling="false"
        name="dots"
      />
    </v-row>
    <v-row v-else>
      <v-col cols="12">
        <app-page-list
          :data="category.data"
          :me="me"
          @follow="followCategory"
          @unfollow="unfollowCategory"
        />
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
  import listCategory from "./components/__listCategory.vue"
  export default {
    components: {
      "app-page-list": listCategory,
    },
    data: () => ({
      category: {
        meta: {},
        links: {},
        data: [],
      },
      page: 1,
      state_load: false,
      load_first: true,
    }),
    computed: {
      me () {
        const Me = localStorage.getItem("ME")
        const users = JSON.parse(Me)
        return users
      },
    },
    mounted () {
      this.getDataCategory()
      this.scroll()
    },
    methods: {
      getDataCategory (page) {
        this.$store
          .dispatch("category/getDataCategory", {
            entities: "studio.img,img,follow",
            page: page,
            paginate: 6,
          })
          .then(res => {
            if (res.data.meta.status) {
              this.load_first = false
              this.category.meta = res.data.meta
              this.category.links = res.data.links
              if (page === 1) {
                this.category.data = res.data.data
                this.state_load = false
              } else {
                this.category.data.push(...res.data.data)
                this.state_load = false
              }
            }
          })
      },
      scroll () {
        window.onscroll = () => {
          const bottomOfWindow =
            document.documentElement.scrollTop + window.innerHeight >=
            document.documentElement.offsetHeight

          if (bottomOfWindow) {
            this.moreCategory()
          }
        }
      },
      moreCategory () {
        if (this.category.links.next) {
          this.page++
          this.getDataCategory(this.page)
        }
      },
      followCategory ({ item }) {
        this.$store
          .dispatch("category/followCategory", {
            id: item.id,
            user: this.me,
          })
          .then(res => {
            if (res.data.meta.status) {
              const Toast = this.$swal.mixin({
                toast: true,
                position: "bottom-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: toast => {
                  toast.addEventListener("mouseenter", this.$swal.stopTimer)
                  toast.addEventListener("mouseleave", this.$swal.resumeTimer)
                },
                popup: "swal2-show",
                backdrop: "swal2-backdrop-show",
                icon: "swal2-icon-show",
              })
              Toast.fire({
                icon: "success",
                title: `Follow category ${res.data.data.name}`,
              })
            }
          })
      },
      unfollowCategory ({ item }) {
        this.$store
          .dispatch("category/unfollowCategory", {
            id: item.id,
          })
          .then(res => {
            if (res.data.meta.status) {
              const Toast = this.$swal.mixin({
                toast: true,
                position: "bottom-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: toast => {
                  toast.addEventListener("mouseenter", this.$swal.stopTimer)
                  toast.addEventListener("mouseleave", this.$swal.resumeTimer)
                },
                popup: "swal2-show",
                backdrop: "swal2-backdrop-show",
                icon: "swal2-icon-show",
              })
              Toast.fire({
                icon: "success",
                title: `UnFollow category ${res.data.data.name}`,
              })
            }
          })
      },
    },
  }
</script>

<style></style>
