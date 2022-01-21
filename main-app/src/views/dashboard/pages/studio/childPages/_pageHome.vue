<template>
  <v-container>
    <v-row>
      <!-- <v-col cols="12">
        <v-card
          elevation="24"
          max-width="944"
          class="mx-auto"
        >
          <v-carousel
            v-model="model"
            :continuous="false"
            :cycle="cycle"
            :show-arrows="false"
            delimiter-icon="mdi-minus"
            height="400"
          >
            <v-carousel-item
              v-for="(item, i) in items"
              :key="i"
              :src="item.src"
              reverse-transition="fade-transition"
              transition="fade-transition"
            />
          </v-carousel>
        </v-card>
      </v-col> -->
      <v-col
        cols="12"
        md="8"
        xl="8"
      >
        <v-card>
          <iframe
            width="100%"
            height="400"
            :src="`${list.url}?rel=0&modestbranding=1&fs=1&loop=0&autopause=0`"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture;"
            sandbox="allow-scripts allow-same-origin"
            allowfullscreen
          />

          <v-container>
            <div class="d-flex flex-row justify-start">
              <div class="d-flex flex-column">
                <v-chip
                  outlined
                  color="pallet1"
                  text-color=""
                  label
                >
                  <v-icon left>
                    mdi-account-circle-outline
                  </v-icon>
                  <v-list-item-title>
                    <h4
                      v-if="list.studio"
                      class="text-center text-capitalize"
                    >
                      {{ list.studio.name }} - {{ list.studio.email }}
                    </h4>
                  </v-list-item-title>
                </v-chip>
              </div>
            </div>
            <div class="d-flex flex-row justify-start">
              <div class="d-flex flex-column">
                <h3>
                  {{ list.name }}
                </h3>
              </div>
            </div>
            <div class="d-flex flex-row justify-start">
              <div class="d-flex flex-column">
                <h4
                  v-if="list.author"
                  class="grey--text"
                >
                  Created By
                  {{ list.author.firstName + " " + list.author.lastName }} -
                  {{ timeSince(list.created_at) }}
                </h4>
              </div>
            </div>
          </v-container>
          <v-divider class="" />
          <div
            class="d-flex flex-row"
            :class="seeComments ? '' : 'justify-center ml-2'"
          >
            <div
              class="d-flex flex-column"
              @click="toSee"
            >
              <v-chip
                label
                color="transparent"
                style="cursor: pointer"
                class="mb-2"
              >
                See {{ computedComments.length }} Comments
                <v-icon> mdi-chevron-down </v-icon>
              </v-chip>
            </div>
          </div>
          <app-comments
            v-if="seeComments"
            class="mr-12"
            :me="me"
            :comments="computedComments"
            :vidio="list"
            @comments="insertComments"
            @Replies="repliesComments"
            @nestingReplies="repliesNestingComments"
          />
        </v-card>

        <app-data-list
          ref="input"
          :article="article"
          :object-article="objectArticle"
        />
      </v-col>
      <v-col
        cols="12"
        md="4"
        xl="4"
      >
        <v-card color="transparent">
          <v-app-bar
            absolute
            color="pallet1"
            dark
            src="https://picsum.photos/1920/1080?random"
          >
            <template v-slot:img="{ props }">
              <v-img
                v-bind="props"
                gradient="to top right, rgba(100,115,201,.7), rgba(25,32,72,.7)"
              />
            </template>

            <v-app-bar-title v-if="is_field === false">
              <h3>Studio Vidio</h3>
            </v-app-bar-title>

            <v-spacer />

            <v-btn
              v-if="is_field === false"
              icon
            >
              <v-icon @click="is_field = true">
                mdi-magnify
              </v-icon>
            </v-btn>
            <div
              v-else
              class="d-flex flex-row mt-5 align-center"
            >
              <div class="d-flex flex-column">
                <v-text-field
                  append-icon="mdi-magnify"
                  class="mt-5 ml-9"
                  outlined
                  rounded
                  width="100%"
                  dense
                  @click:append="is_field = false"
                />
              </div>
            </div>
          </v-app-bar>

          <v-list
            max-height="980"
            class="overflow-y-auto"
          >
            <v-list-item>
              <v-list-item-content
                v-if="listVidios.length !== 0"
                class="mt-7"
              >
                <v-card
                  v-for="n in listVidios"
                  :key="n.id"
                >
                  <div v-if="n.id !== list.id">
                    <v-img
                      style="cursor: pointer"
                      width="100%"
                      height="200"
                      :src="n.url_thumbnail_youtube"
                      @click="play(n)"
                      @input="load(n.id)"
                    >
                      <v-row class="fill-height text-right ma-0">
                        <v-col cols="12">
                          <v-chip
                            v-if="n.studio"
                            label
                            class="mx-0 ml-2 mb-2 text-uppercase"
                            color="pallet1"
                            text-color="white"
                            small
                            @click.stop=""
                          >
                            {{ n.studio.name }}
                            <!-- || {{ n.studio.email }} -->
                          </v-chip>
                        </v-col>

                        <!-- <v-col align-self="end">
                          <v-chip
                            class="text-uppercase ma-0"
                            color="primary"
                            label
                            small
                          >
                            See Vidio
                          </v-chip>
                        </v-col> -->
                      </v-row>
                    </v-img>

                    <div class="d-flex flex-row justify-start mt-4">
                      <div class="d-flex flex-column">
                        <p class="ml-2">
                          {{ n.name }}
                        </p>
                      </div>
                    </div>
                    <div class="d-flex flex-row ml-2">
                      <div class="d-flex flex-column">
                        <p
                          v-if="n.author"
                          class="grey--text"
                        >
                          Created By
                          {{ n.author.firstName + " " + n.author.lastName }} -
                          {{ timeSince(n.created_at) }}
                        </p>
                      </div>
                    </div>
                  </div>
                </v-card>
              </v-list-item-content>
              <v-list-item-content v-else>
                <v-card class="mt-12 mx-auto">
                  <v-alert
                    class="mt-12 mx-auto"
                    dense
                    outlined
                    type="error"
                  >
                    You dont have a Vidio Class
                  </v-alert>
                </v-card>
              </v-list-item-content>
            </v-list-item>
          </v-list>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
  import comments from "./component/__comments.vue"
  import listArticle from "./component/__listArticle.vue"
  export default {
    components: {
      "app-comments": comments,
      "app-data-list": listArticle,
    },
    props: {
      list: {
        type: Object,
        default: null,
      },
      listVidios: {
        type: Array,
        default: null,
      },
      tabs: {
        type: Number,
        default: null,
      },
    },
    data: () => ({
      model: 0,
      cycle: false,
      colors: ["primary", "secondary", "yellow darken-2", "red", "orange"],
      items: [
        {
          src: "https://cdn.vuetifyjs.com/images/carousel/squirrel.jpg",
        },
        {
          src: "https://cdn.vuetifyjs.com/images/carousel/sky.jpg",
        },
        {
          src: "https://cdn.vuetifyjs.com/images/carousel/bird.jpg",
        },
        {
          src: "https://cdn.vuetifyjs.com/images/carousel/planet.jpg",
        },
      ],
      is_field: false,
      scrollInvoked: 0,
      childs: {},
      listId: null,
      seeComments: false,
      objectArticle: {},
      page: 1,
      state_loading: false,
      article: {
        meta: null,
        data: null,
        links: {
          next: null,
        },
      },
    }),
    computed: {
      computedComments () {
        return this.$store.state.commentStudioVidio.comments
      },
      computedCommentChilds () {
        return this.$store.state.commentStudioVidio.childs
      },
      list_id () {
        return this.list
      },
      me () {
        return this.$store.state.user.me
      },
    },

    watch: {
      page () {
        this.resize()
      },
    },
    mounted () {
      this.getDataComments()
      this.studioArticle()
      this.scroll()
    },
    beforeMount () {
      this.listId = this.list_id.id
      this.getDataComments()
    },
    methods: {
      load (id) {
        this.listId = id
        this.getDataComments()
      },
      getDataComments () {
        this.$store.dispatch("commentStudioVidio/getDataComments", {
          vidio_id: localStorage.getItem("vidio_id"),
        })
      },
      insertComments ({ item }) {
        this.$store
          .dispatch("commentStudioVidio/insertComments", {
            comment: item.comment,
            vidio_id: localStorage.getItem("vidio_id"),
          })
          .then((res) => {
            if (res.data.meta.status) {
              this.getDataComments()
              item.comment = ""
            }
          })
      },
      repliesComments ({ item }) {
        this.$store
          .dispatch("commentStudioVidio/insertComments", {
            comment: item.item.repliesComment,
            parent_id: item.parent_id,
            vidio_id: localStorage.getItem("vidio_id"),
          })
          .then((res) => {
            if (res.data.meta.status) {
              this.getDataComments()
              item.item.repliesComment = ""
              item.seeReplies = true
            }
          })
      },
      repliesNestingComments ({ item }) {
        this.$store
          .dispatch("commentStudioVidio/insertComments", {
            comment:
              "@" +
              item.user.firstName +
              " " +
              item.user.lastName +
              "  " +
              item.item.repliesNestingComment,
            vidio_id: localStorage.getItem("vidio_id"),
            parent_id: item.custome.parent_id,
          })
          .then((res) => {
            if (res.data.meta) {
              this.getDataComments()
              item.item.repliesNestingComment = ""
              item.seeReplies = true
            }
          })
      // console.log(
      //   '@' +
      //     item.user.firstName +
      //     ' ' +
      //     item.user.lastName +
      //     ' ' +
      //     item.item.repliesNestingComment,
      //   item.custome.parent_id,
      // )
      },
      resize () {
        this.inputHeight = `${this.$refs.input.scrollHeight}px`
        if (this.page === "" || this.page == null) {
          this.inputHeight = "62px"
        }
      },
      toSee () {
        this.seeComments = !this.seeComments
      },
      play (item) {
        this.$emit("play", { item: item })
        this.listId = item.id
        this.getDataComments()
      },
      scroll () {
        if (this.tabs === 0) {
          window.onscroll = () => {
            const bottomOfWindow =
              document.documentElement.scrollTop + window.innerHeight ===
              document.documentElement.offsetHeight
            // console.log(bottomOfWindow)
            setTimeout(() => {
              if (bottomOfWindow) {
                setTimeout(() => {
                  this.moreArticle()
                // this.resize()
                }, 3000)
              }
            }, 3000)
          }
        }
      },
      timeSince (time) {
        switch (typeof time) {
          case "number":
            break
          case "string":
            time = +new Date(time)
            break
          case "object":
            if (time.constructor === Date) time = time.getTime()
            break
          default:
            time = +new Date()
        }
        const timeformats = [
          [60, "seconds", 1], // 60
          [120, "1 minute ago", "1 minute from now"], // 60*2
          [3600, "minutes", 60], // 60*60, 60
          [7200, "1 hour ago", "1 hour from now"], // 60*60*2
          [86400, "hours", 3600], // 60*60*24, 60*60
          [172800, "Yesterday", "Tomorrow"], // 60*60*24*2
          [604800, "days", 86400], // 60*60*24*7, 60*60*24
          [1209600, "Last week", "Next week"], // 60*60*24*7*4*2
          [2419200, "weeks", 604800], // 60*60*24*7*4, 60*60*24*7
          [4838400, "Last month", "Next month"], // 60*60*24*7*4*2
          [29030400, "months", 2419200], // 60*60*24*7*4*12, 60*60*24*7*4
          [58060800, "Last year", "Next year"], // 60*60*24*7*4*12*2
          [2903040000, "years", 29030400], // 60*60*24*7*4*12*100, 60*60*24*7*4*12
          [5806080000, "Last century", "Next century"], // 60*60*24*7*4*12*100*2
          [58060800000, "centuries", 2903040000], // 60*60*24*7*4*12*100*20, 60*60*24*7*4*12*100
        ]
        let seconds = (+new Date() - time) / 1000
        let token = "ago"
        let listchoice = 1

        if (seconds === 0) {
          return "Just now"
        }
        if (seconds < 0) {
          seconds = Math.abs(seconds)
          token = "from now"
          listchoice = 2
        }
        let i = 0
        let format
        while ((format = timeformats[i++])) {
          if (seconds < format[0]) {
            if (typeof format[2] === "string") return format[listchoice]
            else {
              return (
                Math.floor(seconds / format[2]) + " " + format[1] + " " + token
              )
            }
          }
        }
        return time
      },

      studioArticle () {
        this.state_loading = true
        this.$store
          .dispatch("studioArticle/getArticles", {
            slug: this.$route.params.slug,
            page: this.page,
          })
          .then((res) => {
            if (res.data.meta.status) {
              this.state_loading = false
              this.article.meta = res.data.meta
              this.article.links = res.data.links
              if (!this.article.data && this.page === 1) {
                this.article.data = res.data.data
              } else {
                this.article.data.push(...res.data.data)
              }
            } else {
              console.log("error")
            }
          })
      },
      moreArticle () {
        if (this.article.links.next) {
          this.page++

          this.studioArticle()
        }
      },
      getDataMe () {
        this.$store.dispatch("user/me")
      },
    },
  }
</script>

<style></style>
