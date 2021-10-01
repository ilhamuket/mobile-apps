<template>
  <v-container>
    <v-row v-if="is_load">
      <loader
        object="#ff9633"
        color1="#ffffff"
        color2="#24e544"
        size="5"
        speed="2"
        bg="#343a40"
        objectbg="#e79b04"
        opacity="52"
        disable-scrolling="false"
        name="dots"
      />
      <v-row>
        <v-col
          cols="12"
          md="12"
        >
          <v-skeleton-loader
            class="bg-"
            v-bind="attrsLoad"
            type="date-picker"
          />
        </v-col>

        <v-col cols="12">
          <v-skeleton-loader
            v-bind="attrsLoad"
            type="list-item-avatar, divider, list-item-three-line, card-heading, image, actions"
          />

          <v-skeleton-loader
            v-bind="attrsLoad"
            type="list-item-avatar-three-line, image, article"
          />
        </v-col>
      </v-row>
    </v-row>
    <v-row v-else>
      <v-col
        v-resize="onResize"
        cols="12"
      >
        <app-card
          v-if="!isMobile"
          :studio="computedStudio"
          :ratings="computedRatings"
        />
      </v-col>
      <v-col cols="12">
        <v-tabs
          v-model="tabs"
          background-color="btn_primary"
          color="btn_primary"
          class="tabs-profile"
          show-arrows
        >
          <v-tab class="font-spartan-small">
            Home
          </v-tab>
          <v-tab class="font-spartan-small">
            Profile
          </v-tab>
          <v-tab class="font-spartan-small">
            Social Media
          </v-tab>
          <v-tab class="font-spartan-small">
            Discusses
          </v-tab>
          <v-tab class="font-spartan-small">
            Reviews
          </v-tab>
        </v-tabs>
        <v-tabs-items v-model="tabs">
          <v-tab-item>
            <app-page-summarry :summary="cumputedSummary" />
          </v-tab-item>
          <v-tab-item>
            <app-page-one
              :data="computedStudio"
              @edit="upEditProfile"
            />
          </v-tab-item>
          <v-tab-item>
            <app-page-medsos :data="computedStudio" />
          </v-tab-item>
          <v-tab-item>
            <app-page-discusses
              :data="computedDiscuss"
              @reply="upReply"
              @refresh="refresh"
              @delete="upDialogDiscussDelete"
            />
          </v-tab-item>
          <v-tab-item>
            <app-page-reviews :data="computedReviews" />
          </v-tab-item>
        </v-tabs-items>
      </v-col>
    </v-row>
    <app-dialog-reply
      :dialog="reply"
      @send="replyDataStudioDiscuss"
    />
    <app-dialog-notice
      :dialog="deleteDiscuss"
      :by-id="true"
      title="Delete"
      text="card_notice.discuss.del"
      text-button1="Delete"
      icon="mdi-delete "
      color-button1="red"
      color-button2="primary"
      @input="deleteDataDiscusses"
    />
    <app-dialog-edit-profile
      :dialog="dialogEditProfile"
      @update="updateDataStudios"
    />
  </v-container>
</template>

