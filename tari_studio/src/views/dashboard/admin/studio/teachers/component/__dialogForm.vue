<template>
  <v-container>
    <v-dialog
      v-model="dialog.open"
      class="rounded-xl"
    >
      <v-card>
        <v-card-title class="text-h2 pallet1--text font-title-rampart-one">
          Add Instructor

          <v-spacer />

          <v-icon
            aria-label="Close"
            @click="dialog.open = false"
          >
            mdi-close
          </v-icon>
        </v-card-title>
        <v-card-text>
          <v-row>
            <v-col cols="12">
              <v-text-field
                v-model="form.name"
                label="Name"
                placeholder="Input FullName"
                clearable
              />
            </v-col>
            <v-col cols="12">
              <v-text-field
                v-model="form.email"
                label="E-mail"
                placeholder="Input E-mail"
                clearable
              />
            </v-col>
            <v-col cols="12">
              <v-autocomplete
                v-model="form.region"
                label="Region"
                placeholder="Input region"
                :items="itemsRegional"
                clearable
                item-text="name"
                item-value="name"
              />
            </v-col>
            <v-col cols="12">
              <v-text-field
                v-model="form.contact"
                label="Contact"
                placeholder="Input Contact"
                clearable
              />
            </v-col>
            <v-col cols="12">
              <v-text-field
                v-model="form.profession"
                label="Profession"
                placeholder="Input Profession"
                clearable
              />
            </v-col>
            <v-col cols="12">
              <v-textarea
                v-model="form.about"
                label="About"
                placeholder="Input About"
                clearable
              />
            </v-col>
          </v-row>
        </v-card-text>
        <v-card-actions class="d-flex flex-row-reverse mr-5">
          <div class="d-flex flex-column">
            <v-btn
              outlined
              color="primary"
              @click="addTeachers"
            >
              Create
            </v-btn>
          </div>
          <div class="d-flex flex-column">
            <v-btn
              color="red"
              text
              @click="dialog.open = false"
            >
              Cancel
            </v-btn>
          </div>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-container>
</template>

<script>
  import city from '../database/city.json'

  export default {
    props: {
      dialog: {
        type: Object,
        default: () => ({
          open: false,
        }),
      },
    },
    data: () => ({
      form: {
        open: false,
        name: '',
        email: '',
        region: '',
        contact: '',
        profession: '',
        about: '',
      },
      itemsRegional: city,
    }),

    methods: {
      addTeachers () {
        this.$emit('input', { item: this.form })
      },
    },
  }
</script>

<style></style>
