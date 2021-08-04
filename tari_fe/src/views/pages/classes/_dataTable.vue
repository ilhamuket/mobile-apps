<template>
  <base-material-card
    icon="mdi-google-classroom"
    color="pallet1"
  >
    <template v-slot:after-heading>
      <v-chip
        color="transparent"
        text-color="pallet1"
      >
        <h1>
          Class - All
        </h1>
      </v-chip>
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
          md="1"
          offset-md="6"
          class="mr-4 large"
        >
          <v-btn
            outlined
            color="pallet1"
            @click="openDialog"
          >
            Add Class
          </v-btn>
        </v-col>
        <v-col cols="12">
          <v-data-table
            :headers="headers"
            :items="data"
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
            <template v-slot:[`item.status`]="{ item }">
              <v-chip
                class="text-capitalize"
                color="transparent"
                text-color="pallet1"
              >
                <h3>
                  {{ item.status }}
                </h3>
              </v-chip>
            </template>
            <template v-slot:[`item.isVerified`]="{ item }">
              <v-chip
                outlined
                class="text-capitalize"
                :color="getColorVerified(item.isVerified)"
              >
                {{ item.isVerified === 1 ? 'Verified' : 'UnVerified' }}
              </v-chip>
            </template>
            <template v-slot:[`item.type`]="{ item }">
              <span class="text-capitalize">
                {{ item.type }}
              </span>
            </template>
            <template v-slot:[`item.created_at`]="{ item }">
              {{ item.created_at | moment('D MMM YYYY') }}
            </template>
            <template v-slot:[`item.teacher.firstName`]="{ item }">
              <v-chip
                v-if="item.teacher"
                color="transparent"
                class="text-capitalize"
              >
                {{ item.teacher.firstName + ' ' + item.teacher.lastName }}
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
        { text: 'Type', value: 'type' },
        { text: 'Teacher', value: 'teacher.firstName' },
        { text: 'Vidio Title', value: 'posts.title_yt' },
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
      search: '',
    }),
    methods: {
      getColorVerified (verified) {
        if (verified === 1) return 'primary'
        else return 'red'
      },
      removeData (item) {
        this.$emit('remove', { item: item })
      },
      openDialog () {
        this.dialog.open = !this.dialog.open
        this.$emit('open', { item: this.dialog })
      },
    },
  }
</script>

<style></style>
