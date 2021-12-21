<template>
  <v-container>
    <v-card-title class="font-spartan primary--text font-weight-bold">
      Reviews
    </v-card-title>
    <v-row class="ml-2">
      <v-col
        cols="12"
        sm="6"
        lg="4"
      >
        <v-card
          class="mt-5"
          height="120"
        >
          <v-card-text class="">
            <span
              class="
                font-spartan
                ratings__modified
                primary--text
                d-flex
                justify-center
              "
            >
              {{ computedCount }}
            </span>
            <br>
            <span
              class="
                font-spartan font__users_rating
                primary--text
                d-flex
                justify-center
              "
            >
              {{ value.all }} Reviews
            </span>
          </v-card-text>
        </v-card>
      </v-col>
      <v-col
        cols="12"
        sm="6"
        lg="7"
      >
        <div>
          <v-rating
            :value="5"
            color="primary"
            length="1"
            half-increments
            readonly
          >
            <template v-slot:item="props">
              <v-icon
                :color="'primary'"
                medium
                @click="props.click"
              >
                mdi-star-circle
              </v-icon>
              <span>5</span>
            </template>
          </v-rating>
          <v-progress-linear
            class="progres--ratings"
            :value="computedFive"
            color="primary"
            height="12"
            readonly
            rounded
          >
            <span class="font-progresss font-weight-bold primary--text">{{
              value.five
            }}</span>
          </v-progress-linear>

          <br>

          <v-rating
            :value="5"
            color="primary"
            length="1"
            half-increments
            readonly
          >
            <template v-slot:item="props">
              <v-icon
                :color="'primary'"
                medium
                @click="props.click"
              >
                mdi-star-circle
              </v-icon>
              <span>4</span>
            </template>
          </v-rating>
          <v-progress-linear
            class="progres--ratings"
            :value="computedFour"
            color="primary"
            height="12"
            readonly
            rounded
          >
            <span class="font-progresss font-weight-bold primary--text">{{
              value.four
            }}</span>
          </v-progress-linear>

          <br>

          <v-rating
            :value="5"
            color="primary"
            length="1"
            half-increments
            readonly
          >
            <template v-slot:item="props">
              <v-icon
                :color="'primary'"
                medium
                @click="props.click"
              >
                mdi-star-circle
              </v-icon>
              <span>3</span>
            </template>
          </v-rating>
          <v-progress-linear
            class="progres--ratings"
            :value="computedThird"
            color="primary"
            height="12"
            readonly
            rounded
          >
            <span class="font-progresss font-weight-bold primary--text">{{
              value.third
            }}</span>
          </v-progress-linear>

          <br>

          <v-rating
            :value="5"
            color="primary"
            length="1"
            half-increments
            readonly
          >
            <template v-slot:item="props">
              <v-icon
                :color="'primary'"
                medium
                @click="props.click"
              >
                mdi-star-circle
              </v-icon>
              <span>2</span>
            </template>
          </v-rating>
          <v-progress-linear
            class="progres--ratings"
            :value="computedTwo"
            color="primary"
            height="12"
            readonly
            rounded
          >
            <span class="font-progresss font-weight-bold primary--text">{{
              value.two
            }}</span>
          </v-progress-linear>

          <br>

          <v-rating
            :value="5"
            color="primary"
            length="1"
            half-increments
            readonly
          >
            <template v-slot:item="props">
              <v-icon
                :color="'primary'"
                medium
                @click="props.click"
              >
                mdi-star-circle
              </v-icon>
              <span>1</span>
            </template>
          </v-rating>
          <v-progress-linear
            class="progres--ratings"
            :value="computedOne"
            color="primary"
            height="12"
            readonly
            rounded
          >
            <span class="font-progresss font-weight-bold btn_primary--text">{{
              value.one
            }}</span>
          </v-progress-linear>
        </div>
      </v-col>
    </v-row>
    <v-row>
      <v-col
        cols="12"
        md="4"
        class="ml-4"
      >
        <span> Filter </span>

        <v-row class="btn__filter">
          <v-col cols="6">
            <v-select
              v-model="filter"
              outlined
              dense
              :items="item"
              item-text="name"
              item-value="name"
            >
              <template
                slot="selection"
                slot-scope="data"
              >
                <slot
                  name="item"
                  v-bind="data"
                >
                  <v-chip
                    color="transparent"
                    style="text-transform: uppercase"
                  >
                    <v-avatar left>
                      <v-icon :color="data.item.color">
                        {{ data.item.icon }}
                      </v-icon>
                    </v-avatar>
                    {{ data.item.name }}
                  </v-chip>
                </slot>
              </template>
              <template
                slot="item"
                slot-scope="data"
              >
                <slot
                  name="item"
                  v-bind="data"
                >
                  <v-chip
                    color="transparent"
                    class="text-uppercase"
                  >
                    <v-avatar left>
                      <v-icon :color="data.item.color">
                        {{ data.item.icon }}
                      </v-icon>
                    </v-avatar>
                    {{ data.item.name }}
                  </v-chip>
                </slot>
              </template>
            </v-select>
          </v-col>
        </v-row>
      </v-col>
    </v-row>
    <v-divider class="mt-5 mb-2 divider--opacity" />
    <span class="font-spartan-small ml-4">
      All Reviews ({{ reviews.length }})
    </span>
    <v-row
      v-if="reviews.length > 0"
      class="mt-2"
    >
      <v-col
        v-for="(item, i) in reviews"
        :key="i"
        cols="12"
      >
        <v-avatar color="primary">
          <v-img
            src="https://api.ensiklotari.com/app/images/studio/WdC3rSuP0VsBsMkWL3kaToBWB2kp5hhOY566B8Bx.jpg"
          />
        </v-avatar>
        <span
          v-if="item.user"
          class="ml-4"
        >{{ item.user.nickName }}</span>-
        <span class="font__date">{{ timeSince(item.created_at) }}</span>
        <v-card-text>
          <v-rating
            :value="item.ratings"
            color="orange"
            background-color="grey"
            class="ratings__users__reviews"
            half-increments
            readonly
            size="14"
          />

          <p class="font-spartan-small ml-12 mt-1">
            {{ item.body }}
          </p>
          <div class="d-flex flex-row ml-9">
            <div class="d-flex flex-column mr-1">
              <v-img
                width="100"
                src="https://api.ensiklotari.com/app/images/studio/WdC3rSuP0VsBsMkWL3kaToBWB2kp5hhOY566B8Bx.jpg"
              />
            </div>
            <div class="d-flex flex-column">
              <v-img
                width="100"
                src="https://api.ensiklotari.com/app/images/studio/WdC3rSuP0VsBsMkWL3kaToBWB2kp5hhOY566B8Bx.jpg"
              />
            </div>
          </div>
        </v-card-text>
        <v-card-text
          v-if="item.response.length !== 0"
          class="ml-12 card-response"
        >
          <v-container>
            <v-row>
              <v-col
                v-for="(response, x) in item.response"
                :key="x"
                cols="12"
              >
                <span class="font-spartan-small"> Seller Response: </span>
                <br>
                <span class="font-spartan-small">
                  {{ response.body }}
                </span>
              </v-col>
            </v-row>
          </v-container>
        </v-card-text>
      </v-col>
    </v-row>
    <v-row v-else>
      <v-col cols="12">
        <span class="font-spartan d-flex justify-center"> Belum Ada </span>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
  export default {
    props: {
      reviews: {
        type: Array,
        default: null,
      },
      value: {
        type: Object,
        default: null,
      },
    },
    data: () => ({
      skill: 90,
      knowledge: 33,
      power: 78,
      filter: "All",
      item: [
        {
          name: "All",
          icon: "mdi-account",
          color: "primary",
        },
        {
          name: "5",
          icon: "mdi-star",
          color: "orange",
        },
        {
          name: "4",
          icon: "mdi-star",
          color: "orange",
        },
        {
          name: "3",
          icon: "mdi-star",
          color: "orange",
        },
        {
          name: "2",
          icon: "mdi-star",
          color: "orange",
        },
        {
          name: "1",
          icon: "mdi-star",
          color: "orange",
        },
      ],
    }),
    computed: {
      computedFive () {
        let number = 0
        if (this.value !== null) {
          number = (this.value.five / this.value.all) * 100
        }
        return number
      },
      computedFour () {
        let number = 0
        if (this.value !== null) {
          number = (this.value.four / this.value.all) * 100
        }
        return number
      },
      computedThird () {
        let number = 0
        if (this.value !== null) {
          number = (this.value.third / this.value.all) * 100
        }
        return number
      },
      computedTwo () {
        let number = 0
        if (this.value !== null) {
          number = (this.value.two / this.value.all) * 100
        }
        return number
      },
      computedOne () {
        let number = 0
        if (this.value !== null) {
          number = (this.value.one / this.value.all) * 100
        }
        return number
      },
      computedCount () {
        let value = 0.0
        const a = this.reviews.map((x) => x.ratings)
        if (a.length > 0) {
          const sum = a.filter((x) => x > 0).reduce((x, y) => x + y)
          value = sum / this.reviews.length
        }
        const x = parseFloat(value.toFixed(2))
        console.log(x)

        return x
      },
    },

    methods: {
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
    },
  }
</script>

<style lang="sass" scoped>
.progres--ratings
    margin-left: 50px
    margin-top: -20px
.ratings__users__reviews
    margin-left: 46px
    margin-top: -35px
.like__reviews
    margin-left: 43px
    margin-top: -8px
.report__reviews
    margin-left: 86px
    margin-top: -21px
    font-size: 12px
.font__date
    margin-left: 4px
    margin-bottom: -10px
.cols__img_list
  margin-top: -20px
.card-response
  background-color: #F5F5F5
  width: 1080px
.font-progresss
  font-size: 9px
  margin-left: 580px
</style>
