<template>
  <v-container>
    <v-row v-if="item.length === 0">
      <v-col
        class="d-flex justify-center"
        cols="12"
      >
        <!-- <v-img
          :src="require('@/assets/img/perbaikan.png')"
          width="200"
        /> -->
        <v-progress-circular
          indeterminate
          color="primary"
        />
      </v-col>
    </v-row>
    <v-row v-else>
      <v-col
        v-for="(data, i) in item"
        :key="i"
        cols="12"
        md="4"
      >
        <v-hover v-slot="{ hover }">
          <v-card
            :elevation="hover ? 12 : 2"
            :class="{ hover: 'on-hover' }"
            width="400"
            height="400"
          >
            <v-img
              v-if="data.img"
              :src="data.img.url"
              width="400"
              height="400"
              gradient="to top right, rgba(0,0,0,.3), rgba(0,0,0,.3)"
            >
              <div style="margin: 76% 0 0 4%">
                <div class="d-flex flex-column">
                  <div class="d-flex">
                    <span :class="`font-spartan font-weight-bold white--text`">
                      {{ data.name }} - {{ data.profession }}
                    </span>
                  </div>
                </div>
                <div class="d-flex flex-column mt-2">
                  <v-btn
                    color="btn_primary"
                    width="50%"
                  >
                    Detail
                  </v-btn>
                </div>
              </div>
            </v-img>
          </v-card>
        </v-hover>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
  export default {
    props: {
      item: {
        type: Array,
        default: null,
      },
    },
    data: () => ({
      icon: [
        {
          name: "instagram",
          color: "red",
        },
        {
          name: "facebook",
          color: "blue",
        },
        {
          name: "twitter",
          color: "blue",
        },
      ],
    }),
    computed: {},

    methods: {},
  }
</script>

<style lang="sass">
.row--instructor
  margin-top: 85% !important
</style>
