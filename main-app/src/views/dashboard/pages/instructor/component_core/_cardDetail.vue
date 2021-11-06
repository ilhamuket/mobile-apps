<template>
  <v-card
    height="120"
    hidden
    color="transparent"
    class="d-flex justify-center container--profile"
  >
    <v-container>
      <v-row>
        <v-col>
          <v-avatar
            v-if="data.img"
            size="100"
          >
            <v-img :src="data.img.url" />
          </v-avatar>
          <v-avatar
            v-else
            size="100"
          >
            <v-img
              src="https://steezy.imgix.net/choreographers/abey-cabrera.png?auto=compress"
            />
          </v-avatar>
          <div class="margin--span_name">
            <span class="font-spartan font-weight-bold white--text">
              {{ data.name }}
            </span>
          </div>
          <div class="margin--span__atribute">
            <v-tooltip
              color="red"
              bottom
            >
              <template #activator="{ on, attrs }">
                <v-icon
                  v-bind="attrs"
                  color="red"
                  style="cursor: pointer"
                  v-on="on"
                >
                  mdi-instagram
                </v-icon>
              </template>
              <span
                v-if="data.username_ig"
                class="font-spartan-small white--text text-capitalize"
              >
                {{ data.username_ig }}
              </span>
              <span
                v-else
                class="font-spartan-small white--text"
              >instagram</span>
            </v-tooltip>
            <v-tooltip
              color="blue"
              bottom
            >
              <template #activator="{ on, attrs }">
                <v-icon
                  v-bind="attrs"
                  class="ml-1"
                  color="blue"
                  style="cursor: pointer"
                  v-on="on"
                >
                  mdi-facebook
                </v-icon>
              </template>
              <span
                v-if="data.username_fb"
                class="font-spartan-small white--text"
              >
                {{ data.username_fb }}
              </span>
              <span
                v-else
                class="font-spartan-small white--text"
              >
                facebook
              </span>
            </v-tooltip>
            <v-tooltip
              color="blue"
              bottom
            >
              <template #activator="{ on, attrs }">
                <v-icon
                  v-bind="attrs"
                  class="ml-1"
                  color="blue"
                  style="cursor: pointer"
                  v-on="on"
                >
                  mdi-twitter
                </v-icon>
              </template>
              <span
                v-if="data.username_tw"
                class="font-spartan-small white--text"
              >
                {{ data.username_tw }}
              </span>
              <span
                v-else
                class="font-spartan-small white--text"
              >
                Twitter
              </span>
            </v-tooltip>
            <v-icon
              class="ml-1"
              color="blue"
            >
              mdi-map-marker
            </v-icon>
            <span class="font-spartan-small">
              {{ data.region }}
            </span>
          </div>
        </v-col>
      </v-row>
    </v-container>
  </v-card>
</template>

<script>
  export default {
    props: {
      data: {
        type: Object,
        default: null,
      },
    },
    data: () => ({
      ig: true,
    }),
  }
</script>

<style lang="sass">
.container--profile
    width: 80%
    height: 86%
    margin-top: -7%
    margin-left: 10%
    .margin--span_name
        margin-top: -8%
        margin-left: 13%
    .margin--span__atribute
        margin-left: 12%
        margin-top: 2%
</style>
