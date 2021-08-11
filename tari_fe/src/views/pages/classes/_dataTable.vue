<template>
  <base-material-card
    icon="mdi-google-classroom"
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
            v-model="selected"
            :headers="headers"
            :items="data"
            :search="search"
            show-select
            :items-per-page="5"
            @input="selectItems"
          >
            <template v-slot:[`item.id`]="{ item }">
              <v-img
                v-if="item.posts"
                :src="item.posts.thumbnail_url"
                width="100"
              />
            </template>
            <template v-slot:[`item.display_name`]="{ item }">
              <div class="mt-9">
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
              <!-- <div class="bg-unHover">
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
              </div> -->
            </template>
            <template v-slot:[`item.status`]="{ item }">
              <span class="text-capitalize">
                {{ item.status }}
              </span>
            </template>

            <template v-slot:[`item.isVerified`]="{ item }">
              <v-chip
                class="text-capitalize"
                text-color="white"
                :color="getColorVerified(item.isVerified)"
              >
                {{ item.isVerified === 1 ? 'Verified' : 'UnVerified' }}
              </v-chip>
            </template>
            <template v-slot:[`item.type`]="{ item }">
              <div
                :color="setTypeColor(item.type)"
                class="text-capitalize"
              >
                {{ item.type }}
              </div>
            </template>
            <template v-slot:[`item.posts.type`]="{ item }">
              <v-chip
                :color="setColorLevel(item.posts.type)"
                class="text-capitalize"
              >
                <div>
                  {{ item.posts.type }}
                </div>
              </v-chip>
            </template>
            <template v-slot:[`item.created_at`]="{ item }">
              <v-chip color="transparent">
                {{ item.created_at | moment('D MMM YYYY') }}
              </v-chip>
            </template>
            <template v-slot:[`item.teacher.firstName`]="{ item }">
              <span
                v-if="item.teacher"
                color="transparent"
                class="text-capitalize"
              >
                {{ item.teacher.firstName + ' ' + item.teacher.lastName }}
              </span>
            </template>
            <template v-slot:[`item.posts.title_yt`]="{ item }">
              <v-tooltip
                bottom
                color="blue"
              >
                <template v-slot:activator="{ on, attrs }">
                  <!--  -->
                  <span
                    v-bind="attrs"
                    color="transparent"
                    style="cursor:pointer"
                    v-on="on"
                  >
                    {{ item.posts.title_yt.substr(0, 10) + '....' }}
                  </span>
                </template>
                <span>{{ item.posts.title_yt }}</span>
              </v-tooltip>
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
      computedTitle: {
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
          value: 'display_name',
          align: 'start',
        },
        { text: 'Status', value: 'status' },
        { text: 'Type', value: 'type' },
        { text: 'Levels', value: 'posts.type' },
        { text: 'Teacher', value: 'teacher.firstName' },
        { text: 'Vidio Title', value: 'posts.title_yt' },
        {
          text: 'Verification ',
          value: 'isVerified',
        },
        { text: 'Created At', value: 'created_at' },

      // { text: 'Actions', value: 'actions', align: 'start', justify: 'end' },
      ],
      active: false,
      dialog: {
        open: false,
      },
      dialogEdit: {
        open: false,
        id: 0,
        name: '',
        teacher_id: 0,
        type: '',
        status: '',
      },
      search: '',
      selected: [],
    }),
    // mounted () {},
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
        this.dialogEdit.id = item.id
        this.dialogEdit.name = item.name
        this.dialogEdit.teacher_id = item.teacher_id
        this.dialogEdit.type = item.type
        this.dialogEdit.status = item.status
        this.$emit('edit', { item: this.dialogEdit })
      },
      setColorStatus (status) {
        if (status === 'publish') return 'primary'
        if (status === 'preview') return 'info'
        if (status === 'concept') return 'warning'
      },
      setTypeColor (status) {
        if (status === 'Playlist') return '#36CE24'
        if (status === 'Live Class') return 'info'
      },
      setColorLevel (levels) {
        if (levels === 'intermediate') return 'primary'
        if (levels === 'beginner') return 'info'
        if (levels === 'advanced') return '#D0EF0B'
      },
      selectItems () {
        const id = this.selected
        if (id !== null) {
          const array = []
          id.forEach(e => array.push(e.id))
          console.log(array)
        }
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
.border
  background-color: red !important
</style>
