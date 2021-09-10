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
        {{ computudTitle }}
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
                  color="btn_primary"
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
                  <v-list-item>
                    <v-list-item-title>
                      Export
                    </v-list-item-title>
                  </v-list-item>
                </v-list-item-group>
              </v-list>
            </v-menu>
          </div>
          <v-btn
            outlined
            color="btn_primary"
            class="ml-2"
            to="create/sub-class"
          >
            <v-icon>
              mdi-plus
            </v-icon>
            Create Sub-Class
          </v-btn>

          <v-btn
            :disabled="selected.length === 0"
            class="ml-2"
            outlined
            color="blue"
            @click="approvePopUp(selected)"
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
            @click="deletesPopUp(selected)"
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
            mobile-breakpoint="0"
          >
            <!-- Header -->
            <template #[`header.title`]="{ header }">
              {{ $t(header.text) }}
            </template>
            <template #[`header.levels`]="{ header }">
              {{ $t(header.text) }}
            </template>
            <template #[`header.classes.levels`]="{ header }">
              {{ $t(header.text) }}
            </template>
            <template #[`header.start_at`]="{ header }">
              {{ $t(header.text) }}
            </template>
            <template #[`header.end_at`]="{ header }">
              {{ $t(header.text) }}
            </template>
            <template #[`header.classes.name`]="{ header }">
              {{ $t(header.text) }}
            </template>
            <template #[`header.status`]="{ header }">
              {{ $t(header.text) }}
            </template>
            <template #[`header.is_verified`]="{ header }">
              {{ $t(header.text) }}
            </template>

            <!-- Item -->
            <template #[`item.title`]="{item}">
              <div class="mt-6">
                {{ item.title }}
              </div>
              <div class="bg-hover">
                <div class="d-flex flex-row flex-nowrap">
                  <div>
                    <div class="d-flex flex-column flex-nowrap mt-2">
                      <a
                        class="font-a d-flex flex-nowrap"
                        @click="editPopUp(item)"
                      >
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
                      <a
                        class="font-a-delete d-flex flex-nowrap"
                        @click="deleteByIdPopUp(item)"
                      >
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
            <template #[`item.classes.name`]=" {item}">
              <v-chip
                label
                color="primary"
                text-color="black"
              >
                {{ item.classes.name }}
              </v-chip>
            </template>
            <template #[`item.created_at`]="{item}">
              {{ item.created_at | moment('MMMM Do YYYY') }}
            </template>
            <template #[`item.is_verified`]="{item}">
              <v-chip
                :color="setColorApproved(item.is_verified)"
                label
                class="chips--weight"
              >
                {{
                  item.is_verified === 1
                    ? $t('table.approved')
                    : $t('table.non_approved')
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
          text: 'table.sub-class.th.title',
          align: 'start',
          sortable: false,
          value: 'title',
        },
        { text: 'table.sub-class.th.status', value: 'status' },
        { text: 'table.sub-class.th.class', value: 'classes.name' },
        { text: 'table.sub-class.th.levels', value: 'classes.levels' },
        { text: 'table.sub-class.th.started', value: 'start_at' },
        { text: 'table.sub-class.th.Ended', value: 'end_at' },
        { text: 'table.sub-class.th.approved', value: 'is_verified' },
      ],
      data: [
        { title: 'Click Me' },
        { title: 'Click Me' },
        { title: 'Click Me' },
        { title: 'Click Me 2' },
      ],
    }),
    computed: {
      computudTitle () {
        let name = 'Index SubClass - All'
        if (this.$route.query.summary === 'all') {
          name = 'Index SubClass - All'
        }
        if (this.$route.query.summary === 'approved') {
          name = 'Index SubClass - Approved'
        }
        if (this.$route.query.summary === 'non_approved') {
          name = 'Index SubClass - Non Approved'
        }
        if (this.$route.query.summary === 'new') {
          name = 'Index SubClass - New'
        }
        return name
      },
    },
    methods: {
      setColorStatus (status) {
        if (status === 'Publish') return 'btn_primary'
        if (status === 'Concept') return 'secondary'
        if (status === 'Review') return 'red'
      },
      setColorApproved (status) {
        if (status === 1) return 'btn_primary'
        else return 'red'
      },
      // popUpDialog () {
      //   this.$emit('popUpForm')
      // },
      approvePopUp (item) {
        this.$emit('appPopUp', { item: item })
      },
      deletesPopUp (item) {
        this.$emit('delPopUp', { item: item })
      },
      editPopUp (item) {
        this.$emit('edit', { item: item })
      },
      deleteByIdPopUp (item) {
        this.$emit('delById', { item: item })
      },
    },
  }
</script>

<style></style>
