<template>
  <v-container>
    <v-row>
      <v-col cols="12">
        <v-alert
          border="top"
          colored-border
          type="info"
          color="primary"
          elevation="2"
          class="font-spartan alert__custom"
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
                v-model="data.username_ig"
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
                v-model="data.username_fb"
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
                v-model="data.username_tw"
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
        <v-btn
          color="btn_primary"
          @click="save"
        >
          Save
        </v-btn>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
  export default {
    props: {
      data: {
        type: Object,
        default: null,
      },
    },
    methods: {
      save () {
        this.$emit("save", { item: this.data })
      },
    },
  }
</script>

<style lang="sass">
.theme--dark
  .alert
    &__custom
      background-color: #141C31 !important
</style>
