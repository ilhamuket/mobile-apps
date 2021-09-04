<template>
  <v-container class="rounded-xl">
    <v-dialog
      v-model="dialog.open"
      width="90%"
    >
      <v-card>
        <v-card-title class="text-h2 pallet1--text font-title-rampart-one">
          Edit Sub-Class

          <v-spacer />

          <v-icon
            aria-label="Close"
            @click="dialog.open = false"
          >
            mdi-close
          </v-icon>
        </v-card-title>
        <v-container>
          <v-row>
            <v-col cols="12">
              <v-text-field
                v-model="dialog.title"
                label="Title"
                prepend-icon="mdi-format-title"
              />
              <v-select
                v-model="dialog.status"
                label="Status"
                :items="itemStatus"
                prepend-icon="mdi-list-status"
              />
              <v-textarea
                v-model="dialog.about"
                label="About"
                prepend-icon="mdi-information-outline"
              />
              <v-menu
                ref="menu1"
                v-model="menuTimeStart"
                :close-on-content-click="false"
                :nudge-right="40"
                :return-value.sync="dialog.time_start"
                transition="scale-transition"
                offset-y
                max-width="290px"
                min-width="290px"
              >
                <template v-slot:activator="{ on, attrs }">
                  <v-text-field
                    v-model="dialog.time_start"
                    label="Jam Mulai"
                    prepend-icon="mdi-clock-time-four-outline"
                    readonly
                    v-bind="attrs"
                    v-on="on"
                  />
                </template>
                <v-time-picker
                  v-if="menuTimeStart"
                  v-model="dialog.time_start"
                  format="24hr"
                  full-width
                  @click:minute="$refs.menu1.save(dialog.time_start)"
                />
              </v-menu>
              <v-menu
                ref="menu2"
                v-model="menuTimeEnd"
                :close-on-content-click="false"
                :nudge-right="40"
                :return-value.sync="dialog.time_end"
                transition="scale-transition"
                offset-y
                max-width="290px"
                min-width="290px"
              >
                <template v-slot:activator="{ on, attrs }">
                  <v-text-field
                    v-model="dialog.time_end"
                    label="Jam Mulai"
                    prepend-icon="mdi-clock-time-four-outline"
                    readonly
                    v-bind="attrs"
                    v-on="on"
                  />
                </template>
                <v-time-picker
                  v-if="menuTimeEnd"
                  v-model="dialog.time_end"
                  format="24hr"
                  full-width
                  @click:minute="$refs.menu2.save(dialog.time_end)"
                />
              </v-menu>
            </v-col>
            <v-col cols="4">
              <v-color-picker
                v-model="dialog.color.hex"
                :swatches="swatches"
                class="ma-2"
                show-swatches
              />
            </v-col>
            <v-col cols="8">
              <base-material-card
                :color="dialog.color.hex"
                :icon="dialog.icon"
                class="pa-6"
              >
                <template #after-heading>
                  <v-chip
                    color="transparent"
                    :text-color="dialog.color.hex"
                    class="font-title-rampart-one-small text-h3"
                  >
                    <h1>
                      {{ dialog.title }}
                    </h1>
                  </v-chip>
                </template>

                <div class="d-flex flex-row">
                  <div class="d-flex flex-column font-size-ather-roboto-mono">
                    Started Class : {{ dialog.time_start }} s/d
                    {{ dialog.time_end }}
                  </div>
                </div>

                <v-chip
                  :color="setColorStatus(dialog.status)"
                  class=" mb-3"
                  small
                  label
                >
                  {{ dialog.status }}
                </v-chip>

                <div
                  class="font-size-ather-roboto-mono"
                  v-text="dialog.about"
                />

                <div class="d-flex flex-row justify-center mt-6">
                  <div class="d-flex flex-row">
                    <div class="d-flex flex-column">
                      <v-btn
                        :color="dialog.color.hex"
                        class="ml-9"
                        outlined
                        small
                        width="200"
                      >
                        Register
                      </v-btn>
                    </div>
                  </div>
                </div>
              </base-material-card>
            </v-col>
          </v-row>
          <div class="d-flex flex-row-reverse">
            <div class="d-flex flex-column">
              <v-btn
                text
                color="red"
                @click="dialog.open = false"
              >
                Cancel
              </v-btn>
            </div>
            <div class="d-flex flex-column mr-2">
              <v-btn
                outlined
                color="primary"
                @click="editDataSubClass"
              >
                Update
              </v-btn>
            </div>
          </div>
        </v-container>
      </v-card>
    </v-dialog>
  </v-container>
</template>

<script>
  export default {
    props: {
      dialog: {
        type: Object,
        default: null,
      },
    },
    data () {
      return {
        itemStatus: ['Publish', 'Concept', 'Review'],
        time_start: null,
        time_end: null,
        menuTimeStart: false,
        menuTimeEnd: false,
        modal2: false,
        swatches: [
          ['#2BFF18', '#AA0000', '#550000'],
          ['#FFFF00', '#AAAA00', '#555500'],
          ['#00FF00', '#00AA00', '#005500'],
          ['#00FFFF', '#00AAAA', '#005555'],
          ['#0000FF', '#0000AA', '#000055'],
        ],
      }
    },
    methods: {
      setColorStatus (status) {
        if (status === 'Publish') return 'primary'
        if (status === 'Concept') return 'secondary'
        if (status === 'Review') return 'red'
      },
      editDataSubClass () {
        this.$emit('input', { item: this.dialog })
      },
    },
  }
</script>

<style></style>
