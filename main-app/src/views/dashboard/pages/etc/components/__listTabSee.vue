<template>
  <v-container>
    <v-row v-if="itemLastSee.length !== 0">
      <v-col
        v-for="(item, i) in itemLastSee"
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
              v-if="item.img"
              width="400"
              height="276"
              gradient="to top right, rgba(0,0,0,.33), rgba(0,0,0,.7)"
              style="background-color: grey"
              :src="item.img.url"
            >
              <v-container>
                <v-row>
                  <v-col
                    class="d-flex flex-row-reverse"
                    cols="12"
                  >
                    <v-chip
                      label
                      class="mr-1"
                      small
                      text-color="white"
                      :color="setColorStatus(item.status_kelas)"
                    >
                      {{ item.status_kelas }}
                    </v-chip>
                  </v-col>
                </v-row>
                <v-row>
                  <v-col
                    class="cols__followed"
                    cols="12"
                  >
                    <span class="font-spartan white--text ml-2">
                      {{ item.name }}
                    </span>
                    <br>
                    <span class="font-spartan white--text ml-2">
                      {{ item.harga }}
                    </span>
                    <br>

                    <v-btn
                      small
                      width="190"
                      color="btn_primary"
                      class="btn-expolore-studio ml-1"
                    >
                      Register Now !
                    </v-btn>
                    <v-btn
                      v-if="item.studio"
                      width="120"
                      small
                      color="secondary"
                      class="btn-expolore-studio ml-2"
                      @click="
                        navigate(
                          `/detail/class/live/${item.studio.slug}/${item.slug}`
                        )
                      "
                    >
                      Explore
                    </v-btn>
                  </v-col>
                </v-row>
              </v-container>
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
      data: {
        type: Array,
        default: null,
      },
    },
    computed: {
      itemLastSee () {
        const arrObjOne = this.data.filter(
          (item, index) => this.data.indexOf(item) === index,
        )
        const newArray = [
          ...new Map(
            arrObjOne.reverse().map(item => [JSON.stringify(item), item]),
          ).values(),
        ]
        // console.log(newArray)
        return newArray
      },
    },
    mounted () {},
    methods: {
      setColorStatus (status) {
        if (status === "ongoing") {
          return "btn_primary"
        } else if (status === "upcoming") {
          return "secondary"
        } else return "red"
      },
      navigate (link) {
        this.$router.push(link)
      },
    },
  }
</script>

<style></style>
