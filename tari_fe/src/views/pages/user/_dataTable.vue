<template>
  <base-material-card icon="mdi-account-group-outline">
    <template v-slot:after-heading>
      <h2 :class="$vuetify.theme.dark ? 'text--white' : 'text--pallet1'">
        Users
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

        <v-col cols="12">
          <v-data-table
            :items="data"
            :headers="headers"
            show-select
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
              <div class="mt-9 text-capitalize">
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
                        color="red"
                        small
                        class="ml-1"
                      >
                        mdi-delete
                      </v-icon>
                      Delete
                    </a>
                  </div>
                </div>
              </div>
              <div class="bg-unHover">
                <div class="d-flex flex-row flex-nowrap">
                  <div class="d-flex flex-column mt-1">
                    <a
                      small
                      color="transparent"
                      text-color="blue"
                      @click="editItem(item)"
                    />
                  </div>
                  <div class="d-flex flex-column mt-1">
                    <a
                      color="transparent"
                      small
                      text
                      @click="removeData(item)"
                    />
                  </div>
                </div>
              </div>
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
        },
        { text: 'Email', value: 'email' },
        { text: 'Number Phone', value: 'noHp' },
        { text: 'Role Name', value: 'role' },
        { text: 'Created At', value: 'created_at' },
        { text: 'Verification', value: 'isVerified' },
        { text: 'Subcription', value: 'isSubcribe' },

      // { text: 'Actions', value: 'actions', align: 'start', justify: 'end' },
      ],
      dialogEdit: {
        id: 0,
      },
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
        if (name === 'superadmin') return '#E33219'
        if (name === 'admin') return '#529A27'
        if (name === 'instructor') return '#163BD3'
      },
      editItem (item) {},
    },
  }
</script>

<style lang="sass" scoped></style>
