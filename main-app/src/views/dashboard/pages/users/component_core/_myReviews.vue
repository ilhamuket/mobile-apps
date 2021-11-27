<template>
  <v-container>
    <v-row v-if="!data">
      <v-col
        class="d-flex justify-center"
        cols="12"
      >
        <v-img :src="require('@/assets/img/perbaikan.png')" />
      </v-col>
    </v-row>
    <v-row>
      <v-col
        v-for="(item, i) in data"
        :key="i"
        cols="12"
      >
        <v-card>
          <v-container>
            <v-row>
              <v-col
                v-if="item.class"
                cols="12"
                md="3"
              >
                <v-img
                  v-if="item.class.img"
                  height="100"
                  :src="item.class.img.url"
                />
              </v-col>
              <v-col
                v-if="item.user"
                cols="12"
                md="7"
              >
                <span class="font-spartan-text">
                  {{ item.user.firstName }} {{ item.user.lastName }}</span>
                <br>
                <v-rating
                  :value="item.ratings"
                  readonly
                />

                <span class="font-spartan-small">
                  {{ item.body }}
                </span>
              </v-col>
            </v-row>
          </v-container>
        </v-card>
      </v-col>
    </v-row>
    <v-row>
      <v-col cols="12">
        <v-pagination
          v-model="page"
          :length="meta.last_page"
          @input="changePage"
        />
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
      meta: {
        type: Object,
        default: null,
      },
    },
    data: () => ({
      page: 1,
    }),
    methods: {
      changePage () {
        this.$emit("paginate", { item: this.page })
      },
    },
  }
</script>

<style></style>
