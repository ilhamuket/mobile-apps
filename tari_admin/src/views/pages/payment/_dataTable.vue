<template>
  <base-material-card icon="mdi-cart">
    <template #after-heading>
      <span class="font-spartan"> Payment - all </span>
    </template>
    <v-container>
      <v-row>
        <v-col cols="12">
          <v-data-table
            :headers="headers"
            :items="data"
          >
            <template #[`item.type`]="{ item }">
              <span class="text-capitalize">{{
                item.type ? item.type : '-'
              }}</span>
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
          text: '#',
          value: 'id',
          sortable: false,
        },
        {
          text: 'Student Name',
          value: 'cart.form.fullName',
          sortable: false,
        },
        {
          text: 'Type',
          value: 'type',
          sortable: false,
        },
        { text: 'Student Email', value: 'cart.form.email', sortable: false },
        { text: 'UserName Account', value: 'user.nickName' },
        { text: 'Contact WA', value: 'user.noHp', sortable: false },
        { text: 'Payment Method', value: 'bank.bank_name', sortable: false },
        { text: 'Bank Account', value: 'account_bank_number', sortable: false },
        { text: 'Status', value: 'status', sortable: false },
      // { text: 'Last Login', value: 'last_login', sortable: false },
      ],
    }),
  }
</script>

<style></style>
