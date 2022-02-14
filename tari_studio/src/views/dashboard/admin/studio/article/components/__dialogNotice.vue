<template>
  <v-dialog
    v-model="dialog.open"
    width="70%"
  >
    <v-card>
      <base-system
        :icon="iconSystemBar"
        :title="titleSystemBar"
        :color="colorSystemBar"
        @close="dialog.open = false"
      />
      <v-card-text>
        <v-container>
          <v-row>
            <v-col cols="12">
              <span class="font-spartan">
                {{ title }} - {{ isDataArray ? "" : dialog.data.title }}</span>
              <ol
                v-if="isDataArray"
                class="list-decimal"
              >
                <li
                  v-for="(item, i) in dialog.data"
                  :key="i"
                >
                  {{ item.title }} - {{ item.views }} - {{ item.status }}
                </li>
              </ol>
            </v-col>
          </v-row>
        </v-container>
      </v-card-text>
      <v-card-actions class="d-flex justify-end">
        <v-btn
          outlined
          color="red"
          @click="dialog.open = false"
        >
          Cancel
        </v-btn>
        <v-btn
          class=""
          color="btn_primary"
          @click="deletesData"
        >
          {{ nameButton }}
        </v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
  export default {
    props: {
      dialog: {
        type: Object,
        default: null,
      },
      title: {
        type: String,
        default: "",
      },
      titleSystemBar: {
        type: String,
        default: "",
      },
      colorSystemBar: {
        type: String,
        default: "",
      },
      iconSystemBar: {
        type: String,
        default: "",
      },
      nameButton: {
        type: String,
        default: "",
      },
      isDataArray: {
        type: Boolean,
        default: true,
      },
    },
    methods: {
      deletesData () {
        this.$emit("input", { item: this.dialog.data })
      },
    },
  }
</script>

<style></style>
