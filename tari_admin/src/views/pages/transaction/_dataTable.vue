<template>
  <base-material-card icon="mdi-cart">
    <template #after-heading>
      <span class="font-spartan btn_primary--text">
        {{ computedTitle }}
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
            :label="$t('search')"
            :placeholder="$t('search')"
            append-icon="mdi-magnify"
          />
        </v-col>
        <v-col class="d-flex justify-end">
          <v-btn
            color="btn_primary"
            :disabled="selected.length === 0"
          >
            Confirmation {{ selected.length }} Items
          </v-btn>
          <v-btn
            color="red"
            class="ml-2"
            :disabled="selected.length === 0"
          >
            Reject {{ selected.length }} Items
          </v-btn>
        </v-col>
        <v-col cols="12">
          <v-data-table
            v-model="selected"
            :search="search"
            show-select
            :items-per-page="5"
            :headers="headers"
            :items="data"
            show-expand
          >
            <template #[`item.id`]="{ item }">
              <v-card width="150">
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
              </v-card>
            </template>
            <template #[`item.form.fullName`]="{ item }">
              <div
                v-if="item.form.fullName"
                class="mt-7 text-capitalize d-flex flex-nowrap font-clickfont-clickv"
              >
                {{ item.form.fullName ? item.form.fullName : '-' }}
              </div>
              <div class="bg-hover">
                <div class="d-flex flex-row flex-nowrap">
                  <div
                    v-if="item.status === 'waiting_confirmation'"
                    class="d-flex flex-column mt-1"
                  >
                    <a
                      color="transparent"
                      small
                      text
                      @click="confirmationAction(item)"
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
                        <span class="font-spartan-small">Confirmation</span>
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
                    v-if="item.status !== 'pending'"
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
                            @click="rejectEnsiklolive(item)"
                          >
                            mdi-close
                          </v-icon>
                        </template>
                        <span class="font-spartan-small">Reject</span>
                      </v-tooltip>
                    </a>
                  </div>
                </div>
              </div>
            </template>
            <template #[`item.bank.bank_name`]="{ item }">
              <span v-if="item.bank">
                {{ item.bank.bank_name ? item.bank.bank_name : '-' }}
              </span>
            </template>
            <template #[`item.account_bank_number`]="{ item }">
              <span v-if="item.bank">
                {{
                  item.bank.account_bank_number
                    ? item.bank.account_bank_number
                    : '-'
                }}
              </span>
            </template>
            <template #[`item.status`]="{ item }">
              <v-chip
                v-if="item.status"
                class="text-capitalize"
                :color="setColorStatus(item.status)"
              >
                {{ setNameStatus(item.status) }}
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
      selected: [],
      headers: [
        {
          text: '#',
          value: 'id',
          sortable: false,
        },
        {
          text: 'Student Name',
          value: 'form.fullName',
          sortable: false,
        },
        {
          text: 'Class',
          value: 'class.name',
          sortable: false,
        },
        { text: 'Student Email', value: 'form.email', sortable: false },
        { text: 'UserName Account', value: 'user.nickName' },
        { text: 'Contact WA', value: 'user.noHp', sortable: false },
        { text: 'Payment Method', value: 'bank.bank_name', sortable: false },
        { text: 'Bank Account', value: 'account_bank_number', sortable: false },
        { text: 'Status', value: 'status', sortable: false },
      // { text: 'Last Login', value: 'last_login', sortable: false },
      ],
      search: '',
    }),
    computed: {
      computedTitle () {
        let title = 'Transaction EnsikloLive - All'
        if (this.$route.query.summary === 'paid') {
          title = 'Transaction EnsikloLive - Paid'
        }

        if (this.$route.query.summary === 'waiting_payment') {
          title = 'Transaction EnsikloLive - Waiting Payment'
        }

        if (this.$route.query.summary === 'new') {
          title = 'Transaction EnsikloLive - New'
        }
        if (this.$route.query.summary === 'waiting_confirmation') {
          title = 'Transaction EnsikloLive - Waiting Confirmation'
        }
        if (this.$route.query.summary === 'waiting_proof') {
          title = 'Transaction EnsikloLive - Waiting Proof'
        }
        if (this.$route.query.summary === 'cancelled') {
          title = 'Transaction EnsikloLive - Cancelled'
        }
        if (this.$route.query.summary === 'pending') {
          title = 'Transaction EnsikloLive - Pending'
        }

        return title
      },
    },
    methods: {
      setNameStatus (name) {
        // let nameStatus = ''
        if (name === 'waiting_confirmation') return 'waiting confirmation'
        if (name === 'waiting_payment') return 'waiting payment'
        if (name === 'waiting_proof') return 'waiting proof'
        else return name
      },
      setColorStatus (status) {
        // let colorStatus = ''
        if (status === 'paid') return 'btn_primary'
        if (status === 'waiting_payment') return 'warning'
        if (status === 'waiting_proof') return 'warning'
        if (status === 'waiting_confirmation') return 'warning'
        else return 'red'

      // return colorStatus
      },
      confirmationAction (item) {
        this.$emit('confirmation', { item: item })
      },
      rejectEnsiklolive (item) {
        this.$emit('reject', { item: item })
      },
      refresh () {
        this.$emit('refresh')
      },
    },
  }
</script>

<style></style>
