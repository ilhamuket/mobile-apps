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
                :label="$t('search')"
                :placeholder="$t('search')"
                append-icon="mdi-magnify"
                outlined
                dense
              />
            </v-col>
            <v-col cols="12">
              <app-card :classes="classes" />
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
    computed: {
      classes () {
        return this.$store.state.classes.data
      },
    },
    mounted () {
      this.getDataClasses()
      console.log(this.classes)
    },
    methods: {
      getDataClasses () {
        this.$store.dispatch('classes/getDataClasses', {
          entities: 'img,studio',
          filter: 'Publish',
        })
      },
    },
  }
</script>

<style></style>
