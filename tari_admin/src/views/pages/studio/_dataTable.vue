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
            :placeholder="$t('search')"
            :label="$t('search')"
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
            @click="verificationOwners(selected)"
          >
            Verification {{ selected.length }} Studio
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
            <template #[`item.id`]="{ item }">
              <v-card width="150">
                <v-img
                  v-if="item.img.url"
                  width="140"
                  height="100"
                  gradient="to top right, rgba(0,0,0,.33), rgba(0,0,0,.7)"
                  style="cursor: pointer"
                  :src="item.img.url"
                  class="img__hover"
                >
                  <template v-slot:placeholder>
                    <v-row
                      class="fill-height ma-0"
                      align="center"
                      justify="center"
                    >
                      <v-progress-circular
                        indeterminate
                        color="grey lighten-5"
                      />
                    </v-row>
                  </template>
                  <v-container>
                    <v-row>
                      <v-col cols="12">
                        <v-icon
                          large
                          class="mt-5 ml-10 show-btn"
                          color="transparent"
                        >
                          mdi-camera-flip
                        </v-icon>
                      </v-col>
                    </v-row>
                  </v-container>
                </v-img>
                <v-img
                  v-else
                  width="140"
                  height="100"
                  gradient="to top right, rgba(0,0,0,.33), rgba(0,0,0,.7)"
                  style="cursor: pointer"
                  src="https://assets.tokopedia.net/assets-tokopedia-lite/v2/zeus/kratos/62cb37c4.png"
                  class="img__hover"
                >
                  <template v-slot:placeholder>
                    <v-row
                      class="fill-height ma-0"
                      align="center"
                      justify="center"
                    >
                      <v-progress-circular
                        indeterminate
                        color="grey lighten-5"
                      />
                    </v-row>
                  </template>
                  <v-container>
                    <v-row>
                      <v-col cols="12">
                        <v-icon
                          large
                          class="mt-5 ml-10 show-btn"
                          color="transparent"
                        >
                          mdi-camera-flip
                        </v-icon>
                      </v-col>
                    </v-row>
                  </v-container>
                </v-img>
              </v-card>
            </template>
            <template #[`item.name`]="{ item }">
              <div
                class="mt-7 text-capitalize d-flex flex-nowrap font-clickfont-clickv"
              >
                {{ item.name }}
              </div>
              <div class="bg-hover">
                <div class="d-flex flex-row flex-nowrap">
                  <div class="d-flex flex-column mt-1">
                    <a
                      color="transparent"
                      small
                      text
                      @click="verificationOwnerByUserId(item)"
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
            <template #[`item.email`]="{ item }">
              <span class="font-spartan">
                {{
                  item.email.length > 15
                    ? item.email.substr(0, 15) + '...'
                    : item.email
                }}
              </span>
            </template>
            <template #[`item.author.firstName`]="{ item }">
              <span class="">
                {{ item.author.firstName + ' ' + item.author.lastName }}
              </span>
            </template>
            <template #[`item.created_at`]="{ item }">
              {{ item.created_at | moment('D MMM YYYY') }}
            </template>
            <template #[`item.isVerified`]="{ item }">
              <v-chip :color="setColorAppoved(item.author.isVerified)">
                {{ item.author.isVerified === 1 ? 'Verified' : 'Not Verified' }}
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
          text: 'Name Studio',
          value: 'name',
          sortable: false,
        },
        // { text: 'Email Studio', value: 'email', sortable: false },
        { text: 'Owner Name', value: 'author.firstName', sortable: false },
        { text: 'Region', value: 'address', sortable: false },
        { text: 'Contact', value: 'contact', sortable: false },
        { text: 'Created At', value: 'created_at', sortable: false },
        { text: 'Owner Verification', value: 'isVerified', sortable: false },
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
      verificationOwnerByUserId (item) {
        this.$emit('verificationOwner', { item: item })
      },
      refresh () {
        this.$emit('refresh')
      },
      verificationOwners (item) {
        this.$emit('verificationOwners', { item: item })
        this.selected = []
      },
    },
  }
</script>

<style></style>
