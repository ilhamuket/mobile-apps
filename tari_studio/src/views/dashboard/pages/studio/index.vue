<template>
  <v-app class="height">
    <v-container v-if="$store.state.studio.isLoad">
      <loader
        object="#ff9633"
        color1="#ffffff"
        color2="#17fd3d"
        size="5"
        speed="2"
        bg="#343a40"
        objectbg="#999793"
        opacity="80"
        disable-scrolling="false"
        name="spinning"
      />
      <v-skeleton-loader
        v-bind="attrs"
        type="card-avatar, article, actions"
      />
    </v-container>
    <v-container v-else>
      <v-row
        class="relative"
        :class="
          $vuetify.theme.dark
            ? 'customize-dark-scroll'
            : 'custumize-light-scroll'
        "
      >
        <v-col
          cols="12"
          md="3"
          class="mt-4"
        >
          <v-card>
            <v-card-title>
              <h4>
                {{ $t('search') }}
              </h4>
            </v-card-title>
            <v-card-text class="mt-6">
              <v-text-field
                v-model="search"
                :label="$t('search')"
                outlined
                dense
                @input="searchMethods"
              />
              <!-- <v-autocomplete
                label="Search By Category"
                outlined
                dense
                item-text="name"
                item-value="name"
              /> -->
            </v-card-text>
            <!-- <v-card-actions class="d-flex flex-row-reverse">
              <div class="d-flex flex-row-reverse">
                <div class="d-flex flex-column">
                  <v-btn
                    outlined
                    color="primary"
                  >
                    {{ $t('search') }}
                  </v-btn>
                </div>
              </div>
            </v-card-actions> -->
          </v-card>
        </v-col>
        <v-col
          cols="12"
          md="9"
          class="overflow"
        >
          <v-list class="overflow-y-auto">
            <app-data-list
              class="d-none d-md-flex"
              :data="studio"
            />
          </v-list>
        </v-col>
      </v-row>
    </v-container>
  </v-app>
</template>

<script>
  import list from './_list.vue'
  export default {
    components: {
      'app-data-list': list,
    },
    data: () => ({
      search: '',
      timer: null,
      isLoad: true,
      attrs: {
        class: 'mb-6',
        boilerplate: true,
        elevation: 2,
      },
    }),
    computed: {
      studio () {
        return this.$store.state.studio.data
      },
    },
    mounted () {
      this.getDataStudio()
    },
    methods: {
      getDataStudio () {
        this.$store.dispatch('studio/getDataStudio', {
          search: this.search,
          entities: 'member,author,img,followers,likes',
        })
      // .then(res => {
      //   if (res.data.meta.status) {
      //     this.isLoad = false
      //   }
      // })
      // this.$store.commit('studio/GET_OFF')
      },
      searchMethods () {
        if (this.timer) {
          clearTimeout(this.timer)
          this.timer = null
        }
        this.timer = setTimeout(() => {
          this.getDataStudio()
        }, 700)
      },
    },
  }
</script>

<style lang="sass">
.bg-dark
    background-color: #283046 !important
.theme--dark.v-expansion-panels .v-expansion-panel
    background-color: #283046 !important
    color: #FFFFFF
.relative
  overflow-y: hidden !important
  position: relative !important
</style>
