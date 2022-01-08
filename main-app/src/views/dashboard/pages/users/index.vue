<template>
  <v-container id="user-profile">
    <v-row v-if="$store.state.studioReviews.load_data">
      <v-col class="d-flex justify-center">
        <v-progress-circular
          indeterminate
          color="primary"
        />
      </v-col>
    </v-row>
    <v-row v-else>
      <v-col
        cols="12"
        md="3"
      >
        <v-card>
          <app-card-side :user="cumputedMe" />
        </v-card>
      </v-col>

      <v-col
        cols="12"
        md="9"
      >
        <v-card>
          <v-tabs
            v-model="tabs"
            color="primary"
            class="tabs-profile"
          >
            <v-tab class="font-spartan-small">
              <v-icon
                color="grey"
                class="mr-1"
              >
                mdi-account
              </v-icon>Profile
            </v-tab>
            <v-tab>
              <v-icon
                color="grey"
                class="mr-1"
              >
                mdi-mail
              </v-icon> waiting for
              the review
            </v-tab>
            <v-tab>
              <v-icon
                color="grey"
                class="mr-1"
              >
                mdi-message-draw
              </v-icon>
              My Reviews
            </v-tab>
          </v-tabs>
          <v-tabs-items v-model="tabs">
            <v-tab-item>
              <app-profile
                :user="cumputedMe"
                @input="choosePicture"
                @change="changePicture"
                @edit="popUpDialog"
                @editContact="popDialogEditContact"
                @updateSocmed="popDialogEditSocmed"
              />
            </v-tab-item>
            <v-tab-item>
              <app-tabs-waiting
                :data="computedReviews"
                @paginate="changePaginate"
              />
            </v-tab-item>
            <v-tab-item>
              <app-tabs-myreviews
                :data="computedMyReviews"
                :meta="dataMyReviews.meta"
                @paginate="pagePagination"
              />
            </v-tab-item>
          </v-tabs-items>
        </v-card>
      </v-col>
    </v-row>
    <app-card-edit
      :dialog="dialogEdit"
      @input="updateProfile"
    />
    <app-edit-contact
      :dialog="dialogEditContact"
      @input="updateProfile"
    />
    <app-dialog-socmed :dialog="dialogEditSocmed" />
  </v-container>
</template>