<script>
  import card from './components_core/__cardDetail.vue'
  import pageOne from './components_core/_pageProfile.vue'
  import summary from './components_core/_pageSummary.vue'
  import medsos from './components_core/_pageSocilaMedia.vue'
  import discuss from './components_core/_pageDiscusses.vue'
  import reviews from './components_core/_pageReviews.vue'
  import reply from './components/__dialogReply.vue'
  import notice from './components/__dialogNotice.vue'
  import editProfile from './components/__editProfile.vue'
  export default {
    components: {
      'app-card': card,
      'app-page-one': pageOne,
      'app-page-summarry': summary,
      'app-page-medsos': medsos,
      'app-page-discusses': discuss,
      'app-page-reviews': reviews,
      'app-dialog-reply': reply,
      'app-dialog-notice': notice,
      'app-dialog-edit-profile': editProfile,
    },
    data: () => ({
      tabs: null,
      isMobile: false,
      is_load: true,
      attrsLoad: {
        class: 'mb-6',
        boilerplate: true,
        elevation: 2,
      },
      reply: {
        open: false,
        data: {},
      },
      deleteDiscuss: {
        open: false,
        id: 0,
        data: {},
      },
      dialogEditProfile: {
        open: false,
        data: {},
      },
      params: '',
    }),
    computed: {
      computedMe () {
        return this.$store.$state.user.me
      },
      cumputedSummary () {
        return this.$store.state.dashboardSummary.data
      },
      computedStudio () {
        return this.$store.state.studio.me
      },
      computedRatings () {
        return this.$store.state.studioReviews.data
      },
      computedDiscuss () {
        return this.$store.state.studioDiscusses.data
      },
      computedReviews () {
        return this.$store.state.studioReviews.data
      },
    },
    watch: {
      tabs () {
        if (this.tabs === 0) {
          this.params = 'home'
          const params = (this.$route.params.params = this.params)
          this.$router.push(params).catch(() => {})
        } else if (this.tabs === 1) {
          this.params = 'profile'
          const params = (this.$route.params.params = this.params)
          this.$router.push(params).catch(() => {})
        } else if (this.tabs === 2) {
          this.params = 'socmed'
          const params = (this.$route.params.params = this.params)
          this.$router.push(params).catch(() => {})
        } else if (this.tabs === 3) {
          this.params = 'discusses'
          const params = (this.$route.params.params = this.params)
          this.$router.push(params).catch(() => {})
        } else if (this.tabs === 4) {
          this.params = 'reviews'
          const params = (this.$route.params.params = this.params)
          this.$router.push(params).catch(() => {})
        }
      },
      '$route.params.params': function (val) {
        return (this.params = val)
      },
    },
    mounted () {
      this.me()
      this.getDataSummary()
      this.getStudioMe()
      this.getDataReviewsStudio()
      this.getDataStudioDiscusses()
      this.firstLoad()
    },
    methods: {
      firstLoad () {
        if (this.$route.params.params === 'home') return (this.tabs = 0)
        else if (this.$route.params.params === 'profile') return (this.tabs = 1)
        else if (this.$route.params.params === 'socmed') return (this.tabs = 2)
        else if (this.$route.params.params === 'discusses') return (this.tabs = 3)
        else if (this.$route.params.params === 'reviews') return (this.tabs = 4)
        else return (this.tabs = 0)
      },
      me () {
        this.$store
          .dispatch('user/me', {
            entities: 'studio',
          })
          .then(res => {
            this.users = res.data.data
            this.is_load = false
          })
      },
      onResize () {
        if (window.innerWidth < 769) this.isMobile = true
        else this.isMobile = false
      },
      getStudioMe () {
        this.$store
          .dispatch('studio/getDataMeStudio', {
            entities: 'likes,followers,img',
          })
          .then(res => {
            if (res.data.meta.status) {
              this.is_load = false
            }
          })
      },
      updateDataStudios ({ item }) {
        console.log(item)
        this.$store
          .dispatch('studios/updateDataStudios', {
            name: item.name,
            prefix: item.prefix,
            email: item.email,
            contact: item.contact,
            address: item.address,
            about: item.about,
          })
          .then(res => {
            if (res.data.meta.status) {
              this.dialogEditProfile.open = false
              const Toast = this.$swal.mixin({
                toast: true,
                position: 'bottom-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: toast => {
                  toast.addEventListener('mouseenter', this.$swal.stopTimer)
                  toast.addEventListener('mouseleave', this.$swal.resumeTimer)
                },
                popup: 'swal2-show',
                backdrop: 'swal2-backdrop-show',
                icon: 'swal2-icon-show',
              })
              Toast.fire({
                icon: 'success',
                title: 'Data Repllied Successfully',
              })
            }
          })
      },
      getDataReviewsStudio () {
        this.$store.dispatch('studioReviews/getDataReviewsStudio', {
          entities: 'class,user.img',
        })
      },
      toClass () {
        this.$router.push('/class')
      },
      getDataSummary () {
        this.$store.dispatch('dashboardSummary/getDataSummary')
      },
      toNavigate (link) {
        this.$router.push(link)
      },
      getDataStudioDiscusses () {
        this.$store.dispatch('studioDiscusses/getDataStudioDiscusses', {
          entities: 'class.img,user.img,child,likes',
        })
      },
      upReply ({ item }) {
        this.reply.open = true
        this.reply.data = item
      // console.log(item)
      },
      upEditProfile ({ item }) {
        this.dialogEditProfile.open = true
        this.dialogEditProfile.data = item
      },
      upDialogDiscussDelete ({ item }) {
        this.deleteDiscuss.open = true
        this.deleteDiscuss.data = item
        this.deleteDiscuss.id = item.id
      },
      replyDataStudioDiscuss ({ item }) {
        this.$store
          .dispatch('studioDiscusses/replyDataStudioDiscuss', {
            body: item.content,
            parent_id: item.data.id,
            id: item.data.class_id,
          })
          .then(res => {
            if (res.data.meta.status) {
              this.reply.open = false
              item = null
              const Toast = this.$swal.mixin({
                toast: true,
                position: 'bottom-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: toast => {
                  toast.addEventListener('mouseenter', this.$swal.stopTimer)
                  toast.addEventListener('mouseleave', this.$swal.resumeTimer)
                },
                popup: 'swal2-show',
                backdrop: 'swal2-backdrop-show',
                icon: 'swal2-icon-show',
              })
              Toast.fire({
                icon: 'success',
                title: 'Data Repllied Successfully',
              })
            }
          })
      // console.log(item)
      },
      refresh () {
        this.getDataStudioDiscusses()
      },
      deleteDataDiscusses ({ item }) {
        this.$store
          .dispatch('studioDiscusses/deleteDataDiscusses', {
            id: item.id,
          })
          .then(res => {
            if (res.data.meta.status) {
              this.deleteDiscuss.open = false
              const Toast = this.$swal.mixin({
                toast: true,
                position: 'bottom-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: toast => {
                  toast.addEventListener('mouseenter', this.$swal.stopTimer)
                  toast.addEventListener('mouseleave', this.$swal.resumeTimer)
                },
                popup: 'swal2-show',
                backdrop: 'swal2-backdrop-show',
                icon: 'swal2-icon-show',
              })
              Toast.fire({
                icon: 'success',
                title: 'Data Repllied Deleted Successfully',
              })
            }
          })
      // console.log(item)
      },
    },
  }
</script>

<style lang="sass">
.theme--light
    .tabs-profile > .v-tabs-bar
        background-color: #F0F2F5 !important
        margin-bottom: 2px
        border-bottom: 1px double #9DC4D1 !important
</style>
