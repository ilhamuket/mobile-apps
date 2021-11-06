<template>
  <v-container>
    <v-dialog
      v-model="dialog.open"
      width="60%"
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
            Add Instructor
          </v-toolbar-title>

          <v-spacer />

          <v-icon @click="dialog.open = false">
            mdi-close
          </v-icon>
        </v-system-bar>
        <v-card-text>
          <v-container>
            <v-row>
              <v-col
                v-for="(item, i) in options"
                :key="i"
                cols="12"
              >
                <v-text-field
                  v-model="item.option"
                  placeholder="Url"
                  append-icon="mdi-close"
                  @click:append="closeURL"
                >
                  <template #prepend>
                    <v-icon color="red">
                      mdi-youtube
                    </v-icon>
                  </template>
                </v-text-field>
              </v-col>
              <v-col
                cols="12"
                md="4"
              >
                <v-btn
                  color="btn_primary"
                  small
                  @click="addUrl"
                >
                  <v-icon>mdi-plus</v-icon>
                </v-btn>
              </v-col>
              <v-col
                cols="12"
                md="8"
                class="d-flex flex-row-reverse"
              >
                <v-btn
                  color="btn_primary"
                  @click="save"
                >
                  Save
                </v-btn>
                <v-btn
                  color="red"
                  text
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
    },
    data: () => ({
      options: [
        {
          option: "",
        },
      ],
    }),
    methods: {
      addUrl () {
        this.options.push({ option: "" })
      },
      closeURL (i) {
        if (this.options.length > 1) {
          this.options.splice(i, 1)
        }
      },
      save () {
        this.$emit("input", { item: this.options })
      },
    },
  }
</script>

<style></style>
