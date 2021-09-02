<template>
  <v-container class="rounded-xl">
    <v-dialog
      v-model="dialog.open"
      width="90%"
    >
      <v-card>
        <v-card-title class="text-h2 pallet1--text font-title-rampart-one">
          Add Sub-Class

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
            <v-col>
              <v-text-field
                label="Title"
                prepend-icon="mdi-format-title"
              />
              <v-select
                label="Status"
                prepend-icon="mdi-list-status"
              />
              <v-textarea
                label="About"
                prepend-icon="mdi-information-outline"
              />
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
              <v-menu
                ref="menu"
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
                  @click:minute="$refs.menu.save(time_end)"
                />
              </v-menu>
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
              >
                Send
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
        time_start: null,
        time_end: null,
        menuTimeStart: false,
        menuTimeEnd: false,
        modal2: false,
      }
    },
  }
</script>

<style></style>
