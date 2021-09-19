<template>
  <v-card>
    <v-card-title class="font-spartan font-weight-bold">
      Reviews User
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
              class="font-spartan ratings__modified primary--text d-flex justify-center"
            >
              4.6
            </span>
            <br>
            <span
              class="font-spartan font__users_rating primary--text d-flex justify-center"
            >
              dari 620 User
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
          <v-progress-linear
            :value="skill"
            color="primary"
            height="15"
            rounded
            readonly
          >
            <v-rating
              :value="5"
              color="orange"
              half-increments
              readonly
            />
          </v-progress-linear>

          <br>

          <v-progress-linear
            :value="skill"
            color="primary"
            height="15"
            readonly
            rounded
          >
            <v-rating
              :value="4"
              color="orange"
              half-increments
              readonly
            />
          </v-progress-linear>
          <br>
          <v-progress-linear
            :value="skill"
            color="primary"
            height="15"
            readonly
            rounded
          >
            <v-rating
              :value="3"
              color="orange"
              half-increments
              readonly
            />
          </v-progress-linear>
          <br>
          <v-progress-linear
            :value="skill"
            color="primary"
            height="15"
            readonly
            rounded
          >
            <v-rating
              :value="2"
              color="orange"
              half-increments
              readonly
            />
          </v-progress-linear>
          <br>
          <v-progress-linear
            :value="skill"
            color="primary"
            height="15"
            readonly
            rounded
          >
            <v-rating
              :value="1"
              color="orange"
              half-increments
              readonly
            />
          </v-progress-linear>
        </div>
      </v-col>
    </v-row>
    <v-divider class="mt-5 mb-2" />
    <v-row class="mt-4">
      <v-col
        cols="12"
        md="4"
      >
        <span class="font-spartan-spartan font__title_reviews">
          Most Helpful review
        </span>
        <v-card
          width="400"
          class="ml-5 mr-5 cards__reviews"
        >
          <v-avatar tile>
            <v-img
              class="ml-2"
              src="https://ecs7.tokopedia.net/img/cache/100-square/user-1/2020/9/17//_f2b28f83-f185-4936-95f7-aed5d4f6026b.png"
            />
          </v-avatar>
          <span class="font-spartan users__ratings">
            Mahardika Kessuma Denie
          </span>
          <v-rating
            :value="5"
            color="orange"
            background-color="grey"
            class="ratings__users"
            half-increments
            readonly
          />
          <v-card-text>
            <span class="font-spartan-small">
              Pembelajaran Yang Sangat Membantuu Kamiii
            </span>
            <v-divider />

            <span class="font-spartan-small">
              was this review helpful
              <v-icon class="icon__thumb">mdi-thumb-up-outline</v-icon>
            </span>
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>
    <v-row>
      <v-col
        cols="12"
        md="4"
        class="ml-4"
      >
        <span>
          Filter
        </span>

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
      v-if="reviews.length !== 0"
      class="mt-2"
    >
      <v-col
        v-for="(item, i) in reviews"
        :key="i"
        class="ml-5"
        cols="12"
      >
        <v-avatar
          v-if="item.user"
          color="primary"
        >
          <v-img
            v-if="item.user.img"
            :src="item.user.img.url"
          />
          <span
            v-else
            class="text-capitalize"
          >{{
            item.user.nickName.charAt(0)
          }}</span>
        </v-avatar>
        <span
          v-if="item.user"
          class="ml-2 mr-2 text-capitalize"
        >{{
          item.user.nickName
        }}</span>-
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
          <v-tooltip
            v-if="item.likes"
            bottom
            color="primary"
          >
            <template #activator="{on ,attrs}">
              <v-btn
                dark
                small
                v-bind="attrs"
                icon
                class="like__reviews"
                v-on="on"
              >
                <v-icon :color="$vuetify.theme.dark ? 'white' : 'black'">
                  mdi-thumb-up-outline
                </v-icon>
              </v-btn>
            </template>
            <span>{{ item.likes.length }} People Like This Reviews</span>
          </v-tooltip>
          <p class="report__reviews btn_primary--text">
            Report
          </p>
        </v-card-text>
      </v-col>
      <v-divider class="divider--opacity" />
    </v-row>
    <v-row
      v-else
      class="d-flex justify-center mt-2"
    >
      <v-col
        cols="12"
        class="d-flex justify-center"
      >
        <span class="font-spartan text-center">
          No Reviews yet
        </span>
      </v-col>
    </v-row>
  </v-card>
</template>

<script>
  export default {
    props: {
      reviews: {
        type: Array,
        default: null,
      },
    },
    data: () => ({
      skill: 80,
      knowledge: 33,
      power: 78,
      rating: 2,
      filter: 'All',
      item: [
        {
          name: 'All',
          icon: 'mdi-account',
          color: 'btn_primary',
        },
        {
          name: '5',
          icon: 'mdi-star',
          color: 'orange',
        },
        {
          name: '4',
          icon: 'mdi-star',
          color: 'orange',
        },
        {
          name: '3',
          icon: 'mdi-star',
          color: 'orange',
        },
        {
          name: '2',
          icon: 'mdi-star',
          color: 'orange',
        },
        {
          name: '1',
          icon: 'mdi-star',
          color: 'orange',
        },
      ],
    }),
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
    },
  }
</script>

<style lang="sass" scoped>
.ratings__modified
    font-weight: 900
    font-size: 30px
    line-height: 2rem
.font__users_rating
    font: 800
    font-size: 16px
.ratings_starts
    margin-left: 480px
.ratings__users
    margin-left: 56px
    margin-top: -25px
.icon__thumb
    margin-left: 120px
.font__title_reviews
    margin-left: 28px
// .cards__reviews
//     margin-top: -1px
.btn__filter
    margin-left: 52px
    margin-top: -40px
.btn__filter-3
    margin-left: 175px
    margin-top: -52px
.font__date
    margin-left: 4px
    margin-bottom: -10px
.ratings__users__reviews
    margin-left: 40px
    margin-top: -35px
.like__reviews
    margin-left: 43px
    margin-top: -8px
.report__reviews
    margin-left: 86px
    margin-top: -21px
    font-size: 12px
.theme--dark
  .divider--opacity
    opacity: .2
</style>
