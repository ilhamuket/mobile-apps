<template>
  <v-app>
    <v-container>
      <v-row class="d-flex justify-center">
        <v-col
          cols="12"
          md="5"
        >
          <v-card>
            <v-card-title>
              <h4>
                {{ $t('search') }}
              </h4>
            </v-card-title>
            <v-card-text>
              <v-text-field
                :label="$t('search')"
                outlined
                dense
              />
              <v-autocomplete
                label="Search By Studio"
                outlined
                dense
                :items="studio"
                item-text="name"
                item-value="name"
              />
            </v-card-text>
            <v-card-actions class="d-flex flex-row-reverse">
              <div class="d-flex flex-row-reverse">
                <div class="d-flex flex-column">
                  <v-btn
                    outlined
                    color="primary"
                  >
                    {{ $t('search') }}
                  </v-btn>
                </div>
              </div>
            </v-card-actions>
          </v-card>
        </v-col>
      </v-row>
      <v-row dense>
        <v-col
          v-for="n in article"
          :key="n.id"
          cols="12"
          md="4"
        >
          <v-card
            :loading="loading"
            max-width="400"
            height="350"
          >
            <template slot="progress">
              <v-progress-linear
                color="deep-purple"
                height="10"
                indeterminate
              />
            </template>

            <v-img
              height="250"
              :src="n.thumbnail_url"
            >
              <v-row class="fill-height text-right ma-0">
                <v-col cols="12">
                  <v-chip
                    v-if="n.author"
                    label
                    class="mx-0 ml-2 mb-2 text-uppercase"
                    color="pallet1"
                    text-color="white"
                    small
                    @click.stop=""
                  >
                    {{ n.author.firstName + ' ' + n.author.lastName }} -
                    {{ timeSince(n.created_at) }}
                    <!-- || {{ list.class_type }} -->
                  </v-chip>
                  <br>
                  <v-chip
                    v-if="n.studio"
                    label
                    class="mx-0 ml-2 mb-2 text-capitalize"
                    color="pallet1"
                    text-color="white"
                    small
                    @click.stop=""
                  >
                    Studio : {{ n.studio.name }}
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
                    views : {{ n.views }}
                  </v-chip>
                </v-col>

                <v-col align-self="end">
                  <v-chip
                    class="text-uppercase ma-0"
                    color="primary"
                    label
                    small
                    style="cursor:pointer"
                    :to="`/journal/${n.id}/show`"
                  >
                    Read More
                  </v-chip>
                </v-col>
              </v-row>
            </v-img>

            <v-card-title>
              <v-tooltip
                bottom
                color="blue"
              >
                <template #activator="{attrs, on}">
                  <a
                    v-bind="attrs"
                    class="text-subtitle-1 text-roboto"
                    style="cursor:pointer"
                    @click="toSee(n)"
                    v-on="on"
                  >
                    {{ n.title.substr(0, 40) + ' ... ' }}
                  </a>
                </template>
                <span>
                  {{ n.title }}
                </span>
              </v-tooltip>
            </v-card-title>

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
          </v-card>
        </v-col>
      </v-row>
    </v-container>
  </v-app>
</template>

<script>
  export default {
    data: () => ({
      loading: false,
      selection: 1,
    }),
    computed: {
      article () {
        return this.$store.state.article.data
      },
      studio () {
        return this.$store.state.studio.data
      },
    },
    mounted () {
      this.getDataArticle()
      this.getDataStudio()
    },
    methods: {
      getDataArticle () {
        this.$store.dispatch('article/getDataArticle')
      },
      getDataStudio () {
        this.$store.dispatch('studio/getData')
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
      toSee (item) {
        this.$router.push(`/journal/${item.id}/show`)
      },
    },
  }
</script>
<style lang="sass" scoped>
.text-size
    font-size: 20px !important
.text-roboto
    font-family: 'roboto' !important
    color: grey
    font-weight: bold
</style>
