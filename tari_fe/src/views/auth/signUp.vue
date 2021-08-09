<template>
  <v-app>
    <v-img
      src="https://aws1.discourse-cdn.com/elastic/original/3X/9/0/90df22ab443662d632838fd82f6ea38b2cba025a.png"
      max-height="620"
      class="my-auto"
    >
      <app-navigations
        color="#DD5B87"
        class="mb-12"
        :page-login="true"
      />

      <v-container>
        <v-row>
          <v-col>
            <v-row class="d-flex justify-center">
              <v-col cols="6">
                <v-card>
                  <v-card-title class="d-flex justify-center">
                    <h3 class="d-flex justify-center mr-4">
                      Sign-Up
                    </h3>
                  </v-card-title>
                  <v-card-text class="mt-6">
                    <v-form>
                      <v-row>
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
                            label="Input Your Emaill"
                            placeholder="E-mail"
                            prepend-icon="mdi-lock-check-outline"
                          />
                        </v-col>
                        <v-col cols="12">
                          <v-text-field
                            outlined
                            dense
                            label="Input Your Emaill"
                            placeholder="E-mail"
                            prepend-icon="mdi-lock-check-outline"
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
                    </v-form>
                  </v-card-text>
                </v-card>
              </v-col>
            </v-row>
          </v-col>
        </v-row>
      </v-container>
    </v-img>
  </v-app>
</template>

<script>
  import navigations from '../landingpage/components/Navigation.vue'
  export default {
    components: {
      'app-navigations': navigations,
    },
  }
</script>

<style></style>
