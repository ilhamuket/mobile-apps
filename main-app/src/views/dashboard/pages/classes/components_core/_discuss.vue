<template>
  <v-container>
    <v-row>
      <v-col cols="12">
        <span class="font-spartan font-weight-bold">
          Discuss ({{ data.length }})
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
    <v-row>
      <v-col cols="12">
        <v-text-field
          id="question"
          v-model="content"
          placeholder="Apa Yang Anda Ingin Tanyakan Mengenai Kelas Ini ?"
          class=""
          append-icon="mdi-send"
          @click:append="sendDiscusses"
        >
          <template #prepend>
            <v-avatar v-if="me.img">
              <v-img :src="me.img.url" />
            </v-avatar>
          </template>
        </v-text-field>
        <!-- <div class="d-flex flex-row-reverse mt-12">
          <div class="d-flex flex-column">
            <v-btn
              color="btn_primary"
              class="d-flex justify-end mb-4 margin__btn"
              @click=""
            >
              Send
            </v-btn>
          </div>
        </div> -->
      </v-col>
    </v-row>
    <v-row
      v-if="data.length !== 0"
      class="row__hover"
    >
      <v-col
        v-for="(item, i) in data"
        :key="i"
        cols="12"
      >
        <div v-if="item.user">
          <div class="d-flex flex-row flex-nowrap flex_row ">
            <div class="d-flex flex-column">
              <v-avatar>
                <v-img
                  v-if="item.user.img"
                  :src="item.user.img.url"
                />
              </v-avatar>
            </div>
            <div class="d-flex flex-column">
              <span class="font-spartan-small ml-2">
                {{ item.user.nickName }}
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
                  {{ item.class.author_id === me.id ? 'Studio' : 'Visitor' }}
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
                {{ item.body }}
              </span>
            </div>
          </div>
          <div class="d-flex flex-row margin__actions">
            <div class="d-flex-column">
              <span class="font-spartan-small">
                {{ timeSince(item.created_at) }}
              </span>
            </div>
            <div class="d-flex-column ml-4">
              <v-icon>mdi-heart-outline</v-icon>
            </div>
            <div class="d-flex-column ml-4">
              <span
                style="cursor:pointer"
                class="font-spartan-small"
                @click="replyParentActive(item)"
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
        <div
          v-for="(child, z) in item.child"
          :key="z"
          class="reply"
        >
          <div class="d-flex flex-row ml-12 mt-4">
            <div class="d-flex flex-column">
              <v-avatar
                v-if="child.class.author_id === child.user.id"
                size="37"
              >
                <v-img
                  v-if="child.user.studio.img"
                  :src="child.user.studio.img.url"
                />
              </v-avatar>
              <v-avatar
                v-else
                color="primary"
                size="30"
              >
                <v-img
                  v-if="child.user.img"
                  :src="child.user.img.url"
                />
                <span v-else> {{ child.user.nickName.charAt(0) }} </span>
              </v-avatar>
            </div>
            <div class="d-flex flex-column">
              <span class="font-spartan-small ml-2">
                {{ child.user.nickName }}
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
                <v-chip
                  color="transparent"
                  :text-color="
                    child.class.author_id === child.user.id ? 'red' : 'black'
                  "
                  class="font-spartan-small chip__status"
                >
                  {{
                    child.class.author_id === child.user.id
                      ? 'Studio'
                      : 'Visitor'
                  }}
                </v-chip>
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
              {{ child.body }}
            </span>
          </div>
          <div class="d-flex flex-row margin__actions__reply">
            <div class="d-flex-column">
              <span class="font-spartan-small">
                {{ timeSince(child.created_at) }}
              </span>
            </div>
            <div class="d-flex-column ml-4">
              <v-icon>mdi-heart-outline</v-icon>
            </div>
            <div class="d-flex-column ml-4">
              <span
                style="cursor:pointer"
                class="font-spartan-small"
                @click="replyChildActive(child)"
              >
                Reply
              </span>
            </div>
          </div>
          <div
            v-if="child.isChildReplies"
            class="d-flex-row mt-2 margin__reply"
          >
            <div class="d-flex flex-column">
              <v-text-field
                v-if="child.user"
                placeholder="Isi Komentar Disini"
                label="Isi Komentar Disini"
                append-icon="mdi-send"
                :prefix="`@${child.user.nickName}`"
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
        </div>
      </v-col>
      <v-col
        v-if="stateLoad"
        cols="12"
        class="d-flex justify-center"
      >
        <v-progress-circular
          indeterminate
          color="primary"
        />
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
  </v-container>
</template>

<script>
  export default {
    props: {
      data: {
        type: Array,
        default: null,
      },
      me: {
        type: Object,
        default: null,
      },
      stateLoad: {
        type: Boolean,
        default: false,
      },
    },
    data: () => ({
      menu: false,
      isReply: false,
      isA: true,
      isReplies: false,
      content: '',
    }),
    methods: {
      replyParentActive (item) {
        item.isReplies = !item.isReplies
      },
      replyChildActive (item) {
        item.isChildReplies = !item.isChildReplies
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
      sendDiscusses () {
        this.$emit('send', { item: this.content })
        this.content = null
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
.chip__status
  margin-top: -8px
</style>
