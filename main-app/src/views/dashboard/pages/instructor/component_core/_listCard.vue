<template>
  <v-container>
    <v-row>
      <v-col
        v-for="(item, i) in data"
        :key="i"
        cols="12"
        md="3"
      >
        <v-hover v-slot="{ hover }">
          <v-card
            width="400"
            height="400"
            class="rounded-lg card__list"
            :elevation="hover ? 12 : 2"
          >
            <div class="img--instructor">
              <v-img
                v-if="item.img"
                :src="item.img.url"
                width="400"
                class="rounded-xl"
                height="400"
                style="cursor: pointer"
                @click="navigate(`/instructor/profile/${item.slug}`)"
              >
                <v-container>
                  <v-row class="cols__margin--name">
                    <v-col>
                      <div class="d-flex flex-row">
                        <div class="d-flex flex-column">
                          <v-chip
                            small
                            label
                            color="btn_primary"
                            class="font-spartan text-capitalize"
                            text-color="white"
                          >
                            {{ item.name }}
                          </v-chip>
                        </div>
                      </div>
                    </v-col>
                    <v-col
                      cols="12"
                      class="cols__studio"
                    >
                      <div class="d-flex flex-row">
                        <div class="d-flex flex-column">
                          <v-chip
                            v-if="item.studio"
                            color="btn_primary"
                            text-color="white"
                            class="font-spartan-text font-weight-bold"
                            small
                          >
                            {{ item.profession }} - {{ item.studio.name }}
                          </v-chip>
                        </div>
                      </div>
                    </v-col>
                  </v-row>
                </v-container>
              </v-img>
            </div>
            <v-container>
              <v-row>
                <v-col
                  cols="12"
                  class="d-flex flex-row-reverse margin-callbacks"
                >
                  <div class="d-flex flex-row margin--icon">
                    <div class="d-flex flex-column">
                      <v-tooltip
                        top
                        color="btn_primary"
                      >
                        <template #activator="{ on, attrs }">
                          <v-icon
                            v-bind="attrs"
                            color="red"
                            class="mr-2"
                            style="cursor: pointer"
                            v-on="on"
                          >
                            mdi-instagram
                          </v-icon>
                        </template>
                        <span class="font-spartan-small">
                          {{ item.username_ig }}
                        </span>
                      </v-tooltip>
                    </div>
                    <div class="d-flex flex-column">
                      <v-tooltip
                        top
                        color="btn_primary"
                      >
                        <template #activator="{ on, attrs }">
                          <v-icon
                            v-bind="attrs"
                            color="blue"
                            class="mr-2"
                            style="cursor: pointer"
                            v-on="on"
                          >
                            mdi-facebook
                          </v-icon>
                        </template>
                        <span class="font-spartan-small">
                          {{ item.username_fb }}
                        </span>
                      </v-tooltip>
                    </div>
                    <div class="d-flex flex-column">
                      <v-tooltip
                        top
                        color="btn_primary"
                      >
                        <template #activator="{ on, attrs }">
                          <v-icon
                            v-bind="attrs"
                            color="blue"
                            style="cursor: pointer"
                            v-on="on"
                          >
                            mdi-twitter
                          </v-icon>
                        </template>
                        <span class="font-spartan-small">
                          {{ item.username_tw }}
                        </span>
                      </v-tooltip>
                    </div>
                  </div>
                </v-col>
              </v-row>
            </v-container>
          </v-card>
        </v-hover>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
  export default {
    props: {
      data: {
        type: Array,
        default: null,
      },
    },
    data: () => ({}),
    methods: {
      navigate (link) {
        this.$router.push(link)
      },
    },
  }
</script>

<style lang="sass">
.margin-callbacks
    margin-top: -20px
    margin-left: 43px
.cols__margin--name
    margin-top: 312px
.margin--icon
    margin-right: 135px
    margin-top: 20px
    .v-icon
        font-size: 26px !important
.cols__studio
    margin-top: -20px !important
.img--instructor
  img
    transition: 0.1s ease-in !important
    cursor: pointer !important
  &:hover
    img
       transform: scale(1,1) !important
</style>
