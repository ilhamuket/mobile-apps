<template>
  <v-app>
    <v-container>
      <v-row>
        <v-col>
          <base-material-card icon="mdi-eye">
            <template #heading>
              <h2>
                Create
              </h2>
            </template>

            <v-form class="mt-4">
              <v-text-field
                v-model="article.title"
                label="Title"
                placeholder="Input Title"
                dense
                outlined
              />
              <v-select
                v-model="article.status"
                label="Status"
                placeholder="Input Status"
                dense
                outlined
                :items="itemsStatus"
              />
              <v-autocomplete
                v-model="article.studio_id"
                label="Studio"
                placeholder="Input Studio"
                dense
                outlined
                :items="studio"
                item-text="name"
                item-value="id"
              />
              <!-- <v-text-field
                v-model="article.thumbnail_url"
                label="thumbnail_url"
                placeholder="Input thumbnail_url"
                dense
                outlined
              /> -->
              <vue-editor
                v-model="article.content"
                placeholder="Article ..."
              />

              <div class="d-flex flex-row-reverse mt-6">
                <div class="d-flex flex-column">
                  <v-btn
                    outlined
                    color="primary"
                    @click="updateDataArticleById"
                  >
                    Save
                  </v-btn>
                </div>
              </div>
            </v-form>
          </base-material-card>
        </v-col>
      </v-row>
    </v-container>
  </v-app>
</template>

<script>
  import { VueEditor } from 'vue2-quill-editor'
  export default {
    components: {
      VueEditor,
    },
    data: () => ({
      itemsStatus: ['priview', 'concept', 'publish'],
      form: {
        title: '',
        content: '',
        status: '',
        studio_id: 0,
        thumbnail_url: '',
      },
      customToolbar: [
        ['bold', 'italic', 'underline'],
        [{ list: 'ordered' }, { list: 'bullet' }],
        ['image', 'code-block'],
        ['Resize'],
      ],
    }),
    computed: {
      studio () {
        return this.$store.state.studio.data
      },
      article () {
        return this.$store.state.article.article
      },
    },
    mounted () {
      console.log(this.article.status)
      this.getDataStudio()
      this.getDataArticleById()
    },
    methods: {
      getDataArticleById () {
        this.$store.dispatch('article/getDataArticleById', {
          id: this.$route.params.id,
        })
      },
      getDataStudio () {
        this.$store.dispatch('studio/getData')
      },
      updateDataArticleById () {
        this.$store
          .dispatch('article/updateDataArticleById', {
            id: this.$route.params.id,
            title: this.article.title,
            content: this.article.content,
            status: this.article.status,
            studio_id: this.article.studio_id,
          // thumbnail_url: this.article.thumbnail_url,
          })
          .then(res => {
            if (res.data.meta.status) {
              const Toast = this.$swal.mixin({
                toast: true,
                position: 'bottom-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: toast => {
                  toast.addEventListener('mouseenter', this.$swal.stopTimer)
                  toast.addEventListener('mouseleave', this.$swal.resumeTimer)
                },
                popup: 'swal2-show',
                backdrop: 'swal2-backdrop-show',
                icon: 'swal2-icon-show',
              })

              Toast.fire({
                icon: 'success',
                title: 'Data has been successfully Edited',
              })
              this.$router.push('/journal')
            }
          })
      },
    },
  }
</script>

<style></style>
