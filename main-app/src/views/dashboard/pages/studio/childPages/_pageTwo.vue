<template>
  <v-container>
    <!-- <v-row>
      <v-col
        cols="12"
        md="4"
        class="d-flex justify-start"
      >
        <h2 :class="$vuetify.theme.dark ? 'font-spartan' : 'font-spartan'">
          Describe Class
        </h2>
      </v-col>
    </v-row> -->

    <v-row>
      <!-- <v-col
        cols="12"
        md="12"
      >
        <v-row>
          <v-col
            cols="12"
            md="4"
            sm="12"
          >
            <v-text-field
              :label="`${$t('search')}`"
              dense
              outlined
              append-icon="mdi-magnify"
            />
          </v-col>
        </v-row>
      </v-col> -->
      <v-col
        cols="12"
        class="my-2 px-1"
      >
        <v-card>
          <v-date-picker
            ref="picker"
            v-model="date"
            :min="min"
            :allowed-dates="allowedDates"
            :picker-date.sync="pickerDate"
            full-width
            show-week
            @input="fetchTime(date)"
          />
        </v-card>
      </v-col>
      <v-row v-if="classes.length !== 0">
        <v-col
          v-for="(item, i) in classes"
          :key="i"
          cols="12"
          md="4"
        >
          <v-card class="mx-auto">
            <v-img
              v-if="item.img"
              :src="item.img.url"
              width="400"
              height="200"
            />
            <v-img
              v-else
              height="200px"
              src="https://cdn.vuetifyjs.com/images/cards/sunshine.jpg"
            />
            <v-card-text>
              <div class="text-h6">
                <v-chip
                  :color="setColorStatus(item.status_kelas)"
                  label
                  text-color="white"
                  class="text-capitalize"
                >
                  {{ item.status_kelas }}
                </v-chip>
              </div>

              <v-card-text class="text--primary">
                <span class="text-h3 font-spartan pallet1--text">
                  {{ item.name }}
                </span>

                <v-divider
                  class="mt-2 mb-2 divider--opacity"
                  dark
                />
                <v-chip
                  label
                  color="btn_primary"
                  class="font-spartan-small font-weight-thin"
                >
                  Capacity : 0 / {{ item.kapasitas }}
                </v-chip>
                <br>

                <br>
                <span
                  class="font-spartan-small btn_primary--text text-h4 font-italic"
                >
                  {{ item.time_start }} s/d {{ item.time_end }}
                </span>
                <br>
                <span class="font-spartan-small">
                  Duration : {{ item.durasi }} Minutes
                </span>
                <br>
                <br>
                <span class="font-spartan mt-1">
                  Rp.20000
                </span>
              </v-card-text>
              <!-- <div class="text--primary font-size-ather-roboto-mono">
              {{ item.about }}
            </div> -->
            </v-card-text>

            <v-card-actions>
              <v-btn
                class="ml-5"
                text
                color="secondary"
                small
                @click="toPush(item)"
              >
                See Detail
              </v-btn>

              <v-spacer />

              <v-btn
                icon
                dark
                @click="show = !show"
              >
                <v-icon color="secondary">
                  {{ show ? 'mdi-chevron-up' : 'mdi-chevron-down' }}
                </v-icon>
              </v-btn>
            </v-card-actions>

            <v-expand-transition>
              <div v-show="show">
                <v-divider />

                <v-card-text>
                  <div class="text--primary font-spartan-small">
                    {{ item.about }}
                  </div>
                </v-card-text>
              </div>
            </v-expand-transition>
          </v-card>
          <v-col
            v-if="stateLoad"
            cols="12"
            class="d-flex justify-center"
          >
            <div>
              <v-progress-circular
                class="d-flex justify-center"
                indeterminate
                color="red"
              />
            </div>
          </v-col>
        </v-col>
      </v-row>

      <v-row
        v-if="classes.length === 0"
        class="d-flex justify-center ml-12"
      >
        <v-col
          cols="12"
          md="8"
          class="margin__img"
        >
          <v-img
            width="600"
            src="@/assets/img/noclass.svg"
          />
        </v-col>
      </v-row>
    </v-row>
  </v-container>
</template>

<script>
  export default {
    props: {
      classes: {
        type: Array,
        default: null,
      },
      stateLoad: {
        type: Boolean,
        default: false,
      },
      studioDates: {
        type: Array,
        default: () => [],
      },
    },
    data: () => ({
      items: ['tahu', 'ayam'],
      rating: 3,
      show: false,
      picker: '2021-09-21',
      date: new Date(Date.now() - new Date().getTimezoneOffset() * 60000)
        .toISOString()
        .substr(0, 10),
      min: new Date(Date.now() - new Date().getTimezoneOffset() * 60000)
        .toISOString()
        .substr(0, 10),
      pickerDate: null,
      notes: [],
      allNotes: [
        'President met with prime minister',
        'New power plant opened',
        'Rocket launch announced',
        'Global warming discussion cancelled',
        'Company changed its location',
      ],
    }),
    watch: {
      pickerDate (val) {},
    },
    mounted () {
      console.log(this.allowedDates(), 'Ini FUnction')
    },
    methods: {
      allowedDates (val) {
        console.log(val)
        const dates = this.studioDates.map(x => x.start_at)
        const isTrue = dates.some(x => x === val)
        // console.log(isTrue, 'ini date')
        if (isTrue) {
          return true
        } else {
          return false
        }
      },
      setColorStatus (status) {
        if (status === 'upcoming') return 'primary'
        if (status === 'ongoing') return 'btn_primary'
        else return 'red'
      },
      clickSeeMore (item) {
        this.$emit('open', { item: item })
      },
      fetchTime (i) {
        this.$emit('fetchDate', { item: i })
      },
      toPush (item) {
        this.$router.push(
          '/detail/class/live/' + item.studio.slug + '/' + item.slug,
        )
      // console.log(item.studio.slug)
      },
      getDate () {
        // var months = [
        //   'January',
        //   'February',
        //   'March',
        //   'April',
        //   'May',
        //   'June',
        //   'July',
        //   'August',
        //   'September',
        //   'October',
        //   'November',
        //   'December',
        // ]
        const date = new Date()
        console.log(
          date.getFullYear() + '-' + date.getMonth() + '-' + date.getDate(),
        )
        console.log(date.toISOString())
      },
    },
  }
</script>

<style lang="sass" scoped>
// @import url('https://fonts.googleapis.com/css2?family=Rampart+One&display=swap')
// @import url('https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&family=Shadows+Into+Light&display=swap')
// @import url('https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&family=Roboto+Mono:ital,wght@1,100&family=Shadows+Into+Light&display=swap')
// .font-title
//   font-family: 'Rampart One', cursive !important
//   color: #6B75AA !important
// .font-about
//   // font-family: 'Dancing Script', cursive !important
//   font-family: 'Shadows Into Light', cursive !important
// .font-size-ather
//   font-size: 14px !important
//   font-family: 'Roboto Mono', monospace
//   font-weight: bold
// .date__class
//   width: 600px
//   .v-picker__body
//     width: 500px !important
.margin__img
  margin-top: -100px
.theme--dark
  .divider--opacity
    opacity: .2
.customize--font
  font-size: 14px
.font__classes
  font-size: 12px !important
.margin__chips
  margin-left: 10px
.card__class
  margin-top: -10px !important
</style>
