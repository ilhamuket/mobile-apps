<template>
  <v-container>
    <v-row>
      <v-col cols="12">
        <v-alert
          border="top"
          colored-border
          type="info"
          elevation="2"
          class="font-spartan"
        >
          fill in your Username Social Media Instagram, Twitter, and Facebook,
          if you want to publish ..
        </v-alert>
      </v-col>
      <v-col cols="12">
        <v-form>
          <v-row>
            <v-col cols="12">
              <v-text-field
                label="Filled Username Instagram"
                placeholder="type something ..."
                clearable
              >
                <template #prepend>
                  <v-icon color="red">
                    mdi-instagram
                  </v-icon>
                </template>
              </v-text-field>
            </v-col>
            <v-col cols="12">
              <v-text-field
                label="Filled Username Facebook"
                placeholder="type something ..."
                clearable
              >
                <template #prepend>
                  <v-icon color="blue">
                    mdi-facebook
                  </v-icon>
                </template>
              </v-text-field>
            </v-col>
            <v-col cols="12">
              <v-text-field
                label="Filled Username Twitter"
                placeholder="type something ..."
                clearable
              >
                <template #prepend>
                  <v-icon color="blue">
                    mdi-twitter
                  </v-icon>
                </template>
              </v-text-field>
            </v-col>
          </v-row>
        </v-form>
      </v-col>
      <v-col
        cols="12"
        class="d-flex justify-end"
      >
        <v-btn color="btn_primary">
          Save
        </v-btn>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
  export default {}
</script>

<style></style>
