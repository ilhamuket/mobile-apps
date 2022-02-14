<template>
  <v-container class="overflow-auto">
    <v-row>
      <v-col
        cols="12"
        md="4"
      >
        <v-card class="rounded-sm">
          <v-img
            class="rounded-sm"
            :src="computedArticle.thumbnail_url"
          >
            <template v-slot:placeholder>
              <v-row
                class="fill-height ma-0"
                align="center"
                justify="center"
              >
                <v-progress-circular
                  indeterminate
                  color="grey lighten-5"
                />
              </v-row>
            </template>
          </v-img>
        </v-card>
      </v-col>
      <v-col
        cols="12"
        md="8"
      >
        <div class="mt-5">
          <div>
            <span class="font-spartan font-weight-bold"> Title Article </span>
          </div>
          <div>
            <span class="font-spartan font-weight-bold">
              {{ computedArticle.title }}
            </span>
          </div>
        </div>
        <v-divider class="my-4" />
        <div>
          <span class="font-spartan"> Keyword </span>
        </div>
        <div class="">
          <v-chip
            v-for="(item, i) in keyword"
            :key="i"
            label
            color="btn_primary"
            outlined
            class="ml-2"
          >
            {{ item }}
          </v-chip>
        </div>
        <v-divider class="my-4" />
        <div>
          <span
            class="font-spartan"
          >Created At :
            {{ computedArticle.created_at | moment("MMMM Do YYYY") }}</span>
        </div>
        <div class="ql-container ql-snow">
          <div class="ql-editor">
            <div v-html="computedArticle.content" />
          </div>
        </div>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
  export default {
    data: () => ({
      keyword: ["Hebat", "Jago", "Keren"],
    }),
    computed: {
      computedArticle () {
        return this.$store.state.article.show
      },
    },
    mounted () {
      this.showDataArticle()
    },
    methods: {
      showDataArticle () {
        this.$store.dispatch("article/showDataArticle", {
          id: this.$route.params.id,
        })
      },
    },
  }
</script>

<style>
@import "~quill/dist/quill.snow.css";
.ql-container {
  border-radius: 0.5rem;
}
</style>
