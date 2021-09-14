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
        <!-- {{ computudTitle }} -->
        {{ $t('index_class_data_table') }}
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
          <div class="ml-2">
            <v-menu offset-y>
              <template v-slot:activator="{ on, attrs }">
                <v-btn
                  color="btn_primary"
                  dark
                  v-bind="attrs"
                  outlined
                  v-on="on"
                >
                  <v-icon>mdi-chevron-down</v-icon>
                </v-btn>
              </template>
              <v-list>
                <v-list-item-group>
                  <v-list-item>
                    <v-list-item-action>
                      <v-btn
                        width="400"
                        outlined
                        color="btn_primary"
                      >
                        Export
                      </v-btn>
                    </v-list-item-action>
                  </v-list-item>
                </v-list-item-group>
              </v-list>
            </v-menu>
          </div>
          <v-btn
            outlined
            color="btn_primary"
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
            mobile-breakpoint="0"
          >
            <!-- Header -->
            <template #[`header.name`]="{ header }">
              {{ $t(header.text) }}
            </template>
            <template #[`header.levels`]="{ header }">
              {{ $t(header.text) }}
            </template>
            <template #[`header.harga`]="{ header }">
              {{ $t(header.text) }}
            </template>
            <template #[`header.created_at`]="{ header }">
              {{ $t(header.text) }}
            </template>
            <template #[`header.kapasitas`]="{ header }">
              {{ $t(header.text) }}
            </template>
            <template #[`header.status`]="{ header }">
              {{ $t(header.text) }}
            </template>
            <template #[`header.category.name`]="{ header }">
              {{ $t(header.text) }}
            </template>
            <template #[`header.durasi`]="{ header }">
              {{ $t(header.text) }}
            </template>
            <template #[`header.keyword`]="{ header }">
              {{ $t(header.text) }}
            </template>

            <!-- Item -->
            <template #[`item.img.url`]="{item}">
              <v-img
                v-if="item.img"
                :src="item.img.url"
                width="100"
                height="100"
              />
            </template>
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
                    <div class="d-flex flex-column mt-2 ml-1 mr-1">
                      <a
                        class="d-flex blue--text flex-nowrap"
                        @click="upInfoClass(item)"
                      >
                        <v-icon
                          color="blue"
                          small
                        >
                          mdi-eye
                        </v-icon>
                        Info
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
                text-color="white"
                :color="setColorLevels(item.levels)"
                class="text-capitalize chips--weight"
              >
                {{ item.levels }}
              </v-chip>
            </template>
            <template #[`item.keyword`]="{item}">
              <span>{{ item.keyword ? item.keyword : '-' }}</span>
            </template>
            <template #[`item.status`]="{item}">
              <v-chip
                :color="setColorStatus(item.status)"
                label
                text-color="white"
                class="chips--weight"
              >
                {{ item.status }}
              </v-chip>
            </template>
            <template #[`item.kapasitas`]="{item}">
              <v-chip
                label
                color="primary"
              >
                0 / {{ item.kapasitas }}
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
          text: '#',
          value: 'img.url',
        },
        {
          text: 'table.class.th.name',
          align: 'start',
          sortable: false,
          value: 'name',
        },
        { text: 'table.class.th.levels', value: 'levels' },
        { text: 'table.class.th.price', value: 'harga' },
        { text: 'table.class.th.category', value: 'category.name' },
        // { text: 'table.class.th.created_at', value: 'created_at' },
        { text: 'table.class.th.prefix', value: 'keyword' },
        { text: 'table.class.th.capacity', value: 'kapasitas' },
        { text: 'table.class.th.duration', value: 'durasi' },
        { text: 'table.class.th.status', value: 'status' },
      ],
      selected: [],
      search: '',
      dialogAdd: {},
    }),
    computed: {
      computudTitle () {
        let name = 'Class - All'
        if (this.$route.query.summary === 'all') {
          name = 'Class - All'
        }
        if (this.$route.query.summary === 'approved') {
          name = 'Class - Approved'
        }
        if (this.$route.query.summary === 'non-approved') {
          name = 'Class - Non Approved'
        }
        if (this.$route.query.summary === 'new') {
          name = 'Class - New'
        }
        return name
      },
    },
    methods: {
      setColorLevels (levels) {
        if (levels === 'Beginner' || levels === 'beginner') return 'pallet1'
        if (levels === 'Advance') return 'secondary'
        if (levels === 'Intermediate') return 'btn_primary'
      },
      setColorStatus (status) {
        if (status === 'Publish') return 'btn_primary'
        if (status === 'Draft') return 'blue'
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
      upInfoClass (item) {
        this.$emit('info', { item: item })
      },
    },
  }
</script>

<style lang="sass" scoped>
// .font-customize
//   color:
</style>
