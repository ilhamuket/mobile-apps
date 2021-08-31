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
            src="@/assets/5833439.jpg"
          >
            <div class="d-flex flex-row justify-center">
              <div class="d-flex flex-column">
                <span
                  class="text-h1 font-title-rampart-one custome-font"
                >EnsikloTari</span>
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
    <app-dialog-edit :dialog="dialogEdit" />
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
        id: 0,
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
        this.dialogEdit.id = item.id
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
  opacity: .9
</style>
