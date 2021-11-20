<template>
  <base-material-card icon="mdi-account">
    <template #after-heading>
      <span class="font-spartan primary--text"> Index Student </span>
    </template>
    <v-container>
      <v-row>
        <v-col cols="12">
          <v-btn
            class="mr-1"
            outlined
            rounded
            small
            dark
            color="primary"
          >
            <v-tooltip
              color="primary"
              bottom
            >
              <template #activator="{ on, attrs }">
                <v-icon
                  v-bind="attrs"
                  color="size__icon_refresh"
                  v-on="on"
                >
                  mdi-cached
                </v-icon>
              </template>
              <span class="font-spartan-small">
                {{ $t("Segarkan") }}
              </span>
            </v-tooltip>
          </v-btn>
        </v-col>
      </v-row>
      <v-row>
        <v-col
          cols="12"
          md="4"
        >
          <v-text-field
            append-icon="mdi-magnify"
            :label="$t('search')"
          />
        </v-col>
        <v-col
          cols="12"
          md="8"
          class="d-flex flex-row-reverse"
        >
          <v-btn
            :disabled="computedDisable"
            color="btn_primary"
            @click="sendRequest(selected)"
          >
            Send {{ selected.length }} Review
          </v-btn>
        </v-col>
        <v-col cols="12">
          <v-data-table
            v-model="selected"
            show-select
            :headers="headers"
            :items="data"
          >
            <!-- items -->
            <template #[`item.classes.time_status`]="{ item }">
              <v-chip
                v-if="item.classes"
                :color="setColorStatus(item.classes.time_status)"
                text-color="white"
                label
              >
                {{ item.classes.time_status }}
              </v-chip>
            </template>
            <template #[`item.status_responded`]="{ item }">
              <v-chip
                :color="setColorStatus(item.status_responded)"
                text-color="white"
                class="text-capitalize"
              >
                {{ item.status_responded ? item.status_responded : "-----" }}
              </v-chip>
            </template>
            <template #[`item.absent`]="{ item }">
              <v-radio-group
                v-model="item.absent"
                row
                @change="absent(item)"
              >
                <v-radio
                  label="Miss Absent"
                  :value="0"
                  color="red"
                />
                <v-radio
                  label="Present"
                  :value="1"
                />
              </v-radio-group>
            </template>
          </v-data-table>
        </v-col>
      </v-row>
    </v-container>
  </base-material-card>
</template>

<script>
  export default {
    props: {
      data: {
        type: Array,
        default: null,
      },
    },
    data: () => ({
      selected: [],
      headers: [
        {
          text: "A/n",
          sort: false,
          value: "form.fullName",
        },
        {
          text: "E-mail",
          sort: false,
          value: "form.email",
        },
        {
          text: "Contact",
          sort: false,
          value: "form.contact",
        },
        {
          text: "Adress",
          sort: false,
          value: "form.address",
        },
        {
          text: "Status Respond",
          sort: false,
          value: "status_responded",
        },
        {
          text: "Class Status",
          sort: false,
          value: "classes.time_status",
        },
        {
          text: "Absent",
          sort: false,
          value: "absent",
        },
      ],
    }),
    computed: {
      computedDisable () {
        let bool = true
        const nonPublish = this.selected.some(
          (x) => x.status_responded === "pending",
        )
        if (this.selected.length !== 0 && nonPublish) {
          bool = true
        } else if (this.selected.length !== 0 && !nonPublish) {
          bool = false
        }
        return bool
      },
    },
    methods: {
      setColorStatus (status) {
        if (status === "ongoing") return "btn_primary"
        if (status === "upcoming") return "primary"
        if (status === "responded") return "btn_primary"
        else return "red"
      },
      absent (item) {
        this.$emit("absent", { item: item })
      },
      sendRequest (item) {
        this.$emit("sendRequest", { item: item })
      },
    },
  }
</script>

<style></style>
