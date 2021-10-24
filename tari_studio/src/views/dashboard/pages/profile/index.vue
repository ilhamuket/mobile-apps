<template>
  <v-container>
    <v-row v-if="is_load">
      <!-- <loader
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
      /> -->
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
            Discussion
          </v-tab>
          <v-tab class="font-spartan-small">
            Reviews
          </v-tab>
          <v-tab class="font-spartan-small">
            Bank Account
          </v-tab>
        </v-tabs>
        <v-tabs-items v-model="tabs">
          <v-tab-item>
            <app-page-summarry
              :summary="cumputedSummary"
              @navigate="navigateTabs"
            />
          </v-tab-item>
          <v-tab-item>
            <app-page-one
              :data="computedStudio"
              :user="users"
              @edit="upEditProfile"
              @input="inputPictureImgStudio"
              @change="changePictureImgStudio"
            />
          </v-tab-item>
          <v-tab-item>
            <app-page-medsos
              :data="computedStudio"
              @save="saveSocialMedia"
            />
          </v-tab-item>
          <v-tab-item>
            <app-page-discusses
              :data="computedDiscuss"
              @reply="upReply"
              @refresh="refresh"
              @delete="upDialogDiscussDelete"
              @deleteSelected="upDialogDeleteDiscussSelected"
              @hideSelected="upHideDiscusesAll"
            />
          </v-tab-item>
          <v-tab-item>
            <app-page-reviews
              :data="computedReviews"
              @hide="upHideReviewSelected"
              @delete="upDeleteReviewsAll"
              @reply="upReplyReviews"
              @refresh="refreshDataReviews"
            />
          </v-tab-item>
          <v-tab-item>
            <app-page-payment
              :data="computedBankAccount"
              @delAll="upDialogDeleteSelected"
              @add="updialogAddBankAccount"
              @edit="upDialogEditBankAccount"
              @deleteById="upDialogDeleteBankById"
              @refresh="refereshBankAccount"
              @activated="upActivateDataBankAccount"
            />
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
    <app-dialog-notice
      :dialog="dialogDeleteDiscussBroadcast"
      title="Delete"
      text="card_notice.discuss.del"
      text-button1="Delete"
      icon="mdi-delete"
      @input="deleteDataDiscussesSelected"
    />
    <app-dialog-notice
      :dialog="dialogHideDiscussesAll"
      title="Hide"
      text="card_notice.discuss.hide"
      text-button1="hide"
      icon="mdi-delete"
      @input="hideDataDiscussesSelected"
    />
    <app-dialog-notice
      :dialog="dialogHideReviewsAll"
      title="Hide"
      text="card_notice.reviews.hide"
      text-button1="hide"
      icon="mdi-delete"
      @input="hideReviewSelected"
    />
    <app-dialog-notice
      :dialog="dialogDeleteReviewsAll"
      title="Delete"
      text="card_notice.reviews.del"
      text-button1="delete"
      icon="mdi-delete"
      @input="deleteReviewSelected"
    />
    <app-dialog-reply
      :dialog="replyReviews"
      @send="sendReplieReviews"
    />
    <app-dialog-add-form
      :dialog="dialogAddBankAccount"
      @input="insertDataBankAccont"
    />
    <app-dialog-edit-bank-account
      :dialog="dataDialogEditBankAccount"
      @input="updateDataBankAccount"
    />
    <app-dialog-notice-bank-account
      :dialog="dialogDeleteSelectedBank"
      icon="mdi-delete"
      text="Are you sure want to delete Bank Account"
    />
    <app-dialog-notice-bank-account
      :dialog="dalogBankDeleteById"
      icon="mdi-delete"
      :by-id="true"
      text="Are you sure want to delete Bank Account with name"
      @input="deleteDataBankAccountById"
    />
    <app-dialog-notice-bank-account
      :dialog="activatedBankAccount"
      icon="mdi-check"
      text="Are you sure want to activated Bank Account with name"
      text-btn1="Activated"
      @input="activatedDataBankAccount"
    />
  </v-container>
