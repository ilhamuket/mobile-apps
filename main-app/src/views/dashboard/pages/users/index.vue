<template>
  <v-container id="user-profile">
    <v-row>
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
            color="btn_primary"
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
          </v-tabs>
          <v-tabs-items v-model="tabs">
            <v-tab-item>
              <app-profile
                :user="cumputedMe"
                @input="choosePicture"
                @change="changePicture"
              />
            </v-tab-item>
          </v-tabs-items>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
// import timelines from "./component_core/Timeline.vue"
  import cardSide from "./component/__cardSide.vue"
  import profile from "./component_core/_profile.vue"

  // import dialogEditProfile from "./component/_dialogEdit.vue"
  export default {
    components: {
      // timelines,
      // "app-dialog-edit": dialogEditProfile,
      "app-card-side": cardSide,
      "app-profile": profile,
    },
    data: () => ({
      isLoader: true,
      dialogEdit: {
        open: false,
        data: {},
      },
      tabs: null,
    }),
    computed: {
      cumputedMe () {
        return this.$store.state.user.me
      },
    },
    mounted () {
      this.getMe()
    },
    methods: {
      getMe () {
        this.$store
          .dispatch("user/me", {
            entities: "followingStudio.followers,followingStudio.likes, img",
          })
          .then(res => {
            if (res.data.meta.status) {
              this.isLoader = false
            }
          })
      },
      popUpDialog ({ item }) {
        this.dialogEdit.open = true
        this.dialogEdit.data = item
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
          .then(res => {
            this.dialogEdit.open = false
            if (res.data.meta.status) {
              this.dialogEdit.open = false
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
                title: "User Profile Successfully",
              })
              this.getMe()
            }
          })
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
</style>
