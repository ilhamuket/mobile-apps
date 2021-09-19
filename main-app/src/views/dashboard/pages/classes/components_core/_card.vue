<template>
  <v-row>
    <v-col
      v-for="(item, i) in classes"
      :key="i"
      cols="12"
      md="4"
    >
      <v-card
        class="mx-auto"
        max-width="344"
      >
        <v-img
          v-if="item.img"
          :src="item.img.url"
          height="200px"
          style="cursor:pointer"
          @click="toPush(item)"
        >
          <v-row class="fill-height mt-g text-right">
            <v-col cols="12">
              <v-chip
                label
                class="font-spartan mr-1 mt-2 text-uppercase"
                :color="setColorLabel(item.status_kelas)"
                text-color="white"
                small
                @click.stop=""
              >
                {{ item.status_kelas }}
              </v-chip>
            </v-col>
          </v-row>
        </v-img>
        <v-img
          v-else
          class="white--text align-end"
          height="200px"
          src="https://cdn.vuetifyjs.com/images/cards/docks.jpg"
        >
          <v-row class="fill-height mt-g text-right">
            <v-col cols="12">
              <v-chip
                label
                class="font-spartan mr-1 text-uppercase"
                :color="setColorLabel(item.status_kelas)"
                text-color="white"
                small
                @click.stop=""
              >
                {{ item.status_kelas }}
              </v-chip>
            </v-col>
          </v-row>
        </v-img>

        <v-card-actions class="font-spartan customize--font primary--text">
          <v-tooltip
            v-if="item.name.length > 13"
            bottom
            color="primary"
            style="cursor:pointer"
          >
            <template #activator="{on, attrs}">
              <span
                v-bind="attrs"
                style="cursor:pointer"
                @click="toPush(item)"
                v-on="on"
              >
                {{ item.name.substr(0, 10) + '...' }}
              </span>
            </template>
            {{ item.name }}
          </v-tooltip>
          <span
            v-else
            style="cursor:pointer"
            @click="toPush(item)"
          >
            {{ item.name }}
          </span>
          <span class="orange--text text-caption ml-2"> (200 Reviews) </span>
          <v-spacer />
          <span class="orange--text text-caption"> ({{ rating }}) </span>
          <v-rating
            v-model="rating"
            background-color="white"
            color="yellow accent-4"
            readonly
            dense
            half-increments
            hover
            size="18"
          />
        </v-card-actions>

        <v-card-text class="text--primary">
          <v-chip
            v-if="item.studio"
            label
            outlined
            color="btn_primary"
            class="text-h4 font-spartan-small"
          >
            Studio : {{ item.studio.name }}
          </v-chip>

          <v-divider
            class="mt-1 mb-1 divider--opacity"
            dark
          />
          <v-chip
            label
            color="primary"
            class="font-spartan-small font-italic font-weight-thin"
          >
            Capacity : 0 / {{ item.kapasitas }}
          </v-chip>
          <br>
          <span class="font-spartan-small">
            Started Class : {{ item.start_at | moment('MMMM Do YYYY') }}
          </span>
          <br>
          <span class="font-spartan-small font-italic">
            {{ item.time_start }} s/d {{ item.time_end }}
          </span>
          <br>
          <span class="font-spartan-small font-italic">
            Duration : {{ item.durasi }} Minutes
          </span>
          <br>
          <span class="font-spartan-small font-italic">
            Rp.20000
          </span>
        </v-card-text>

        <v-card-actions>
          <v-btn
            color="primary"
            text
            @click="toPush(item)"
          >
            See Class Online
          </v-btn>

          <v-spacer />

          <v-btn
            icon
            dark
            @click="item.show = !item.show"
          >
            <v-icon color="primary">
              {{ item.show ? 'mdi-chevron-up' : 'mdi-chevron-down' }}
            </v-icon>
          </v-btn>
        </v-card-actions>

        <v-expand-transition>
          <div v-show="item.show">
            <v-divider class="divider--opacity" />

            <v-card-text> " {{ item.about }} " </v-card-text>
          </div>
        </v-expand-transition>
      </v-card>
    </v-col>
  </v-row>
</template>

<script>
  export default {
    props: {
      classes: {
        type: Array,
        default: null,
      },
    },
    data: () => ({
      show: false,
      rating: 4.5,
      card: {
        meta: null,
        data: [],
        links: {
          next: null,
        },
      },
      page: 1,
    }),
    computed: {
      momentConver (val) {
        return val.moment('dddd, MMMM Do YYYY')
      },
    },
    watch: {
      page () {},
    },
    mounted () {},

    methods: {
      setColorLabel (item) {
        if (item === 'ongoing') return 'btn_primary'
        if (item === 'upcoming') return 'primary'
        else return 'red'
      },
      scroll () {
        if (this.tabs === 0) {
          window.onscroll = () => {
            const bottomOfWindow =
              document.documentElement.scrollTop + window.innerHeight ===
              document.documentElement.offsetHeight
            console.log(bottomOfWindow)
            setTimeout(() => {
              if (bottomOfWindow) {
                setTimeout(() => {
                  this.moreClass()
                // this.resize()
                }, 3000)
              }
            }, 3000)
          }
        }
      },
      toPush (link) {
        console.log(link)
        this.$router.push(`classes/detail/${link.studio.slug}/${link.slug}`)
      },
      moreClass () {
        if (this.card.links.next) {
          this.page++
          this.getDataClasses()
        }
      },
      moment () {
        if (!this.$page.prop.locale) {
          this.locale = this.$page.prop.app_locale
          this.$i18n.locale = this.$page.prop.app_locale
        } else {
          this.locale = this.$page.prop.locale
          this.$i18n.locale = this.$page.prop.locale
        }
      },
    },
  }
</script>

<style lang="sass" scoped>
.theme--dark
  .divider--opacity
    opacity: .2
.customize--font
  font-size: 14px
.font__classes
  font-size: 12px !important
.margin__chips
  margin-left: 10px
</style>
