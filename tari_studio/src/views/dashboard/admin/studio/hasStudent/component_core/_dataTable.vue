<template>
  <base-material-card
    color="btn_primary"
    icon="mdi-account-outline"
  >
    <template #after-heading>
      <span class="font-spartan btn_primary--text"> Index Student </span>
    </template>
    <v-container>
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
        <!-- <v-col
          cols="12"
          md="8"
          class="d-flex flex-row-reverse"
        >
          <v-btn>Export</v-btn>
        </v-col> -->
        <v-col cols="12">
          <v-data-table
            show-select
            :headers="headers"
            :items="data"
            :items-per-page="5"
          >
            <!-- Header -->
            <template #[`header.student.nickName`]="{ header }">
              {{ $t(header.text) }}
            </template>
            <template #[`header.form.fullName`]="{ header }">
              {{ $t(header.text) }}
            </template>
            <template #[`header.form.email`]="{ header }">
              {{ $t(header.text) }}
            </template>
            <template #[`header.form.address`]="{ header }">
              {{ $t(header.text) }}
            </template>
            <template #[`header.form.contact`]="{ header }">
              {{ $t(header.text) }}
            </template>
            <template #[`header.classes.name`]="{ header }">
              {{ $t(header.text) }}
            </template>
            <!-- items -->
            <template #[`item.img`]="{ item }">
              <v-card>
                <v-avatar
                  v-if="item.student"
                  tile
                  size="90"
                >
                  <v-img
                    v-if="item.student.img"
                    :src="item.student.img.url"
                  />
                  <span v-else> {{ item.student.nickName.charAt(0) }} </span>
                </v-avatar>
              </v-card>
            </template>
            <template #[`item.student.nickName`]="{ item }">
              <div
                v-if="item.student"
                class="mt-6"
              >
                {{ item.student.nickName }}
              </div>
              <div class="bg-hover">
                <div class="d-flex flex-row flex-nowrap">
                  <div>
                    <div class="d-flex flex-column flex-nowrap mt-2">
                      <a
                        class="font-a d-flex flex-nowrap"
                        @click="upDialogUpdateCategory(item)"
                      >
                        <v-tooltip
                          color="primary"
                          bottom
                        >
                          <template #activator="{ on, attrs }">
                            <v-icon
                              v-bind="attrs"
                              small
                              color="blue"
                              v-on="on"
                            >
                              mdi-eye
                            </v-icon>
                          </template>
                          <span
                            class="font-spartan-small blue--text"
                          >See Detail
                          </span>
                        </v-tooltip>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </template>
            <template #[`item.form.cart.status`]="{ item }">
              <v-chip
                v-if="item.form.cart"
                text-color="white"
                :color="setColorStatus(item.form.cart.status)"
              >
                {{ item.form.cart.status }}
              </v-chip>
            </template>
            <template #[`item.classes.name`]="{ item }">
              <v-chip
                v-if="item.classes"
                text-color="white"
                color="btn_primary"
              >
                {{ item.classes.name }}
              </v-chip>
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
      headers: [
        {
          text: "#",
          value: "img",
          sortable: false,
        },
        {
          text: "table.student.th.nickName",
          align: "start",
          sortable: false,
          value: "student.nickName",
        },
        {
          text: "table.student.th.fullname",
          align: "start",
          sortable: false,
          value: "form.fullName",
        },
        {
          text: "table.student.th.class",
          align: "start",
          sortable: false,
          value: "classes.name",
        },
        { text: "table.student.th.email", value: "form.email", sortable: false },
        // {
        //   text: "table.student.th.alamat",
        //   value: "form.address",
        //   sortable: false,
        // },
        {
          text: "table.student.th.notlp",
          value: "form.contact",
          sortable: false,
        },
        {
          text: "Status",
          value: "form.cart.status",
          sortable: false,
        },

      // { text: "table.student.th.capacity", value: "kapasitas", sortable: false },
      // { text: "table.student.th.status", value: "status", sortable: false },
      // {
      //   text: "table.student.th.status_time",
      //   value: "status_kelas",
      //   sortable: false,
      // },
      ],
    }),
    methods: {
      setColorStatus (status) {
        if (status === "paid") return "btn_primary"
        else return "red"
      },
    },
  }
</script>

<style></style>
