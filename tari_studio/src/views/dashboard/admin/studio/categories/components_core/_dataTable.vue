<template>
  <base-material-card icon="mdi-playlist-check">
    <template #after-heading>
      <span class="text-h3 primary--text">
        Category - All
      </span>
    </template>
    <v-container>
      <v-row>
        <v-col cols="4">
          <v-text-field
            v-model="search"
            append-icon="mdi-magnify"
            :label="$t('search')"
            :placeholder="$t('search')"
          />
        </v-col>
        <v-col
          class="d-flex flex-row-reverse"
          cols="8"
        >
          <v-btn
            color="btn_primary"
            outlined
            @click="popUpCreateCategory"
          >
            Create category
          </v-btn>
        </v-col>
        <v-col cols="12">
          <v-data-table
            :headers="headers"
            :items="data"
            show-select
            :search="search"
          >
            <!-- Header -->
            <template #[`header.name`]="{ header }">
              {{ $t(header.text) }}
            </template>
            <template #[`header.display_name`]="{ header }">
              {{ $t(header.text) }}
            </template>
            <template #[`header.status`]="{ header }">
              {{ $t(header.text) }}
            </template>
            <template #[`header.created_at`]="{ header }">
              {{ $t(header.text) }}
            </template>
            <template #[`header.class`]="{ header }">
              {{ $t(header.text) }}
            </template>

            <!-- Items -->
            <template #[`item.name`]="{item}">
              <div class="mt-6">
                {{ item.name }}
              </div>
              <div class="bg-hover">
                <div class="d-flex flex-row flex-nowrap">
                  <div>
                    <div class="d-flex flex-column flex-nowrap mt-2">
                      <a
                        class="font-a d-flex flex-nowrap"
                        @click="upDialogeditClass(item)"
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
                    <div class="d-flex flex-column mt-2 ml-1 mr-1">
                      <a
                        class="d-flex blue--text flex-nowrap"
                        @click="upInfoClass(item)"
                      >
                        <v-icon
                          color="blue"
                          small
                        >
                          mdi-eye
                        </v-icon>
                        Info
                      </a>
                    </div>
                  </div>
                  <div>
                    <div class="d-flex flex-column mt-2">
                      <a
                        class="font-a-delete d-flex flex-nowrap"
                        @click="deleteById(item)"
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
                label
                :color="setColorStatus(item.status)"
                class="text-capitalize"
              >
                {{ item.status }}
              </v-chip>
            </template>
            <template #[`item.created_at`]="{item}">
              {{ item.created_at | moment('MMMM Do YYYY') }}
            </template>
            <template #[`item.class`]="{item}">
              {{ item.class.length }}
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
      headers: [
        {
          text: 'table.category.th.name',
          align: 'start',
          sortable: false,
          value: 'name',
        },
        {
          text: 'table.category.th.display_name',
          align: 'start',
          sortable: false,
          value: 'display_name',
        },
        {
          text: 'table.category.th.status',
          align: 'start',
          sortable: false,
          value: 'status',
        },
        {
          text: 'table.category.th.created_at',
          align: 'start',
          sortable: false,
          value: 'created_at',
        },
        {
          text: 'table.category.th.class',
          align: 'start',
          sortable: false,
          value: 'class',
        },
      ],
      selected: [],
      search: '',
    }),
    methods: {
      setColorStatus (item) {
        if (item === 'publish') return 'btn_primary'
        if (item === 'draft') return 'primary'
        else return 'red'
      },
      popUpCreateCategory () {
        this.$emit('create')
      },
      deleteById (item) {
        this.$emit('deleteById', { item: item })
      },
    },
  }
</script>

<style></style>
