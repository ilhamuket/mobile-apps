<template>
  <v-container>
    <v-row class="justify-center">
      <v-col
        cols="12"
        md="8"
        lg="8"
        xl="8"
      >
        <base-material-card icon="mdi-eye">
          <template #after-heading>
            <span class="font-spartan info--text"> Create Article </span>
          </template>
          <v-container>
            <v-row>
              <v-col cols="12">
                <v-text-field
                  v-model="article.title"
                  label="Title"
                  placeholder="Title Article"
                />
              </v-col>
              <v-col cols="12">
                <quillEditor
                  v-model="article.content"
                  class="quill--editor"
                />
              </v-col>
              <v-col
                cols="12"
                class="d-flex justify-end"
              >
                <v-btn
                  class=""
                  color="btn_primary"
                  @click="insertDataArticle"
                >
                  Create
                </v-btn>
              </v-col>
            </v-row>
          </v-container>
        </base-material-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
  import "quill/dist/quill.core.css"
  import "quill/dist/quill.snow.css"
  import "quill/dist/quill.bubble.css"

  import { quillEditor } from "vue-quill-editor"

  export default {
    components: {
      quillEditor,
    },
    data: () => ({
      article: {
        title: "",
        content: "",
      },
    }),
    methods: {
      insertDataArticle () {
        this.$store
          .dispatch("article/insertDataArticle", {
            title: this.article.title,
            content: this.article.content,
          })
          .then((res) => {
            if (res.data.meta.status) {
              this.$router.push("/article")
              const Toast = this.$swal.mixin({
                toast: true,
                position: "bottom-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                  toast.addEventListener("mouseenter", this.$swal.stopTimer)
                  toast.addEventListener("mouseleave", this.$swal.resumeTimer)
                },
                popup: "swal2-show",
                backdrop: "swal2-backdrop-show",
                icon: "swal2-icon-show",
              })
              Toast.fire({
                icon: "success",
                title: "Created Successfully",
              })
            } else {
              console.log(this.article.content)
              console.log("error")
            }
          })
      },
    },
  }
</script>

<style lang="sass">
.quill--editor
    height: 100vh
    margin: 0 0 5rem 0
</style>
