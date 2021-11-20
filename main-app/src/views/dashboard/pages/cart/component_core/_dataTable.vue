<template>
  <v-container>
    <v-row>
      <v-col cols="12">
        <v-data-table
          :items="data"
          :headers="headers"
          show-expand
        >
          <!-- Expand Items -->
          <template #expanded-item="{ headers, item }">
            <td :colspan="headers.length">
              <v-container v-if="item.form">
                <v-row>
                  <v-col
                    cols="12"
                    class="d-flex justify-center"
                  >
                    <span class="font-spartan font-weight-bold grey--text">
                      Form
                    </span>
                  </v-col>
                  <v-col cols="12">
                    <v-text-field
                      v-model="item.form.fullName"
                      outlined
                      label="Fullname"
                      readonly
                    />
                  </v-col>
                  <v-col cols="12">
                    <v-text-field
                      v-model="item.form.email"
                      outlined
                      label="E-mail"
                      readonly
                    />
                  </v-col>
                  <v-col cols="12">
                    <v-text-field
                      v-model="item.form.contact"
                      outlined
                      label="Contact"
                      readonly
                    />
                  </v-col>
                  <v-col cols="12">
                    <v-text-field
                      v-model="item.form.address"
                      outlined
                      label="address"
                      readonly
                    />
                  </v-col>
                  <v-col cols="12">
                    <v-text-field
                      :value="computedDateFormattedMomentjs(item.form.ttl)"
                      outlined
                      label="Date Of Birth"
                      readonly
                    />
                  </v-col>
                  <v-col cols="12">
                    <v-text-field
                      :value="age(item.form.ttl)"
                      outlined
                      label="Age"
                      readonly
                    />
                  </v-col>
                </v-row>
              </v-container>
            </td>
          </template>
          <!-- items -->
          <template #[`item.img`]="{ item }">
            <v-hover v-slot="{ hover }">
              <v-card
                v-if="item.class"
                width="140"
                height="100"
                :elevation="hover ? 12 : 2"
                :class="{ 'on-hover': hover }"
              >
                <v-img
                  v-if="item.class.img"
                  :src="item.class.img.url"
                  width="140"
                  height="100"
                  gradient="to top right, rgba(0,0,0,.33), rgba(0,0,0,.7)"
                />
              </v-card>
            </v-hover>
          </template>
          <template #[`item.status`]="{ item }">
            <v-chip
              :color="setStatusColor(item.status)"
              class="text-capitalize"
              text-color="white"
            >
              {{ item.status }}
            </v-chip>
          </template>
          <template #[`item.actions`]="{ item }">
            <v-btn
              color="btn_primary"
              small
              outlined
              @click="navigate(item)"
            >
              <v-icon> mdi-contactless-payment-circle-outline </v-icon>
            </v-btn>
          </template>
        </v-data-table>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
  import moment from "moment"
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
        },
        {
          text: "Name",
          value: "class.name",
        },
        {
          text: "Type",
          value: "type",
        },
        {
          text: "Price",
          value: "class.harga",
        },
        {
          text: "Status",
          value: "status",
        },
        {
          text: "Actions",
          value: "actions",
        },
      ],
    }),
    computed: {},
    methods: {
      navigate (link) {
        this.$router.push(`/cart/detail/${link.form.id}`)
      },
      computedDateFormattedMomentjs (date) {
        return date ? moment(date).format("dddd, MMMM Do YYYY") : ""
      },
      age (date) {
        const age = date ? moment(date, "YYYYMMDD").fromNow() : ""

        const arry = age.split(" ")

        const newText = arry[0] + " Years Old"

        return newText
      },
      setStatusColor (status) {
        if (status === "paid") {
          return "btn_primary"
        } else return "red"
      },
    },
  }
</script>

<style></style>
