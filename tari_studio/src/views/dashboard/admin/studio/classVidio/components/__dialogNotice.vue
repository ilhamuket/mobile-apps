<template>
  <v-container>
    <v-dialog v-model="dialog.open">
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
        <v-card-text v-if="isPublish">
          {{ $t("card_notice.publish_class") }}
          <v-list-item
            v-for="n in dialog.data"
            :key="n.id"
          >
            <v-list-item-avatar tile>
              <v-img
                :src="n.url_thumbnail"
                width="120"
              />
            </v-list-item-avatar>
            <v-list-item-content>
              <v-list-item-title>
                {{ n.name }} -
                <v-chip
                  class="text-capitalize"
                  :color="setColorStatus(n.levels)"
                  text-color="white"
                >
                  {{ n.levels }}
                </v-chip>
              </v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </v-card-text>
        <v-card-text v-if="isHide">
          {{ $t("card_notice.hide") }} #{{ dialog.data.name }}
        </v-card-text>
        <v-card-text v-if="isDelete">
          {{ $t("card_notice.delete_class_vidio") }}
          <v-list-item
            v-for="n in dialog.data"
            :key="n.id"
          >
            <v-list-item-avatar tile>
              <v-img
                :src="n.url_thumbnail"
                width="120"
              />
            </v-list-item-avatar>
            <v-list-item-content>
              <v-list-item-title>
                {{ n.name }} -
                <v-chip
                  class="text-capitalize"
                  :color="setColorStatus(n.levels)"
                  text-color="white"
                >
                  {{ n.levels }}
                </v-chip>
              </v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </v-card-text>
        <v-card-text v-if="isDeleteById">
          {{ $t("card_notice.delete_class_vidio") }} #{{ dialog.data.name }}
        </v-card-text>
        <v-card-actions
          v-if="isPublish"
          class="d-flex flex-row-reverse"
        >
          <v-btn
            color="btn_primary"
            @click="publish"
          >
            Publish
          </v-btn>
          <v-btn
            text
            color="red"
            @click="dialog.open = false"
          >
            cancel
          </v-btn>
        </v-card-actions>
        <v-card-actions
          v-if="isHide"
          class="d-flex flex-row-reverse"
        >
          <v-btn
            text
            color="red"
            @click="publish"
          >
            Hide
          </v-btn>
          <v-btn
            color="btn_primary"
            @click="dialog.open = false"
          >
            cancel
          </v-btn>
        </v-card-actions>
        <v-card-actions
          v-if="isDelete"
          class="d-flex flex-row-reverse"
        >
          <v-btn
            text
            color="red"
            @click="deletes"
          >
            Delete
          </v-btn>
          <v-btn
            color="btn_primary"
            @click="dialog.open = false"
          >
            cancel
          </v-btn>
        </v-card-actions>
        <v-card-actions
          v-if="isDeleteById"
          class="d-flex flex-row-reverse"
        >
          <v-btn
            text
            color="red"
            @click="deletes"
          >
            Delete
          </v-btn>
          <v-btn
            color="btn_primary"
            @click="dialog.open = false"
          >
            cancel
          </v-btn>
        </v-card-actions>
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
      isPublish: {
        type: Boolean,
        default: false,
      },
      isHide: {
        type: Boolean,
        default: false,
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
        default: "Publish Class",
      },
      isDelete: {
        type: Boolean,
        default: false,
      },
      isDeleteById: {
        type: Boolean,
        default: false,
      },
    },
    methods: {
      setColorStatus (status) {
        if (status === "intermediate") return "btn_primary"
        if (status === "advance") return "primary"
        if (status === "beginner") return "secondary"
        else return "red"
      },
      publish () {
        this.$emit("input", { item: this.dialog.data })
      },
      hide () {
        this.$emit("input", { item: this.dialog.data })
      },
      deletes () {
        this.$emit("input", { item: this.dialog.data })
      },
    },
  }
</script>

<style></style>