</template>

<script>
  import card from "./components_core/__cardDetail.vue"
  import pageOne from "./components_core/_pageProfile.vue"
  import summary from "./components_core/_pageSummary.vue"
  import medsos from "./components_core/_pageSocilaMedia.vue"
  import discuss from "./components_core/_pageDiscusses.vue"
  import reviews from "./components_core/_pageReviews.vue"
  import payment from "./components_core/_bankAccount.vue"
  import reply from "./components/__dialogReply.vue"
  import notice from "./components/__dialogNotice.vue"
  import editProfile from "./components/__editProfile.vue"
  import dialogFormAddPayment from "./components/__dialogAddPayment.vue"
  import dialogEditBankAccount from "./components/__dialogEditBankAccount.vue"
  import dialogNoticeBankAccount from "./components/__dialogNoticeBank.vue"
  export default {
    components: {
      "app-card": card,
      "app-page-one": pageOne,
      "app-page-summarry": summary,
      "app-page-medsos": medsos,
      "app-page-discusses": discuss,
      "app-page-reviews": reviews,
      "app-page-payment": payment,
      "app-dialog-reply": reply,
      "app-dialog-notice": notice,
      "app-dialog-edit-profile": editProfile,
      "app-dialog-add-form": dialogFormAddPayment,
      "app-dialog-edit-bank-account": dialogEditBankAccount,
      "app-dialog-notice-bank-account": dialogNoticeBankAccount,
    },
    data: () => ({
      tabs: null,
      isMobile: false,
      is_load: true,
      attrsLoad: {
        class: "mb-6",
        boilerplate: true,
        elevation: 2,
      },
      reply: {
        open: false,
        data: {},
      },
      replyReviews: {
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
      dialogDeleteDiscussBroadcast: {
        open: false,
        data: [],
      },
      dialogHideDiscussesAll: {
        open: false,
        data: [],
      },
      dialogHideReviewsAll: {
        open: false,
        data: [],
      },
      dialogDeleteReviewsAll: {
        open: false,
        data: [],
      },
      dialogAddBankAccount: {
        open: false,
      },
      dataDialogEditBankAccount: {
        open: false,
        data: {},
      },
      dialogDeleteSelectedBank: {
        open: false,
        data: [],
      },
      dalogBankDeleteById: {
        open: false,
        data: {},
      },
      activatedBankAccount: {
        open: false,
        data: [],
      },
      params: "",
      users: {},
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
      computedBankAccount () {
        return this.$store.state.bank_account.data
      },
    },
    watch: {
      tabs () {
        if (this.tabs === 0) {
          this.params = "home"
          const params = (this.$route.params.params = this.params)
          this.$router.push(params).catch(() => {})
        } else if (this.tabs === 1) {
          this.params = "profile"
          const params = (this.$route.params.params = this.params)
          this.$router.push(params).catch(() => {})
        } else if (this.tabs === 2) {
          this.params = "socmed"
          const params = (this.$route.params.params = this.params)
          this.$router.push(params).catch(() => {})
        } else if (this.tabs === 3) {
          this.params = "discussion"
          const params = (this.$route.params.params = this.params)
          this.$router.push(params).catch(() => {})
        } else if (this.tabs === 4) {
          this.params = "reviews"
          const params = (this.$route.params.params = this.params)
          this.$router.push(params).catch(() => {})
        } else if (this.tabs === 5) {
          this.params = "bank-account"
          const params = (this.$route.params.params = this.params)
          this.$router.push(params).catch(() => {})
        }
      },
      "$route.params.params": function (val) {
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
      this.getDataBankAccount()
    },
    methods: {
      firstLoad () {
        if (this.$route.params.params === "home") return (this.tabs = 0)
        else if (this.$route.params.params === "profile") return (this.tabs = 1)
        else if (this.$route.params.params === "socmed") return (this.tabs = 2)
        else if (this.$route.params.params === "discussion")
          return (this.tabs = 3)
        else if (this.$route.params.params === "reviews") return (this.tabs = 4)
        else if (this.$route.params.params === "bank-account")
          return (this.tabs = 5)
        else return (this.tabs = 0)
      },
      me () {
        this.$store
          .dispatch("user/me", {
            entities: "studio",
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
          .dispatch("studio/getDataMeStudio", {
            entities: "likes,followers,img",
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
          .dispatch("studios/updateDataStudios", {
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
                title: "Data Repllied Successfully",
              })
            }
          })
      },
      getDataReviewsStudio () {
        this.$store.dispatch("studioReviews/getDataReviewsStudio", {
          entities: "class,user.img,classVidio",
        })
      },
      upHideDiscusesAll ({ item }) {
        this.dialogHideDiscussesAll.open = true
        this.dialogHideDiscussesAll.data = item
      },
      hideDataDiscussesSelected ({ item }) {
        this.$store
          .dispatch("studioDiscusses/hideDataDiscussesSelected", item)
          .then(res => {
            if (res.data.meta.status) {
              this.dialogHideDiscussesAll.open = false
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
                title: "Data Hided Successfully",
              })
            }
          })
      },
      toClass () {
        this.$router.push("/class")
      },
      getDataSummary () {
        this.$store.dispatch("dashboardSummary/getDataSummary")
      },
      toNavigate (link) {
        this.$router.push(link)
      },
      getDataStudioDiscusses () {
        this.$store.dispatch("studioDiscusses/getDataStudioDiscusses", {
          entities: "class.img,user.img,child,likes",
        })
      },
      upReply ({ item }) {
        this.reply.open = true
        this.reply.data = item
      // console.log(item)
      },
      upReplyReviews ({ item }) {
        this.replyReviews.open = true
        this.replyReviews.data = item
      },
      upDialogDeleteDiscussSelected ({ item }) {
        this.dialogDeleteDiscussBroadcast.open = true
        this.dialogDeleteDiscussBroadcast.data = item
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
          .dispatch("studioDiscusses/replyDataStudioDiscuss", {
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
                title: "Data Repllied Successfully",
              })
            }
          })
      // console.log(item)
      },
      refresh () {
        this.getDataStudioDiscusses()
      },
      refreshDataReviews () {
        this.getDataReviewsStudio()
      },
      deleteDataDiscusses ({ item }) {
        this.$store
          .dispatch("studioDiscusses/deleteDataDiscusses", {
            id: item.id,
          })
          .then(res => {
            if (res.data.meta.status) {
              this.deleteDiscuss.open = false
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
                title: "Data Repllied Deleted Successfully",
              })
            }
          })
      // console.log(item)
      },
      deleteDataDiscussesSelected ({ item }) {
        this.$store
          .dispatch("studioDiscusses/deleteDataDiscussesSelected", item)
          .then(res => {
            if (res.data.meta.status) {
              item = []
              this.dialogDeleteDiscussBroadcast.open = false
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
                title: "Data Deleted Successfully",
              })
            }
          })
      },
      upHideReviewSelected ({ item }) {
        this.dialogHideReviewsAll.open = true
        this.dialogHideReviewsAll.data = item
      },
      hideReviewSelected ({ item }) {
        this.$store
          .dispatch("studioReviews/hideReviewSelected", item)
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
                title: "Data Reviews Hided Successfully",
              })
            }
          })
      },
      upDeleteReviewsAll ({ item }) {
        this.dialogDeleteReviewsAll.open = true
        this.dialogDeleteReviewsAll.data = item
      },
      deleteReviewSelected ({ item }) {
        this.$store
          .dispatch("studioReviews/deleteReviewSelected", item)
          .then(res => {
            if (res.data.meta.status) {
              this.dialogDeleteReviewsAll.open = false
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
                title: "Data Reviews Deleted Successfully",
              })
            }
          })
      },
      sendReplieReviews ({ item }) {
        this.$store
          .dispatch("studioReviews/sendReplieReviews", {
            id: item.data.id,
            body: item.content,
          })
          .then(res => {
            if (res.data.meta.status) {
              this.replyReviews.open = false
              item.content = ""
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
                title: "Data Reviews Replied Successfully",
              })
            }
          })
      },
      saveSocialMedia ({ item }) {
        console.log(item)
        this.$store
          .dispatch("studios/updateDataStudios", {
            ig: item.username_ig,
            tw: item.username_tw,
            fb: item.username_fb,
          })
          .then(res => {
            if (res.data.meta.status) {
              this.$route.params.params = "profile"
              this.firstLoad()
            }
          })
      },
      navigateTabs ({ item }) {
        console.log(item)
        this.$route.params.params = item
        this.firstLoad()
      },
      inputPictureImgStudio ({ item }) {
        console.log(item)
        this.$store
          .dispatch("studios/inputPictureImgStudio", {
            files: item.files,
            studio_id: item.id,
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
                title: "Data Repllied Successfully",
              })
              this.getStudioMe()
            }
          })
      },
      changePictureImgStudio ({ item }) {
        this.$store
          .dispatch("studios/changePictureImgStudio", {
            files: item.files,
            studio_id: item.id,
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
                title: "Data Repllied Successfully",
              })
              this.getStudioMe()
            }
          })
      },
      getDataBankAccount () {
        this.$store.dispatch("bank_account/getDataBankAccount")
      },
      updialogAddBankAccount () {
        this.dialogAddBankAccount.open = true
      },
      insertDataBankAccont ({ item }) {
        // console.log(item)
        this.$store
          .dispatch("bank_account/insertDataBankAccont", {
            name: item.name,
            no_rek: item.no_rek,
            bank_name: item.bank_name,
            status: item.status,
          })
          .then(res => {
            if (res.data.meta.status) {
              this.dialogAddBankAccount.open = false
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
                title: "Data Added Successfully",
              })
            }
          })
      },
      upDialogEditBankAccount ({ item }) {
        this.dataDialogEditBankAccount.open = true
        this.dataDialogEditBankAccount.data = item
      },
      updateDataBankAccount ({ item }) {
        this.$store
          .dispatch("bank_account/updateDataBankAccount", {
            id: item.id,
            bank_name: item.bank_name,
            name: item.name,
            no_rek: item.no_rek,
          })
          .then(res => {
            if (res.data.meta.status) {
              this.dataDialogEditBankAccount.open = false
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
                title: "Data Added Successfully",
              })
            }
          })
      },
      upDialogDeleteSelected ({ item }) {
        this.dialogDeleteSelectedBank.open = true
        this.dialogDeleteSelectedBank.data = item
      },
      upDialogDeleteBankById ({ item }) {
        this.dalogBankDeleteById.open = true
        this.dalogBankDeleteById.data = item
      },
      deleteDataBankAccountById ({ item }) {
        this.$store
          .dispatch("bank_account/deleteDataBankAccountById", {
            id: item.id,
          })
          .then(res => {
            if (res.data.meta.status) {
              this.dalogBankDeleteById.open = false
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
                title: "Data Deleted Successfully",
              })
            }
          })
      },
      refereshBankAccount () {
        this.getDataBankAccount()
        const Toast = this.$swal.mixin({
          toast: true,
          position: "top-end",
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
          title: "Fetch Data",
        })
      },
      upActivateDataBankAccount ({ item }) {
        this.activatedBankAccount.open = true
        this.activatedBankAccount.data = item
      },
      activatedDataBankAccount ({ item }) {
        console.log(item, "asas")
        this.$store
          .dispatch("bank_account/activatedDataBankAccount", item)
          .then(res => {
            if (res.data.meta.status) {
              this.activatedBankAccount.open = false
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
                title: "Data Activated Successfully",
              })
            }
          })
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
