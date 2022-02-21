<template>
  <v-container>
    <v-row>
      <v-col>
        <v-form
          v-model="invalid"
          @submit.prevent="methodContinue"
        >
          <v-row>
            <v-col
              cols="12"
              md="6"
            >
              <v-text-field
                v-model="data.firstname"
                :rules="[rules.required]"
                label="FirstName"
                placeholder="FirstName"
              />
            </v-col>
            <v-col
              cols="12"
              md="6"
            >
              <v-text-field
                v-model="data.lastname"
                :rules="[rules.required]"
                label="LastName"
                placeholder="LastName"
              />
            </v-col>
          </v-row>
          <v-text-field
            v-model="data.username"
            :rules="[rules.required]"
            label="Username"
            placeholder="Username Account"
          />
          <v-text-field
            v-model="data.contact"
            :rules="[rules.required, rules.min]"
            label="Contact Owner"
          />
          <v-text-field
            v-model="data.email"
            :rules="[rules.required, rules.emailRules]"
            label="Email"
            placeholder="Email Owner"
          />
          <v-text-field
            v-model="data.password"
            :rules="[rules.required]"
            label="Password"
            type="password"
            placeholder="Password"
          />
          <v-text-field
            v-model="data.confirmPassword"
            :rules="[rules.required, computedMatchPassword]"
            label="Confirm Password"
            type="password"
            placeholder="Confirm Username"
          />
          <v-col
            cols="12"
            class=""
          >
            <v-btn
              :disabled="!invalid"
              type="submit"
              color="btn_primary"
            >
              Continue
            </v-btn>
          </v-col>
        </v-form>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
  export default {
    data: () => ({
      data: {
        firstname: "",
        lastname: "",
        username: "",
        contact: "",
        email: "",
        password: "",
        confirmPassword: "",
      },
      owner: {},
      studio: {},
      rules: {
        required: (value) => !!value || "Required.",
        min: (v) => (v && v.length >= 8) || "Min 8 characters",
        emailRules: (v) =>
          /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/.test(v) ||
          "E-mail must be valid",
      },
      invalid: true,
    }),
    computed: {
      computedMatchPassword () {
        return this.data.password === this.data.confirmPassword || "not match"
      },
    },
    methods: {
      methodContinue () {
        this.$emit("continue", { item: this.data })
      },
    },
  }
</script>

<style></style>
