<template>
  <v-row>
    <v-col>
      <v-stepper alt-labels>
        <v-stepper-header>
          <v-stepper-step
            step="3"
            complete
          >
            Ad type
          </v-stepper-step>

          <v-divider />

          <v-stepper-step
            step="4"
            complete
          >
            Ad style
          </v-stepper-step>

          <v-divider />

          <v-stepper-step
            :rules="[() => false]"
            step="5"
          >
            Custom channels
            <small>Alert message</small>
          </v-stepper-step>

          <v-divider />

          <v-stepper-step step="6">
            Get code
          </v-stepper-step>
        </v-stepper-header>
      </v-stepper>
    </v-col>
  </v-row>
</template>

<script>
  export default {
    data () {
      return {
        e6: 1,
      }
    },
  }
</script>

<style></style>
