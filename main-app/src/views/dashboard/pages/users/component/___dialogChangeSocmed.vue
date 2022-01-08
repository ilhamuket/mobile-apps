<template>
  <v-container>
    <v-dialog
      v-model="dialog.open"
      width="70%"
    >
      <v-card>
        <v-system-bar
          :color="$vuetify.theme.dark ? '#141C31' : '#F0F8FF'"
          window
        >
          <v-toolbar-title
            :class="$vuetify.theme.dark ? 'white--text' : ' black--text'"
          >
            <v-icon :color="$vuetify.theme.dark ? 'white' : 'black'">
              mdi-pencil
            </v-icon>
            <span class="font-spartan-small"> Edit Profile </span>
          </v-toolbar-title>

          <v-spacer />

          <v-icon @click="dialog.open = false">
            mdi-close
          </v-icon>
        </v-system-bar>
        <v-card-text>
          <v-container>
            <v-row>
              <v-col cols="12">
                <v-text-field
                  label="Instagram"
                  placeholder="your instagram"
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
                  label="Facebook"
                  placeholder="your Facebook"
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
                  label="Twitter"
                  placeholder="your Twitter"
                >
                  <template #prepend>
                    <v-icon color="blue">
                      mdi-twitter
                    </v-icon>
                  </template>
                </v-text-field>
              </v-col>
            </v-row>
          </v-container>
        </v-card-text>
      </v-card>
    </v-dialog>
  </v-container>
</template>

<script>
  export default {
    props: {
      dialog: {
        type: Object,
        default: null,
      },
    },
  }
</script>

<style></style>
