<template>
  <v-container v-if="data">
    <v-row>
      <v-col class="d-flex justify-center">
        <h3 class="text-center font-title-rampart-one">
          TimeLines
        </h3>
      </v-col>
    </v-row>
    <v-row>
      <v-col>
        <v-timeline
          align-top
          :dense="$vuetify.breakpoint.smAndDown"
        >
          <v-timeline-item
            v-for="(item, i) in data"
            :key="i"
            :color="item.color"
            :icon="item.icon"
            fill-dot
          >
            <base-material-card
              :color="item.color"
              :icon="item.icon"
            >
              <template #after-heading>
                <v-chip
                  color="transparent"
                  :text-color="item.color"
                  class="font-title-rampart-one-small text-h3"
                >
                  <h1>
                    {{ item.title }}
                  </h1>
                </v-chip>
              </template>
              <v-card-text>
                <div class="d-flex flex-row">
                  <div class="d-flex flex-column font-size-ather-roboto-mono">
                    Started Class : {{ item.time_start }} s/d
                    {{ item.time_end }}
                  </div>
                </div>
                <v-divider class="mb-1 mt-1" />
                <p class="font-size-ather-roboto-mono">
                  {{ item.about }}
                </p>
                <v-btn
                  :color="item.color"
                  class="ml-9"
                  outlined
                  small
                  width="200"
                >
                  Register
                </v-btn>
              </v-card-text>
            </base-material-card>
          </v-timeline-item>
        </v-timeline>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
  export default {
    props: {
      data: {
        type: Array,
        default: () => [
          {
            color: 'red',
            icon: 'mdi-eye',
          },
        ],
      },
    },
    data: () => ({
      items: [
        {
          color: 'red lighten-2',
          icon: 'mdi-star',
        },
        {
          color: 'purple darken-1',
          icon: 'mdi-book-variant',
        },
        {
          color: 'green lighten-1',
          icon: 'mdi-airballoon',
        },
        {
          color: 'indigo',
          icon: 'mdi-buffer',
        },
      ],
    }),
    computed: {},
  }
</script>

<style lang="sass" scoped>
.bg-timelines
    color: black !important
.bg-heading
    color: blue !important
</style>
