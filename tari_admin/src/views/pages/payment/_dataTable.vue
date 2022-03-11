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
            :placeholder="$t('search')"
            append-icon="mdi-magnify"
          />
        </v-col>
        <v-col
          cols="12"
          md="8"
          class="d-flex justify-end"
        >
          <v-btn color="red">
            Delete {{ selected.length }} items
          </v-btn>
        </v-col>
        <v-col cols="12">
          <v-data-table
            v-model="selected"
            :search="search"
            :headers="headers"
            :items="data"
            show-select
          >
            <template #[`item.id`]="{ item }">
              <v-card width="150">
                <div v-if="item.type === 'live'">
                  <v-img
                    v-if="item.image_url"
                    width="140"
                    height="100"
                    gradient="to top right, rgba(0,0,0,.33), rgba(0,0,0,.7)"
                    style="cursor: pointer"
                    :src="item.image_url"
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
                </div>
                <div v-else>
                  <v-img
                    v-if="item.cart"
                    width="140"
                    height="100"
                    gradient="to top right, rgba(0,0,0,.33), rgba(0,0,0,.7)"
                    style="cursor: pointer"
                    :src="item.cart.image_url"
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
                </div>
              </v-card>
            </template>
            <template #[`item.class.studio.name`]="{ item }">
              <div class="mt-2">
                <span v-if="item.type === 'live'">
                  {{ item.class.studio.name }}
                </span>
                <span v-if="item.type === 'video'">
                  {{ item.video ? item.video.studio.name : '-' }}
                </span>
              </div>
              <div class="bg-hover">
                <div class="d-flex flex-row flex-nowrap">
                  <div
                    v-if="item.status === 'waiting_transfer'"
                    class="d-flex flex-column mt-1"
                  >
                    <a
                      color="transparent"
                      small
                      text
                      @click="transfer(item)"
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
                        <span class="font-spartan-small">Transfer</span>
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
                        <span class="font-spartan-small">Contact Whatsapp</span>
                      </v-tooltip>
                    </a>
                  </div>
                  <div
                    v-if="item.status === 'rejected'"
                    class="d-flex flex-column mt-1"
                  >
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
                            @click="deletePayment(item)"
                          >
                            mdi-delete
                          </v-icon>
                        </template>
                        <span class="font-spartan-small">Delete</span>
                      </v-tooltip>
                    </a>
                  </div>
                </div>
              </div>
            </template>
            <template #[`item.type`]="{ item }">
              <span class="text-capitalize">{{
                item.type ? item.type : '-'
              }}</span>
            </template>
            <template #[`item.class.studio.email`]="{ item }">
              <div v-if="item.type === 'live'">
                <span>{{
                  item.class.studio.email ? item.class.studio.email : '-'
                }}</span>
              </div>
              <div v-else>
                <span>
                  {{ item.video ? item.video.studio.email : '-' }}
                </span>
              </div>
            </template>
            <template #[`item.class.studio.contact`]="{ item }">
              <div v-if="item.type === 'live'">
                <span>{{
                  item.class.studio.contact ? item.class.studio.contact : '-'
                }}</span>
              </div>
              <div v-else>
                <span>
                  {{ item.video ? item.video.studio.contact : '-' }}
                </span>
              </div>
            </template>
            <template #[`item.class.name`]="{ item }">
              <div v-if="item.type === 'live'">
                <span>{{ item.class ? item.class.name : '-' }}</span>
              </div>
              <div v-else>
                <v-tooltip
                  bottom
                  color="btn_primary"
                >
                  <template #activator="{ on, attrs }">
                    <span
                      v-bind="attrs"
                      v-on="on"
                    >
                      {{
                        item.video ? item.video.name.substr(0, 15) + '...' : '-'
                      }}
                    </span>
                  </template>
                  <span>
                    {{ item.video ? item.video.name : '-' }}
                  </span>
                </v-tooltip>
              </div>
            </template>
            <template #[`item.status`]="{ item }">
              <v-chip
                class="text-capitalize"
                :color="setColorStatus(item.status)"
              >
                {{ setStatus(item.status) }}
              </v-chip>
            </template>
            <template #[`item.bank`]="{ item }">
              <v-btn
                v-if="!item.to"
                color="btn_primary"
                small
                @click="listBank(item)"
              >
                List Bank Account
              </v-btn>
              <v-chip
                v-else
                close
                color="btn_primary"
                @click:close="removeBankChoice(item)"
              >
                {{ item.to }}
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
        {
          text: '#',
          value: 'id',
          sortable: false,
        },
        {
          text: 'Studio',
          value: 'class.studio.name',
          sortable: false,
        },
        {
          text: 'Type',
          value: 'type',
          sortable: false,
        },
        { text: 'Studio Email', value: 'class.studio.email', sortable: false },
        { text: 'Studio Contact', value: 'class.studio.contact' },
        { text: 'Class Name', value: 'class.name', sortable: false },
        // { text: 'Payment Method', value: 'bank.bank_name', sortable: false },
        { text: 'Status', value: 'status', sortable: false },
        { text: 'Bank Account', value: 'bank', sortable: false },
      // { text: 'Last Login', value: 'last_login', sortable: false },
      ],
      search: '',
      selected: [],
    }),
    computed: {
      computedTitle () {
        let title = 'Payment - All'
        if (this.$route.query.summary === 'paid') title = 'Payment Paid'
        if (this.$route.query.summary === 'waiting_transfer') {
          title = 'Payment - Waiting Transfer'
        }
        if (this.$route.query.summary === 'rejected') title = 'Payment - Rejected'
        if (this.$route.query.summary === 'new') title = 'Payment - New'
        return title
      },
    },
    methods: {
      setStatus (name) {
        if (name === 'waiting_transfer') return 'Waiting Transfer'
        else return name
      },
      setColorStatus (status) {
        if (status === 'waiting_transfer') return 'warning'
        if (status === 'paid') return 'btn_primary'
        else return 'red'
      },
      transfer (item) {
        this.$emit('transfer', { item: item })
      },
      refresh () {
        this.$emit('refresh')
      },
      listBank (item) {
        this.$emit('listBank', { item: item })
      },
      deletePayment (item) {
        this.$emit('delete', { item: item })
      },
      removeBankChoice (item) {
        this.$emit('removeBank', { item: item })
      // item.to = null
      },
    },
  }
</script>

<style></style>
