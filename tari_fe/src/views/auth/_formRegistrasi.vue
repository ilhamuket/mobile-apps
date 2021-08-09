<template>
  <v-card>
    <!-- <v-card-title class="d-flex justify-center">
      <h3 class="d-flex justify-center mr-4">
        Sign-Up
      </h3>
    </v-card-title> -->
    <v-card-text class="">
      <v-form>
        <v-row dense>
          <v-col cols="6">
            <v-text-field
              outlined
              dense
              label="First Name"
              placeholder="Firts Names"
              prepend-icon="mdi-account-convert"
            />
          </v-col>
          <v-col
            class="d-flex flex-column-reverse"
            cols="6"
          >
            <v-text-field
              outlined
              dense
              label="Last Name"
              placeholder="Last Name"
              append-icon="mdi-account-convert-outline"
            />
          </v-col>
          <v-col cols="12">
            <v-text-field
              outlined
              dense
              label="Input Your Emaill"
              placeholder="E-mail"
              prepend-icon="mdi-email"
            />
          </v-col>
          <v-col cols="12">
            <v-text-field
              outlined
              dense
              label="Password"
              type="password"
              placeholder="Password"
              prepend-icon="mdi-lock-check-outline"
            />
          </v-col>
          <v-col cols="12">
            <v-text-field
              outlined
              dense
              label="Confirm Password"
              type="password"
              placeholder="Confirm Password"
              prepend-icon="mdi-lock-check-outline"
            />
          </v-col>
          <v-col>
            <v-text-field
              outlined
              dense
              type="email"
              label="Input Your Emaill"
              placeholder="E-mail"
              prepend-icon="mdi-email"
            />
          </v-col>
          <v-col>
            <v-text-field
              outlined
              dense
              label="Input Your Emaill"
              placeholder="E-mail"
              prepend-icon="mdi-email"
            />
          </v-col>
        </v-row>

        <div class="d-flex flex-row justify-center ml-9 mt-5">
          <div class="d-flex flex-column">
            <v-btn
              rounded
              color="#DD5B87"
              @click="move"
            >
              Sign-Up
            </v-btn>
          </div>
        </div>

        <div class="d-flex flex-row justify-center ml-9 mt-2">
          <div class="d-flex-column">
            <v-chip
              to="/login"
              color="transparent"
            >
              Already have an account ?
            </v-chip>
          </div>
        </div>
      </v-form>
    </v-card-text>
  </v-card>
</template>

<script>
  export default {
    methods: {
      move () {
        this.$emit('move')
      },
    },
  }
</script>

<style></style>
