<template>
  <v-container v-if="$store.state.studio.isLoad">
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
    <v-skeleton-loader
      v-bind="attrs"
      type="card-avatar, article, actions"
    />
  </v-container>
  <v-container v-else>
    <v-row
      class="relative ml-6"
      :class="
        $vuetify.theme.dark ? 'customize-dark-scroll' : 'custumize-light-scroll'
      "
    >
      <v-col
        cols="12"
        md="12"
        class="overflow"
      >
        <v-row>
          <v-col
            cols="12"
            md="4"
            class="ml-5"
          >
            <v-text-field
              v-model="search"
              outlined
              dense
              :label="$t('search')"
              placeholder="Search"
              append-icon="mdi-magnify"
              @input="searchMethods"
            />
          </v-col>
        </v-row>
        <div
          v-if="is_loading"
          class="d-flex justify-center"
        >
          <v-progress-circular
            class="d-flex justify-center"
            indeterminate
            color="red"
          />
        </div>
        <span
          v-if="studio.length === 0"
          class="d-flex justify-center"
        >
          No Data Avalaible
        </span>

        <app-data-list-page
          v-else
          :data="dataStudio.data"
          :user="user"
          @follow="followStudio"
          @unFollow="executeUnfollowStudio"
          @like="likeStudio"
          @unLike="unLikeStudio"
        />
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
// import list from "./component_core/_list.vue"
  import list_ from "./component_core/_list_new.vue"
  export default {
    components: {
      // "app-data-list": list,
      "app-data-list-page": list_,
    },
    data: () => ({
      dataStudio: {
        meta: {},
        links: {},
        data: [],
      },
      page: 1,
      search: "",
      timer: null,
      isLoad: true,
      attrs: {
        class: "mb-6",
        boilerplate: true,
        elevation: 2,
      },
      is_loading: true,
    }),
    computed: {
      studio () {
        return this.$store.state.studio.data
      },
      user () {
        return this.$store.state.user.me
      },
    },
    mounted () {
      this.firstLoadStudio()
      this.getMe()
      this.scroll()
    },
    methods: {
      firstLoadStudio () {
        if (this.search !== null && this.search === "") {
          this.getDataStudio()
        } else {
          this.getDataSearch()
        }
      },
      getDataStudio (page) {
        this.$store
          .dispatch("studio/getDataStudio", {
            search: this.search,
            entities: "author,img,followers,likes,reviews",
            page: page,
            paginate: 6,
          })
          .then((res) => {
            if (res.data.meta.status) {
              if (this.search === "") {
                this.is_loading = false
                this.dataStudio.meta = res.data.meta
                this.dataStudio.links = res.data.links
                if (page === 1) {
                  this.dataStudio.data = res.data.data
                } else {
                  this.dataStudio.data.push(...res.data.data)
                  this.is_load = false
                }
              }
              if (this.search !== "") {
                this.dataStudio.data = res.data.data
                page = 1
                this.is_loading = false
              }

              if (this.studio.length === 0) {
                const Toast = this.$swal.mixin({
                  toast: true,
                  position: "top-end",
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
                  title: "Data Not Found",
                })
              }
            }
          })
      // .then(res => {
      //   if (res.data.meta.status) {
      //     this.isLoad = false
      //   }
      // })
      // this.$store.commit('studio/GET_OFF')
      },
      getDataSearch () {
        this.$store
          .dispatch("studio/getDataStudio", {
            search: this.search,
            entities: "author,img,followers,likes,reviews",
            paginate: 6,
          })
          .then((res) => {
            if (res.data.meta.status) {
              this.dataStudio.data = res.data.data
            }
          })
      },
      scroll () {
        window.onscroll = () => {
          const bottomOfWindow =
            document.documentElement.scrollTop + window.innerHeight >=
            document.documentElement.offsetHeight - 150

          if (bottomOfWindow) {
            this.moreStudio()
          }
        }
      },
      moreStudio () {
        if (this.dataStudio.links.next) {
          this.page++
          // console.log(this.page)
          this.is_load = true
          this.getDataStudio(this.page)
        }
      },
      getMe () {
        this.$store.dispatch("user/me")
      },
      followStudio ({ item }) {
        this.$store
          .dispatch("studio/followStudio", {
            slug: item.slug,
          })
          .then((res) => {
            if (res.data.meta.status) {
              // this.isFollow = true

              this.$swal.fire({
                customClass: {},
                title: "You have Followed this studio.",
                width: 600,
                padding: "3em",
                background:
                  "#fff url(https://sweetalert2.github.io/images/trees.png)",
                backdrop: `
  rgba(0,0,123,0.4)
  url("https://sweetalert2.github.io/images/nyan-cat.gif")
  left top
  no-repeat
`,
              })
            }
          })
      },
      executeUnfollowStudio ({ item }) {
        this.$store
          .dispatch("studio/unfollStudio", {
            slug: item.slug,
          })
          .then(({ data }) => {
            if (data.meta.status) {
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
                title: "You Unfollow this Studio",
              })
              this.getDataStudioBySlug()
            }
          })
      },
      likeStudio ({ item }) {
        this.$store
          .dispatch("studio/likeStudio", {
            slug: item.slug,
          })
          .then(({ data }) => {
            if (data.meta.status) {
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
                title: "You like this Studio",
              })
            }
          })
      },
      unLikeStudio ({ item }) {
        this.$store
          .dispatch("studio/unLikeStudio", {
            slug: item.slug,
          })
          .then(({ data }) => {
            if (data.meta.status) {
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
                title: "You Unlike this Studio",
              })
            }
          })
      },

      searchMethods () {
        if (this.timer) {
          clearTimeout(this.timer)
          this.timer = null
        }
        this.timer = setTimeout(() => {
          this.getDataStudio()
          this.is_loading = true
        }, 700)
      },
    },
  }
</script>
<style lang="sass">
.bg-dark
    background-color: #283046 !important
.theme--dark.v-expansion-panels .v-expansion-panel
    background-color: #283046 !important
    color: #FFFFFF
.relative
  overflow-y: hidden !important
  overflow-x: hidden !important
  position: relative !important
</style>
<style lang="sass" scoped>
.theme--dark
  .list--customize
    background-color: #141C31 !important
.theme--light
  .list--customize
    background-color: #f0f2f5 !important
</style>
