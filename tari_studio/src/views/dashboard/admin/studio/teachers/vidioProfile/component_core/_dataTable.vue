<template>
  <base-material-card
    icon="mdi-alpha-t-box"
    color="primary"
  >
    <template #after-heading>
      <span class="font-spartan text-h3 primary--text">
        Vidio-Profile Instructor
      </span>
    </template>
    <v-container>
      <v-row>
        <v-col cols="12">
          <v-btn
            class="mr-1"
            outlined
            rounded
            small
            dark
            color="primary"
            @click="refreshClick"
          >
            <v-tooltip
              color="primary"
              bottom
            >
              <template #activator="{ on, attrs }">
                <v-icon
                  v-bind="attrs"
                  color="size__icon_refresh"
                  v-on="on"
                >
                  mdi-cached
                </v-icon>
              </template>
              <span class="font-spartan-small">
                {{ $t("Segarkan") }}
              </span>
            </v-tooltip>
          </v-btn>
        </v-col>
      </v-row>
      <v-row>
        <v-col
          cols="12"
          md="4"
        >
          <v-text-field
            :placeholder="$t('search')"
            :label="$t('search')"
            append-icon="mdi-magnify"
          />
        </v-col>
        <v-col
          cols="12"
          md="8"
          class="d-flex flex-row-reverse mt-2"
        >
          <v-btn
            color="btn_primary"
            @click="addVidio"
          >
            Add Vidio
          </v-btn>
          <v-btn
            :disabled="selected.length === 0"
            outlined
            color="red"
            class="mr-2"
          >
            Delete {{ selected.length }} item
          </v-btn>
          <v-btn
            :disabled="computedDisableApprove"
            outlined
            color="blue"
            class="mr-2"
          >
            approved {{ selected.length }} item
          </v-btn>
        </v-col>
        <v-col cols="12">
          <v-data-table
            v-model="selected"
            :headers="headers"
            :items="data"
            show-expand
            show-select
            :items-per-page="5"
          >
            <template v-slot:expanded-item="{ headers, item }">
              <td :colspan="headers.length">
                <v-container>
                  <v-row>
                    <v-col>
                      <v-card>
                        <iframe
                          width="100%"
                          height="400"
                          :src="`${item.url}?rel=0&modestbranding=1&fs=1&loop=0&autopause=0`"
                          allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture;"
                          sandbox="allow-forms allow-scripts allow-pointer-lock allow-same-origin allow-top-navigation allow-presentation"
                          allowfullscreen
                        />

                        <v-container>
                          <v-row>
                            <v-col cols="12">
                              <span class="font-spartan">
                                {{ item.title }}
                              </span>
                            </v-col>
                            <v-col
                              v-if="item.instructor"
                              cols="12"
                            >
                              <span class="font-spartan-small">
                                <v-avatar size="50">
                                  <v-img
                                    v-if="item.instructor.img"
                                    :src="item.instructor.img.url"
                                  />
                                  <v-img
                                    v-else
                                    src="https://steezy.imgix.net/choreographers/abey-cabrera.png?auto=compress"
                                  />
                                </v-avatar>
                                <span
                                  v-if="item.instructor.studio"
                                  class="font-spartan-small ml-2"
                                >
                                  {{ item.instructor.name }} -
                                  {{ item.instructor.studio.name }} -
                                  <span class="font-spartan-small">
                                    {{ timeSince(item.created_at) }}
                                  </span>
                                </span>
                              </span>
                            </v-col>
                          </v-row>
                        </v-container>
                      </v-card>
                    </v-col>
                  </v-row>
                </v-container>
              </td>
            </template>
            <template #[`item.#`]="{ item }">
              <v-avatar
                tile
                size="70"
              >
                <v-img :src="item.url_thumbnail" />
              </v-avatar>
            </template>
            <template #[`item.title`]="{ item }">
              <span class="font-spartan-small">
                {{ item.title }}
              </span>
              <div class="bg-hover">
                <div class="d-flex flex-row flex-nowrap">
                  <div>
                    <div class="d-flex flex-column flex-nowrap mt-2">
                      <a
                        class="font-a d-flex flex-nowrap"
                        @click="popEditForm(item)"
                      >
                        <v-tooltip
                          bottom
                          color="primary"
                        >
                          <template #activator="{ on, attrs }">
                            <v-icon
                              v-bind="attrs"
                              small
                              color="blue"
                              class="mr-1"
                              v-on="on"
                            >
                              mdi-pencil
                            </v-icon>
                          </template>
                          <span class="font-spartan-small"> Edit </span>
                        </v-tooltip>
                      </a>
                    </div>
                  </div>
                  <div>
                    <div class="d-flex flex-column flex-nowrap mt-2">
                      <a
                        class="font-a d-flex flex-nowrap"
                        @click="uploadVidioPrifle(item)"
                      >
                        <v-tooltip
                          bottom
                          color="primary"
                        >
                          <template #activator="{ on, attrs }">
                            <v-icon
                              v-bind="attrs"
                              small
                              color="blue"
                              class="mr-1"
                              v-on="on"
                            >
                              mdi-youtube-subscription
                            </v-icon>
                          </template>
                          <span
                            class="font-spartan-small white--text"
                          >Upload Vidio Profile</span>
                        </v-tooltip>
                      </a>
                    </div>
                  </div>
                  <div>
                    <div class="d-flex flex-column mt-2">
                      <a
                        class="font-a-delete d-flex flex-nowrap"
                        @click="deleteByIdPopUp(item)"
                      >
                        <v-tooltip
                          bottom
                          color="primary"
                        >
                          <template #activator="{ on, attrs }">
                            <v-icon
                              color="red"
                              small
                              v-bind="attrs"
                              v-on="on"
                            >
                              mdi-delete
                            </v-icon>
                          </template>
                          <span class="font-spartan-small red--text">
                            Delete
                          </span>
                        </v-tooltip>
                      </a>
                    </div>
                  </div>
                  <div>
                    <div class="d-flex flex-column mt-2">
                      <a
                        class="font-a-delete d-flex flex-nowrap"
                        @click="deactive(item)"
                      >
                        <v-tooltip
                          bottom
                          color="primary"
                        >
                          <template #activator="{ on, attrs }">
                            <v-icon
                              color="red"
                              small
                              v-bind="attrs"
                              v-on="on"
                            >
                              mdi-eye-off
                            </v-icon>
                          </template>
                          <span class="font-spartan-small red--text">
                            Deactivate
                          </span>
                        </v-tooltip>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </template>
            <template #[`item.status`]="{ item }">
              <v-chip
                :color="setColor(item.status)"
                text-color="white"
                class="text-capitalize"
              >
                {{ item.status }}
              </v-chip>
            </template>
            <template #[`item.is_verified`]="{ item }">
              <v-chip
                :color="setColorStatus(item.is_verified)"
                class="font-spartan-small"
                text-color="white"
              >
                {{
                  item.is_verified === 1
                    ? $t("table.approved")
                    : $t("table.non_approved")
                }}
              </v-chip>
            </template>
          </v-data-table>
        </v-col>
      </v-row>
    </v-container>
  </base-material-card>
</template>

<script>
  export default {
    props: {
      data: {
        type: Array,
        default: null,
      },
    },
    data: () => ({
      selected: [],
      headers: [
        {
          text: "#",
          value: "#",
        },
        {
          text: "Title",
          align: "start",
          sortable: false,
          value: "title",
        },
        {
          text: "Status",
          value: "status",
        },
        {
          text: "Verified",
          value: "is_verified",
        },
      ],
    }),
    computed: {
      computedDisableApprove () {
        let bool = true
        const nonPublish = this.selected.some((x) => x.status === "publish")
        if (this.selected.length !== 0 && nonPublish) {
          bool = true
        } else if (this.selected.length !== 0 && !nonPublish) {
          bool = false
        }
        return bool
      },
    },
    mounted () {
      console.log(this.computedDisableApprove)
    },
    methods: {
      setColor (status) {
        if (status === "draft") return "secondary"
        if (status === "publish") return "btn_primary"
        else return "red"
      },
      setColorStatus (status) {
        if (status === 1) return "btn_primary"
        else return "red"
      },
      refreshClick () {
        this.$emit("refresh")
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
      addVidio () {
        this.$emit("add")
      },
    },
  }
</script>

<style></style>
