<template>
  <v-container fluid>
    <v-dialog
      v-model="dialog.open"
      width="90%"
    >
      <v-card class="rounded-xl">
        <v-card-title class="text-h2 primary--text font-spartan">
          Add Class

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
                v-model="form.name"
                label="Name Class"
                dense
                prepend-icon="mdi-alpha-n-circle-outline"
                clearable
              />
              <v-autocomplete
                v-model="form.instructor_id"
                :items="computedInstructor"
                label="Instructor"
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
                      color="brown"
                      size="20"
                    >
                      <span>{{ data.item.name.charAt(0) }}</span>
                    </v-list-item-avatar>

                    {{ data.item.name }}
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
                      color="brown"
                      size="20"
                    >
                      <span>{{ data.item.name.charAt(0) }}</span>
                    </v-list-item-avatar>

                    <span class="black--text">{{ data.item.name }}</span>
                  </slot>
                </template>
              </v-autocomplete>
              <v-select
                v-model="form.levels"
                label="Levels Class"
                dense
                :items="items"
                prepend-icon="mdi-alpha-a-circle-outline"
                clearable
              />
              <v-text-field
                v-model="form.url"
                dense
                label="Url"
                placeholder="Input Url Class"
                prepend-icon="mdi-google-analytics"
              />
              <v-text-field
                v-model="form.keyword"
                dense
                label="KeyWord / Prefix"
                placeholder="Input KeyWord Class"
                prepend-icon="mdi-alpha-p-circle-outline"
              />
              <v-text-field
                v-model="form.price"
                dense
                label="Price"
                placeholder="Input Price Class"
                prepend-icon="mdi-progress-check"
              />
              <v-text-field
                v-model="form.capacity"
                dense
                label="Capacity"
                type="number"
                placeholder="Input Capacity Class"
                prepend-icon="mdi-human-capacity-increase"
              />
              <v-menu
                ref="menu1"
                v-model="menuTimeStart"
                :close-on-content-click="false"
                :nudge-right="40"
                :return-value.sync="form.time_start"
                transition="scale-transition"
                offset-y
                max-width="290px"
                min-width="290px"
              >
                <template v-slot:activator="{ on, attrs }">
                  <v-text-field
                    v-model="form.time_start"
                    label="Time Started"
                    prepend-icon="mdi-clock-time-four-outline"
                    readonly
                    v-bind="attrs"
                    v-on="on"
                  />
                </template>
                <v-time-picker
                  v-if="menuTimeStart"
                  v-model="form.time_start"
                  format="24hr"
                  full-width
                  @click:minute="$refs.menu1.save(form.time_start)"
                />
              </v-menu>
              <v-menu
                ref="menu2"
                v-model="menuTimeEnd"
                :close-on-content-click="false"
                :nudge-right="40"
                :return-value.sync="form.time_end"
                transition="scale-transition"
                offset-y
                max-width="290px"
                min-width="290px"
              >
                <template v-slot:activator="{ on, attrs }">
                  <v-text-field
                    v-model="form.time_end"
                    label="Time Ended"
                    prepend-icon="mdi-clock-time-four-outline"
                    readonly
                    v-bind="attrs"
                    v-on="on"
                  />
                </template>
                <v-time-picker
                  v-if="menuTimeEnd"
                  v-model="form.time_end"
                  format="24hr"
                  full-width
                  @click:minute="$refs.menu2.save(form.time_end)"
                />
              </v-menu>
              <v-text-field
                v-model="form.duration"
                dense
                label="Duration (Minutes)"
                type="number"
                placeholder="Input Duration Class (Minutes)"
                prepend-icon="mdi-metronome"
              />
              <v-textarea
                v-model="form.about"
                label="About Class"
                dense
                prepend-icon="mdi-alpha-a-circle-outline"
              />
            </v-col>
          </v-row>
          <div class="d-flex flex-row-reverse">
            <div class="d-flex flex-column">
              <v-btn
                text
                color="red"
                @click="closeDialog"
              >
                Cancel
              </v-btn>
            </div>
            <div class="d-flex flex-column">
              <v-btn
                color="primary"
                @click="createClass"
              >
                Create
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
    data: () => ({
      items: ['Intermediate', 'Advance', 'Beginner'],
      form: {
        name: '',
        levels: '',
        about: '',
        url: '',
        keyword: '',
        durasi: '',
        harga: '',
        capacity: '',
        time_start: null,
        time_end: null,
        instructor_id: 0,
      },
      menuTimeStart: false,
      menuTimeEnd: false,
      modal2: false,
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
      createClass () {
        this.$emit('input', { item: this.form })
      },
      getDataTeacherStudio () {
        this.$store.dispatch('studioInstructor/getDataTeacherStudio', {
          entities: 'studio',
        })
      },
    },
  }
</script>

<style></style>
