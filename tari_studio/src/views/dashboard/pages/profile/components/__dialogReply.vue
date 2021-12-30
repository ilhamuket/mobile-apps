<template>
  <v-container>
    <v-dialog
      v-model="dialog.open"
      width="60%"
    >
      <v-card>
        <!-- <v-card-title class="text-h2 primary--text font-spartan"> -->
        <v-system-bar
          :color="$vuetify.theme.dark ? '#141C31' : '#F0F8FF'"
          window
        >
          <v-toolbar-title
            :class="$vuetify.theme.dark ? 'white--text' : ' black--text'"
            class="font-spartan-small btn_primary--text font-italic"
          >
            <v-icon :color="$vuetify.theme.dark ? 'white' : 'btn_primary'">
              mdi-reply-all-outline
            </v-icon>
            Reply
          </v-toolbar-title>

          <v-spacer />

          <v-icon @click="dialog.open = false">
            mdi-close
          </v-icon>
        </v-system-bar>
        <!-- </v-card-title> -->
        <v-container>
          <v-row>
            <v-col
              v-if="dialog.data.user"
              class="d-flex justify-center"
              cols="12"
            >
              <v-avatar
                v-if="dialog.data.user.img"
                size="90"
              >
                <v-img :src="dialog.data.user.img.url" />
              </v-avatar>
              <v-avatar
                v-else
                size="90"
                color="primary"
              >
                <!-- <v-img
                  src="https://ecs7.tokopedia.net/img/cache/100-square/user-1/2021/1/22/38585570/38585570_bd6dcd82-263e-45e4-bb8f-725e0088068b.jpg"
                /> -->
                <span class="font-spartan">
                  {{ dialog.data.user.firstName.charAt(0)
                  }}{{ dialog.data.user.lastName.charAt(0) }}
                </span>
              </v-avatar>
            </v-col>
            <v-col
              cols="12"
              class="d-flex justify-center"
            >
              <span
                v-if="dialog.data.user"
                class="font-spartan text-h4"
              >
                {{
                  dialog.data.user.firstName + " " + dialog.data.user.lastName
                }}
              </span>
            </v-col>
            <v-col
              cols="12"
              class="d-flex justify-center col__email"
            >
              <span
                v-if="dialog.data.user"
                class="font-spartan-small"
              >
                Username : {{ dialog.data.user.nickName }}
              </span>
            </v-col>
            <v-col
              cols="12"
              class="d-flex justify-center"
            >
              <span
                v-if="dialog.data.user"
                class="font-spartan-small col__email"
              >
                Email : {{ dialog.data.user.email }}
              </span>
            </v-col>
          </v-row>
          <v-divider class="mb-2 mt-2" />
          <v-row>
            <v-col cols="12">
              <!-- <div class="d-flex flex-row">
                <div class="d-flex flex-column">
                  <span class="font-spartan text-h4">
                    Membalas :
                  </span>
                </div>
              </div> -->
              <div class="d-flex flex-row mt-2">
                <div class="d-flex flex-column">
                  <span class="font-spartan text-h4"> Content : </span>
                </div>
              </div>

              <div class="d-flex flex-row ml-2">
                <div class="d-flex flex-column">
                  <span class="font-spartan text-h4">
                    {{ dialog.data.body }}
                  </span>
                </div>
              </div>
              <v-divider class="mt-4 mb-4" />
            </v-col>

            <v-col cols="12">
              <v-textarea
                v-if="!dialog.data.parent_id"
                v-model="content"
                label="Reply as Studio"
                :placeholder="$t('type')"
              />
              <v-textarea
                v-else
                v-model="content"
                :prefix="`@${dialog.data.parent.user.nickName}`"
                label="Reply as Studio"
                :placeholder="$t('type')"
              />
            </v-col>
            <v-col
              cols="12"
              class="d-flex flex-row-reverse"
            >
              <v-btn
                v-if="!dialog.data.parent_id"
                color="btn_primary"
                @click="send"
              >
                Send
              </v-btn>
              <v-btn
                v-else
                color="btn_primary"
                @click="sendChild"
              >
                Send
              </v-btn>
              <v-btn
                text
                color="red"
                @click="cancel"
              >
                Cancel
              </v-btn>
            </v-col>
          </v-row>
        </v-container>
      </v-card>
    </v-dialog>
  </v-container>
</template>

<script>
  export default {
    props: {
      dialog: {
        type: Object,
        default: null,
      },
    },
    data: () => ({
      content: "",
    }),
    methods: {
      send () {
        this.$emit("send", {
          item: {
            data: this.dialog.data,
            content: this.content,
          },
        })
      },
      sendChild () {
        this.$emit("send-child", {
          item: {
            data: this.dialog.data,
            content: this.content,
          },
        })
      },
      cancel () {
        this.dialog.open = false
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
          icon: "error",
          title: "Dialog Closed",
        })
      },
    },
  }
</script>

<style lang="sass">
.col__email
    margin-top: -20px
</style>
