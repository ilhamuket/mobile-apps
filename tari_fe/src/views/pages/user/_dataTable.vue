<template>
  <base-material-card icon="mdi-account-group-outline">
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

        <v-col cols="12">
          <v-data-table
            :items="data"
            :headers="headers"
            show-select
            :search="search"
            :sort-desc="false"
          >
            <template v-slot:[`item.id`]="{ item }">
              {{
                data
                  .map(x => {
                    return x.id
                  })
                  .indexOf(item.id) + 1
              }}
            </template>
            <template v-slot:[`item.firstName`]="{ item }">
              <div class="mt-9 text-capitalize d-flex flex-nowrap">
                {{ item.firstName + ' ' + item.lastName }}
              </div>

              <div class="bg-hover">
                <div class="d-flex flex-row flex-nowrap">
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
                      @click="removeData(item)"
                    >
                      <v-icon
                        color="primary"
                        small
                        class="ml-1"
                      >
                        mdi-check-decagram
                      </v-icon>
                      Verification
                    </a>
                  </div>
                </div>
              </div>
            </template>
            <template #[`item.nickName`]="{item}">
              <v-tooltip
                v-if="item.nickName.length > 10"
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
                    {{ item.nickName.substr(0, 10) + '....' }}
                  </span>
                </template>
                <span>{{ item.nickName }}</span>
              </v-tooltip>
              <span v-else>{{ item.nickName }}</span>
            </template>

            <template #[`item.email`]="{item}">
              <v-tooltip
                v-if="item.email.length > 10"
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
                    {{ item.email.substr(0, 10) + '....' }}
                  </span>
                </template>
                <span>{{ item.email }}</span>
              </v-tooltip>
              <span v-else>{{ item.email }}</span>
            </template>
            <template v-slot:[`item.noHp`]="{ item }">
              {{ item.noHp === null ? '-' : item.noHp }}
            </template>
            <template v-slot:[`item.role`]="{ item }">
              <div v-if="item.roles">
                <v-list-item
                  v-for="role in item.roles"
                  :key="role.id"
                >
                  <v-chip
                    :text-color="$vuetify.theme.dark ? 'black' : ''"
                    :color="setColorRoleName(role.name)"
                    class="text-capitalize"
                    v-text="role.name"
                  />
                </v-list-item>
              </div>
            </template>
            <template v-slot:[`item.isVerified`]="{ item }">
              <v-chip :color="setColorVerification(item.isVerified)">
                {{ item.isVerified !== 0 ? 'Verified' : 'UnVerified' }}
              </v-chip>
            </template>
            <template v-slot:[`item.isSubcribe`]="{ item }">
              <v-chip :color="setColorSubcribe(item.isSubcribe)">
                {{ item.isSubcribe !== 0 ? 'Subcribe' : 'unsubscribe' }}
              </v-chip>
            </template>
            <template v-slot:[`item.created_at`]="{ item }">
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
      computedTitle: {
        type: String,
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
          text: 'Fullname',
          value: 'firstName',
          sortable: false,
        },
        { text: 'Email', value: 'email', sortable: false },
        { text: 'UserName', value: 'nickName' },
        { text: 'Number Phone', value: 'noHp', sortable: false },
        { text: 'Role Name', value: 'role', sortable: false },
        { text: 'Created At', value: 'created_at', sortable: false },
        { text: 'Verification', value: 'isVerified', sortable: false },
        { text: 'Subcription', value: 'isSubcribe', sortable: false },

      // { text: 'Actions', value: 'actions', align: 'start', justify: 'end' },
      ],
      dialogEdit: {
        id: 0,
      },
      search: '',
    }),
    mounted () {},
    methods: {
      setColorVerification (status) {
        if (status === 1) return 'primary'
        if (status === 0) return '#F44336'
      },
      setColorSubcribe (status) {
        if (status === 1) return 'primary'
        if (status === 0) return '#F44336'
      },
      setColorRoleName (name) {
        if (name === 'superadministrator') return '#81F109'
        if (name === 'administrator') return '#529A27'
        if (name === 'instructor') return '#DF0EE5'
      },
      editItem (item) {},
    },
  }
</script>

<style lang="sass" scoped></style>
