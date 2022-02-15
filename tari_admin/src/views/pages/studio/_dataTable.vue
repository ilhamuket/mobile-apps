<template>
  <base-material-card icon="mdi-shopping-music">
    <template v-slot:after-heading>
      <h2 :class="$vuetify.theme.dark ? 'text--white' : 'text--pallet1'">
        Studio
      </h2>
    </template>
    <v-container>
      <v-row>
        <v-col
          cols="12"
          md="4"
        >
          <v-text-field
            v-model="search"
            append-icon="mdi-magnify"
            outlined
            rounded
            color="pallet1"
            dense
          />
        </v-col>

        <v-col
          cols="12"
          md="8"
          class="d-flex flex-row-reverse"
        >
          <v-btn
            outlined
            color="primary"
            class="ml-2"
            @click="dialogAdd"
          >
            <v-icon>
              mdi-plus
            </v-icon>
            Add Studio
          </v-btn>

          <v-btn
            :disabled="selected.length === 0"
            class="ml-2"
            outlined
            color="blue"
            @click="popUpApproved(selected)"
          >
            <v-icon>
              mdi-check-decagram
            </v-icon>
            Approve {{ selected.length }} item
          </v-btn>
          <v-btn
            :disabled="selected.length === 0"
            outlined
            color="red"
            @click="popUpDelete(selected)"
          >
            <v-icon>
              mdi-delete-empty-outline
            </v-icon>
            Delete {{ selected.length }} item
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
            <template #[`item.name`]="{item}">
              <div class="mt-7 text-capitalize d-flex flex-nowrap">
                {{ item.name }}
              </div>
              <div class="bg-hover">
                <div class="d-flex flex-row flex-nowrap">
                  <div class="d-flex flex-column mt-1">
                    <a
                      color="transparent red--text"
                      small
                      text
                      @click="removeData(item)"
                    >
                      <v-icon
                        color="red"
                        small
                        class="ml-1"
                      >
                        mdi-delete
                      </v-icon>
                      Delete
                    </a>
                  </div>
                  <div class="d-flex flex-column mt-1">
                    <a
                      small
                      color="transparent"
                      text-color="blue"
                      @click="editItem(item)"
                    >
                      <v-icon
                        small
                        color="blue"
                        class="ml-1"
                      >
                        mdi-pencil
                      </v-icon>
                      Edit
                    </a>
                  </div>
                  <div class="d-flex flex-column mt-1">
                    <a
                      color="transparent"
                      small
                      text
                      @click="approveDataById(item)"
                    >
                      <v-icon
                        color="primary"
                        small
                        class="ml-1"
                      >
                        mdi-check-decagram
                      </v-icon>
                      Approve
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
                {{ item.isVerified === 1 ? 'Approved' : 'Not Approved' }}
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
        { text: 'Region', value: 'region', sortable: false },
        { text: 'Contact', value: 'contact', sortable: false },
        { text: 'Created At', value: 'created_at', sortable: false },
        { text: 'Approve', value: 'isVerified', sortable: false },
      // { text: 'author', value: 'isSubcribe', sortable: false },

      // { text: 'Actions', value: 'actions', align: 'start', justify: 'end' },
      ],
      selected: [],
      search: '',
    }),
    methods: {
      popUpDelete (item) {
        this.$emit('delete', { item: item })
      },
      popUpApproved (item) {
        this.$emit('approve', { item: item })
      },
      setColorAppoved (status) {
        if (status === 1) return 'primary'
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
    },
  }
</script>

<style></style>
