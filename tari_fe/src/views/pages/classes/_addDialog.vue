<template>
  <v-dialog
    v-model="dialog.open"
    width="50%"
  >
    <base-material-card
      icon="mdi-eye"
      class="mt-5"
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
          label="Input Name"
          placeholder="Name"
          outlined
          dense
        />
        <v-select
          placeholder="Instructor"
          label="Please choose "
          outlined
          dense
        />
        <v-select
          label="Please choose"
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
        <v-select
          outlined
          label="Please choose"
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
        <v-card-actions>
          <v-spacer />
          <v-btn
            color="red"
            outlined
            @click="dialog.open = false"
          >
            Close
          </v-btn>
          <v-btn
            color="pallet1"
            outlined
          >
            Save
          </v-btn>
        </v-card-actions>
      </v-form>
    </base-material-card>
  </v-dialog>
</template>

<script>
  export default {
    props: {
      dialog: {
        type: Object,
        default: null,
      },
    },
    data: () => ({
      itemsStatus: ['publish', 'preview', 'concept'],
      itemsType: ['Live Class', 'Playlist'],
    }),
  }
</script>

<style></style>
