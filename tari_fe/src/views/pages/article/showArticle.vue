<template>
  <v-app>
    <v-container>
      <v-row
        justify="center"
        class="d-flex justify-center mb-6 ml-12 offset-mr-5"
      >
        <v-col>
          <v-card>
            <v-card-title class="d-flex justify-center">
              <h3 class="font-weight-dark text-capitalize">
                {{ article.title }}
              </h3>
            </v-card-title>
            <v-card-title class="d-flex justify-center">
              <h6
                v-if="article.author"
                class="font-weight-dark text-capitalize"
              >
                {{ article.author.nickName }} -
                {{ article.created_at | moment('dddd D MMM YYYY') }}
              </h6>
            </v-card-title>
            <v-card-text>
              <div class="ql-container ql-snow">
                <div class="ql-editor">
                  <div v-html="article.content" />
                </div>
              </div>
            </v-card-text>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
  </v-app>
</template>

<script>
  export default {
    computed: {
      article () {
        return this.$store.state.article.article
      },
    },
    mounted () {
      this.getDataArticleById()
    },
    methods: {
      getDataArticleById () {
        this.$store.dispatch('article/getDataArticleById', {
          id: this.$route.params.id,
        })
      },
    },
  }
</script>

<style lang="sass">
@import '~quill/dist/quill.snow.css'
</style>
