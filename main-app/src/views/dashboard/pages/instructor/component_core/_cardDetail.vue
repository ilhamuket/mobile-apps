<template>
  <v-container class="container--profile">
    <v-row>
      <v-col>
        <v-card
          height="120"
          hidden
          color="transparent"
        >
          <v-avatar size="120">
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
                v-if="ig"
                class="font-spartan-small white--text text-capitalize"
              >
                instagram
              </span>
              <span
                v-else
                class="font-spartan white--text"
              > harimau </span>
            </v-tooltip>
            <v-icon
              class="ml-1"
              color="blue"
            >
              mdi-facebook
            </v-icon>
            <v-icon
              class="ml-1"
              color="blue"
            >
              mdi-twitter
            </v-icon>
            <v-icon
              class="ml-1"
              color="blue"
            >
              mdi-map-marker
            </v-icon>
            <span class="font-spartan-small"> {{ data.region }} </span>
          </div>
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
    data: () => ({
      ig: true,
    }),
  }
</script>

<style lang="sass">
.container--profile
    margin-top: -9%
    .margin--span_name
        margin-top: -8%
        margin-left: 12%
    .margin--span__atribute
        margin-left: 12%
        margin-top: 1%
</style>
