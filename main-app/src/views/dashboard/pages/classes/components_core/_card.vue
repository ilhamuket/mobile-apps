<template>
  <v-row class="ml-2">
    <v-col
      v-for="(item, i) in classes"
      :key="i"
      cols="12"
      md="4"
    >
      <v-card class="card__class">
        <v-img
          v-if="item.img"
          :src="item.img.url"
          height="200px"
          style="cursor: pointer"
          gradient="to top right, rgba(0,0,0,.33), rgba(0,0,0,.7)"
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

        <!-- <v-card-actions
          v-if="item.studio"
          class="font-spartan-small customize--font primary--text"
        >
          <v-tooltip
            v-if="item.studio.name.length > 13"
            bottom
            color="primary"
            style="cursor: pointer"
          >
            <template #activator="{ on, attrs }">
              <span
                v-bind="attrs"
                style="cursor: pointer"
                @click="toPush(item)"
                v-on="on"
              >
                {{ item.studio.name.substr(0, 9) + "..." }}
              </span>
            </template>
            {{ item.studio.name }}
          </v-tooltip>
          <span
            v-else
            style="cursor: pointer"
            @click="toPush(item)"
          >
            {{ item.studio.name }}
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
        </v-card-actions> -->

        <v-card-text class="text--primary">
          <!-- <v-chip
            label
            outlined
            color="btn_primary"
            class="text-h4 font-spartan-small"
          >
            {{ item.name }}
          </v-chip> -->
          <span class="font-spartan-small font-weight-bold btn_primary--text">
            {{ item.name }} -
            {{ item.studio ? item.studio.name : "Studio Ensiklo" }}
          </span>

          <!-- <v-chip
            v-if="item.category"
            label
            outlined
            color="btn_primary"
            class="text-h4 font-spartan-small ml-4"
          >
            Category : {{ item.category.display_name }}
          </v-chip> -->

          <v-divider
            class="mt-2 mb-2 divider--opacity"
            dark
          />
          <v-chip
            label
            color="btn_primary"
            text-color="white"
            class="font-spartan-small font-italic font-weight-thin"
          >
            Capacity : 0 / {{ item.kapasitas }}
          </v-chip>
          <br>
          <span
            v-if="item.category"
            class="font-spartan-small btn_primary--text"
          >
            Category : {{ item.category.display_name }}
          </span>
          <br>
          <span class="font-spartan-small">
            Registration : {{ item.start_at | moment("MMMM Do") }} -
            {{ item.end_at | moment("MMMM Do YYYY") }}
          </span>
          <br>
          <span class="font-spartan-small">
            Started Class : {{ item.end_at | moment("MMMM Do YYYY") }}
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
            Rp.{{ item.harga }}
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

          <!-- <v-btn
            icon
            dark
            @click="item.show = !item.show"
          >
            <v-icon color="primary">
              {{ item.show ? 'mdi-chevron-up' : 'mdi-chevron-down' }}
            </v-icon>
          </v-btn> -->
        </v-card-actions>

        <!-- <v-expand-transition>
          <div v-show="item.show">
            <v-divider class="divider--opacity" />

            <v-card-text> " {{ item.about }} " </v-card-text>
          </div>
        </v-expand-transition> -->
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
        return val.moment("dddd, MMMM Do YYYY")
      },
    },
    watch: {
      page () {},
    },
    mounted () {},

    methods: {
      setColorLabel (item) {
        if (item === "ongoing") return "btn_primary"
        if (item === "upcoming") return "primary"
        else return "red"
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
        this.$router.push(
          `/detail/class/live/${link.studio.slug}/${link.slug}/keyword/${link.keyword}`,
        )
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

<style lang="sass">
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
