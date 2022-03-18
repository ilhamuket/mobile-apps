<template>
  <base-material-card icon="mdi-cart">
    <template #after-heading>
      <span class="font-spartan btn_primary--text"> {{ computedTitle }} </span>
    </template>
    <v-container>
      <v-row>
        <v-col cols="12">
          <v-btn
            class="mr-1"
            outlined
            rounded
            small
            dark
            color="primary"
            @click="refresh"
          >
            <v-tooltip
              color="btn_primary"
              bottom
            >
              <template #activator="{ on, attrs }">
                <v-icon
                  v-bind="attrs"
                  color="size__icon_refresh"
                  v-on="on"
                >
                  mdi-refresh
                </v-icon>
              </template>
              <span class="font-spartan-small"> Refresh </span>
            </v-tooltip>
          </v-btn>
        </v-col>
      </v-row>
      <v-row>
        <v-col
          cols="12"
          md="4"
        >
          <v-text-field
            v-model="search"
            :label="$t('search')"
            :placeholder="$t('type')"
            append-icon="mdi-magnify"
          />
        </v-col>
        <v-col
          cols="12"
          md="8"
          class="d-flex justify-end"
        >
          <v-btn
            color="info"
            class="mr-2"
          >
            Activated {{ selected.length }} Items
          </v-btn>

          <v-btn
            class="ml-2"
            color="btn_primary"
            @click="createItem"
          >
            Create Plan
          </v-btn>
        </v-col>
        <v-col cols="12">
          <v-data-table
            v-model="selected"
            show-select
            :headers="headers"
            :items="items"
          >
            <template #[`item.name`]="{ item }">
              <div class="mt-6">
                {{ item.name }}
              </div>
              <div class="bg-hover">
                <div class="d-flex flex-row flex-nowrap">
                  <div class="d-flex flex-column mt-1">
                    <a
                      color="transparent"
                      small
                      text
                      @click="activedItem(item)"
                    >
                      <v-tooltip
                        color="btn_primary"
                        bottom
                      >
                        <template #activator="{ on, attrs }">
                          <v-icon
                            v-bind="attrs"
                            color="btn_primary"
                            small
                            class="ml-1"
                            v-on="on"
                          >
                            mdi-check-decagram
                          </v-icon>
                        </template>
                        <span class="font-spartan-small">Actived Plan</span>
                      </v-tooltip>
                    </a>
                  </div>
                  <div class="d-flex flex-column mt-1">
                    <a
                      color="transparent"
                      small
                      text
                      @click="editForm(item)"
                    >
                      <v-tooltip
                        color="btn_primary"
                        bottom
                      >
                        <template #activator="{ on, attrs }">
                          <v-icon
                            v-bind="attrs"
                            color="btn_primary"
                            small
                            class="ml-1"
                            v-on="on"
                          >
                            mdi-pencil
                          </v-icon>
                        </template>
                        <span class="font-spartan-small">Edit Plan</span>
                      </v-tooltip>
                    </a>
                  </div>
                  <div class="d-flex flex-column mt-1">
                    <a
                      color="transparent"
                      small
                      text
                    >
                      <v-tooltip
                        color="red"
                        bottom
                      >
                        <template #activator="{ on, attrs }">
                          <v-icon
                            v-bind="attrs"
                            color="red"
                            small
                            class="ml-1"
                            v-on="on"
                            @click="activate(item)"
                          >
                            mdi-close
                          </v-icon>
                        </template>
                        <span class="font-spartan-small">Inactivate</span>
                      </v-tooltip>
                    </a>
                  </div>
                </div>
              </div>
            </template>
            <template #[`item.date_count`]="{ item }">
              <span> {{ item.date_count }} Months </span>
            </template>
            <template #[`item.type`]="{ item }">
              {{ setType(item.type) }}
            </template>
            <template #[`item.status`]="{ item }">
              <v-chip
                :color="setColorStatus(item.status)"
                class="text-capitalize"
              >
                {{ item.status }}
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
        { text: 'Name', align: 'left', value: 'name' },
        { text: 'Type', value: 'type' },
        { text: 'Duration (M)', value: 'date_count' },
        { text: 'status', value: 'status' },
      // { text: 'Start date', value: 'date' },
      // { text: 'Salary', value: 'salary' },
      ],
    }),
    computed: {
      computedTitle () {
        let title = 'Plan List - All'
        if (this.$route.query.summary === 'active') title = 'Plan List - Active'
        if (this.$route.query.summary === 'inactive') {
          title = 'Plan List - Inactive'
        }
        if (this.$route.query.summary === 'new') title = 'Plan List - New'

        return title
      },
    },
    methods: {
      setColorStatus (status) {
        if (status === 'active') return 'btn_primary'
        else return 'red'
      },
      deleteItems (item) {
        this.$emit('deletes', { item: item })
      },
      createItem () {
        this.$emit('open')
      },
      activedItem (item) {
        this.$emit('actived', { item: item })
      },
      editForm (item) {
        this.$emit('edit', { item: item })
      },
      refresh () {
        this.$emit('refresh')
      },
      setType (type) {
        if (type === 'ensiklo-video') return 'Ensiklo Video'
      },
      activate (item) {
        this.$emit('activate', { item: item })
      },
    },
  }
</script>

<style></style>
