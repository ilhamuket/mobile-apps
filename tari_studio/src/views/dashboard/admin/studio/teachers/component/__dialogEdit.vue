<template>
  <v-container>
    <v-dialog
      v-model="dialog.open"
      width="90%"
    >
      <v-card>
        <v-system-bar
          :color="$vuetify.theme.dark ? '#141C31' : '#F0F8FF'"
          window
        >
          <v-toolbar-title
            :class="$vuetify.theme.dark ? 'white--text' : ' black--text'"
            class="font-spartan-small"
          >
            <v-icon :color="$vuetify.theme.dark ? 'white' : 'black'">
              mdi-pencil
            </v-icon>
            Edit Instructor
          </v-toolbar-title>

          <v-spacer />

          <v-icon @click="dialog.open = false">
            mdi-close
          </v-icon>
        </v-system-bar>
        <v-card-text>
          <v-row>
            <v-col cols="12">
              <v-text-field
                v-model="dialog.name"
                label="Name"
                placeholder="Input FullName"
                prepend-icon="mdi-rename-box"
                clearable
              />
            </v-col>
            <v-col cols="12">
              <v-text-field
                v-model="dialog.email"
                type="email"
                label="Name"
                placeholder="Input FullName"
                prepend-icon="mdi-at"
                clearable
              />
            </v-col>
            <v-col cols="12">
              <v-select
                v-model="dialog.region"
                :items="itemRegion"
                label="Region"
                placeholder="Input Region"
                clearable
                prepend-icon="mdi-map-marker"
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
                prepend-icon="mdi-phone"
                clearable
              />
            </v-col>
            <v-col cols="12">
              <v-text-field
                v-model="dialog.profession"
                type="Profession"
                label="Profession"
                placeholder="Input Profession"
                prepend-icon="mdi-professional-hexagon"
                clearable
              />
            </v-col>
            <v-col cols="12">
              <v-text-field
                v-model="dialog.username_fb"
                type="Username Fb"
                label="Username Fb"
                placeholder="Input Username Fb"
                clearable
              >
                <template #prepend>
                  <v-icon color="blue">
                    mdi-facebook
                  </v-icon>
                </template>
              </v-text-field>
            </v-col>
            <v-col cols="12">
              <v-text-field
                v-model="dialog.username_ig"
                type="username Instagram"
                label="username Instagram"
                placeholder="Input username Instagram"
                clearable
              >
                <template #prepend>
                  <v-icon color="red">
                    mdi-instagram
                  </v-icon>
                </template>
              </v-text-field>
            </v-col>
            <v-col cols="12">
              <v-text-field
                v-model="dialog.username_tw"
                type="username Twitter"
                label="username Twitter"
                placeholder="Input username Twitter"
                clearable
              >
                <template #prepend>
                  <v-icon color="blue">
                    mdi-twitter
                  </v-icon>
                </template>
              </v-text-field>
            </v-col>
            <v-col cols="12">
              <v-textarea
                v-model="dialog.about"
                type="About"
                label="About"
                placeholder="Input About"
                prepend-icon="mdi-information-variant"
                clearable
              />
            </v-col>
          </v-row>
        </v-card-text>
        <v-card-actions class="d-flex flex-row-reverse mb-2 mr-2">
          <div class="d-flex flex-column">
            <v-btn
              color="btn_primary"
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
  import database from "../database/city.json"
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
        this.$emit("input", { item: this.dialog })
      },
    },
  }
</script>

<style></style>
