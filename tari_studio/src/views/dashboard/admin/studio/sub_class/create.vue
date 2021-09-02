<template>
  <v-app>
    <v-container>
      <v-row>
        <v-col>
          <v-card>
            <v-card-title class="d-flex justify-center">
              <span
                class="text-h2 pallet1--text text-center font-title-rampart-one"
              >
                Add Sub-Class
              </span>
            </v-card-title>
            <v-container>
              <v-row>
                <v-col cols="12">
                  <v-text-field
                    v-model="title"
                    label="Title"
                    prepend-icon="mdi-format-title"
                  />
                </v-col>
                <v-col cols="12">
                  <v-select
                    v-model="status"
                    :items="itemStatus"
                    label="Status"
                    prepend-icon="mdi-format-title"
                  />
                </v-col>
                <v-col cols="12">
                  <v-textarea
                    v-model="about"
                    label="About"
                    prepend-icon="mdi-format-title"
                  />
                </v-col>
                <v-col cols="6">
                  <v-menu
                    ref="menu"
                    v-model="menuTimeStart"
                    :close-on-content-click="false"
                    :nudge-right="40"
                    :return-value.sync="time_start"
                    transition="scale-transition"
                    offset-y
                    max-width="290px"
                    min-width="290px"
                  >
                    <template v-slot:activator="{ on, attrs }">
                      <v-text-field
                        v-model="time_start"
                        label="Jam Mulai"
                        prepend-icon="mdi-clock-time-four-outline"
                        readonly
                        v-bind="attrs"
                        v-on="on"
                      />
                    </template>
                    <v-time-picker
                      v-if="menuTimeStart"
                      v-model="time_start"
                      full-width
                      @click:minute="$refs.menu.save(time_start)"
                    />
                  </v-menu>
                </v-col>
                <v-col cols="6">
                  <v-menu
                    ref="menu1"
                    v-model="menuTimeEnd"
                    :close-on-content-click="false"
                    :nudge-right="40"
                    :return-value.sync="time_end"
                    transition="scale-transition"
                    offset-y
                    max-width="290px"
                    min-width="290px"
                  >
                    <template v-slot:activator="{ on, attrs }">
                      <v-text-field
                        v-model="time_end"
                        label="Jam Mulai"
                        prepend-icon="mdi-clock-time-four-outline"
                        readonly
                        v-bind="attrs"
                        v-on="on"
                      />
                    </template>
                    <v-time-picker
                      v-if="menuTimeEnd"
                      v-model="time_end"
                      full-width
                      @click:minute="$refs.menu1.save(time_end)"
                    />
                  </v-menu>
                </v-col>

                <v-col cols="12">
                  <v-autocomplete
                    v-model="icon"
                    prepend-icon="mdi-star-face"
                    :items="icons"
                  >
                    <template
                      slot="selection"
                      slot-scope="data"
                    >
                      <slot
                        name="item"
                        v-bind="data"
                      >
                        <v-icon>
                          {{ data.item }}
                        </v-icon>

                        {{ data.item }}
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
                        <v-col>
                          <v-icon>
                            {{ data.item }}
                          </v-icon>
                          {{ data.item }}
                        </v-col>
                      </slot>
                    </template>
                  </v-autocomplete>
                </v-col>
                <v-col cols="4">
                  <v-color-picker
                    v-model="color"
                    :swatches="swatches"
                    class="ma-2"
                    show-swatches
                  />
                </v-col>
                <v-col
                  v-if="color"
                  cols="6"
                >
                  <span
                    class="font-title-rampart-one-small text-h2 text-center pallet1--text d-flex justify-center"
                  >
                    Reviews
                  </span>

                  <base-material-card
                    :color="color.hex"
                    :icon="icon"
                    class="pa-6"
                  >
                    <template #after-heading>
                      <v-chip
                        color="transparent"
                        :text-color="color.hex"
                        class="font-title-rampart-one-small text-h3"
                      >
                        <h1>
                          {{ title }}
                        </h1>
                      </v-chip>
                    </template>

                    <div class="d-flex flex-row">
                      <div
                        class="d-flex flex-column font-size-ather-roboto-mono"
                      >
                        Started Class : {{ time_start }} s/d
                        {{ time_end }}
                      </div>
                    </div>

                    <v-chip
                      :color="setColorStatus(status)"
                      class=" mb-3"
                      small
                      label
                    >
                      {{ status }}
                    </v-chip>

                    <div
                      class="font-size-ather-roboto-mono"
                      v-text="about"
                    />

                    <!-- <template v-if="timeline.action">
                              <v-divider class="mb-3" />

                              <v-menu
                                v-model="menu"
                                bottom
                                offset-y
                                origin="top left"
                                right
                                transition="scale-transition"
                              >
                                <template v-slot:activator="{ attrs, on }">
                                  <v-btn
                                    v-bind="attrs"
                                    :color="timeline.action"
                                    large
                                    rounded
                                    v-on="on"
                                  >
                                    <v-icon
                                      left
                                      v-text="timeline.actionIcon"
                                    />
                                    <v-icon right>
                                      {{
                                        menu ? 'mdi-menu-up' : 'mdi-menu-down'
                                      }}
                                    </v-icon>
                                  </v-btn>
                                </template>

                                <v-sheet>
                                  <v-list>
                                    <v-list-item
                                      v-for="a in timeline.actions"
                                      :key="a"
                                      link
                                    >
                                      <v-list-item-title v-text="a" />
                                    </v-list-item>
                                  </v-list>
                                </v-sheet>
                              </v-menu>
                            </template> -->
                  </base-material-card>
                </v-col>
              </v-row>
            </v-container>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
  </v-app>
