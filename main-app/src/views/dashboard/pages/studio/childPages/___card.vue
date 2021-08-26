<template>
  <v-container>
    <v-row class="d-flex justify-center">
      <v-col>
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
            <span class="font-title-rampart-one">{{ data.name }}</span>
          </v-card-title>

          <v-card-text class="text-h5 font-size-ather-roboto-mono">
            "{{ data.about }}"
          </v-card-text>

          <v-card-actions>
            <v-list-item
              v-if="data.studio"
              class="grow"
            >
              <v-list-item-content>
                <v-list-item-title>
                  <span class="font-indie-flower">
                    Studio : {{ data.studio.name }}
                  </span>
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
