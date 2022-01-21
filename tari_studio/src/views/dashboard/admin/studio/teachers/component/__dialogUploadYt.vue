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
            class="font-spartan-small"
          >
            <v-icon :color="$vuetify.theme.dark ? 'white' : 'black'">
              mdi-youtube-subscription
            </v-icon>
            Add Vidio Profile
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
                v-for="(item, i) in data"
                :key="i"
                cols="12"
              >
                <v-text-field
                  v-model="item.url"
                  placeholder="Link Youtube Profile"
                  label="Vidio Profile"
                  append-icon="mdi-close"
                  @click:append="deleteForm(i)"
                >
                  <template #prepend>
                    <v-icon color="red">
                      mdi-youtube
                    </v-icon>
                  </template>
                </v-text-field>
              </v-col>
              <v-col cols="12">
                <v-btn
                  small
                  color="btn_primary"
                  @click="addForm"
                >
                  <v-icon> mdi-plus </v-icon>
                </v-btn>
              </v-col>
              <v-col
                cols="12"
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
      data: [
        {
          url: "",
        },
      ],
    }),
    methods: {
      save () {
        this.$emit("input", { item: this.data, id: this.dialog.data.id })
      },
      addForm () {
        this.data.push({ url: "" })
      },
      deleteForm (i) {
        if (this.data.length > 1) {
          this.data.splice(i, 1)
          const Toast = this.$swal.mixin({
            toast: true,
            position: "bottom-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.addEventListener("mouseenter", this.$swal.stopTimer)
              toast.addEventListener("mouseleave", this.$swal.resumeTimer)
            },
            popup: "swal2-show",
            backdrop: "swal2-backdrop-show",
            icon: "swal2-icon-show",
          })
          Toast.fire({
            icon: "success",
            title: "Delete Form Successfully",
          })
        } else {
          const Toast = this.$swal.mixin({
            toast: true,
            position: "bottom-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.addEventListener("mouseenter", this.$swal.stopTimer)
              toast.addEventListener("mouseleave", this.$swal.resumeTimer)
            },
            popup: "swal2-show",
            backdrop: "swal2-backdrop-show",
            icon: "swal2-icon-show",
          })
          Toast.fire({
            icon: "error",
            title: "Cannot delete form",
          })
        }
      },
    },
  }
</script>

<style></style>
