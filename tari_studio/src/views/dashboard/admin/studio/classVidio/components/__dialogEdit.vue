<template>
  <v-container>
    <v-dialog
      v-model="dialog.open"
      width="70%"
    >
      <v-card>
        <v-system-bar
          :color="$vuetify.theme.dark ? '#141C31' : '#F0F8FF'"
          window
        >
          <v-toolbar-title
            :class="$vuetify.theme.dark ? 'white--text' : ' black--text'"
          >
            <v-icon :color="color">
              {{ icon }}
            </v-icon>
            <span class="font-spartan-small">
              {{ $t(title) }}
            </span>
          </v-toolbar-title>

          <v-spacer />

          <v-icon @click="dialog.open = false">
            mdi-close
          </v-icon>
        </v-system-bar>
        <v-card-text>
          <v-container>
            <v-row>
              <v-col cols="12">
                <v-text-field
                  v-model="dialog.data.name"
                  label="Name"
                  placeholder="Name"
                  prepend-icon="mdi-alpha-n-circle-outline"
                />
              </v-col>
              <v-col cols="12">
                <v-select
                  v-model="dialog.data.levels"
                  prepend-icon="mdi-alpha-l-circle-outline"
                  label="Levels"
                  :items="itemLevels"
                  placeholder="Input levels"
                />
              </v-col>
              <v-col cols="12">
                <v-text-field
                  v-model="dialog.data.duration"
                  prepend-icon="mdi-av-timer"
                  type="number"
                  label="Duration (Minutes)"
                  placeholder="Duration"
                />
              </v-col>
              <v-col cols="12">
                <v-text-field
                  v-model="dialog.data.price"
                  prepend-icon="mdi-cash"
                  type="number"
                  label="Price (Rp)"
                  placeholder="Price"
                />
              </v-col>
              <v-col cols="12">
                <v-select
                  v-model="dialog.data.category_id"
                  prepend-icon="mdi-alpha-c-circle-outline"
                  label="Category"
                  :items="category"
                  placeholder="Input Category"
                  item-text="name"
                  item-value="id"
                />
              </v-col>
              <v-col cols="12">
                <v-textarea
                  v-model="dialog.data.note"
                  prepend-icon="mdi-alpha-n-circle-outline"
                  label="Note"
                  placeholder="Input Note"
                />
              </v-col>
              <v-col cols="12">
                <v-textarea
                  v-model="dialog.data.about"
                  prepend-icon="mdi-alpha-l-circle-outline"
                  label="About"
                  placeholder="Input About"
                />
              </v-col>
              <v-col
                cols="12"
                class="d-flex flex-row-reverse"
              >
                <v-btn
                  color="btn_primary"
                  @click="update"
                >
                  Update
                </v-btn>
                <v-btn
                  text
                  color="red"
                  @click="dialog.open = false"
                >
                  Cancel
                </v-btn>
              </v-col>
            </v-row>
          </v-container>
        </v-card-text>
      </v-card>
    </v-dialog>
  </v-container>
</template>

<script>
  export default {
    props: {
      dialog: {
        type: Object,
        default: null,
      },
      icon: {
        type: String,
        default: "mdi-publish",
      },
      color: {
        type: String,
        default: "blue",
      },
      title: {
        type: String,
        default: "Title",
      },
      category: {
        type: Array,
        default: null,
      },
    },
    data: () => ({
      itemLevels: ["intermediate", "advance", "beginner"],
    }),
    methods: {
      update () {
        this.$emit("input", { item: this.dialog.data })
      },
    },
  }
</script>

<style></style>
