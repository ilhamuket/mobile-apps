<template>
  <base-material-card icon="mdi-notebook-multiple">
    <template #after-heading>
      <h2 :class="$vuetify.theme.dark ? 'text--white' : 'text--pallet1'">
        Journal
      </h2>
    </template>

    <v-container>
      <v-row>
        <v-col
          cols="12"
          md="4"
        >
          <v-text-field
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
            to="/journal/create"
            outlined
            color="primary"
          >
            <v-icon>
              mdi-plus
            </v-icon>
            Add Journal
          </v-btn>
          <v-btn
            :disabled="selected.length === 0"
            class="mr-2"
            outlined
            color="blue"
            @click="popUpApproved(selected)"
          >
            Approve {{ selected.length }} Journal
          </v-btn>
          <v-btn
            :disabled="selected.length === 0"
            class="mr-2"
            outlined
            color="red"
            @click="popUpDelete(selected)"
          >
            Delete {{ selected.length }} Journal
          </v-btn>
        </v-col>
        <v-col cols="12">
          <v-data-table
            v-model="selected"
            :headers="headers"
            :items="data"
            show-select
          >
            <template #[`item.id`]="{item}">
              <v-img
                :src="item.thumbnail_url"
                width="100"
                height="80"
              />
            </template>
            <template #[`item.title`]="{item}">
              <div
                v-if="item.title.length < 15"
                class="text-capitalize mt-7"
              >
                {{ item.title }}
              </div>
              <div
                v-else
                class="text-capitalize mt-7"
              >
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
                      {{ item.title.substr(0, 25) + '....' }}
                    </span>
                  </template>
                  <span>{{ item.title }}</span>
                </v-tooltip>
                <!-- {{ item.title.substr(0, 15) + '....' }} -->
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
                      @click="toEdit(item)"
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
                      @click="toSee(item)"
                    >
                      <v-icon
                        color="primary"
                        small
                        class="ml-1"
                      >
                        mdi-eye
                      </v-icon>
                      See
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
            <template #[`item.author.firstName`]="{item}">
              <span
                v-if="item.author"
                class="text-capitalize"
              >
                {{ item.author.firstName + ' ' + item.author.lastName }}
              </span>
            </template>
            <template #[`item.isVerified`]="{item}">
              <v-chip :color="setColorAppoved(item.isVerified)">
                {{ item.isVerified !== 0 ? 'Approve' : 'Not Approved' }}
              </v-chip>
            </template>
            <template #[`item.status`]="{item}">
              <v-chip
                :color="setColorStatus(item.status)"
                class="text-capitalize"
              >
                {{ item.status }}
              </v-chip>
            </template>
            <template #[`item.created_at`]="{ item }">
              {{ item.created_at | moment('D MMM YYYY') }}
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
        { text: '#', value: 'id' },
        { text: 'Title', value: 'title' },
        { text: 'Author', value: 'author.firstName' },
        { text: 'Studio', value: 'studio.name' },
        { text: 'Approve', value: 'isVerified' },
        { text: 'Status', value: 'status' },
        { text: 'Views', value: 'views' },
        { text: 'Created_at', value: 'created_at' },
      ],
      selected: [],
    }),
    computed: {},
    mounted () {},
    methods: {
      setColorStatus (status) {
        if (status === 'preview') return 'info'
        if (status === 'publish') return 'primary'
        if (status === 'concept') return 'pallet1'
      },
      setColorAppoved (status) {
        if (status === 1) return 'primary'
        else return 'red'
      },
      toEdit (item) {
        this.$router.push(`journal/${item.id}/edit`)
      },
      toSee (item) {
        this.$router.push(`journal/${item.id}/show`)
      },
      popUpDelete (item) {
        this.$emit('delete', { item: item })
      },
      popUpApproved (item) {
        this.$emit('approve', { item: item })
      },
      approveDataById (item) {
        this.$emit('approveById', { item: item })
      },
      removeData (item) {
        this.$emit('deleteById', { item: item })
      },
    },
  }
</script>

<style></style>
