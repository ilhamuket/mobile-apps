<template>
  <v-container fluid>
    <v-dialog
      v-model="dialog.open"
      width="90%"
    >
      <v-card class="rounded-xl">
        <v-system-bar
          :color="$vuetify.theme.dark ? '#141C31' : '#F0F8FF'"
          window
          class="mb-2"
        >
          <v-toolbar-title
            :class="$vuetify.theme.dark ? 'white--text' : ' black--text'"
            class="font-size-ather-roboto-mono"
          >
            <v-icon :color="$vuetify.theme.dark ? 'white' : 'black'">
              mdi-pencil
            </v-icon>
            Edit Class
          </v-toolbar-title>

          <v-spacer />

          <v-icon @click="dialog.open = false">
            mdi-close
          </v-icon>
        </v-system-bar>
        <v-container>
          <v-row>
            <v-col cols="12">
              <v-text-field
                v-model="dialog.name"
                label="Name Class"
                dense
                prepend-icon="mdi-alpha-n-circle-outline"
                clearable
              />
            </v-col>
            <v-col cols="12">
              <v-select
                v-model="dialog.levels"
                label="Levels Class"
                dense
                :items="items"
                prepend-icon="mdi-alpha-a-circle-outline"
                clearable
              />
            </v-col>
            <v-col cols="12">
              <v-autocomplete
                v-model="dialog.instructor_id"
                :items="computedInstructor"
                label="Class Name"
                clearable
                prepend-icon="mdi-format-title"
                multiple
                item-text="name"
                item-value="id"
              >
                <template
                  slot="selection"
                  slot-scope="data"
                >
                  <slot
                    name="item"
                    v-bind="data"
                  >
                    <v-list-item-avatar
                      color="primary"
                      size="22"
                    >
                      <span class="ml-2">{{ data.item.name.charAt(0) }}</span>
                    </v-list-item-avatar>

                    <v-chip
                      label
                      color="transparent"
                      close
                      @click:close="remove(data.item)"
                    >
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
                    <v-list-item-avatar
                      color="primary"
                      size="22"
                    >
                      <span class="ml-2">{{ data.item.name.charAt(0) }}</span>
                    </v-list-item-avatar>

                    <span class="black--text">{{ data.item.name }}</span>
                  </slot>
                </template>
              </v-autocomplete>
            </v-col>
            <v-col cols="12">
              <v-select
                v-model="dialog.category_id"
                label="Categories Class"
                dense
                :items="categories"
                prepend-icon="mdi-alpha-c-circle-outline"
                item-text="name"
                item-value="id"
              />
            </v-col>
            <v-col cols="12">
              <v-text-field
                v-model="dialog.url"
                dense
                label="Url"
                placeholder="Input Url Class"
                prepend-icon="mdi-google-analytics"
              />
            </v-col>

            <v-col cols="12">
              <v-text-field
                v-model="dialog.keyword"
                dense
                label="KeyWord / Prefix"
                placeholder="Input KeyWord Class"
                prepend-icon="mdi-alpha-p-circle-outline"
              />
            </v-col>
            <v-col cols="12">
              <v-text-field
                v-model="dialog.price"
                dense
                label="Price"
                placeholder="Input Price Class"
                prepend-icon="mdi-progress-check"
              />
            </v-col>
            <v-col cols="12">
              <v-text-field
                v-model="dialog.capacity"
                dense
                label="Capacity"
                type="number"
                placeholder="Input Capacity Class"
                prepend-icon="mdi-human-capacity-increase"
              />
            </v-col>
            <v-col
              cols="12"
              md="6"
            >
              <v-menu
                ref="menuStart_at"
                v-model="menuStart_at"
                :close-on-content-click="false"
                :return-value.sync="dialog.start_at"
                transition="scale-transition"
                offset-y
                min-width="auto"
              >
                <template v-slot:activator="{ on, attrs }">
                  <v-text-field
                    v-model="dialog.start_at"
                    label="Started At *"
                    prepend-icon="mdi-calendar"
                    readonly
                    v-bind="attrs"
                    v-on="on"
                  />
                </template>
                <v-date-picker
                  v-model="dialog.start_at"
                  no-title
                  scrollable
                >
                  <v-spacer />
                  <v-btn
                    text
                    color="primary"
                    @click="menuStart_at = false"
                  >
                    Cancel
                  </v-btn>
                  <v-btn
                    text
                    color="primary"
                    @click="$refs.menuStart_at.save(dialog.start_at)"
                  >
                    OK
                  </v-btn>
                </v-date-picker>
              </v-menu>
            </v-col>
            <v-col
              cols="12"
              md="6"
            >
              <v-menu
                ref="menuEnd_at"
                v-model="menuEnd_at"
                :close-on-content-click="false"
                :return-value.sync="dialog.end_at"
                transition="scale-transition"
                offset-y
                min-width="auto"
              >
                <template v-slot:activator="{ on, attrs }">
                  <v-text-field
                    v-model="dialog.end_at"
                    label="Ended At*"
                    prepend-icon="mdi-calendar"
                    readonly
                    v-bind="attrs"
                    v-on="on"
                  />
                </template>
                <v-date-picker
                  v-model="dialog.end_at"
                  no-title
                  scrollable
                >
                  <v-spacer />
                  <v-btn
                    text
                    color="primary"
                    @click="menuEnd_at = false"
                  >
                    Cancel
                  </v-btn>
                  <v-btn
                    text
                    color="primary"
                    @click="$refs.menuEnd_at.save(dialog.end_at)"
                  >
                    OK
                  </v-btn>
                </v-date-picker>
              </v-menu>
            </v-col>
            <v-col
              cols="12"
              md="6"
            >
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
                    label="Time Started"
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
            </v-col>
            <v-col
              cols="12"
              md="6"
            >
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
                    label="Time Started"
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
            <v-col cols="12">
              <v-text-field
                v-model="dialog.duration"
                dense
                label="Duration (Minutes)"
                type="number"
                placeholder="Input Duration Class (Minutes)"
                prepend-icon="mdi-metronome"
              />
            </v-col>
            <v-col cols="12">
              <v-textarea
                v-model="dialog.about"
                label="About Class"
                dense
                prepend-icon="mdi-alpha-a-circle-outline"
              />
            </v-col>
            <v-col
              cols="12"
              class="d-flex flex-row-reverse"
            >
              <v-btn
                color="primary"
                @click="updateClass"
              >
                Update
              </v-btn>
              <v-btn
                text
                color="red"
                @click="closeDialog"
              >
                Cancel
              </v-btn>
            </v-col>
          </v-row>
          <!-- <div class="d-flex flex-row-reverse">
            <div class="d-flex flex-column">

            </div>
            <div class="d-flex flex-column">

            </div>
          </div> -->
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
      categories: {
        type: Array,
        default: null,
      },
    },
    data: () => ({
      items: ['Intermediate', 'Advance', 'Beginner'],
      menuStart_at: false,
      menuTimeStart: false,
      menuEnd_at: false,
      menuTimeEnd: false,
      form: {
        name: '',
        levels: '',
        about: '',
      },
    }),
    computed: {
      computedInstructor () {
        return this.$store.state.studioInstructor.data
      },
    },
    mounted () {
      this.getDataTeacherStudio()
    },
    methods: {
      closeDialog () {
        this.dialog.open = false
        const Toast = this.$swal.mixin({
          toast: true,
          position: 'bottom-end',
          showConfirmButton: false,
          timer: 3000,
          timerProgressBar: true,
          didOpen: toast => {
            toast.addEventListener('mouseenter', this.$swal.stopTimer)
            toast.addEventListener('mouseleave', this.$swal.resumeTimer)
          },
          popup: 'swal2-show',
          backdrop: 'swal2-backdrop-show',
          icon: 'swal2-icon-show',
        })
        Toast.fire({
          icon: 'success',
          title: 'Dialog Closed',
        })
      },
      updateClass () {
        this.$emit('input', { item: this.dialog })
      },
      getDataTeacherStudio () {
        this.$store.dispatch('studioInstructor/getDataTeacherStudio', {
          entities: 'studio',
        })
      },
      remove (item) {
        this.dialog.instructor_id.splice(
          this.dialog.instructor_id.indexOf(item),
          1,
        )
        this.dialog.instructor_id = [...this.dialog.instructor_id]
      },
    },
  }
</script>

<style></style>
