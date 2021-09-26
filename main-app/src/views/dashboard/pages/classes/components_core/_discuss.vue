<template>
  <v-container>
    <v-row>
      <v-col cols="12">
        <span class="font-spartan font-weight-bold">
          Discuss (0)
        </span>
        <br>
        <span class="font-spartan-small">
          Kecak - Hurip Studio
        </span>
      </v-col>
      <v-col cols="12">
        <v-alert
          outlined
          color="grey"
        >
          <div class="text-h6">
            <v-icon color="grey">
              mdi-chat-question-outline
            </v-icon>
          </div>
          <span class="font-spartan font-weight-bold grey--text">
            Ada pertanyaan? Diskusikan dengan penjual atau pengguna lain
          </span>
          <v-spacer />
          <v-btn
            small
            color="btn_primary"
            href="#question"
          >
            Mulai Discusi
          </v-btn>
        </v-alert>
      </v-col>
    </v-row>
    <v-row
      v-if="isA"
      class="row__hover"
    >
      <v-col cols="12">
        <!-- <v-avatar>
          <v-img
            src="https://ecs7.tokopedia.net/img/cache/100-square/default_picture_user/default_toped-16.jpg"
          />
        </v-avatar>

        <span class="font-spartan-small font-weight-bold ml-1">
          Mahardika
        </span>
        <br>
        <span class="font-spartan-small margin-body">
          Apa kah Bagus
        </span>
        <br>
        <span
          class="font-spartan-small text-h6 margin-actions grey--text"
        >22 Maret 2002</span> -->
        <div>
          <div class="d-flex flex-row flex-nowrap flex_row ">
            <div class="d-flex flex-column">
              <v-avatar>
                <v-img
                  src="https://ecs7.tokopedia.net/img/cache/100-square/default_picture_user/default_toped-16.jpg"
                />
              </v-avatar>
            </div>
            <div class="d-flex flex-column">
              <span class="font-spartan-small ml-2">
                mahardika
              </span>
            </div>

            <div class="d-flex flex-row">
              <div class="d-flex flex-column">
                <span class="font-spartan-small ml-2">
                  -
                </span>
              </div>
            </div>
            <div class="d-flex flex-row">
              <div class="d-flex flex-column">
                <span class="font-spartan-small ml-2">
                  Penulis
                </span>
              </div>
            </div>
            <div class="d-flex flex-row margin__icon">
              <div class="d-flex flex-column">
                <v-menu v-model="menu">
                  <template #activator="{on,attrs}">
                    <v-icon
                      v-bind="attrs"
                      v-on="on"
                    >
                      mdi-dots-horizontal
                    </v-icon>
                  </template>
                  <v-list v-if="menu">
                    <v-list-item>
                      <v-list-item-title>
                        Report
                      </v-list-item-title>
                    </v-list-item>
                  </v-list>
                </v-menu>
              </div>
            </div>
          </div>
          <div class="d-flex flex-row margin__body mb-2">
            <div class="d-flex flex-column">
              <span class="font-spartan-small text">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia
                sunt atque neque corporis. Illum similique nemo, praesentium
                perspiciatis, exercitationem sed et odit, incidunt soluta
                dolorum deleniti ad. Eum eaque cum facere ipsam a sequi optio
                libero quia ipsa. Nam repudiandae ut impedit. Magnam nobis
                mollitia unde et ad nulla repellendus?
              </span>
            </div>
            <!-- <div class="d-flex flex-columnn margin__icon_love">
            <v-tooltip
              color="btn_primary"
              bottom
            >
              <template #activator="{on,attrs}">
                <v-icon
                  style="cursor:pointer"
                  v-bind="attrs"
                  class=""
                  v-on="on"
                >
                  mdi-heart-outline
                </v-icon>
              </template>
              <span class="font-spartan-small">6 people </span>
            </v-tooltip>
          </div> -->
          </div>
          <div class="d-flex flex-row margin__actions">
            <div class="d-flex-column">
              <span class="font-spartan-small">
                22 hour ago
              </span>
            </div>
            <div class="d-flex-column ml-4">
              <span
                style="cursor:pointer"
                class="font-spartan-small"
                @click="replyParentActive"
              >
                Reply
              </span>
            </div>
          </div>
        </div>
        <div
          v-if="isReply"
          class="d-flex-row ml-12 mt-2"
        >
          <div class="d-flex flex-column">
            <v-text-field
              placeholder="Isi Komentar Disini"
              label="Isi Komentar Disini"
              append-icon="mdi-send"
            >
              <template #prepend>
                <v-avatar size="30">
                  <v-img
                    src="https://ecs7.tokopedia.net/img/cache/100-square/default_picture_user/default_toped-16.jpg"
                  />
                </v-avatar>
              </template>
            </v-text-field>
          </div>
        </div>
        <div class="reply">
          <div class="d-flex flex-row ml-12 mt-4">
            <div class="d-flex flex-column">
              <v-avatar size="30">
                <v-img
                  src="https://ecs7.tokopedia.net/img/cache/100-square/default_picture_user/default_toped-16.jpg"
                />
              </v-avatar>
            </div>
            <div class="d-flex flex-column">
              <span class="font-spartan-small ml-2">
                mahardika
              </span>
            </div>

            <div class="d-flex flex-row">
              <div class="d-flex flex-column">
                <span class="font-spartan-small ml-2">
                  -
                </span>
              </div>
            </div>
            <div class="d-flex flex-row">
              <div class="d-flex flex-column">
                <span class="font-spartan-small ml-2">
                  Penulis
                </span>
              </div>
            </div>
            <div class="d-flex flex-row margin__icon__reply">
              <div class="d-flex flex-column">
                <v-menu v-model="menu">
                  <template #activator="{on,attrs}">
                    <v-icon
                      v-bind="attrs"
                      v-on="on"
                    >
                      mdi-dots-horizontal
                    </v-icon>
                  </template>
                  <v-list v-if="menu">
                    <v-list-item>
                      <v-list-item-title>
                        Report
                      </v-list-item-title>
                    </v-list-item>
                  </v-list>
                </v-menu>
              </div>
            </div>
          </div>
          <div class="d-flex flex-column margin__reply__body">
            <span class="font-spartan-small">
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi,
              eaque cupiditate. Rerum possimus inventore perferendis quasi
              maxime quidem quod! Dolore nam ducimus corrupti, eligendi repellat
              repudiandae, praesentium voluptatibus rem est dolor dolorum ad.
              Harum asperiores architecto minima pariatur fugit facilis.
            </span>
          </div>
          <div class="d-flex flex-row margin__actions__reply">
            <div class="d-flex-column">
              <span class="font-spartan-small">
                22 Hours
              </span>
            </div>
            <div class="d-flex-column ml-4">
              <span
                style="cursor:pointer"
                class="font-spartan-small"
                @click="replyChildActive"
              >
                Reply
              </span>
            </div>
          </div>
        </div>

        <div
          v-if="isReplies"
          class="d-flex-row mt-2 margin__reply"
        >
          <div class="d-flex flex-column">
            <v-text-field
              placeholder="Isi Komentar Disini"
              label="Isi Komentar Disini"
              append-icon="mdi-send"
              prefix="@mahardika"
            >
              <template #prepend>
                <v-avatar size="30">
                  <v-img
                    src="https://ecs7.tokopedia.net/img/cache/100-square/default_picture_user/default_toped-16.jpg"
                  />
                </v-avatar>
              </template>
            </v-text-field>
          </div>
        </div>
      </v-col>
    </v-row>
    <v-row
      v-else
      class="d-flex justify-center"
    >
      <v-col cols="6">
        <v-img src="@/assets/img/No-data-pana.svg" />
      </v-col>
      <v-col
        class="d-flex justify-center"
        cols="12"
      >
        <span class="font-spartan">
          Tidak Ada Diskusi
        </span>
      </v-col>
    </v-row>
    <v-row>
      <v-col cols="12">
        <v-textarea
          id="question"
          placeholder="Apa Yang Anda Ingin Tanyakan Mengenai Kelas Ini ?"
          class=""
          outlined
        />
        <div class="d-flex flex-row-reverse mt-12">
          <div class="d-flex flex-column">
            <v-btn
              color="btn_primary"
              class="d-flex justify-end mb-4 margin__btn"
            >
              Send
            </v-btn>
          </div>
        </div>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
  export default {
    data: () => ({
      menu: false,
      isReply: false,
      isA: true,
      isReplies: false,
    }),
    methods: {
      replyParentActive () {
        this.isReply = !this.isReply
      },
      replyChildActive () {
        this.isReplies = !this.isReplies
      },
      timeSince (time) {
        switch (typeof time) {
          case 'number':
            break
          case 'string':
            time = +new Date(time)
            break
          case 'object':
            if (time.constructor === Date) time = time.getTime()
            break
          default:
            time = +new Date()
        }
        const timeformats = [
          [60, 'seconds', 1], // 60
          [120, '1 minute ago', '1 minute from now'], // 60*2
          [3600, 'minutes', 60], // 60*60, 60
          [7200, '1 hour ago', '1 hour from now'], // 60*60*2
          [86400, 'hours', 3600], // 60*60*24, 60*60
          [172800, 'Yesterday', 'Tomorrow'], // 60*60*24*2
          [604800, 'days', 86400], // 60*60*24*7, 60*60*24
          [1209600, 'Last week', 'Next week'], // 60*60*24*7*4*2
          [2419200, 'weeks', 604800], // 60*60*24*7*4, 60*60*24*7
          [4838400, 'Last month', 'Next month'], // 60*60*24*7*4*2
          [29030400, 'months', 2419200], // 60*60*24*7*4*12, 60*60*24*7*4
          [58060800, 'Last year', 'Next year'], // 60*60*24*7*4*12*2
          [2903040000, 'years', 29030400], // 60*60*24*7*4*12*100, 60*60*24*7*4*12
          [5806080000, 'Last century', 'Next century'], // 60*60*24*7*4*12*100*2
          [58060800000, 'centuries', 2903040000], // 60*60*24*7*4*12*100*20, 60*60*24*7*4*12*100
        ]
        let seconds = (+new Date() - time) / 1000
        let token = 'ago'
        let listchoice = 1

        if (seconds === 0) {
          return 'Just now'
        }
        if (seconds < 0) {
          seconds = Math.abs(seconds)
          token = 'from now'
          listchoice = 2
        }
        let i = 0
        let format
        while ((format = timeformats[i++])) {
          if (seconds < format[0]) {
            if (typeof format[2] === 'string') return format[listchoice]
            else {
              return (
                Math.floor(seconds / format[2]) + ' ' + format[1] + ' ' + token
              )
            }
          }
        }
        return time
      },
    },
  }
</script>

<style lang="sass">
.margin__btn
    margin-top: -60px
    margin-bottom: 10px
.margin__body
    margin-left: 60px
    margin-top: -20px
    .text
      text-align:justify
      text-justify:inter-word
.margin__actions
    margin-left: 60px
.col_discus
    size__header
        font-size: 21px !important
.margin__icon
    margin-left: 950px
    opacity: 0
.row__hover
  &:hover
    .margin__icon
      opacity: 1
.margin__icon_love
  margin-left: 20px
  margin-top: -20px
.margin__reply__body
  margin-left: 90px
.margin__actions__reply
  margin-left: 90px
  margin-top: 10px
.margin__icon__reply
  margin-left: 920px
  opacity: 0
.reply
  &:hover
    .margin__icon__reply
      opacity: 1 !important
.margin__reply
  margin-left: 80px
  margin-top: 10px
</style>
