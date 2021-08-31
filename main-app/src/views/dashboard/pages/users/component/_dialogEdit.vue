<template>
  <v-container fluid>
    <v-dialog
      v-model="dialog.open"
      width="90%"
    >
      <v-card
        size-avatar="120"
        avatar="https://demos.creative-tim.com/muse-vue-ant-design-dashboard/images/face-1.jpg"
      >
        <v-avatar
          size="128"
          class="custome-bg-profile elevation-6 mt-2"
          color="grey"
        >
          <v-img
            src="https://demos.creative-tim.com/muse-vue-ant-design-dashboard/images/face-1.jpg"
          />
        </v-avatar>
        <v-card-title class="font-title-rampart-one">
          Dialog Title

          <v-spacer />

          <v-icon
            aria-label="Close"
            @click="dialog.open = false"
          >
            mdi-close
          </v-icon>
        </v-card-title>

        <v-container>
          <v-row>
            <v-col
              cols="12"
              md="4"
            >
              <v-text-field
                outlined
                label="FirstName"
                dense
                prepend-icon="mdi-alpha-f-circle-outline"
              />
            </v-col>
            <v-col
              cols="12"
              md="4"
            >
              <v-text-field
                outlined
                label="LastName"
                dense
                prepend-icon="mdi-alpha-l-circle-outline"
              />
            </v-col>
            <v-col
              cols="12"
              md="4"
            >
              <v-text-field
                outlined
                label="UserName"
                dense
                prepend-icon="mdi-alpha-u-circle-outline"
              />
            </v-col>
          </v-row>
        </v-container>
      </v-card>
    </v-dialog>
  </v-container>
</template>

<script>
  export default {
    props: {
      dialog: {
        type: Object,
        default: () => ({
          open: false,
        }),
      },
    },
  }
</script>
<style lang="sass" scoped>
.v-application .custome-bg-profile
  margin-left: 544px !important
</style>
