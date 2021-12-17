<template>
  <v-row>
    <v-col
      v-for="(item, i) in data"
      :key="i"
      cols="12"
      md="4"
    >
      <v-hover v-slot="{ hover }">
        <v-card
          :elevation="hover ? 12 : 2"
          :class="{ 'on-hover': hover }"
        >
          <v-img
            width="400"
            height="276"
            gradient="to top right, rgba(0,0,0,.33), rgba(0,0,0,.7)"
            style="background-color: grey"
            :src="item.url_thumbnail"
          >
            <v-container>
              <v-row>
                <v-col
                  class="d-flex flex-row-reverse"
                  cols="12"
                >
                  <v-icon color="primary">
                    mdi-lock
                  </v-icon>
                  <!-- <v-icon
                  v-else
                  color="red"
                  @click="unLike(item)"
                >
                  mdi-heart
                </v-icon> -->
                  <v-icon
                    class="mr-2"
                    color="primary"
                  >
                    mdi-share-variant
                  </v-icon>
                </v-col>
              </v-row>
              <v-row class="cols__class-vidio">
                <v-col cols="12">
                  <span class="font-spartan-small white--text">
                    {{ item.name.substr(0, 40) + ".." }}
                  </span>
                  <br>
                  <span
                    v-if="item.category && item.studio"
                    class="font-spartan-small white--text"
                  >
                    {{ item.category.display_name }} - {{ item.studio.name }}
                  </span>
                  <br>
                  <span class="font-spartan white--text"> 2000 </span>
                  <br>

                  <!-- <v-rating
                    :value="2"
                    class="ratings__ensiklotari-vidio"
                    readonly
                    background-color="grey"
                    color="orange"
                    size="20"
                  /> -->

                  <v-btn
                    small
                    outlined
                    width="190"
                    color="primary white--text"
                    @click="navigate(`/class-vidio/detail/${item.slug}`)"
                  >
                    Explore
                  </v-btn>
                  <v-btn
                    small
                    width="120"
                    color="btn_primary"
                    class="btn_explore-vidio white--text ml-1"
                    @click="navigate(`/class-vidio/detail/${item.slug}`)"
                  >
                    Register Now !
                  </v-btn>
                </v-col>
              </v-row>
            </v-container>
          </v-img>
        </v-card>
      </v-hover>
    </v-col>
  </v-row>
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
      navigate (link) {
        this.$router.push(link)
      },
    },
  }
</script>

<style lang="sass">
.cols__class-vidio
    margin-top: 110px !important
.ratings__ensiklotari-vidio
    margin-top: -7px
.btn_explore-vidio
    margin-left: -2px
    margin-top: 7px
    // &:hover
    //     background-color: #9DC4D1
    //     color: white !important
</style>
