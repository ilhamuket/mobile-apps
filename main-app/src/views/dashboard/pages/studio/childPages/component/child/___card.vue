<template>
  <v-container>
    <v-row class="d-flex justify-center">
      <v-col cols="12">
        <v-card
          class="mx-auto"
          max-width="400"
        >
          <v-card-title>
            <v-icon
              large
              left
            >
              mdi-twitter
            </v-icon>
            <span class="font-spartan primary--text font-italic">{{
              data.name
            }}</span>
          </v-card-title>

          <v-card-text class="text-h5 font-spartan">
            "{{ data.about }}"
          </v-card-text>

          <v-card-actions>
            <v-list-item v-if="data.studio">
              <v-list-item-content>
                <v-list-item-title>
                  <v-tooltip
                    bottom
                    color="primary"
                  >
                    <template #activator="{on,attrs}">
                      <span
                        v-bind="attrs"
                        class="font-italic"
                        v-on="on"
                      >
                        Studio : {{ data.studio.name }}
                      </span>
                    </template>
                    <span>{{ data.studio.name }}</span>
                  </v-tooltip>
                </v-list-item-title>
              </v-list-item-content>

              <v-row
                align="center"
                justify="end"
              >
                <v-icon
                  color="red"
                  class="mr-1"
                >
                  mdi-heart
                </v-icon>
                <span class="subheading mr-2">256</span>
                <span class="mr-1">·</span>
                <v-icon class="mr-1">
                  mdi-share-variant
                </v-icon>
                <span class="subheading" />
              </v-row>
            </v-list-item>
          </v-card-actions>
        </v-card>
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
  }
</script>

<style></style>
