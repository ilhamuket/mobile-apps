<template>
  <v-container fluid>
    <v-dialog
      v-model="dialog.open"
      width="70%"
    >
      <v-card size-avatar="120">
        <v-avatar
          v-if="dialog.data.img"
          size="128"
          class="custome-bg-profile elevation-6 mt-2"
          color="grey"
        >
          <v-img :src="dialog.data.img.url" />
        </v-avatar>
        <v-list-item-avatar
          v-else
          class="custome-bg-profile elevation-6 mt-2"
          color="primary"
        >
          <span> s </span>
        </v-list-item-avatar>
        <div class="d-flex flex-row justify-center">
          <div class="d-flex flex-column">
            <v-tooltip
              bottom
              color="primary"
            >
              <template #activator="{ on, attrs }">
                <v-btn
                  v-bind="attrs"
                  class="mt-2"
                  dark
                  width="100"
                  outlined
                  small
                  type="file"
                  color="primary"
                  v-on="on"
                  @click="openDialog"
                >
                  <v-icon color="red">
                    mdi-camera
                  </v-icon>
                </v-btn>
              </template>
              <span>Change Picture</span>
            </v-tooltip>
          </div>
          <div class="d-flex flex-column ml-2">
            <v-tooltip
              bottom
              color="primary"
            >
              <template #activator="{ on, attrs }">
                <v-btn
                  v-bind="attrs"
                  class="mt-2"
                  dark
                  width="100"
                  outlined
                  small
                  color="primary"
                  v-on="on"
                >
                  <v-icon color="red">
                    mdi-lock-reset
                  </v-icon>
                </v-btn>
              </template>
              <span>Change Password</span>
            </v-tooltip>
          </div>
        </div>
        <v-card-title class="font-spartan font-italic primary--text">
          Dialog Title

          <v-spacer />

          <v-icon
            aria-label="Close"
            @click="dialog.open = false"
          >
            mdi-close
          </v-icon>
        </v-card-title>

        <v-container>
          <v-row>
            <v-col
              cols="12"
              md="6"
            >
              <v-text-field
                v-model="dialog.data.firstName"
                outlined
                label="FirstName"
                dense
                prepend-icon="mdi-alpha-f-circle-outline"
              />
            </v-col>
            <v-col
              cols="12"
              md="6"
            >
              <v-text-field
                v-model="dialog.data.lastName"
                outlined
                label="LastName"
                dense
                prepend-icon="mdi-alpha-l-circle-outline"
              />
            </v-col>
            <v-col cols="12">
              <v-text-field
                v-model="dialog.data.nickName"
                outlined
                label="UserName"
                dense
                prepend-icon="mdi-alpha-u-circle-outline"
              />
            </v-col>
            <v-col
              cols="12"
              md="6"
            >
              <v-text-field
                v-model="dialog.data.noHp"
                outlined
                label="Contact"
                dense
                prepend-icon="mdi-account-box-outline"
              />
            </v-col>
            <v-col
              cols="12"
              md="6"
            >
              <v-text-field
                v-model="dialog.data.email"
                outlined
                label="Email"
                dense
                prepend-icon="mdi-email-check-outline"
              />
            </v-col>
            <v-col
              cols="12"
              md="6"
            >
              <v-select
                v-model="dialog.data.homeAddress"
                outlined
                :items="itemRegional"
                label="Regional"
                dense
                item-text="name"
                item-value="name"
                prepend-icon="mdi-alpha-r-circle-outline"
              />
            </v-col>
            <v-col
              cols="12"
              md="6"
            >
              <v-dialog
                ref="dialog"
                v-model="modal"
                :return-value.sync="date"
                width="290px"
              >
                <template v-slot:activator="{ on, attrs }">
                  <v-text-field
                    v-model="dialog.data.dateOfBirth"
                    label="Picker in dialog"
                    prepend-icon="mdi-calendar"
                    readonly
                    outlined
                    dense
                    v-bind="attrs"
                    v-on="on"
                  />
                </template>
                <v-date-picker
                  v-model="dialog.data.dateOfBirth"
                  scrollable
                >
                  <v-spacer />
                  <v-btn
                    text
                    color="primary"
                    @click="modal = false"
                  >
                    Cancel
                  </v-btn>
                  <v-btn
                    text
                    color="primary"
                    @click="$refs.dialog.save(dialog.data.dateOfBirth)"
                  >
                    OK
                  </v-btn>
                </v-date-picker>
              </v-dialog>
            </v-col>
            <v-col
              cols="12"
              md="4"
            >
              <v-text-field
                v-model="dialog.data.username_ig"
                label="Username Instagram"
                placeholder="Input Your Username Instagram"
                outlined
                prepend-icon="mdi-instagram"
                dense
              />
            </v-col>
            <v-col
              cols="12"
              md="4"
            >
              <v-text-field
                v-model="dialog.data.username_fb"
                label="Username Facebook"
                placeholder="Input Your Username Facebook"
                prepend-icon="mdi-facebook"
                outlined
                dense
              />
            </v-col>
            <v-col
              cols="12"
              md="4"
            >
              <v-text-field
                v-model="dialog.data.username_tw"
                label="Username Twitter"
                placeholder="Input Your Username Twitter"
                prepend-icon="mdi-twitter"
                outlined
                dense
              />
            </v-col>
            <v-col
              cols="12"
              md="12"
            >
              <v-textarea
                v-model="dialog.data.about"
                label="About"
                placeholder="About"
                prepend-icon="mdi-information-outline"
                dense
                outlined
              />
            </v-col>
          </v-row>
          <div class="d-flex flex-row-reverse">
            <div class="d-flex flex-column">
              <v-btn
                text
                color="red"
                @click="dialog.open = false"
              >
                Cancel
              </v-btn>
            </div>
            <div class="d-flex flex-column">
              <v-btn
                color="primary"
                @click="update"
              >
                Update
              </v-btn>
            </div>
          </div>
        </v-container>
      </v-card>
    </v-dialog>
    <app-change-profile
      :dialog="dialogData"
      @input="changeProfileMethods"
    />
  </v-container>
