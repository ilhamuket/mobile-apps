<template>
  <base-material-card icon="mdi-alpha-c-box">
    <template #after-heading>
      <span
        :class="
          $vuetify.theme.dark
            ? 'text-h3 white--text font-customize font-size-ather-roboto-mono-name-page'
            : 'text-h3 pallet1--text font-customize font-size-ather-roboto-mono-name-page'
        "
      >
        {{ computudTitle }}
      </span>
    </template>
    <v-container>
      <v-row>
        <v-col
          cols="12"
          md="4"
          class="mt-2"
        >
          <v-text-field
            v-model="search"
            append-icon="mdi-magnify"
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
            @click="upDialog"
          >
            <v-icon>
              mdi-plus
            </v-icon>
            Make Sub-Class
          </v-btn>
          <v-btn
            outlined
            color="primary"
            class="ml-2"
            @click="upDialog"
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
            @click="upDialogApproves(selected)"
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
            @click="upDialogDeletes(selected)"
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
            show-select
            :search="search"
            :headers="headers"
            :items="data"
          >
            <!-- Header -->
            <template #[`header.name`]="{ header }">
              {{ $t(header.text) }}
            </template>
            <template #[`header.levels`]="{ header }">
              {{ $t(header.text) }}
            </template>
            <template #[`header.studio.name`]="{ header }">
              {{ $t(header.text) }}
            </template>
            <template #[`header.created_at`]="{ header }">
              {{ $t(header.text) }}
            </template>
            <template #[`header.author.nickName`]="{ header }">
              {{ $t(header.text) }}
            </template>
            <template #[`header.status`]="{ header }">
              {{ $t(header.text) }}
            </template>

            <!-- Item -->
            <template #[`item.name`]="{item}">
              <div class="mt-6">
                {{ item.name }}
              </div>
              <div class="bg-hover">
                <div class="d-flex flex-row flex-nowrap">
                  <div>
                    <div class="d-flex flex-column flex-nowrap mt-2">
                      <a
                        class="font-a d-flex flex-nowrap"
                        @click="upDialogeditClass(item)"
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
                        @click="upDeleteClass(item)"
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
            </template>
            <template #[`item.levels`]="{item}">
              <v-chip
                label
                outlined
                :color="setColorLevels(item.levels)"
                class="text-capitalize chips--weight"
              >
                {{ item.levels }}
              </v-chip>
            </template>
            <template #[`item.status`]="{item}">
              <v-chip
                :color="setColorStatus(item.status)"
                label
                outlined
                class="chips--weight"
              >
                {{ item.status === 1 ? 'Approved' : 'Non-Approved' }}
              </v-chip>
            </template>
            <template #[`item.created_at`]="{item}">
              {{ item.created_at | moment('MMMM Do YYYY') }}
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
          text: 'table.class.th.name',
          align: 'start',
          sortable: false,
          value: 'name',
        },
        { text: 'table.class.th.levels', value: 'levels' },
        { text: 'table.class.th.studio', value: 'studio.name' },
        { text: 'table.class.th.created_at', value: 'created_at' },
        { text: 'table.class.th.author', value: 'author.nickName' },
        { text: 'table.class.th.status', value: 'status' },
      ],
      selected: [],
      search: '',
      dialogAdd: {},
    }),
    computed: {
      computudTitle () {
        let name = 'Index Class - All'
        if (this.$route.query.summary === 'all') {
          name = 'Index Class - All'
        }
        if (this.$route.query.summary === 'approved') {
          name = 'Index Class - Approved'
        }
        if (this.$route.query.summary === 'non-approved') {
          name = 'Index Class - Non Approved'
        }
        if (this.$route.query.summary === 'new') {
          name = 'Index Class - New'
        }
        return name
      },
    },
    methods: {
      setColorLevels (levels) {
        if (levels === 'Beginner' || levels === 'beginner') return 'red'
        if (levels === 'Advance') return 'secondary'
        if (levels === 'Intermediate') return 'pallet1'
      },
      setColorStatus (status) {
        if (status === 1) return 'primary'
        else return 'red'
      },
      upDialog () {
        this.$emit('add', { item: this.dialogAdd })
      },
      upDialogDeletes (item) {
        this.$emit('deletes', { item: item })
      },
      upDialogApproves (item) {
        this.$emit('approves', { item: item })
      },
      upDialogeditClass (item) {
        this.$emit('update', { item: item })
      },
      upDeleteClass (item) {
        this.$emit('del', { item: item })
      },
    },
  }
</script>

<style lang="sass" scoped>
// .font-customize
//   color:
</style>
