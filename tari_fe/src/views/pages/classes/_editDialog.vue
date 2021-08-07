<template>
  <v-dialog
    v-model="dialog.open"
    width="50%"
  >
    <base-material-card
      icon="mdi-eye"
      class="mt-12"
    >
      <template v-slot:heading>
        <v-chip color="transparent">
          <h3>
            Add Class
          </h3>
        </v-chip>
      </template>

      <v-form class="mt-4">
        <v-text-field
          v-model="dialog.name"
          label="Input Name"
          placeholder="Name"
          outlined
          dense
        />
        <v-select
          v-model="dialog.type"
          outlined
          label="Please choose Type"
          dense
          :items="itemsType"
        >
          <template
            slot="selection"
            slot-scope="data"
          >
            <slot
              name="item"
              v-bind="data"
            >
              <v-chip
                color="transparent"
                style="text-transdialog: capitalize"
              >
                <v-avatar left>
                  <v-img
                    src="https://sumedangtandang.com/upload/logo/logo_259.jpg"
                  />
                </v-avatar>
                {{ data.item }}
              </v-chip>
            </slot>
          </template>
          <template
            slot="item"
            slot-scope="data"
          >
            <slot
              name="item"
              v-bind="data"
            >
              <v-chip
                color="transparent"
                class="text-capitalize"
              >
                <v-avatar left>
                  <v-img
                    src="https://sumedangtandang.com/upload/logo/logo_259.jpg"
                  />
                </v-avatar>
                {{ data.item }}
              </v-chip>
            </slot>
          </template>
        </v-select>

        <v-select
          v-model="dialog.teacher_id"
          placeholder="Instructor"
          label="Please choose Instructor"
          outlined
          dense
          :items="instructor"
          item-text="firstName"
          item-value="id"
        >
          <template
            slot="selection"
            slot-scope="data"
          >
            <slot
              name="item"
              v-bind="data"
            >
              <v-chip
                color="transparent"
                style="text-transform: capitalize"
              >
                <v-avatar left>
                  <!-- <v-img
                    src="https://eshendetesia.com/images/user-profile.png"
                  /> -->
                  <span>{{
                    data.item.firstName.charAt(0) + data.item.lastName.charAt(0)
                  }}</span>
                </v-avatar>
                {{ data.item.firstName + ' ' + data.item.lastName }}
              </v-chip>
            </slot>
          </template>
          <template
            slot="item"
            slot-scope="data"
          >
            <slot
              name="item"
              v-bind="data"
            >
              <v-chip
                color="transparent"
                class="text-capitalize"
              >
                <v-avatar left>
                  <!-- <v-img
                    src="https://eshendetesia.com/images/user-profile.png"
                  /> -->
                  <span>{{
                    data.item.firstName.charAt(0) + data.item.lastName.charAt(0)
                  }}</span>
                </v-avatar>
                {{ data.item.firstName + ' ' + data.item.lastName }}
              </v-chip>
            </slot>
          </template>
        </v-select>
        <v-select
          v-model="dialog.status"
          label="Please choose Status"
          placeholder="Status"
          outlined
          dense
          :items="itemsStatus"
        >
          <template
            slot="selection"
            slot-scope="data"
          >
            <slot
              name="item"
              v-bind="data"
            >
              <v-chip
                color="transparent"
                style="text-transform: capitalize"
              >
                <v-avatar left>
                  <v-img
                    src="https://sumedangtandang.com/upload/logo/logo_259.jpg"
                  />
                </v-avatar>
                {{ data.item }}
              </v-chip>
            </slot>
          </template>
          <template
            slot="item"
            slot-scope="data"
          >
            <slot
              name="item"
              v-bind="data"
            >
              <v-chip
                color="transparent"
                class="text-capitalize"
              >
                <v-avatar left>
                  <v-img
                    src="https://sumedangtandang.com/upload/logo/logo_259.jpg"
                  />
                </v-avatar>
                {{ data.item }}
              </v-chip>
            </slot>
          </template>
        </v-select>

        <div class="d-flex flex-row-reverse">
          <div class="d-flex-flex-column">
            <v-btn
              color="pallet1"
              outlined
              @click="editClass"
            >
              Save
            </v-btn>
            <v-btn
              color="red"
              outlined
              class="ml-2"
              @click="dialog.open = false"
            >
              Close
            </v-btn>
          </div>
        </div>
      </v-form>
    </base-material-card>
  </v-dialog>
</template>

<script>
  export default {
    props: {
      dialog: {
        type: Object,
        default: () => ({
          open: false,
          id: 0,
          name: '',
          display_name: '',
          teacher_id: 0,
          status: '',
          type: '',
        }),
      },
      instructor: {
        type: Array,
        default: null,
      },
    },
    data: () => ({
      itemsStatus: ['publish', 'preview', 'concept'],
      itemsType: ['Live Class', 'Playlist'],
    }),
    methods: {
      editClass () {
        this.$emit('edit', { item: this.dialog })
      },
    },
  }
</script>

<style></style>
