<template>
  <base-material-card
    icon="mdi-shape-outline"
    color="pallet1"
    title="Category - ALL"
  >
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
          class="mr-4 large"
        >
          <v-btn
            outlined
            color="pallet1"
            width="130"
            class="ml-10"
            @click="openDialog"
          >
            Add
          </v-btn>
        </v-col>
        <v-col cols="12">
          <v-data-table
            :headers="headers"
            :items="data"
            :items-per-page="5"
            class="elevation-1"
            :search="search"
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
              <v-chip
                color="transparent"
                class="chips-hover"
              >
                <div class="font-chips">
                  {{ item.display_name }}
                </div>
              </v-chip>
            </template>
            <template v-slot:[`item.status`]="{ item }">
              <v-chip
                :color="getColorStatus(item.status)"
                outlined
              >
                {{ item.status }}
              </v-chip>
            </template>
            <template v-slot:[`item.created_at`]="{ item }">
              {{ item.created_at | moment('dddd D MMM YYYY') }}
            </template>
            <template v-slot:[`item.isVerified`]="{ item }">
              {{ item.isverified === 1 ? 'Verified' : 'Non-Verified' }}
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
    },
    data: () => ({
      headers: [
        {
          text: '#',
          value: 'id',
          align: 'start',
        },
        {
          text: 'Name',
          sortable: false,
          value: 'display_name',
          align: 'start',
        },
        { text: 'Status', value: 'status', align: 'start' },
        {
          text: 'Verification ',
          value: 'isVerified',
          align: 'start',
        },
        { text: 'Created At', value: 'created_at', align: 'start' },

        { text: 'Actions', value: 'actions', align: 'end' },
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
      search: '',
    }),
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
