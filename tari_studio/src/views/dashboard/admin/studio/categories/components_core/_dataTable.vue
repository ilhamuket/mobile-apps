<template>
  <base-material-card icon="mdi-playlist-check">
    <template #after-heading>
      <span class="text-h3 primary--text">
        Category - All
      </span>
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
            @click="refreshMethods"
          >
            <v-tooltip
              color="primary"
              bottom
            >
              <template #activator="{on, attrs}">
                <v-icon
                  v-bind="attrs"
                  color="size__icon_refresh"
                  v-on="on"
                >
                  mdi-cached
                </v-icon>
              </template>
              <span class="font-spartan-small">
                {{ $t('Segarkan') }}
              </span>
            </v-tooltip>
          </v-btn>
        </v-col>
      </v-row>
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
          <v-btn
            :disabled="disableApproveBtn"
            class="mr-1"
            color="blue"
            outlined
            @click="approveSelected(selected)"
          >
            Approve {{ selected.length }} category
          </v-btn>
          <v-btn
            :disabled="selected.length === 0"
            class="mr-1"
            color="red"
            outlined
            @click="deleteSelected(selected)"
          >
            Delete {{ selected.length }} category
          </v-btn>
        </v-col>
        <v-col cols="12">
          <v-data-table
            v-model="selected"
            :headers="headers"
            :items="data"
            show-select
            :search="search"
            :items-per-page="5"
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
                        @click="upDialogUpdateCategory(item)"
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
              <span
                v-if="item.class"
                class="font-spartan-small"
              >
                {{ item.class.length }}
              </span>
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
    computed: {
      disableApproveBtn () {
        let bool = true
        const nonPublish = this.selected.some(x => x.status === 'publish')
        if (this.selected.length !== 0 && nonPublish) {
          bool = true
        } else if (this.selected.length !== 0 && !nonPublish) {
          bool = false
        }
        return bool
      },
    },
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
      deleteSelected (item) {
        this.$emit('deleteSelected', { item: item })
        this.selected = []
      },
      approveSelected (item) {
        this.$emit('approveSelected', { item: item })
        this.selected = []
      },
      upDialogUpdateCategory (item) {
        this.$emit('update', { item: item })
      },
      refreshMethods () {
        this.$emit('refresh')
      },
    },
  }
</script>

<style></style>
