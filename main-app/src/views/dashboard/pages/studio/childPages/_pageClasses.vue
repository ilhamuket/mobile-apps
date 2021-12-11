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
            :events="allowedDates"
            show-current="false"
            event-color="btn_primary"
            :picker-date.sync="pickerDate"
            full-width
            show-week
            class="date-picker__ensiklotari"
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
          class="ml-1"
        >
          <v-card class="ml-1">
            <v-img
              v-if="item.img"
              :src="item.img.url"
              width="450"
              height="276"
              gradient="to top right, rgba(0,0,0,.33), rgba(0,0,0,.7)"
              style="background-color: grey; cursor: pointer"
              @click="toPush(item)"
            >
              <v-container>
                <v-row>
                  <v-col class="d-flex flex-row-reverse">
                    <v-chip
                      label
                      text-color="white"
                      :color="setColorStatus(item.status_kelas)"
                      class="text-capitalize"
                    >
                      {{ item.status_kelas }}
                    </v-chip>
                  </v-col>
                </v-row>
              </v-container>
            </v-img>
            <v-img
              v-else
              height="200px"
              src="https://cdn.vuetifyjs.com/images/cards/sunshine.jpg"
            />
            <v-card-text>
              <v-row class="">
                <div class="d-flex flex-row mt-2 ml-1">
                  <div class="d-flex flex-column">
                    <v-chip
                      v-if="item.category"
                      label
                      text-color="white"
                      color="btn_primary"
                      class="font-spartan-small"
                    >
                      {{ item.name }} - {{ item.category.display_name }}
                    </v-chip>
                  </div>
                </div>
              </v-row>
              <v-row>
                <div class="d-flex flex-row mt-2 ml-1">
                  <div class="d-flex flex-column">
                    <span class="font-spartan">
                      Price per person : Rp{{ item.harga }}
                    </span>
                  </div>
                </div>
              </v-row>
              <v-row>
                <div class="d-flex flex-row mt-2 ml-1">
                  <div class="d-flex flex-column">
                    <span class="font-spartan-small">
                      Registration : {{ item.start_at | moment("MMMM Do") }} -
                      {{ item.end_at | moment("MMMM Do YYYY") }}
                    </span>
                  </div>
                </div>
              </v-row>
              <v-row>
                <div class="d-flex flex-row mt-2 ml-1">
                  <div
                    v-if="item.about.length > 200"
                    class="d-flex flex-column"
                  >
                    <span
                      v-if="isMore"
                      class="font-spartan-small"
                    >
                      #About <br>
                      {{
                        item.about.length > 200
                          ? item.about.substr(0, 200) + "..."
                          : item.about
                      }}
                    </span>
                    <span
                      v-else
                      class="font-spartan-small"
                    >
                      #About <br>
                      {{ item.about }}
                    </span>
                    <a
                      class="font-spartan-small font-italic btn_primary--text"
                      style="cursor: pointer"
                      color="transparent"
                      @click="isMore = !isMore"
                    >
                      less
                    </a>
                  </div>
                  <div
                    v-else
                    class="d-flex flex-column"
                  >
                    #About <br>
                    {{ item.about }}
                  </div>
                </div>
              </v-row>
            </v-card-text>
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
      items: ["tahu", "ayam"],
      isMore: true,
      rating: 3,
      show: false,
      picker: "2021-09-21",
      date: new Date(Date.now() - new Date().getTimezoneOffset() * 60000)
        .toISOString()
        .substr(0, 10),
      min: new Date(Date.now() - new Date().getTimezoneOffset() * 60000)
        .toISOString()
        .substr(0, 10),
      pickerDate: null,
      notes: [],
      allNotes: [
        "President met with prime minister",
        "New power plant opened",
        "Rocket launch announced",
        "Global warming discussion cancelled",
        "Company changed its location",
      ],
    }),
    watch: {
      pickerDate (val) {},
      date (val) {
        this.$router.push({ query: { ...this.$route.query, date: val } })
      },
      "$route.query.date": function (item) {
        this.date = item
      },
    },
    methods: {
      allowedDates (val) {
        console.log(val)
        const dates = this.studioDates.map((x) => x.start_at)
        const isTrue = dates.some((x) => x === val)
        // console.log(isTrue, 'ini date')
        if (isTrue) {
          return true
        } else {
          return false
        }
      },
      setColorStatus (status) {
        if (status === "upcoming") return "primary"
        if (status === "ongoing") return "btn_primary"
        else return "red"
      },
      clickSeeMore (item) {
        this.$emit("open", { item: item })
      },
      fetchTime (i) {
        this.$emit("fetchDate", { item: i })
      },
      toPush (item) {
        this.$router.push(
          "/detail/class/live/" + item.studio.slug + "/" + item.slug,
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
          date.getFullYear() + "-" + date.getMonth() + "-" + date.getDate(),
        )
        console.log(date.toISOString())
      },
    },
  }
</script>

<style lang="sass">
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
.date-picker
  &__ensiklotari
    .v-picker__body .theme--dark
      background-color: #141C31 !important
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
.margin--cols
  margin-top: 64%
  margin-left: 1%
.margin-a
  margin-left: 90%
</style>
