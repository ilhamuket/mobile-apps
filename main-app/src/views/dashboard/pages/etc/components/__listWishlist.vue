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
                      :color="setColorStatus(item.status_kelas)"
                      text-color="white"
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
                      width="120"
                      small
                      color="red"
                      class="btn-expolore-studio ml-2"
                      @click="delWishlist(item)"
                    >
                      <v-tooltip
                        color="red"
                        bottom
                      >
                        <template #activator="{on,attrs}">
                          <v-icon
                            v-bind="attrs"
                            v-on="on"
                          >
                            mdi-trash-can
                          </v-icon>
                        </template>
                        <span class="font-spartan-text white--text">
                          Delete From wishlist
                        </span>
                      </v-tooltip>
                    </v-btn>
                  </v-col>
                </v-row>
              </v-container>
            </v-img>
          </v-card>
        </v-hover>
      </v-col>
    </v-row>
    <v-col
      v-else
      cols="12"
      class="img--empety"
    >
      <v-img
        width="900"
        height="400"
        src="@/assets/img/noclass.svg"
      />
    </v-col>
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
      delWishlist (item) {
        this.$emit("del", { item: item })
        const index = this.data.findIndex(x => x.id === item.id)
        if (index !== -1) {
          this.data.splice(index, 1)
        }
      },
      setColorStatus (status) {
        if (status === "ongoing") {
          return "btn_primary"
        } else if (status === "upcoming") {
          return "secondary"
        } else return "red"
      },
    },
  }
</script>

<style></style>
