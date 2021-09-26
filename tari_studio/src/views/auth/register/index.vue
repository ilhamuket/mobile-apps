<template>
  <v-content>
    <!-- <v-row>
      <v-col cols="12">
        <app-banners />
      </v-col>
    </v-row> -->
    <v-row>
      <v-col cols="6">
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
  </v-content>
</template>

<script>
//   import banners from './component_core/banners.vue'
//   import stepper from './component_core/stepper.vue'
  export default {
    components: {
    //   'app-banners': banners,
    //   'app-stepper': stepper,
    },
  }
</script>

<style></style>
