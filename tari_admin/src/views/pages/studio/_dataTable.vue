<template>
  <base-material-card icon="mdi-shopping-music">
    <template v-slot:after-heading>
      <h2 class="btn_primary--text">
        {{ computedTableTitle }}
      </h2>
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
            append-icon="mdi-magnify"
            color="btn_primary"
            dense
          />
        </v-col>
        <v-col
          cols="12"
          md="8"
          class="d-flex justify-end"
        >
          <v-btn
            :disabled="selected.length === 0"
            color="btn_primary"
            class="ml-2"
            @click="approved(selected)"
          >
            {{ selected.length }} Approved
          </v-btn>
        </v-col>
        <v-col cols="12">
          <v-data-table
            v-model="selected"
            :search="search"
            :items="data"
            :headers="headers"
            show-select
            :items-per-page="5"
          >
            <template #[`item.name`]="{ item }">
              <div class="mt-7 text-capitalize d-flex flex-nowrap">
                {{ item.name }}
              </div>
              <div class="bg-hover">
                <div class="d-flex flex-row flex-nowrap">
                  <div class="d-flex flex-column mt-1">
                    <a
                      color="transparent"
                      small
                      text
                      @click="approveDataById"
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
                        <span class="font-spartan-small">Verification</span>
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
                            mdi-whatsapp
                          </v-icon>
                        </template>
                        <span class="font-spartan-small">Contact Owner</span>
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
                            mdi-star-check
                          </v-icon>
                        </template>
                        <span class="font-spartan-small">Nonactive</span>
                      </v-tooltip>
                    </a>
                  </div>
                </div>
              </div>
            </template>
            <template #[`item.created_at`]="{ item }">
              {{ item.created_at | moment('D MMM YYYY') }}
            </template>
            <template #[`item.isVerified`]="{ item }">
              <v-chip :color="setColorAppoved(item.isVerified)">
                {{ item.author.isVerified === 1 ? 'Approved' : 'Not Approved' }}
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
      headers: [
        // {
        //   text: '#',
        //   value: 'id',
        // },
        {
          text: 'Name',
          value: 'name',
          sortable: false,
        },
        { text: 'Prefix', value: 'prefix', sortable: false },
        { text: 'Username', value: 'username', sortable: false },
        { text: 'Email', value: 'email', sortable: false },
        { text: 'Region', value: 'address', sortable: false },
        { text: 'Contact', value: 'contact', sortable: false },
        { text: 'Created At', value: 'created_at', sortable: false },
        { text: 'Approve', value: 'isVerified', sortable: false },
      // { text: 'author', value: 'isSubcribe', sortable: false },

      // { text: 'Actions', value: 'actions', align: 'start', justify: 'end' },
      ],
      selected: [],
      search: '',
    }),
    computed: {
      computedTableTitle () {
        let title = 'Studio - All'
        if (this.$route.query.summary === 'approved') title = 'Studio - Approved'
        if (this.$route.query.summary === 'non_approved') {
          title = 'Studio - Non Approved'
        }
        if (this.$route.query.summary === 'new') title = 'Studio - New'
        return title
      },
    },
    methods: {
      popUpDelete (item) {
        this.$emit('delete', { item: item })
      },
      popUpApproved (item) {
        this.$emit('approve', { item: item })
      },
      setColorAppoved (status) {
        if (status === 1) return 'btn_primary'
        else return 'red'
      },
      dialogAdd () {
        this.$emit('add')
      },
      removeData (item) {
        this.$emit('remove', { item: item })
      },
      approveDataById (item) {
        this.$emit('aproveById', { item: item })
      },
      refresh () {
        this.$emit('refresh')
      },
      approved (item) {
        this.$emit('approved', { item: item })
        this.selected = []
      },
    },
  }
</script>

<style></style>
