<template>
  <base-material-card
    icon="mdi-shape-outline"
    color="pallet1"
  >
    <template v-slot:after-heading>
      <h2 :class="$vuetify.theme.dark ? 'text--white' : 'text--pallet1'">
        {{ computedTitle }}
      </h2>
    </template>
    <v-container>
      <v-row>
        <v-col
          cols="12"
          md="4"
          class="mb-3"
        >
          <v-text-field
            v-model="search"
            append-icon="mdi-magnify"
            :label="$t('search')"
            dense
            outlined
            rounded
            color="pallet1"
          />
        </v-col>
        <v-col
          cols="12"
          md="1"
          offset-md="6"
        >
          <v-btn
            outlined
            :color="$vuetify.theme.dark ? 'white' : 'pallet1'"
            @click="openDialog"
          >
            {{ $t('categories.btn.btn_name') }}
          </v-btn>
        </v-col>
        <v-col cols="12">
          <v-data-table
            :headers="headers"
            :items="data"
            :items-per-page="5"
            class="elevation-1"
            :search="search"
            show-select
          >
            <template v-slot:[`item.id`]="{ item }">
              <v-chip color="primary">
                {{
                  data
                    .map(x => {
                      return x.id
                    })
                    .indexOf(item.id) + 1
                }}
              </v-chip>
            </template>
            <template v-slot:[`item.display_name`]="{ item }">
              <div class="font-chips mt-9">
                {{ item.display_name }}
              </div>

              <div class="bg-hover">
                <div class="d-flex flex-row flex-nowrap">
                  <div>
                    <div class="d-flex flex-column flex-nowrap mt-2">
                      <a
                        class="font-a d-flex flex-nowrap"
                        @click="editItem(item)"
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
                        @click="removeData(item)"
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
              <div class="bg-unHover">
                <div class="d-flex flex-row flex-nowrap">
                  <div class="d-flex flex-column mt-2">
                    <a
                      class="font-a d-flex flex-nowrap"
                      @click="editItem(item)"
                    />
                  </div>
                  <div class="d-flex flex-column mt-2">
                    <a
                      class="font-a d-flex flex-nowrap"
                      @click="editItem(item)"
                    />
                  </div>
                </div>
              </div>
            </template>
            <template v-slot:[`item.status`]="{ item }">
              <v-chip
                class="text-capitalize"
                :color="getColorStatus(item.status)"
              >
                {{ item.status }}
              </v-chip>
            </template>
            <template v-slot:[`item.created_at`]="{ item }">
              {{ item.created_at | moment('dddd D MMM YYYY') }}
            </template>
            <template v-slot:[`item.isVerified`]="{ item }">
              <v-chip :color="getColorVerified(item.isVerified)">
                {{ item.isVerified === 1 ? 'Verified' : 'Non-Verified' }}
              </v-chip>
            </template>
            <template v-slot:[`item.actions`]="{ item }">
              <v-icon
                small
                class="mr-2"
                color="blue"
                @click="editItem(item)"
              >
                mdi-pencil
              </v-icon>
              <v-icon
                color="red"
                small
                @click="removeData(item)"
              >
                mdi-delete
              </v-icon>
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
      title: {
        type: String,
        default: '',
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
          sortable: false,
          value: 'display_name',
        },
        { text: 'Status', value: 'status' },
        {
          text: 'Verification ',
          value: 'isVerified',
        },
        { text: 'Created At', value: 'created_at' },

      // { text: 'Actions', value: 'actions', align: 'end' },
      ],
      dialog: {
        open: false,
      },
      editDialog: {
        open: false,
        id: 0,
        name: '',
        status: '',
      },
      removeDialog: {
        open: false,
        id: 0,
        name: '',
      },
      search: '',
    }),
    computed: {
      computedTitle () {
        if (this.title === '') return this.$t('category') + ' - ' + this.$t('all')
        if (this.title === 'verified') {
          return this.$t('category') + ' - ' + this.$t('verified')
        }
        if (this.title === 'not_verified') {
          return this.$t('category') + ' - ' + this.$t('unverified')
        }

        if (this.title === 'deleted') {
          return this.$t('category') + ' - ' + this.$t('deleted')
        }

        return this.title
      },
    },
    methods: {
      openDialog () {
        this.dialog.open = !this.dialog.open
        this.$emit('openDialog', { item: this.dialog })
      },
      getColorStatus (status) {
        if (status === 'publish') return 'primary'
        if (status === 'preview') return 'info'
        if (status === 'concept') return '#8A289A'
        else return 'pallet1'
      },
      editItem (item) {
        this.editDialog.open = true
        this.editDialog.id = item.id
        this.editDialog.name = item.name
        this.editDialog.status = item.status
        this.$emit('edit', { item: this.editDialog })
      },
      removeData (item) {
        // this.removeDialog.open = true
        // this.removeDialog.id = item.id
        // this.removeDialog.name = item.name
        // this.$emit('remove', { item: this.removeDialog })
        this.$swal
          .fire({
            title: this.$t('categories.delete.content') + `${item.name}`,
            icon: 'question',
            // text: 'Something went wrong!',
            showCancelButton: true,
            cancelButtonText: this.$t('categories.delete.cancel'),
            confirmButtonText: this.$t('categories.delete.submit'),
          })
          .then(result => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
              this.$store
                .dispatch('category/removeData', {
                  id: item.id,
                })
                .then(res => {
                  const Toast = this.$swal.mixin({
                    toast: true,
                    position: 'bottom-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: toast => {
                      toast.addEventListener('mouseenter', this.$swal.stopTimer)
                      toast.addEventListener('mouseleave', this.$swal.resumeTimer)
                    },
                    popup: 'swal2-show',
                    backdrop: 'swal2-backdrop-show',
                    icon: 'swal2-icon-show',
                  })

                  Toast.fire({
                    icon: 'success',
                    title: 'Data has been successfully deleted',
                  })
                })
            } else if (result.isDismissed) {
              this.$swal.fire(
                this.$t('categories.delete.response'),
                this.$t('categories.delete.text_responses'),
                'error',
              )
            }
          })
      },
      getColorVerified (verified) {
        if (verified === 1) return 'primary'
        else return 'red'
      },
    },
  }
</script>

<style lang="sass" scoped>

.chips-hover
  cursor: pointer
  &:hover
    color: #6B75AA
    // background-color: red !important3
.font-chip
  font-size: 200px !important
</style>
