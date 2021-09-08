<template>
  <base-material-card
    icon="mdi-alpha-t-box"
    color="pallet1"
  >
    <template #after-heading>
      <span
        :class="
          $vuetify.theme.dark
            ? 'text-h3 white--text font-customize font-size-ather-roboto-mono-name-page'
            : 'text-h3 pallet1--text font-customize font-size-ather-roboto-mono-name-page'
        "
      >
        {{ computedTitle }}
      </span>
    </template>
    <v-container>
      <v-row>
        <v-col cols="4">
          <v-text-field
            v-model="search"
            :label="$t('search')"
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
            color="primary"
            class="ml-2"
            @click="createTeachers"
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
            @click="popUpApprove(selected)"
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
            @click="popDelete(selected)"
          >
            <v-icon>
              mdi-delete-empty-outline
            </v-icon>
            Delete {{ selected.length }} item
          </v-btn>
        </v-col>
        <v-col v-resize="onResize">
          <v-data-table
            v-model="selected"
            :headers="headers"
            :items="data"
            show-select
            :search="search"
            :class="{ mobile: isMobile }"
            mobile-breakpoint="0"
          >
            <!-- Mobile -->

            <!-- Header -->
            <template #[`header.name`]="{ header }">
              {{ $t(header.text) }}
            </template>
            <template #[`header.email`]="{ header }">
              {{ $t(header.text) }}
            </template>
            <template #[`header.region`]="{ header }">
              {{ $t(header.text) }}
            </template>
            <template #[`header.contact`]="{ header }">
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
            <template #[`header.profession`]="{ header }">
              {{ $t(header.text) }}
            </template>
            <template #[`header.is_verified`]="{ header }">
              {{ $t(header.text) }}
            </template>

            <!-- Item -->
            <template #[`item.name`]="{item}">
              <div class="mt-6">
                <v-list-item-avatar
                  size="23"
                  color="primary"
                >
                  <!-- <v-img src="https://cdn.vuetifyjs.com/images/lists/1.jpg" /> -->
                  <span>{{ item.name.charAt(0) }}</span>
                </v-list-item-avatar>
                <v-tooltip
                  v-if="item.name.length > 9"
                  bottom
                  color="blue"
                >
                  <template #activator="{on, attrs}">
                    <span
                      v-bind="attrs"
                      v-on="on"
                    >
                      {{ item.name.substr(0, 9) + '..' }}
                    </span>
                  </template>
                  <span>{{ item.name }}</span>
                </v-tooltip>
                <span v-else>{{ item.name }}</span>
              </div>
              <div class="bg-hover">
                <div class="d-flex flex-row flex-nowrap">
                  <div>
                    <div class="d-flex flex-column flex-nowrap mt-2">
                      <a
                        class="font-a d-flex flex-nowrap"
                        @click="popEditForm(item)"
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
            <template #[`item.is_verified`]="{item}">
              <v-chip
                :color="setColorVerified(item.is_verified)"
                class="text-capitalize chips--weight"
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
      data: {
        type: Array,
        default: null,
      },
    },
    data: () => ({
      isMobile: false,
      headers: [
        {
          text: 'table.teachers.th.fullName',
          align: 'start',
          sortable: false,
          value: 'name',
        },
        { text: 'table.teachers.th.email', value: 'email' },
        { text: 'table.teachers.th.region', value: 'region', sortable: false },
        { text: 'table.teachers.th.contact', value: 'contact' },
        { text: 'table.teachers.th.profession', value: 'profession' },
        { text: 'table.teachers.th.approved', value: 'is_verified' },
      ],
      search: '',
      selected: [],
    }),
    computed: {
      computedTitle () {
        let title = 'Index Instructor - All'
        if (this.$route.query.summary === 'all') {
          title = 'Index Instructor - All'
        }
        if (this.$route.query.summary === 'approved') {
          title = 'Index Instructor - Approved'
        }
        if (this.$route.query.summary === 'non_approved') {
          title = 'Index Instructor - Non Approved'
        }
        if (this.$route.query.summary === 'new') {
          title = 'Index Instructor - New'
        }
        return title
      },
    },
    mounted () {
      console.log(this.isMobile)
    },
    methods: {
      onResize () {
        if (window.innerWidth < 769) this.isMobile = true
        else this.isMobile = false
      },
      createTeachers () {
        this.$emit('create')
      },
      popEditForm (item) {
        this.$emit('edit', { item: item })
      },
      popUpApprove (item) {
        this.$emit('approve', { item: item })
      },
      popDelete (item) {
        this.$emit('deletes', { item: item })
      },
      deleteByIdPopUp (item) {
        this.$emit('deleteById', { item: item })
      },
      setColorVerified (status) {
        if (status === 1) return 'primary'
        else return 'red'
      },
    },
  }
</script>

<style lang="sass" scoped>
.v-input--selection-controls__input
    .mdi
        width: 100%
        color: #4CAF50 !important
</style>
