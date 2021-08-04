<template>
  <v-dialog
    v-model="dialog.open"
    width="50%"
  >
    <base-material-card
      icon="mdi-eye"
      class="mt-5"
      color="pallet1"
    >
      <template v-slot:heading>
        <v-chip color="transparent">
          <h2>
            Tambah Data
          </h2>
        </v-chip>
      </template>

      <v-text-field
        v-model="form.name"
        label="Input Name"
        placeholder="name"
        dense
        outlined
        color="pallet1"
        prepend-icon="mdi-rename-box"
      />

      <v-select
        v-model="form.status"
        label="Input Status"
        placeholder="status"
        outlined
        dense
        :items="items"
        item-color="pallet1"
        color="pallet1"
        prepend-icon="mdi-list-status"
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
          @click="insertData"
        >
          Save
        </v-btn>
      </v-card-actions>
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
        }),
      },
    },
    data: () => ({
      items: ['publish', 'preview', 'concept'],
      form: {
        name: '',
        status: '',
      },
    }),
    methods: {
      insertData () {
        this.$emit('input', { item: this.form })
      },
    },
  }
</script>

<style></style>