<script>
// import timelines from "./component_core/Timeline.vue"
  import cardSide from "./component/__cardSide.vue"
  import profile from "./component_core/_profile.vue"
  import cardEdit from "./component/__change.vue"
  import editContact from "./component/__changeContact.vue"
  import waiting from "./component_core/_waitingForReviews.vue"
  import myreviews from "./component_core/_myReviews.vue"
  import ___dialogChangeSocmedVue from "./component/___dialogChangeSocmed.vue"

  // import dialogEditProfile from "./component/_dialogEdit.vue"
  export default {
    components: {
      // timelines,
      // "app-dialog-edit": dialogEditProfile,
      "app-card-side": cardSide,
      "app-profile": profile,
      "app-card-edit": cardEdit,
      "app-edit-contact": editContact,
      "app-tabs-waiting": waiting,
      "app-tabs-myreviews": myreviews,
      "app-dialog-socmed": ___dialogChangeSocmedVue,
    },
    data: () => ({
      isLoader: true,
      dialogEdit: {
        open: false,
        data: {},
      },
      dialogEditContact: {
        open: false,
        data: {},
      },
      dialogEditSocmed: {
        open: false,
        data: {},
      },
      tabs: null,
      dataMyReviews: {
        meta: {},
      },
    }),
    computed: {
      cumputedMe () {
        return this.$store.state.user.me
      },
      computedReviews () {
        return this.$store.state.studioReviews.need_reviews
      },
      computedMyReviews () {
        return this.$store.state.studioReviews.my_reviews
      },
    },
    watch: {
      tabs () {
        if (this.tabs === 0) {
          const folder = "profile"
          const params = (this.$route.params.folder = folder)
          this.$router.push(params).catch(() => {})
        } else if (this.tabs === 1) {
          const folder = "waiting-reviews"
          const params = (this.$route.params.folder = folder)
          this.$router.push(params).catch(() => {})
          document.title = `Waiting Reviews  - ${process.env.VUE_APP_TITLE}`
        } else if (this.tabs === 2) {
          const folder = "my-reviews"
          const params = (this.$route.params.folder = folder)
          this.$router.push(params).catch(() => {})
          document.title = `My Reviews  - ${process.env.VUE_APP_TITLE}`
        }
      },
    },
    mounted () {
      this.getMe()
      this.getDataNeedReviews()
      this.firstLoad()
      this.getDataMyReviews()
    },
    methods: {
      getMe () {
        this.$store
          .dispatch("user/me", {
            entities: "followingStudio.followers,followingStudio.likes, img",
          })
          .then((res) => {
            if (res.data.meta.status) {
              this.isLoader = false
            }
          })
      },
      firstLoad () {
        if (this.$route.params.folder === "profile") {
          this.tabs = 0
        } else if (this.$route.params.folder === "waiting-reviews") {
          this.tabs = 1
        } else if (this.$route.params.folder === "my-reviews") {
          this.tabs = 2
        }
      },
      popUpDialog ({ item }) {
        this.dialogEdit.open = true
        this.dialogEdit.data = item
      },
      popDialogEditContact ({ item }) {
        this.dialogEditContact.open = true
        this.dialogEditContact.data = item
      },
      popDialogEditSocmed ({ item }) {
        this.dialogEditSocmed.open = true
        this.dialogEditSocmed.data = item
      },
      updateProfile ({ item }) {
        this.$store
          .dispatch("user/updateProfile", {
            id: item.id,
            firstName: item.firstName,
            lastName: item.lastName,
            email: item.email,
            homeAddress: item.homeAddress,
            dateOfBirth: item.dateOfBirth,
            nickname: item.nickName,
            noHp: item.noHp,
            about: item.about,
            ig: item.username_ig,
            fb: item.username_fb,
            tw: item.username_tw,
          })
          .then((res) => {
            this.dialogEdit.open = false
            if (res.data.meta.status) {
              this.dialogEdit.open = false
              this.dialogEditContact.open = false
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
                title: "User Profile Edited Successfully",
              })
            }
          })
      },
      choosePicture ({ item }) {
        this.$store
          .dispatch("user/choosePicture", {
            files: item.files,
          })
          .then((res) => {
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
                title: "User Profile Successfully",
              })
              this.getMe()
            }
          })
      },
      changePicture ({ item }) {
        this.$store
          .dispatch("user/changePicture", {
            files: item.files,
          })
          .then((res) => {
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
                title: "User Profile Successfully",
              })
              this.getMe()
            }
          })
      },
      getDataNeedReviews (page) {
        this.$store
          .dispatch("studioReviews/getDataNeedReviews", {
            page: page,
            entities:
              "classes.studio.img,classes.img,classes.category,classes.studio.reviews",
          })
          .then((res) => {
            if (res.data.meta.status) {
              this.$store.commit("studioReviews/LOAD")
              this.$store.commit("studioReviews/LOAD_PAGE")
            }
          })
      },
      changePaginate ({ item }) {
        console.log(item)
        this.getDataNeedReviews(item)
      },
      getDataMyReviews (page) {
        this.$store
          .dispatch("studioReviews/getDataMyReviews", {
            entities: "class.img,user",
            page: page,
          })
          .then((res) => {
            this.dataMyReviews.meta = res.data.meta
          })
      },
      pagePagination ({ item }) {
        this.getDataMyReviews(item)
      },
    },
  }
</script>
<style lang="sass" scoped>
.custome-font
  color: #384064 !important
  font-weight: bold
  font-size: 59px !important
.img-oppa
  background-color: #843839 !important
</style>
<style lang="sass">
.tabs-profile
  .v-item-group
    border-bottom: 2px double #9DACC2 !important
    .v-tab
        text-transform: capitalize
        font-family: "Spartan", sans-serif
        font-size: 14px
    .theme--dark
      .v-tab--active
        color: white !important
    .theme--light
      .v-tab--active
        color: black !important
</style>
