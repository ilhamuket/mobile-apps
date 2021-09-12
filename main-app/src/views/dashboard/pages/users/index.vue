<template>
  <v-container id="user-profile">
    <loader
      v-if="isLoader"
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

    <v-row
      v-else
      class="ml-2"
      justify="center"
    >
      <v-col cols="12">
        <v-card class="rounded-xl">
          <v-img
            height="140"
            class="img-oppa"
            src=""
          >
            <div class="d-flex flex-row justify-center">
              <div class="d-flex flex-column">
                <v-img
                  width="570"
                  src="@/assets/logo.svg"
                />
              </div>
            </div>
          </v-img>
        </v-card>
      </v-col>
      <v-col
        class="d-flex justify-center"
        cols="12"
      >
        <app-data-card :me="cumputedMe" />
      </v-col>
      <v-col
        cols="12"
        md="4"
      >
        <app-data-profile
          :me="cumputedMe"
          @popUpDialog="popUpDialog"
        />
      </v-col>
      <v-col
        cols="12"
        md="4"
      >
        <app-list-following :me="cumputedMe" />
      </v-col>

      <v-col cols="12">
        <timelines id="timeLines" />
      </v-col>
    </v-row>
    <app-dialog-edit
      :data="cumputedMe"
      :dialog="dialogEdit"
      @input="updateProfile"
      @refresh="getMe"
    />
  </v-container>
</template>

<script>
  import card from './component_core/_cardDetail.vue'
  import timelines from './component_core/Timeline.vue'
  import cardInformation from './component_core/_cardDetailProfile.vue'
  import cardList from './component_core/_cardInformation.vue'
  import dialogEditProfile from './component/_dialogEdit.vue'
  export default {
    components: {
      timelines,
      'app-data-card': card,
      'app-data-profile': cardInformation,
      'app-list-following': cardList,
      'app-dialog-edit': dialogEditProfile,
    },
    data: () => ({
      isLoader: true,
      dialogEdit: {
        open: false,
        data: {},
      },
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
          .dispatch('user/me', {
            entities: 'followingStudio.followers,followingStudio.likes',
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
          .dispatch('user/updateProfile', {
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
                title: 'User Profile Edited Successfully',
              })
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
