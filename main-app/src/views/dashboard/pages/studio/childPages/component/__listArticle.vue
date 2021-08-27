<template>
  <v-row>
    <!-- <v-col
      v-if="isLoading"
      class="d-flex justify-center"
    >
      <v-progress-circular
        indeterminate
        color="primary"
      />
    </v-col> -->
    <v-col
      v-for="item in article.data"
      :key="item.id"
      cols="6"
    >
      <v-card
        max-width="400"
        height="350"
      >
        <v-progress-linear
          v-if="loading"
          :loading="loading"
          color="deep-purple"
          height="10"
          indeterminate
        />

        <div v-else>
          <v-img
            height="250"
            :src="item.thumbnail_url"
          >
            <v-row>
              <v-col cols="12">
                <v-chip
                  v-if="item.author"
                  label
                  class="mx-0 mt-2 ml-2 mb-2 text-uppercase"
                  color="pallet1"
                  text-color="white"
                  small
                  @click.stop=""
                >
                  {{ item.author.firstName + ' ' + item.author.lastName }} -
                  {{ timeSince(item.created_at) }}
                </v-chip>
                <br>
                <v-chip
                  v-if="item.studio"
                  label
                  class="mx-0 ml-2 mb-2 text-capitalize"
                  color="pallet1"
                  text-color="white"
                  small
                  @click.stop=""
                >
                  Studio : {{ item.studio.name }}
                  <!-- || {{ list.class_type }} -->
                </v-chip>
                <br>
                <v-chip
                  label
                  class="mx-0 ml-2 mb-2 text-uppercase"
                  color="pallet1"
                  text-color="white"
                  small
                  @click.stop=""
                >
                  views : {{ item.views }}
                </v-chip>
              </v-col>
            </v-row>
          </v-img>
          <v-btn
            dark
            color="red"
            icon
          >
            <v-icon>mdi-heart</v-icon>
            20
          </v-btn>

          <v-btn
            dark
            icon
            color="blue"
          >
            <v-icon>mdi-comment-text-multiple-outline</v-icon>
            0
          </v-btn>
          <v-card-title>
            <v-tooltip
              bottom
              color="blue"
            >
              <template #activator="{attrs, on}">
                <a
                  v-if="item.title"
                  v-bind="attrs"
                  class="text-subtitle-1 text-roboto"
                  style="cursor:pointer"
                  v-on="on"
                >
                  {{ item.title.substr(0, 40) + ' ... ' }}
                </a>
              </template>
              <span>
                {{ item.title }}
              </span>
            </v-tooltip>
          </v-card-title>
        </div>
      </v-card>
    </v-col>
    <!-- <div class="d-flex justify-center">
      <v-progress-circular
        :size="50"
        color="primary"
        indeterminate
      />
    </div> -->
  </v-row>
</template>

<script>
  export default {
    props: {
      article: {
        type: Object,
        default: null,
      },
      objectArticle: {
        type: Object,
        default: null,
      },
      isLoading: {
        type: Boolean,
        default: true,
      },
      load: {
        type: Boolean,
        default: null,
      },
    },
    data: () => ({
      i: 1,

      loading: false,
    }),
    mounted () {
      // this.getNext()
      console.log(this.article)
    },
    methods: {
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
      getNext () {
        this.isLoading = true
        this.loading = true

        window.onscroll = () => {
          const bottomOfWindow =
            document.documentElement.scrollTop + window.innerHeight ===
            document.documentElement.offsetHeight
          // console.log(
          //   bottomOfWindow &&
          //     this.objectArticle.current_page !== this.objectArticle.last_page,
          //   '1',
          // )

          if (bottomOfWindow && this.i !== this.objectArticle.last_page) {
            this.isLoading = false
            this.loading = false
            if (this.i !== this.objectArticle.last_page) {
              this.isLoading = false
              this.loading = false

              setTimeout(() => {
                this.i++
                this.$store
                  .dispatch('studioArticle/getArticles', {
                    slug: this.$route.params.slug,
                    page: this.i,
                  })
                  .then(res => {
                    const a = this.article
                    a.push(...res.data.data)
                  })
              }, 3000)
            }
          }
        }
      },
    },
  }
</script>

<style></style>
