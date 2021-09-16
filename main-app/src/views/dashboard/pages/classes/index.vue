<template>
  <v-container>
    <v-row>
      <v-col>
        <v-card>
          <v-card-title
            class="d-flex justify-center text-h2 font-italic font-spartan"
          >
            {{ $t('classes') }}
          </v-card-title>
          <v-row>
            <v-col
              cols="12"
              md="4"
              class="ml-2"
            >
              <v-text-field
                v-model="search"
                :label="$t('search')"
                :placeholder="$t('search')"
                append-icon="mdi-magnify"
                outlined
                dense
                @input="searchMethods"
              />
            </v-col>
            <v-col cols="12">
              <div
                v-if="isLoading"
                class="d-flex justify-center"
              >
                <v-progress-circular
                  class="d-flex justify-center"
                  indeterminate
                  color="red"
                />
              </div>
              <span
                v-if="classes.length === 0"
                class="d-flex justify-center"
              >
                No Data Avalaible
              </span>
              <app-card
                v-else
                :classes="classes"
              />
            </v-col>
          </v-row>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
  import card from './components_core/_card.vue'
  export default {
    components: {
      'app-card': card,
    },
    data: () => ({
      search: '',
      isLoading: false,
    }),
    computed: {
      classes () {
        return this.$store.state.classes.data
      },
    },
    mounted () {
      this.getDataClasses()
    },
    methods: {
      getDataClasses () {
        this.$store
          .dispatch('classes/getDataClasses', {
            entities: 'img,studio',
            filter: 'Publish',
            q: this.search,
          })
          .then(res => {
            if (res.data.meta.status) {
              this.isLoading = false
            }
            if (this.classes.length === 0) {
              const Toast = this.$swal.mixin({
                toast: true,
                position: 'top-end',
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
                title: 'Data Not Found',
              })
            }
          })
      },
      searchMethods () {
        if (this.timer) {
          clearTimeout(this.timer)
          this.timer = null
        }
        this.timer = setTimeout(() => {
          this.getDataClasses()
          this.isLoading = true
        }, 700)
      },
    },
  }
</script>

<style></style>
