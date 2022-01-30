<template>
  <v-container>
    <v-row>
      <v-col>
        <!-- <v-card-title
            class="d-flex justify-center text-h2 font-italic font-spartan"
          >
            {{ $t('classes') }}
          </v-card-title> -->
        <v-row>
          <v-col
            cols="12"
            md="4"
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
          <v-col
            cols="12"
            md="2"
            sm="12"
            class="d-flex justify-end"
          >
            <span class="mt-2 mr-2 ml-2">{{ $t("sort") }}</span>
            <v-select
              v-model="filter"
              outlined
              dense
              :items="itemFilter"
            >
              <template
                slot="selection"
                slot-scope="data"
              >
                <slot
                  name="item"
                  v-bind="data"
                >
                  <span class="text-capitalize font-spartan-small">
                    {{ data.item }}
                  </span>
                </slot>
              </template>
              <template
                slot="item"
                slot-scope="data"
              >
                <slot
                  name="item"
                  v-bind="data"
                >
                  <span class="text-capitalize font-spartan-small">
                    {{ data.item }}
                  </span>
                </slot>
              </template>
            </v-select>
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

            <div v-if="classes.data">
              <app-card
                v-if="classes.data.length !== 0"
                :classes="classes.data"
              />
            </div>
            <div
              v-else
              class="d-flex justify-center"
            >
              <v-img
                width="900"
                height="400"
                src="@/assets/img/noclass.svg"
              />
            </div>
          </v-col>
        </v-row>
        <v-row
          v-if="is_load"
          class="d-flex justify-center"
        >
          <div>
            <v-progress-circular
              class="d-flex justify-center"
              indeterminate
              color="red"
            />
          </div>
        </v-row>
        <v-row
          v-if="first_load"
          class="d-flex justify-center"
        >
          <div>
            <v-progress-circular
              class="d-flex justify-center"
              indeterminate
              color="red"
            />
          </div>
        </v-row>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
  import card from "./components_core/_card.vue"
  export default {
    components: {
      "app-card": card,
    },
    data: () => ({
      inputHeight: "0",
      filter: "all",
      itemFilter: ["all", "ongoing", "upcoming", "missed"],
      search: "",
      isLoading: false,
      first_load: true,
      is_load: false,
      page: 1,
      classes: {
        meta: null,
        data: null,
        links: {
          next: null,
        },
      },
    }),
    computed: {
    // classes () {
    //   return this.$store.state.classes.data
    // },
    },
    watch: {
      filter () {
        this.page = 1
        this.getDataClasses(this.page)
      },
    },
    mounted () {
      if (this.search === "" || this.search === null) {
        this.getDataClasses(this.page)
      } else {
        this.getDataClassesSearch(this.page)
      }
      this.scroll()
    },
    methods: {
      getDataClasses (page) {
        this.$store
          .dispatch("classes/getDataClasses", {
            entities: "img,studio, lastSee, category",
            filter: "Publish",
            sort: "-views, id",
            status_kelas: this.filter,
            q: this.search,
            page: page,
          })
          .then((res) => {
            if (res.data.meta.status) {
              this.first_load = false
              this.isLoading = false
              this.classes.meta = res.data.meta
              this.classes.links = res.data.links
              if (page === 1) {
                this.classes.data = res.data.data
              } else {
                this.classes.data.push(...res.data.data)
                this.is_load = false
              }
            }
            if (this.classes.data.length === 0) {
              const Toast = this.$swal.mixin({
                toast: true,
                position: "top-end",
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
                title: "Data Not Found",
              })
            }
          })
      },
      scroll () {
        window.onscroll = () => {
          const bottomOfWindow =
            document.documentElement.scrollTop + window.innerHeight >=
            document.documentElement.offsetHeight - 150
          // console.log(bottomOfWindow)

          // setTimeout(() => {
          if (bottomOfWindow) {
            // setTimeout(() => {
            this.moreClass()

          // this.resize()
          // }, 3000)
          }
        // }, 3000)
        }
      },
      moreClass () {
        if (this.classes.links.next) {
          this.page++
          // console.log(this.page)
          this.is_load = true
          this.getDataClasses(this.page)
        }
      },
      getDataClassesSearch () {
        this.$store
          .dispatch("classes/getDataClassesSearch", {
            q: this.search,
            filter: "Publish",
            entities: "img,studio,category",
          })
          .then((res) => {
            if (res.data.meta.status) {
              this.classes.data = res.data.data
              // const index =  this.classes.data.findIndex(x => x.id === res.data.data.id)
              // this.classes.data
              this.isLoading = false
            }
          })
      },
      searchMethods () {
        if (this.timer) {
          clearTimeout(this.timer)
          this.timer = null
        }
        this.timer = setTimeout(() => {
          if (this.search) {
            this.getDataClassesSearch(null)
          } else {
            this.getDataClasses((this.page = 1))
          }
          this.isLoading = true
        }, 700)
      },
    },
  }
</script>

<style lang="sass">
.col__filter
  margin-left: 541px !important
  .text__filter
    margin-left: -67px !important
    margin-top: -2px !important
  .v-input
    margin-top: -29px
@media screen and (max-width: 500px)
  .col__filter
    // margin-left: 541px !important
    .text__filter
      margin-left: -67px !important
      margin-top: -2px !important
    .v-input
      margin-top: -29px
</style>