</template>

<script>
  import axios from "axios"
  import regional from "../database/regional.json"
  import changeProfile from "./___changePhotoProfile.vue"
  export default {
    components: {
      "app-change-profile": changeProfile,
    },
    props: {
      dialog: {
        type: Object,
        default: () => ({
          open: false,
        }),
      },
      data: {
        type: Object,
        default: null,
      },
    },
    data: () => ({
      date: new Date(Date.now() - new Date().getTimezoneOffset() * 60000)
        .toISOString()
        .substr(0, 10),
      menu: false,
      modal: false,
      menu2: false,
      itemRegional: regional,
      dialogData: {
        open: false,
      },
    }),
    mounted () {
      this.getMe()
    },
    methods: {
      update () {
        this.$emit("input", { item: this.dialog.data })
      },
      openDialog () {
        this.dialogData.open = true
      },
      changeProfileMethods ({ item }) {
        axios.defaults.headers.common.Authorization =
          "Bearer " + localStorage.getItem("access_token")
        axios.defaults.baseURL = process.env.VUE_APP_API_URL

        const URL = "user/change-thumbnail"
        const data = new FormData()
        data.append("img", item)
        const config = {
          header: {
            "Content-Type": "image/png",
          },
        }
        axios.post(URL, data, config).then((response) => {
          if (response.data.meta.status) {
            this.dialogData.open = false
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
              title: "Image Profile Edited Successfully",
            })
            this.getMe()
          }
        })
      },
      getMe () {
        this.$store
          .dispatch("user/me", {
            entities: "followingStudio.followers,followingStudio.likes",
          })
          .then((res) => {
            if (res.data.meta.status) {
              this.isLoader = false
            }
          })
      },
    },
  }
</script>
<style lang="sass" scoped>
.v-application .custome-bg-profile
  margin-left: 544px !important
</style>