</template>

<script>
  export default {
    data: () => ({
      title: 'Dummy Title',
      about:
        ' Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ex impedit molestias, suscipit quibusdam exercitationem, rem quasi minus totam quae placeat doloremque. Quisquam non, officiis nam laborum ratione at ad rem.',
      status: 'Concept',
      itemStatus: ['Publish', 'Concept', 'Review'],
      time_start: '12:00',
      time_end: '14:00',
      menuTimeStart: false,
      menuTimeEnd: false,
      modal2: false,
      icon: 'mdi-account-box-multiple',
      menuColor: false,
      color: {
        hex: '#283046',
      },
      swatches: [
        ['#2BFF18', '#AA0000', '#550000'],
        ['#FFFF00', '#AAAA00', '#555500'],
        ['#00FF00', '#00AA00', '#005500'],
        ['#00FFFF', '#00AAAA', '#005555'],
        ['#0000FF', '#0000AA', '#000055'],
      ],
      icons: [
        'mdi-access-point',
        'mdi-access-point-network',
        'mdi-account',
        'mdi-account-alert',
        'mdi-account-box',
        'mdi-account-box-multiple',
        'mdi-account-box-outline',
        'mdi-account-card-details',
        'mdi-account-check',
        'mdi-account-circle',
        'mdi-account-convert',
        'mdi-account-edit',
        'mdi-account-group',
        'mdi-account-heart',
        'mdi-account-key',
        'mdi-account-location',
        'mdi-account-minus',
        'mdi-account-multiple',
        'mdi-account-multiple-check',
        'mdi-account-multiple-minus',
        'mdi-account-multiple-outline',
        'mdi-account-multiple-plus',
        'mdi-account-multiple-plus-outline',
        'mdi-account-network',
        'mdi-account-off',
        'mdi-account-outline',
        'mdi-account-plus',
        'mdi-account-plus-outline',
        'mdi-account-remove',
        'mdi-account-search',
        'mdi-account-search-outline',
        'mdi-account-settings',
        'mdi-account-settings-variant',
        'mdi-account-star',
        'mdi-account-switch',
        'mdi-accusoft',
        'mdi-adjust',
        'mdi-adobe',
        'mdi-air-conditioner',
        'mdi-airballoon',
        'mdi-airplane',
        'mdi-airplane-landing',
        'mdi-airplane-off',
        'mdi-airplane-takeoff',
        'mdi-airplay',
        'mdi-airport',
        'mdi-alarm',
        'mdi-alarm-bell',
        'mdi-alarm-check',
        'mdi-alarm-light',
        'mdi-alarm-multiple',
        'mdi-alarm-off',
        'mdi-alarm-plus',
        'mdi-alarm-snooze',
        'mdi-album',
        'mdi-alert',
        'mdi-alert-box',
        'mdi-alert-circle',
        'mdi-alert-circle-outline',
        'mdi-alert-decagram',
        'mdi-alert-octagon',
        'mdi-alert-octagram',
        'mdi-alert-outline',
        'mdi-alien',
        'mdi-all-inclusive',
        'mdi-alpha',
        'mdi-alphabetical',
        'mdi-altimeter',
        'mdi-amazon',
        'mdi-amazon-alexa',
        'mdi-amazon-drive',
        'mdi-ambulance',
        'mdi-amplifier',
        'mdi-anchor',
        'mdi-android',
        'mdi-android-debug-bridge',
        'mdi-android-head',
        'mdi-android-studio',
        'mdi-angle-acute',
        'mdi-angle-obtuse',
        'mdi-angle-right',
        'mdi-angular',
        'mdi-angularjs',
        'mdi-animation',
        'mdi-animation-play',
        'mdi-anvil',
        'mdi-apple',
        'mdi-apple-finder',
        'mdi-apple-icloud',
        'mdi-apple-ios',
        'mdi-apple-keyboard-caps',
        'mdi-apple-keyboard-command',
        'mdi-apple-keyboard-control',
        'mdi-apple-keyboard-option',
        'mdi-apple-keyboard-shift',
        'mdi-apple-safari',
        'mdi-application',
        'mdi-approval',
        'mdi-apps',
        'mdi-arch',
        'mdi-archive',
        'mdi-arrange-bring-forward',
        'mdi-arrange-bring-to-front',
        'mdi-arrange-send-backward',
        'mdi-arrange-send-to-back',
        'mdi-arrow-all',
        'mdi-arrow-bottom-left',
        'mdi-arrow-bottom-left-bold-outline',
        'mdi-arrow-bottom-left-thick',
        'mdi-arrow-bottom-right',
        'mdi-arrow-bottom-right-bold-outline',
        'mdi-arrow-bottom-right-thick',
        'mdi-arrow-collapse',
        'mdi-arrow-collapse-all',
        'mdi-arrow-collapse-down',
        'mdi-arrow-collapse-horizontal',
        'mdi-arrow-collapse-left',
        'mdi-arrow-collapse-right',
        'mdi-arrow-collapse-up',
        'mdi-arrow-collapse-vertical',
        'mdi-arrow-decision',
        'mdi-arrow-decision-auto',
        'mdi-arrow-decision-auto-outline',
        'mdi-arrow-decision-outline',
        'mdi-arrow-down',
        'mdi-arrow-down-bold',
        'mdi-arrow-down-bold-box',
        'mdi-arrow-down-bold-box-outline',
        'mdi-arrow-down-bold-circle',
        'mdi-arrow-down-bold-circle-outline',
        'mdi-arrow-down-bold-hexagon-outline',
        'mdi-arrow-down-bold-outline',
        'mdi-arrow-down-box',
        'mdi-arrow-down-drop-circle',
        'mdi-arrow-down-drop-circle-outline',
        'mdi-arrow-down-thick',
        'mdi-arrow-expand',
        'mdi-arrow-expand-all',
        'mdi-arrow-expand-down',
        'mdi-arrow-expand-horizontal',
        'mdi-arrow-expand-left',
        'mdi-arrow-expand-right',
        'mdi-arrow-expand-up',
        'mdi-arrow-expand-vertical',
        'mdi-arrow-left',
        'mdi-arrow-left-bold',
        'mdi-arrow-left-bold-box',
        'mdi-arrow-left-bold-box-outline',
        'mdi-arrow-left-bold-circle',
        'mdi-arrow-left-bold-circle-outline',
        'mdi-arrow-left-bold-hexagon-outline',
        'mdi-arrow-left-bold-outline',
        'mdi-arrow-left-box',
        'mdi-arrow-left-drop-circle',
        'mdi-arrow-left-drop-circle-outline',
        'mdi-arrow-left-right-bold-outline',
        'mdi-arrow-left-thick',
        'mdi-arrow-right',
        'mdi-arrow-right-bold',
        'mdi-arrow-right-bold-box',
        'mdi-arrow-right-bold-box-outline',
        'mdi-arrow-right-bold-circle',
        'mdi-arrow-right-bold-circle-outline',
        'mdi-arrow-right-bold-hexagon-outline',
        'mdi-arrow-right-bold-outline',
        'mdi-arrow-right-box',
        'mdi-arrow-right-drop-circle',
        'mdi-arrow-right-drop-circle-outline',
        'mdi-arrow-right-thick',
        'mdi-arrow-split-horizontal',
        'mdi-arrow-split-vertical',
        'mdi-arrow-top-left',
        'mdi-arrow-top-left-bold-outline',
        'mdi-arrow-top-left-thick',
        'mdi-arrow-top-right',
        'mdi-arrow-top-right-bold-outline',
        'mdi-arrow-top-right-thick',
        'mdi-arrow-up',
        'mdi-arrow-up-bold',
        'mdi-arrow-up-bold-box',
        'mdi-arrow-up-bold-box-outline',
        'mdi-arrow-up-bold-circle',
        'mdi-arrow-up-bold-circle-outline',
        'mdi-arrow-up-bold-hexagon-outline',
        'mdi-arrow-up-bold-outline',
        'mdi-arrow-up-box',
        'mdi-arrow-up-down-bold-outline',
        'mdi-arrow-up-drop-circle',
        'mdi-arrow-up-drop-circle-outline',
        'mdi-arrow-up-thick',
        'mdi-artist',
        'mdi-assistant',
        'mdi-asterisk',
        'mdi-at',
        'mdi-atlassian',
        'mdi-atom',
        'mdi-attachment',
        'mdi-audio-video',
        'mdi-audiobook',
        'mdi-augmented-reality',
        'mdi-auto-fix',
        'mdi-auto-upload',
        'mdi-autorenew',
        'mdi-av-timer',
        'mdi-axe',
        'mdi-azure',
        'mdi-baby',
        'mdi-baby-buggy',
        'mdi-backburger',
        'mdi-backspace',
        'mdi-backup-restore',
        'mdi-badminton',
      ],
      timelines: [
        {
          chip: 'Some title',
          color: 'error',
          icon: 'mdi-briefcase',
          text:
            "Wifey made the best Father's Day meal ever. So thankful so happy so blessed. Thank you for making my family We just had fun with the “future” theme !!! It was a fun night all together ... The always rude Kanye Show at 2am Sold Out Famous viewing @ Figueroa and 12th in downtown.",
          subtext: '11 hours ago via twitter',
        },
      ],
    }),
    computed: {
      computedColor () {
        return this.color.hex
      },
    },
    methods: {
      setColorStatus (status) {
        if (status === 'Publish') return 'primary'
        if (status === 'Concept') return 'secondary'
        if (status === 'Review') return 'red'
      },
    },
  }
</script>

<style></style>
