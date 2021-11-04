<template>
  <v-container>
    <v-row>
      <v-col cols="12">
        <v-card>
          <v-card-text>
            <div class="d-flex flex-row">
              <div class="d-flex flex-column">
                <span class="font-spartan-small"> FullName : Mahardika </span>
              </div>
            </div>
            <div class="d-flex flex-row mt-1">
              <div class="d-flex flex-column">
                <span class="font-spartan-small"> Studio : EnsikloStudio </span>
              </div>
            </div>
            <div class="d-flex flex-row mt-4">
              <div class="d-flex flex-column">
                <span class="font-spartan font-weight-bold"> Credits</span>
              </div>
            </div>
            <div class="d-flex flex-row mt-2">
              <div class="d-flex flex-column">
                <span class="font-spartan-small">
                  Lorem ipsum dolor sit amet consectetur, adipisicing elit.
                  Ipsa, voluptatum fuga distinctio numquam id dicta minima
                  beatae consequatur. Commodi, reprehenderit!</span>
              </div>
            </div>
            <div class="d-flex flex-row mt-2">
              <div class="d-flex flex-column">
                <span class="font-spartan font-weight-bold mt-4">
                  About {{ data.name }}
                </span>
              </div>
            </div>
            <div class="d-flex flex-row mt-2">
              <div class="d-flex flex-column">
                <span class="font-spartan-small">
                  {{ data.about }}
                </span>
              </div>
            </div>
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>
    <v-row>
      <v-col
        cols="12"
        md="8"
      >
        <v-card>
          <iframe
            width="100%"
            height="400"
            :src="`${autoPlay.url}?rel=0&modestbranding=1&fs=1&loop=0&autopause=0`"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture;"
            sandbox="allow-forms allow-scripts allow-pointer-lock allow-same-origin allow-top-navigation allow-presentation"
            allowfullscreen
          />

          <v-container>
            <v-row>
              <v-col cols="12">
                <span class="font-spartan"> {{ autoPlay.title }} </span>
              </v-col>
              <v-col
                v-if="autoPlay.instructor"
                cols="12"
              >
                <span class="font-spartan-small">
                  <v-avatar size="50">
                    <v-img
                      v-if="autoPlay.instructor.img"
                      :src="autoPlay.instructor.img.url"
                    />
                    <v-img
                      v-else
                      src="https://steezy.imgix.net/choreographers/abey-cabrera.png?auto=compress"
                    />
                  </v-avatar>
                  <span
                    v-if="autoPlay.instructor.studio"
                    class="font-spartan-small ml-2"
                  >
                    {{ autoPlay.instructor.name }} -
                    {{ autoPlay.instructor.studio.name }} -
                    <span class="font-spartan-small">
                      {{ timeSince(autoPlay.created_at) }}
                    </span>
                  </span>
                </span>
              </v-col>
            </v-row>
          </v-container>
        </v-card>
      </v-col>
      <v-col
        cols="12"
        md="4"
      >
        <v-card>
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
              <h3>Instructor Vidio Profile</h3>
            </v-app-bar-title>

            <v-spacer />

            <v-btn
              v-if="is_field === false"
              icon
            >
              <v-icon> mdi-magnify </v-icon>
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
                />
              </div>
            </div>
          </v-app-bar>
          <v-list
            max-height="580"
            class="overflow-y-auto"
          >
            <v-list-item-group>
              <v-list-item>
                <v-list-item-content class="mt-7">
                  <v-card
                    v-for="(item, i) in list"
                    :key="i"
                    class="card--list"
                    @click="chooseVidio(item)"
                  >
                    <div v-if="autoPlay.id !== item.id">
                      <v-img
                        style="cursor: pointer"
                        width="400"
                        height="200"
                        :src="item.url_thumbnail"
                      >
                        <v-row
                          v-if="item.instructor"
                          class="fill-height text-right ma-0"
                        >
                          <v-col
                            v-if="item.instructor.studio"
                            cols="12"
                          >
                            <v-chip
                              label
                              class="mx-0 ml-2 mb-2 text-uppercase"
                              color="btn_primary"
                              text-color="white"
                              small
                              @click.stop=""
                            >
                              {{ item.instructor.studio.name }}
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
                            {{ item.title }}
                          </p>
                        </div>
                      </div>
                      <div class="d-flex flex-row ml-2 mb-2">
                        <div class="d-flex flex-column">
                          <v-avatar>
                            <v-img
                              src="https://steezy.imgix.net/choreographers/abey-cabrera.png?auto=compress"
                            />
                          </v-avatar>
                        </div>
                        <div class="d-flex flex-column ml-2 mt-2">
                          <p
                            v-if="item.instructor && item.instructor.studio"
                            class="grey--text font-weight-bold"
                          >
                            {{ item.instructor.name }} -
                            {{ item.instructor.studio.name }} <br>
                            {{ timeSince(item.created_at) }}
                          </p>
                        </div>
                      </div>
                    </div>
                  </v-card>
                </v-list-item-content>
                <!-- <v-list-item-content v-else>
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
              </v-list-item-content> -->
              </v-list-item>
            </v-list-item-group>
          </v-list>
        </v-card>
      </v-col>
      <!-- <v-col cols="12">
        <v-container>
          <v-carousel>
            <v-carousel-item
              reverse-transition="fade-transition"
              transition="fade-transition"
            />
          </v-carousel>
        </v-container>
      </v-col> -->
    </v-row>
  </v-container>
</template>

<script>
  export default {
    props: {
      data: {
        type: Object,
        default: null,
      },
      autoPlay: {
        type: Object,
        default: null,
      },
      list: {
        type: Array,
        default: null,
      },
    },
    data: () => ({
      is_field: false,
    }),
    methods: {
      chooseVidio (item) {
        this.$emit("choose", { item: item })
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
    },
  }
</script>

<style lang="sass">
.overflow--x
  overflow-x: auto
.v-list
    background-color: white !important
.margin--instructor__time
    margin-left: 9%
    margin-top: -1%
.card--list
    .v-image
        .v-image__image
            transition: .1s ease-in
            cursor: pointer
    &:hover
        .v-image__image
            transform: scale(1,1)
            background-color: red
</style>
