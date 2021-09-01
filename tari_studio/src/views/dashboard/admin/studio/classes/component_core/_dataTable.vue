<template>
  <base-material-card icon="mdi-book-variant">
    <template #after-heading>
      <span
        class="text-h3 pallet1--text font-customize font-size-ather-roboto-mono-name-page"
      >
        Index Class
      </span>
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
            @click="upDialog"
          >
            <v-icon>
              mdi-plus
            </v-icon>
            Make Schedules
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
            <template #[`item.name`]="{item}">
              <div class="pallet1--text mt-6">
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
                :color="setColorLevels(item.levels)"
                class="text-capitalize"
              >
                {{ item.levels }}
              </v-chip>
            </template>
            <template #[`item.status`]="{item}">
              <v-chip
                :color="setColorStatus(item.status)"
                label
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
          text: 'Name',
          align: 'start',
          sortable: false,
          value: 'name',
        },
        { text: 'Levels', value: 'levels' },
        { text: 'Studio', value: 'studio.name' },
        { text: 'Created_at', value: 'created_at' },
        { text: 'Author', value: 'author.nickName' },
        { text: 'Status', value: 'status' },
      ],
      selected: [],
      search: '',
      dialogAdd: {},
    }),
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
