<template>
  <v-container fluid>
    <v-dialog
      v-model="dialog.open"
      width="90%"
    >
      <v-card class="rounded-xl">
        <v-card-title class="text-h2 pallet1--text font-title-rampart-one">
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
        instructor_id: 0,
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
