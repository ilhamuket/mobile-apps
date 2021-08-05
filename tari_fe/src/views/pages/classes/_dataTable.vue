<template>
  <base-material-card
    icon="mdi-google-classroom"
    color="pallet1"
  >
    <template v-slot:after-heading>
      <v-chip
        color="transparent"
        :text-color="$vuetify.theme.dark ? 'white' : 'pallet1'"
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
        >
          <v-btn
            outlined
            :color="$vuetify.theme.dark ? 'white' : 'pallet1'"
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
            <template v-slot:[`item.display_name`]="{ item }">
              <v-chip color="transparent">
                {{ item.display_name }}
              </v-chip>
            </template>
            <template v-slot:[`item.status`]="{ item }">
              <v-chip
                class="text-capitalize"
                color="transparent"
                text-color="pallet1"
              >
                {{ item.status }}
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
              <v-chip
                color="transparent"
                class="text-capitalize"
              >
                {{ item.type }}
              </v-chip>
            </template>
            <template v-slot:[`item.created_at`]="{ item }">
              <v-chip color="transparent">
                {{ item.created_at | moment('D MMM YYYY') }}
              </v-chip>
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
            <template v-slot:[`item.posts.title_yt`]="{ item }">
              <v-chip color="transparent">
                {{ item.posts.title_yt }}
              </v-chip>
            </template>
            <template v-slot:[`item.actions`]="{ item }">
              <v-chip color="transparent">
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
          align: 'start',
        },
        {
          text: 'Name',
          value: 'display_name',
        },
        { text: 'Status', value: 'status' },
        { text: 'Type', value: 'type' },
        { text: 'Teacher', value: 'teacher.firstName' },
        { text: 'Vidio Title', value: 'posts.title_yt' },
        {
          text: 'Verification ',
          value: 'isVerified',
        },
        { text: 'Created At', value: 'created_at' },

        { text: 'Actions', value: 'actions', align: 'start', justify: 'end' },
      ],
      dialog: {
        open: false,
      },
      dialogEdit: {
        open: false,
        name: '',
        teacher_id: 0,
        type: '',
        status: '',
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
      editItem (item) {
        this.dialogEdit.open = true
        this.dialogEdit.name = item.name
        this.dialogEdit.teacher_id = item.teacher_id
        this.dialogEdit.type = item.type
        this.dialogEdit.status = item.status
        this.$emit('edit', { item: this.dialogEdit })
      },
    },
  }
</script>

<style lang="sass">

::-webkit-scrollbar
  height: 7px
  width: 4px
  border: 1px solid #d5d5d5

::-webkit-scrollbar-track .theme-dark
  border-radius: 0
  background: #eeeeee

::-webkit-scrollbar-thumb
  border-radius: 0
  background: #b0b0b0
</style>
