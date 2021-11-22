<template>
  <v-container>
    <v-row>
      <v-col cols="12">
        <app-list-card :data="computedData" />
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
  import listCard from "./component_core/_list_card.vue"
  export default {
    components: {
      "app-list-card": listCard,
    },
    computed: {
      computedData () {
        return this.$store.state.my_class.data
      },
    },
    mounted () {
      this.getDataMyClass()
    },
    methods: {
      getDataMyClass () {
        this.$store
          .dispatch("my_class/getDataMyClass", {
            entities: "student,classes.img,classes.studio",
          })
          .then((res) => {
            console.log(res.data.data)
          })
      },
    },
  }
</script>

<style></style>
