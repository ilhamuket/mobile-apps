<template>
  <div>
    <v-container fluid>
      <app-row-detail-img />
      <app-card-detail-profile :data="computedDetail" />
    </v-container>
  </div>
</template>

<script>
  import rowDetail from "./component_core/_rowDetail.vue"
  import cardDetail from "./component_core/_cardDetail.vue"
  export default {
    components: {
      "app-row-detail-img": rowDetail,
      "app-card-detail-profile": cardDetail,
    },
    data: () => ({}),
    computed: {
      computedDetail () {
        return this.$store.state.instructor.detail
      },
    },
    mounted () {
      this.fetchDataDetailInstructor()
    },
    methods: {
      fetchDataDetailInstructor () {
        this.$store.dispatch("instructor/fetchDataDetailInstructor", {
          entities: "studio,img",
          slug: this.$route.params.slug,
        })
      },
    },
  }
</script>

<style lang="sass"></style>
