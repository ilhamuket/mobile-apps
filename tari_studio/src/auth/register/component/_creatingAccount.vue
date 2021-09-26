<template>
  <v-container>
    <v-form v-model="invalid">
      <v-row>
        <v-col cols="6">
          <v-text-field
            v-model="data.firstName"
            dense
            label="FirstName"
            :rules="[rules.required]"
            prepend-icon="mdi-alpha-f-circle-outline"
          />
        </v-col>
        <v-col cols="6">
          <v-text-field
            v-model="data.lastName"
            dense
            :rules="[rules.required]"
            label="LastName"
            prepend-icon="mdi-alpha-l-circle-outline"
          />
        </v-col>
        <v-col cols="12">
          <v-text-field
            v-model="data.userName"
            dense
            label="Username"
            :rules="[rules.required]"
            prepend-icon="mdi-alpha-u-circle-outline"
          />
        </v-col>
        <v-col cols="12">
          <v-text-field
            v-model="data.phoneNumber"
            dense
            label="Phone Number"
            :rules="[rules.required]"
            prepend-icon="mdi-alpha-u-circle-outline"
          />
        </v-col>
        <v-col cols="12">
          <v-text-field
            v-model="data.email"
            dense
            label="Email"
            type="email"
            :rules="[rules.required, rules.emailRules]"
            prepend-icon="mdi-at"
          />
        </v-col>
        <v-col cols="12">
          <v-text-field
            v-model="data.password"
            dense
            label="Password"
            :rules="[rules.required]"
            prepend-icon="mdi-lock"
            :append-icon="!show ? 'mdi-eye' : 'mdi-eye-off'"
            :type="show ? 'text' : 'password'"
            @click:append="show = !show"
          />
        </v-col>
        <v-col cols="12">
          <v-text-field
            v-model="data.confirmPassword"
            dense
            :rules="[checkPassword, rules.required]"
            label="Confirm Password"
            prepend-icon="mdi-lock"
            :append-icon="!show ? 'mdi-eye' : 'mdi-eye-off'"
            :type="show ? 'text' : 'password'"
            @click:append="show = !show"
          />
        </v-col>
      </v-row>

      <v-btn
        color="primary"
        :disabled="!invalid"
        @click="nextStep"
      >
        Continue
      </v-btn>

      <v-btn
        text
        @click="cancel"
      >
        Cancel
      </v-btn>
    </v-form>
  </v-container>
</template>

<script>
  export default {
    props: {},
    data: () => ({
      data: {
        firstName: '',
        lastName: '',
        userName: '',
        phoneNumber: '',
        email: '',
        password: '',
        confirmPassword: '',
      },

      invalid: true,
      show: false,
      rules: {
        required: value => !!value || 'Required.',
        min: v => (v && v.length >= 8) || 'Min 8 characters',
        emailRules: v =>
          /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/.test(v) ||
          'E-mail must be valid',
      },
    }),
    computed: {
      checkPassword () {
        return this.data.password === this.data.confirmPassword
      },
    },
    methods: {
      cancel () {
        this.$router.push('/login')
      },
      nextStep () {
        this.$emit('next', { item: this.data })
      },
    },
  }
</script>

<style></style>
