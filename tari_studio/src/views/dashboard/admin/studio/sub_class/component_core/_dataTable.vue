<template>
  <base-material-card icon="mdi-alpha-s-box">
    <template #after-heading>
      <span
        :class="
          $vuetify.theme.dark
            ? 'text-h3 white--text font-customize font-size-ather-roboto-mono-name-page'
            : 'text-h3 pallet1--text font-customize font-size-ather-roboto-mono-name-page'
        "
      >
        Index Sub-Class
      </span>
    </template>
    <v-container>
      <v-row>
        <v-col cols="4">
          <v-text-field
            v-model="search"
            append-icon="mdi-magnify"
          />
        </v-col>
        <v-col
          cols="12"
          md="8"
          class="d-flex flex-row-reverse"
        >
          <div class="text-center ml-2">
            <v-menu offset-y>
              <template v-slot:activator="{ on, attrs }">
                <v-btn
                  color="primary"
                  dark
                  v-bind="attrs"
                  outlined
                  v-on="on"
                >
                  <v-icon>mdi-chevron-down</v-icon>
                </v-btn>
              </template>
              <v-list>
                <v-list-item-group>
                  <v-list-item
                    v-for="(item, index) in data"
                    :key="index"
                  >
                    <v-list-item-title>{{ item.title }}</v-list-item-title>
                  </v-list-item>
                </v-list-item-group>
              </v-list>
            </v-menu>
          </div>
          <v-btn
            outlined
            color="primary"
            class="ml-2"
            to="create/sub-class"
          >
            <v-icon>
              mdi-plus
            </v-icon>
            Add Studio
          </v-btn>

          <v-btn
            :disabled="selected.length === 0"
            class="ml-2"
            outlined
            color="blue"
          >
            <v-icon>
              mdi-check-decagram
            </v-icon>
            Approve {{ selected.length }} item
          </v-btn>
          <v-btn
            :disabled="selected.length === 0"
            outlined
            color="red"
          >
            <v-icon>
              mdi-delete-empty-outline
            </v-icon>
            Delete {{ selected.length }} item
          </v-btn>
        </v-col>
        <v-col cols="12">
          <v-data-table
            v-model="selected"
            :headers="headers"
            :items="items"
            show-select
            :search="search"
          >
            <template #[`item.title`]="{item}">
              <div class="mt-6">
                {{ item.title }}
              </div>
              <div class="bg-hover">
                <div class="d-flex flex-row flex-nowrap">
                  <div>
                    <div class="d-flex flex-column flex-nowrap mt-2">
                      <a class="font-a d-flex flex-nowrap">
                        <v-icon
                          small
                          color="blue"
                          class="mr-1"
                        >
                          mdi-pencil
                        </v-icon>
                        Edit
                      </a>
                    </div>
                  </div>
                  <div>
                    <div class="d-flex flex-column mt-2">
                      <a class="font-a-delete d-flex flex-nowrap">
                        <v-icon
                          color="red"
                          small
                        >
                          mdi-delete
                        </v-icon>
                        Delete
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </template>
            <template #[`item.status`]="{item}">
              <v-chip
                :color="setColorStatus(item.status)"
                label
                class="text-capitalize chips--weight"
              >
                {{ item.status }}
              </v-chip>
            </template>
            <template #[`item.start_at`]="{item}">
              {{ item.time_start }}
            </template>
            <template #[`item.end_at`]="{item}">
              {{ item.time_end }}
            </template>
            <template #[`item.created_at`]="{item}">
              {{ item.created_at | moment('MMMM Do YYYY') }}
            </template>
            <template #[`item.is_verified`]="{item}">
              {{ item.isVerified === 1 ? 'Approved' : 'Non-Approved' }}
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
      items: {
        type: Array,
        default: null,
      },
    },
    data: () => ({
      selected: [],
      search: '',
      headers: [
        {
          text: 'Name',
          align: 'start',
          sortable: false,
          value: 'title',
        },
        { text: 'Status', value: 'status' },
        { text: 'Levels', value: 'classes.levels' },
        { text: 'Class Name', value: 'classes.name' },

        { text: 'Started', value: 'start_at' },
        { text: 'Ended', value: 'end_at' },
        { text: 'Approved', value: 'is_verified' },
      ],
      data: [
        { title: 'Click Me' },
        { title: 'Click Me' },
        { title: 'Click Me' },
        { title: 'Click Me 2' },
      ],
    }),
    methods: {
      setColorStatus (status) {
        if (status === 'publish') return 'primary'
        if (status === 'concept') return 'secondary'
        if (status === 'review') return 'red'
      },
      popUpDialog () {
        this.$emit('popUpForm')
      },
    },
  }
</script>

<style></style>
