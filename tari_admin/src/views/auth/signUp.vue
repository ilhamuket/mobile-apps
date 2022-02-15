<template>
  <v-app>
    <v-img
      src="https://aws1.discourse-cdn.com/elastic/original/3X/9/0/90df22ab443662d632838fd82f6ea38b2cba025a.png"
      max-height="700"
      class="my-auto"
    >
      <app-navigations
        color="#DD5B87"
        class="mb-12 heiight"
        :page-login="true"
      />

      <v-container>
        <v-row
          dense
          class="d-flex justify-center mt-12"
        >
          <v-col cols="6">
            <v-stepper v-model="e6">
              <v-stepper-header>
                <v-stepper-step
                  editable
                  :complete="e1 > 1"
                  step="1"
                >
                  Name of step 1
                </v-stepper-step>

                <v-divider />

                <v-stepper-step
                  editable
                  :complete="e1 > 2"
                  step="2"
                >
                  Name of step 2
                </v-stepper-step>

                <v-divider />

                <v-stepper-step
                  editable
                  step="3"
                >
                  Name of step 3
                </v-stepper-step>
              </v-stepper-header>

              <v-stepper-items>
                <v-stepper-content step="1">
                  <v-card
                    class="mb-12"
                    color="grey lighten-1"
                    height="200px"
                  />

                  <v-btn
                    color="primary"
                    @click="e1 = 2"
                  >
                    Continue
                  </v-btn>

                  <v-btn text>
                    Cancel
                  </v-btn>
                </v-stepper-content>

                <v-stepper-content step="2">
                  <v-card
                    class="mb-12"
                    color="grey lighten-1"
                    height="200px"
                  />

                  <v-btn
                    color="primary"
                    @click="e1 = 3"
                  >
                    Continue
                  </v-btn>

                  <v-btn text>
                    Cancel
                  </v-btn>
                </v-stepper-content>

                <v-stepper-content step="3">
                  <app-form-registrasi @move="e6 = 2" />
                </v-stepper-content>
              </v-stepper-items>
            </v-stepper>
          </v-col>
          <!-- <v-col cols="6">
            <v-card>
              <v-card-title class="d-flex justify-center">
                <h3 class="d-flex justify-center mr-4">
                  Sign-Up
                </h3>
              </v-card-title>
              <v-card-text class="mt-6">
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

                  <div class="d-flex flex-row-reverse mt-5">
                    <div class="d-flex flex-column">
                      <v-btn
                        rounded
                        color="#DD5B87"
                      >
                        Sign-Up
                      </v-btn>
                    </div>
                  </div>
                </v-form>
              </v-card-text>
            </v-card>
          </v-col> -->
        </v-row>
      </v-container>
    </v-img>
  </v-app>
</template>

<script>
// import navigations from '../landingpage/components/Navigation.vue'
  import form from './_formRegistrasi.vue'
  export default {
    components: {
      // 'app-navigations': navigations,
      'app-form-registrasi': form,
    },
    data: () => ({
      e6: 1,
    }),
  }
</script>

<style lang="sass" scoped></style>
