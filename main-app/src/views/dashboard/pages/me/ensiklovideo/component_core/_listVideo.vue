<template>
  <v-container>
    <v-row v-if="data.length > 0">
      <v-col
        v-for="(item, i) in data"
        :key="i"
        cols="12"
        md="4"
      >
        <v-hover v-slot="{ hover }">
          <v-card
            v-if="item.video"
            :elevation="hover ? 12 : 2"
            :class="{ 'on-hover': hover }"
            class="card__list"
          >
            <v-img
              class="img__video"
              :src="item.video.url_thumbnail"
              gradient="to top right, rgba(0,0,0,.33), rgba(0,0,0,.7)"
              @click="
                toPush(`/my-video/${item.video.id}/slug/${item.video.slug}`)
              "
            >
              <v-container>
                <v-row
                  align-content="end"
                  class=""
                >
                  <v-col
                    cols="12"
                    class="list__cols"
                  >
                    <span class="font-spartan-small white--text">
                      {{ item.video.name }}
                    </span>
                  </v-col>
                </v-row>
              </v-container>
            </v-img>
          </v-card>
        </v-hover>
      </v-col>
    </v-row>
    <v-row v-else>
      <v-col cols="12">
        <div class="d-flex justify-center">
          <v-img
            width="900"
            height="400"
            src="@/assets/img/noclass.svg"
          />
        </div>
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
    methods: {
      toPush (link) {
        this.$router.push(link)
      },
    },
  }
</script>

<style lang="sass">
.card
  &__list
    // .img
    //   &__video
    &:hover
      transform: scale(.9)
      overflow-x: none
      cursor: pointer
      border: 2px double #9DC4D1
.list
  &__cols
    padding-top: 53%
</style>
