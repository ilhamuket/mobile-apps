<template>
  <base-material-card icon="mdi-cart">
    <template #after-heading>
      <span class="font-spartan btn_primary--text">
        {{ computedTitle }}
      </span>
    </template>
    <v-container>
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
        <v-col cols="12">
          <v-data-table
            :search="search"
            show-select
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
                class="mt-7 text-capitalize d-flex flex-nowrap font-clickfont-clickv"
              >
                {{ item.form.fullName }}
              </div>
              <div class="bg-hover">
                <div class="d-flex flex-row flex-nowrap">
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
                        <span class="font-spartan-small">Contact Whatsapp</span>
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
                            mdi-panorama-variant-outline
                          </v-icon>
                        </template>
                        <span class="font-spartan-small">Nonactive</span>
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
          text: 'Student Name',
          value: 'form.fullName',
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
        if (this.$route.query.summary === 'waiting') {
          title = 'Transaction EnsikloLive - Waiting'
        }
        if (this.$route.query.summary === 'new') {
          title = 'Transaction EnsikloLive - New'
        }

        return title
      },
    },
  }
</script>

<style></style>
