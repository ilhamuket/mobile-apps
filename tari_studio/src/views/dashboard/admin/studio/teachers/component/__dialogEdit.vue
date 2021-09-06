<template>
  <v-container>
    <v-dialog
      v-model="dialog.open"
      width="90%"
    >
      <v-card>
        <v-card-title class="text-h2 pallet1--text font-title-rampart-one">
          Edit Instructor

          <v-spacer />

          <v-icon
            aria-label="Close"
            @click="dialog.open = false"
          >
            mdi-close
          </v-icon>
        </v-card-title>
        <v-card-text>
          <v-row>
            <v-col cols="12">
              <v-text-field
                v-model="dialog.name"
                label="Name"
                placeholder="Input FullName"
                clearable
              />
            </v-col>
            <v-col cols="12">
              <v-text-field
                v-model="dialog.email"
                type="email"
                label="Name"
                placeholder="Input FullName"
                clearable
              />
            </v-col>
            <v-col cols="12">
              <v-select
                v-model="dialog.region"
                :items="itemRegion"
                label="Name"
                placeholder="Input FullName"
                clearable
                item-text="name"
                item-value="name"
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
                      color="primary"
                      label
                      style="text-transform: uppercase"
                    >
                      <v-icon class="mr-2">
                        mdi-map-marker
                      </v-icon>
                      {{ data.item.name }}
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
                      class="text-uppercase"
                    >
                      <!-- <v-avatar left>
                        <v-img :src="data.item.img" />
                      </v-avatar> -->
                      {{ data.item.name }}
                    </v-chip>
                  </slot>
                </template>
              </v-select>
            </v-col>
            <v-col cols="12">
              <v-text-field
                v-model="dialog.contact"
                type="Contact"
                label="Contact"
                placeholder="Input Contact"
                clearable
              />
            </v-col>
            <v-col cols="12">
              <v-text-field
                v-model="dialog.profession"
                type="Contact"
                label="Contact"
                placeholder="Input Contact"
                clearable
              />
            </v-col>
            <v-col cols="12">
              <v-textarea
                v-model="dialog.about"
                type="Contact"
                label="Contact"
                placeholder="Input Contact"
                clearable
              />
            </v-col>
          </v-row>
        </v-card-text>
        <v-card-actions class="d-flex flex-row-reverse mb-2 mr-2">
          <div class="d-flex flex-column">
            <v-btn
              outlined
              color="primary"
              @click="editData"
            >
              Update
            </v-btn>
          </div>
          <div class="d-flex flex-column">
            <v-btn
              text
              color="red"
              @click="dialog.open = false"
            >
              Cancel
            </v-btn>
          </div>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-container>
</template>

<script>
  import database from '../database/city.json'
  export default {
    props: {
      dialog: {
        type: Object,
        default: null,
      },
    },
    data: () => ({
      itemRegion: database,
    }),
    methods: {
      editData () {
        this.$emit('input', { item: this.dialog })
      },
    },
  }
</script>

<style></style>
